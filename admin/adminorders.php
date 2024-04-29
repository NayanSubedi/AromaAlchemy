<?php

include('../database/database.php');


function getOrders() {
    global $conn;
    $sql = "SELECT * FROM orders";
    $result = mysqli_query($conn, $sql);
    return $result;
}


function addOrder($userID, $productID, $totalAmount, $quantity, $paymentStatus) {
    global $conn;
    $sql = "INSERT INTO orders (UserID, ProductID, TotalAmount, Quantity, PaymentStatus) 
            VALUES ('$userID', '$productID', '$totalAmount', '$quantity', '$paymentStatus')";
    mysqli_query($conn, $sql);
}


function updateOrder($id, $userID, $productID, $totalAmount, $quantity, $paymentStatus) {
    global $conn;
    $sql = "UPDATE orders SET UserID='$userID', ProductID='$productID', TotalAmount='$totalAmount', Quantity='$quantity', PaymentStatus='$paymentStatus' WHERE OrderID='$id'";
    mysqli_query($conn, $sql);
}


function deleteOrder($id) {
    global $conn;
    $sql = "DELETE FROM orders WHERE OrderID='$id'";
    mysqli_query($conn, $sql);
}


if(isset($_POST['submit'])) {
    
    if($_POST['action'] == 'add') {
        addOrder($_POST['userID'], $_POST['productID'], $_POST['totalAmount'], $_POST['quantity'], $_POST['paymentStatus']);
    } elseif($_POST['action'] == 'edit') {
        updateOrder($_POST['edit_id'], $_POST['userID'], $_POST['productID'], $_POST['totalAmount'], $_POST['quantity'], $_POST['paymentStatus']);
    }
}


if(isset($_GET['delete'])) {
    deleteOrder($_GET['delete']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Payment Management</title>
  <link rel="stylesheet" href="../styles/adminorders.css" />
 
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
      <h2>Admin Order Page</h2>
      <form method="post">
          <input type="hidden" name="action" value="add">
          <input type="text" name="userID" placeholder="User ID" required>
          <input type="text" name="productID" placeholder="Product ID" required>
          <input type="text" name="totalAmount" placeholder="Total Amount" required>
          <input type="text" name="quantity" placeholder="Quantity" required>
          <input type="text" name="paymentStatus" placeholder="Payment Status" required>
          <button type="submit" name="submit">Add Order</button>
      </form>

      <h3>Orders:</h3>
      <table border="1">
          <tr>
              <th>Order ID</th>
              <th>User ID</th>
              <th>Product ID</th>
              <th>Total Amount</th>
              <th>Quantity</th>
              <th>Payment Status</th>
              <th>Action</th>
          </tr>
          <div class="orders">
          <?php
          $orders = getOrders();
          while($row = mysqli_fetch_assoc($orders)) {
              echo "<tr>";
              echo "<td>".$row['OrderID']."</td>";
              echo "<td>".$row['UserID']."</td>";
              echo "<td>".$row['ProductID']."</td>";
              echo "<td>".$row['TotalAmount']."</td>";
              echo "<td>".$row['Quantity']."</td>";
              echo "<td>".$row['PaymentStatus']."</td>";
              echo "<td><a href='?edit=".$row['OrderID']."'>Edit</a> | <a href='?delete=".$row['OrderID']."'>Delete</a></td>";
              echo "</tr>";
          }
          ?>
      </table>

      <?php
      // Edit order
      if(isset($_GET['edit'])) {
          $editOrder = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM orders WHERE OrderID=".$_GET['edit']));
      ?>
      
      <h3>Edit Order:</h3>
      <form method="post">
          <input type="hidden" name="edit_id" value="<?php echo $editOrder['OrderID']; ?>">
          <input type="hidden" name="action" value="edit">
          <input type="text" name="userID" placeholder="User ID" value="<?php echo $editOrder['UserID']; ?>" required>
          <input type="text" name="productID" placeholder="Product ID" value="<?php echo $editOrder['ProductID']; ?>" required>
          <input type="text" name="totalAmount" placeholder="Total Amount" value="<?php echo $editOrder['TotalAmount']; ?>" required>
          <input type="text" name="quantity" placeholder="Quantity" value="<?php echo $editOrder['Quantity']; ?>" required>
          <input type="text" name="paymentStatus" placeholder="Payment Status" value="<?php echo $editOrder['PaymentStatus']; ?>" required>
          <button type="submit" name="submit">Update Order</button>
      </form>
      <?php } ?>
    </div>
  </div>
</body>
</html>