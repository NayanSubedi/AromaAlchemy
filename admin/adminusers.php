<?php

include('../database/database.php');


function getUsers() {
    global $conn;
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    return $result;
}


function addUser($fullName, $email, $username, $password, $repeatPassword, $address, $phone, $userType) {
    global $conn;
    $sql = "INSERT INTO users (FullName, Email, Username, Password, RepeatPassword, Address, Phone, usertype) 
            VALUES ('$fullName', '$email', '$username', '$password', '$repeatPassword', '$address', '$phone', '$userType')";
    mysqli_query($conn, $sql);
}


function updateUser($id, $fullName, $email, $username, $password, $repeatPassword, $address, $phone, $userType) {
    global $conn;
    $sql = "UPDATE users SET FullName='$fullName', Email='$email', Username='$username', Password='$password', RepeatPassword='$repeatPassword', Address='$address', Phone='$phone', usertype='$userType' WHERE UserID='$id'";
    mysqli_query($conn, $sql);
}


function deleteUser($id) {
    global $conn;
    $sql = "DELETE FROM users WHERE UserID='$id'";
    mysqli_query($conn, $sql);
}


if(isset($_POST['submit'])) {
   
    if($_POST['action'] == 'add') {
        addUser($_POST['fullName'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['repeatPassword'], $_POST['address'], $_POST['phone'], $_POST['usertype']);
    } elseif($_POST['action'] == 'edit') {
        updateUser($_POST['edit_id'], $_POST['fullName'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['repeatPassword'], $_POST['address'], $_POST['phone'], $_POST['usertype']);
    }
}


if(isset($_GET['delete'])) {
    deleteUser($_GET['delete']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Management</title>
  <link rel="stylesheet" href="../styles/adminusers.css" />
 
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
      <h2>Admin User Page</h2>
      <form method="post">
          <input type="hidden" name="action" value="add">
          <input type="text" name="fullName" placeholder="Full Name" required>
          <input type="email" name="email" placeholder="Email" required>
          <input type="text" name="username" placeholder="Username" required>
          <input type="password" name="password" placeholder="Password" required>
          <input type="password" name="repeatPassword" placeholder="Repeat Password" required>
          <input type="text" name="address" placeholder="Address">
          <input type="text" name="phone" placeholder="Phone">
          <input type="text" name="usertype" value="user" readonly>
          <button type="submit" name="submit">Add User</button>
      </form>

      <h3>Users:</h3>
      <table border="1">
          <tr>
              <th>Full Name</th>
              <th>Email</th>
              <th>Username</th>
              <th>Address</th>
              <th>Phone</th>
              <th>User Type</th>
              <th>Action</th>
          </tr>
          <div class="users">
          <?php
          $users = getUsers();
          while($row = mysqli_fetch_assoc($users)) {
              echo "<tr>";
              echo "<td>".$row['FullName']."</td>";
              echo "<td>".$row['Email']."</td>";
              echo "<td>".$row['Username']."</td>";
              echo "<td>".$row['Address']."</td>";
              echo "<td>".$row['Phone']."</td>";
              echo "<td>".$row['usertype']."</td>";
              echo "<td><a href='?edit=".$row['UserID']."'>Edit</a> | <a href='?delete=".$row['UserID']."'>Delete</a></td>";
              echo "</tr>";
          }
          ?>
      </table>

      <?php
      // Edit user
      if(isset($_GET['edit'])) {
          $editUser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE UserID=".$_GET['edit']));
      ?>
      
      <h3>Edit User:</h3>
      <form method="post">
          <input type="hidden" name="edit_id" value="<?php echo $editUser['UserID']; ?>">
          <input type="hidden" name="action" value="edit">
          <input type="text" name="fullName" placeholder="Full Name" value="<?php echo $editUser['FullName']; ?>" required>
          <input type="email" name="email" placeholder="Email" value="<?php echo $editUser['Email']; ?>" required>
          <input type="text" name="username" placeholder="Username"  value="<?php echo $editUser['Username']; ?>" required>
          <input type="password" name="password" placeholder="Password" value="<?php echo $editUser['Password']; ?>" required>
          <input type="password" name="repeatPassword"placeholder="RepeatPassword" value="<?php echo $editUser['RepeatPassword']; ?>" required>
          <input type="text" name="address" placeholder="Address"value="<?php echo $editUser['Address']; ?>">
          <input type="text" name="phone" placeholder="Phone" value="<?php echo $editUser['Phone']; ?>">
          <input type="text" name="usertype" placeholder="Usertype"value="<?php echo $editUser['usertype']; ?>" readonly>
          <button type="submit" name="submit">Update User</button>
      </form>
      <?php } ?>
    </div>
  </div>

    
    </div> 
  </div>
</body>
</html>
