<?php
session_start();
include '../database/database.php';

if (isset($_GET['productId'])) {
    $productId = $_GET['productId'];

    $query = "SELECT p.*, c.CategoryName, i.ImagePath FROM product p
    JOIN category c ON p.CategoryID = c.CategoryID
    LEFT JOIN Images i ON p.ProductID = i.ProductID
    WHERE p.ProductID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();


    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <title><?= isset($product['Name']) ? $product['Name'] . ' Details' : 'Product Details' ?></title>
    <link rel="stylesheet" href="../styles/productsdetails.css">
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
      <a href="../index.php">
  <img class="navbar-brand" src="../assets/AromaAlchemy.png" alt="Logo" width="70" height="70">
</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
            </li>
            </ul>
            </li>

            <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="productdisplay.php">Product</a>
            </li>
            </ul>
            <ul class="navbar-nav">
           
            </li>
            <li class="nav-item">
              <a class="nav-link" href="comingsoon.php">Sale</a>
            </li>
  

            
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>

          <?php
          
if (isset($_SESSION["user"])) {
    
    echo '
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle2" href="#" id="navbarDropdownMenuUser" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuUser">
                <li><a class="dropdown-item" href="#">My Account</a></li>
                <li><a class="dropdown-item" href="../login/logout.php">Logout</a></li>
            </ul>
        </li>
    ';
} else {
   
    echo '<li class="nav-item"><a class="nav-link" href="../login/login.php"><i class="bi bi-person"></i></a></li>';
}
?>

            <li class="nav-item">
              <a class="nav-link" href="../cart/cart.php">
                <i class="bi bi-cart"></i> 
              </a>
            </li>
          
        </div>
      </div>
    </nav>
  </header>



<?php if (isset($product) && !empty($product)): ?>
    <div class="product-container">
        <div class="product-details">
            <div class="product-image-container">
                <img src="<?= isset($product['ImagePath']) ? $product['ImagePath'] : '' ?>" alt="<?= isset($product['Name']) ? $product['Name'] : '' ?>" class="product-image">
            </div>
            <div class="product-info">
                <h1><?= isset($product['Name']) ? $product['Name'] : '' ?></h1>
                <p><strong>Brand:</strong> <?= isset($product['Brand']) ? $product['Brand'] : '' ?></p>
                <p><strong>Category:</strong> <?= isset($product['CategoryName']) ? $product['CategoryName'] : '' ?></p>
                <p><strong>Description:</strong> <?= isset($product['Description']) ? $product['Description'] : '' ?></p>
                <p><strong>Price:</strong> $<?= isset($product['Price']) ? number_format($product['Price'], 2) : '' ?></p>
               
                <form action="../cart/cart.php" method="post">
    <input type="hidden" name="productId" value="<?= isset($product['ProductID']) ? $product['ProductID'] : '' ?>">
    <input type="hidden" name="Name" value="<?= isset($product['Name']) ? $product['Name'] : '' ?>">
    <input type="hidden" name="price" value="<?= isset($product['Price']) ? $product['Price'] : '' ?>">
    <input type="hidden" name="quantity" value="1">

    <button type="submit" class="btn btn-primary btn-buy-now add-to-cart-btn"
            style="background-color: black; color: white;">
        <i class="bi bi-cart-plus"></i> Add to Cart
    </button>
</form>


</div>

            </div>
        </div>
    </div>

    
    <div class="similar-products-container">
        <h2>More Products</h2>
        <div class="row">
            <?php
           
            $similarQuery = "SELECT p.*, i.ImagePath FROM product p
                             LEFT JOIN Images i ON p.ProductID = i.ProductID
                             WHERE p.CategoryID = {$product['CategoryID']} AND p.ProductID != $productId
                             LIMIT 4";
            $similarResult = $conn->query($similarQuery);

            if ($similarResult->num_rows > 0) {
                while ($similarProduct = $similarResult->fetch_assoc()) {
                  
                    ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="<?= isset($similarProduct['ImagePath']) ? $similarProduct['ImagePath'] : '' ?>" class="card-img-top" alt="<?= isset($similarProduct['Name']) ? $similarProduct['Name'] : '' ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= isset($similarProduct['Name']) ? $similarProduct['Name'] : '' ?></h5>
                                <p class="card-text">$<?= isset($similarProduct['Price']) ? number_format($similarProduct['Price'], 2) : '' ?></p>
                                <a href="productsdetails.php?productId=<?= $similarProduct['ProductID'] ?> "class="btn btn-primary">View Details</a>

                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p>No similar products found.</p>';
            }
            ?>
        </div>
    </div>
<?php else: ?>
    <p>Product not found.</p>
<?php endif; ?>

<footer class="footer  bg-light">
<div class="container">
      <div class="row">
        <div class="col-md-4">
          <h5>Quick Links</h5>
          <ul class="list-unstyled">
            <li><a href="../index.php">Home</a></li>
            <li><a href="#">Products</a></li>
            
            <li><a href="comingsoon.php">Sale</a></li>
          </ul>
        </div>
        
        <div class="col-md-4">
          <h5>Contact Us</h5>
          <address>
            <strong>Aroma Alchemy</strong><br>
            Kathmandu<br>
            Nepal, 44600<br>
            9746493682 <br>
          </address>
        </div>
        <div class="col-md-4">
          <h5>Subscribe to Our Newsletter</h5>
          <form>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" placeholder="your email address">
            </div>
            <button type="submit" class="btn btn-primary">Subscribe</button>
          </form>
        </div>
      </div>
    </div>



    <div class="container text-center mt-3">
      <span class="text-muted">© 2024 Aroma Alchemy</span>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
   
    document.addEventListener('DOMContentLoaded', function () {
        const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
        
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-product-id');
                const productName = this.getAttribute('data-product-name');
                const productPrice = this.getAttribute('data-product-price');
                const productImage = this.getAttribute('data-product-image');
                
                addToCart(productId, productName, productPrice, productImage);
            });
        });

        function addToCart(productId, productName, productPrice, productImage) {
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert('Product added to cart!');
                    } else {
                        alert('Failed to add product to cart. Please try again.');
                    }
                }
            };
            xhr.open('POST', '../cart/cart.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.send(`productId=${productId}&productName=${productName}&price=${productPrice}&quantity=1&imagePath=${productImage}`);
        }
    });
</script>
</body>
</html>

<?php
    } else {
        echo 'Product not found.';
    }
} else {
    echo 'Invalid product ID.';
}

$conn->close();
?>
