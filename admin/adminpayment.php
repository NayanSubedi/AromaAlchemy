<?php

include('../database/database.php');


function getPayments() {
    global $conn;
    $sql = "SELECT * FROM payment";
    $result = mysqli_query($conn, $sql);
    return $result;
}


function addPayment($orderID, $userID, $paymentDate, $paymentAmount, $paymentMethod, $cardNumber, $cvc, $expiryDate, $nameOnCard) {
    global $conn;
    $sql = "INSERT INTO payment (OrderID, UserID, PaymentDate, PaymentAmount, PaymentMethod, CardNumber, Cvc, ExpiryDate, NameOnCard) 
            VALUES ('$orderID', '$userID', '$paymentDate', '$paymentAmount', '$paymentMethod', '$cardNumber', '$cvc', '$expiryDate', '$nameOnCard')";
    mysqli_query($conn, $sql);
}


function updatePayment($id, $orderID, $userID, $paymentDate, $paymentAmount, $paymentMethod, $cardNumber, $cvc, $expiryDate, $nameOnCard) {
    global $conn;
    $sql = "UPDATE payment SET OrderID='$orderID', UserID='$userID', PaymentDate='$paymentDate', PaymentAmount='$paymentAmount', 
            PaymentMethod='$paymentMethod', CardNumber='$cardNumber', Cvc='$cvc', ExpiryDate='$expiryDate', NameOnCard='$nameOnCard' WHERE PaymentID='$id'";
    mysqli_query($conn, $sql);
}


function deletePayment($id) {
    global $conn;
    $sql = "DELETE FROM payment WHERE PaymentID='$id'";
    mysqli_query($conn, $sql);
}


if(isset($_POST['submit'])) {
   
    if($_POST['action'] == 'add') {
        addPayment($_POST['orderID'], $_POST['userID'], $_POST['paymentDate'], $_POST['paymentAmount'], $_POST['paymentMethod'], $_POST['cardNumber'], $_POST['cvc'], $_POST['expiryDate'], $_POST['nameOnCard']);
    } elseif($_POST['action'] == 'edit') {
        updatePayment($_POST['edit_id'], $_POST['orderID'], $_POST['userID'], $_POST['paymentDate'], $_POST['paymentAmount'], $_POST['paymentMethod'], $_POST['cardNumber'], $_POST['cvc'], $_POST['expiryDate'], $_POST['nameOnCard']);
    }
}


if(isset($_GET['delete'])) {
    deletePayment($_GET['delete']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Payment Management</title>
  <link rel="stylesheet" href="../styles/adminpayment.css" />
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<body>
  <div class="container">
  <nav>
      <ul>
        <li><a href="admindashboard.php" class="logo">
          <span class="nav-item">DashBoard</span>
        </a></li>
        <li><a href="admindashboard.php">
          <i class="fas fa-home"></i>
          <span class="nav-item">Home</span>
        </a></li>
        <li><a href="adminusers.php">
          <i class="fas fa-user"></i>
          <span class="nav-item">Users</span>
        </a></li>
        <li><a href="adminproduct.php">
        <i class="fas fa-shopping-bag"></i>
          <span class="nav-item">Products</span>
        </a></li>
        <li><a href="adminorders.php">
          <i class="fas fa-archive"></i>
          <span class="nav-item">Orders</span>
        </a></li>
      
        <li><a href="adminpayment.php">
          <i class="fas fa-credit-card"></i>
          <span class="nav-item">Payment</span>
        </a></li>
        <li><a href="">
          <i class="fas fa-question-circle"></i>
          <span class="nav-item">Help</span>
        </a></li>
        <li><a href="login.php" class="logout">
          <i class="fas fa-sign-out-alt"></i>
          <span class="nav-item">Log out</span>
        </a></li>
      </ul>
    </nav>

    <div class="content">
      <h2>Admin Payment Page</h2>
      <form method="post">
          <input type="hidden" name="action" value="add">
        
          <input type="text" name="orderID" placeholder="Order ID" required>
          <input type="text" name="userID" placeholder="User ID" required>
          <input type="date" name="paymentDate" placeholder="Payment Date" required>
          <input type="text" name="paymentAmount" placeholder="Payment Amount" required>
          <input type="text" name="paymentMethod" placeholder="Payment Method" required>
          <input type="text" name="cardNumber" placeholder="Card Number" required>
          <input type="text" name="cvc" placeholder="CVC" required>
          <input type="date" name="expiryDate" placeholder="Expiry Date" required>
          <input type="text" name="nameOnCard" placeholder="Name On Card" required>
          <button type="submit" name="submit">Add Payment</button>
      </form>

      <h3>Payments:</h3>
      <table border="1">
          <tr>
              <th>Order ID</th>
              <th>User ID</th>
              <th>Payment Date</th>
              <th>Payment Amount</th>
              <th>Payment Method</th>
              <th>Card Number</th>
              <th>CVC</th>
              <th>Expiry Date</th>
              <th>Name On Card</th>
              <th>Action</th>
          </tr>
          <div class="payments">
          <?php
          $payments = getPayments();
          while($row = mysqli_fetch_assoc($payments)) {
              echo "<tr>";
              echo "<td>".$row['OrderID']."</td>";
              echo "<td>".$row['UserID']."</td>";
              echo "<td>".$row['PaymentDate']."</td>";
              echo "<td>".$row['PaymentAmount']."</td>";
              echo "<td>".$row['PaymentMethod']."</td>";
              echo "<td>".$row['CardNumber']."</td>";
              echo "<td>".$row['Cvc']."</td>";
              echo "<td>".$row['ExpiryDate']."</td>";
              echo "<td>".$row['NameOnCard']."</td>";
              echo "<td><a href='?edit=".$row['PaymentID']."'>Edit</a> | <a href='?delete=".$row['PaymentID']."'>Delete</a></td>";
              echo "</tr>";
          }
          ?>
      </table>

      <?php
      // Edit payment
      if(isset($_GET['edit'])) {
          $editPayment = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM payment WHERE PaymentID=".$_GET['edit']));
      ?>
      
      <h3>Edit Payment:</h3>
      <form method="post">
          <input type="hidden" name="edit_id" value="<?php echo $editPayment['PaymentID']; ?>">
          <input type="hidden" name="action" value="edit">
          <input type="text" name="orderID" placeholder="Order ID" value="<?php echo $editPayment['OrderID']; ?>" required>
          <input type="text" name="userID" placeholder="User ID" value="<?php echo $editPayment['UserID']; ?>" required>
          <input type="date" name="paymentDate" placeholder="Payment Date" value="<?php echo $editPayment['PaymentDate']; ?>" required>
          <input type="text" name="paymentAmount" placeholder="Payment Amount" value="<?php echo $editPayment['PaymentAmount']; ?>" required>
          <input type="text" name="paymentMethod" placeholder="Payment Method" value="<?php echo $editPayment['PaymentMethod']; ?>" required>
          <input type="text" name="cardNumber" placeholder="Card Number" value="<?php echo $editPayment['CardNumber']; ?>" required>
          <input type="text" name="cvc" placeholder="CVC" value="<?php echo $editPayment['Cvc']; ?>" required>
          <input type="date" name="expiryDate" placeholder="Expiry Date" value="<?php echo $editPayment['ExpiryDate']; ?>" required>
          <input type="text" name="nameOnCard" placeholder="Name On Card" value="<?php echo $editPayment['NameOnCard']; ?>" required>
          <button type="submit" name="submit">Update Payment</button>
      </form>
      <?php } ?>
    </div>
  </div>
</body>
</html>
