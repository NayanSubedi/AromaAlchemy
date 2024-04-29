<?php
session_start();

?>    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Display</title>
 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #D9DDDC; 
        }

        .product {
            border: 1px solid #ddd; 
            margin: 5px; 
            padding: 5px;
            cursor: pointer; 
            width:200px;
        }

        .product img {
            max-width: 100%;
            height: auto; 
            
           

        }
        .navbar-nav .nav-link.dropdown-toggle2::after {
    display: none;
}
.product-name,
    .product-price {
        display: none;
    }

    .product:hover .product-name,
    .product:hover .product-price {
        display: block;
    }

    </style>
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


<div class="container">
    <div class="row" id="product-container">
    <i class="bi bi-filter"></i>
        
       
    <?php
        include '../database/database.php';

        $query = "SELECT p.ProductID, p.Name, p.Price, i.ImagePath 
                  FROM product p
                  LEFT JOIN Images i ON p.ProductID = i.ProductID";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $count = 0;
            while ($row = $result->fetch_assoc()) {
                if ($count % 5 == 0) {
                    echo '</div><div class="row">';
                }
                ?>
                <div class="row-md-2">
                    <div class="product">
                        <a href="productsdetails.php?productId=<?= $row['ProductID'] ?>">
                            <img src="<?= $row['ImagePath'] ?>" alt="<?= $row['Name'] ?>" class="product-image">
                        </a>
                        <h6 class="product-name"><?= $row['Name'] ?></h6>
                        <p class="product-price">$<?= number_format($row['Price'], 2) ?></p>
                    </div>
                </div>
                <?php
                $count++;
            }
        } else {
            echo 'No products found.';
        }

        $conn->close();
        ?>
    </div>
</div>
<footer class="footer  bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h5>Quick Links</h5>
          <ul class="list-unstyled">
          <li><a href="../index.php">Home</a></li>
            <li><a href="#">Products</a></li>
            
            <li><a href="comingsoon.php">Sale</a></li>
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

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
