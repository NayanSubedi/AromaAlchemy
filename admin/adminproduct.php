<?php
include('../database/database.php');


function getProducts() {
    global $conn;
    $sql = "SELECT * FROM product";
    $result = mysqli_query($conn, $sql);
    return $result;
}


function addProduct($name, $brand, $description, $price, $quantity, $categoryID) {
    global $conn;
    $sql = "INSERT INTO product (Name, Brand, Description, Price, Quantity, CategoryID) 
            VALUES ('$name', '$brand', '$description', '$price', '$quantity', '$categoryID')";
    mysqli_query($conn, $sql);
}


function updateProduct($id, $name, $brand, $description, $price, $quantity, $categoryID) {
    global $conn;
    $sql = "UPDATE product SET Name='$name', Brand='$brand', Description='$description', Price='$price', Quantity='$quantity', CategoryID='$categoryID' WHERE ProductID='$id'";
    mysqli_query($conn, $sql);
}


function deleteProduct($id) {
    global $conn;
    $sql = "DELETE FROM product WHERE ProductID='$id'";
    mysqli_query($conn, $sql);
}


if(isset($_POST['submit'])) {
   
    if($_POST['action'] == 'add') {
        addProduct($_POST['name'], $_POST['brand'], $_POST['description'], $_POST['price'], $_POST['quantity'], $_POST['categoryID']);
    } elseif($_POST['action'] == 'edit') {
        updateProduct($_POST['edit_id'], $_POST['name'], $_POST['brand'], $_POST['description'], $_POST['price'], $_POST['quantity'], $_POST['categoryID']);
    }
}


if(isset($_GET['delete'])) {
    deleteProduct($_GET['delete']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Product Management</title>
  <link rel="stylesheet" href="../styles/adminproduct.css" />
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
      <h2>Admin Product Page</h2>
      
      <form method="post">
          <input type="hidden" name="action" value="add">
          
          <input type="text" name="name" placeholder="Product Name" required>
          <input type="text" name="brand" placeholder="Brand" required>
          <textarea name="description" placeholder="Description" required></textarea>
          <input type="text" name="price" placeholder="Price" required>
          <input type="text" name="quantity" placeholder="Quantity" required>
          <input type="text" name="categoryID" placeholder="Category ID" required>
          <button type="submit" name="submit">Add Product</button>
      </form>

      <h3>Products:</h3>
<table border="1">
    <tr>
        <th>Product ID</th> 
        <th>Name</th>
        <th>Brand</th>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Category ID</th>
        <th>Action</th>
    </tr>
    <?php
    $products = getProducts();
    while($row = mysqli_fetch_assoc($products)) {
        echo "<tr>";
        echo "<td>".$row['ProductID']."</td>"; 
        echo "<td>".$row['Name']."</td>";
        echo "<td>".$row['Brand']."</td>";
        echo "<td class='desc small'>".$row['Description']."</td>";

        echo "<td>".$row['Price']."</td>";
        echo "<td>".$row['Quantity']."</td>";
        echo "<td>".$row['CategoryID']."</td>";
        echo "<td><a href='?edit=".$row['ProductID']."'>Edit</a> | <a href='?delete=".$row['ProductID']."'>Delete</a></td>";
        echo "</tr>";
    }
    ?>
</table>


      
      <?php
      if(isset($_GET['edit'])) {
          $editProduct = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM product WHERE ProductID=".$_GET['edit']));
      ?>
      
      <h3>Edit Product:</h3>
      <form method="post">
          <input type="hidden" name="edit_id" value="<?php echo $editProduct['ProductID']; ?>">
          <input type="hidden" name="action" value="edit">
          <input type="text" name="name" placeholder="Product Name" value="<?php echo $editProduct['Name']; ?>" required>
          <input type="text" name="brand" placeholder="Brand" value="<?php echo $editProduct['Brand']; ?>" required>
          <textarea name="description" placeholder="Description" required><?php echo $editProduct['Description']; ?></textarea>
          <input type="text" name="price" placeholder="Price" value="<?php echo $editProduct['Price']; ?>" required>
          <input type="text" name="quantity" placeholder="Quantity" value="<?php echo $editProduct['Quantity']; ?>" required>
          <input type="text" name="categoryID" placeholder="Category ID" value="<?php echo $editProduct['CategoryID']; ?>" required>
          <button type="submit" name="submit">Update Product</button>
      </form>
      <?php } ?>
    </div>
  </div>
</body>
</html>
