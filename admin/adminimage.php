<?php

include('../database/database.php');

function getImages() {
    global $conn;
    $sql = "SELECT * FROM images";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function addImage($title, $path, $productID) {
    global $conn;
    $sql = "INSERT INTO images (ImageTitle, ImagePath, ProductID) 
            VALUES ('$title', '$path', '$productID')";
    mysqli_query($conn, $sql);
}

function updateImage($id, $title, $path, $productID) {
    global $conn;
    $sql = "UPDATE images SET ImageTitle='$title', ImagePath='$path', ProductID='$productID' WHERE ImageID='$id'";
    mysqli_query($conn, $sql);
}

function deleteImage($id) {
    global $conn;
    $sql = "DELETE FROM images WHERE ImageID='$id'";
    mysqli_query($conn, $sql);
}

if(isset($_POST['submit'])) {

    if($_POST['action'] == 'add') {
        addImage($_POST['title'], $_POST['path'], $_POST['productID']);
    } elseif($_POST['action'] == 'edit') {
        updateImage($_POST['edit_id'], $_POST['title'], $_POST['path'], $_POST['productID']);
    }
}

if(isset($_GET['delete'])) {
    deleteImage($_GET['delete']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Image Management</title>
  <link rel="stylesheet" href="adminpanel.css" />
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
      <h2>Admin Image Page</h2>
      
      <form method="post">
          <input type="hidden" name="action" value="add">
        
          <input type="text" name="title" placeholder="Image Title" required>
          <input type="text" name="path" placeholder="Image Path" required>
          <input type="text" name="productID" placeholder="Product ID" required>
          <button type="submit" name="submit">Add Image</button>
      </form>

      <h3>Images:</h3>
      <table border="1">
          <tr>
              <th>Title</th>
              <th>Path</th>
              <th>Product ID</th>
              <th>Action</th>
          </tr>
          <?php
          $images = getImages();
          while($row = mysqli_fetch_assoc($images)) {
              echo "<tr>";
              echo "<td>".$row['ImageTitle']."</td>";
              echo "<td>".$row['ImagePath']."</td>";
              echo "<td>".$row['ProductID']."</td>";
              echo "<td><a href='?edit=".$row['ImageID']."'>Edit</a> | <a href='?delete=".$row['ImageID']."'>Delete</a></td>";
              echo "</tr>";
          }
          ?>
      </table>

    
      <?php
      if(isset($_GET['edit'])) {
          $editImage = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM images WHERE ImageID=".$_GET['edit']));
      ?>
      
      <h3>Edit Image:</h3>
      <form method="post">
          <input type="hidden" name="edit_id" value="<?php echo $editImage['ImageID']; ?>">
          <input type="hidden" name="action" value="edit">
          <input type="text" name="title" placeholder="Image Title" value="<?php echo $editImage['ImageTitle']; ?>" required>
          <input type="text" name="path" placeholder="Image Path" value="<?php echo $editImage['ImagePath']; ?>" required>
          <input type="text" name="productID" placeholder="Product ID" value="<?php echo $editImage['ProductID']; ?>" required>
          <button type="submit" name="submit">Update Image</button>
      </form>
      <?php } ?>
    </div>
  </div>
</body>
</html>
