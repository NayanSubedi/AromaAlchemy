<?php
session_start();
?>      
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <style>
    .blur-background {
      background-image: url('assets/bg-img1.png');
      background-size: cover;
      background-position: center;
      height: 100vh;
      width: 100%;
      margin: 0 auto;
      z-index: -1;
    }

    .content {
    position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      color: white;
      z-index: 1;
    }

    .content h2,
    .content p {
      margin-bottom: 40px;
    } 

    .shop-now-btn {
      background: transparent;
      border: 2px solid white;
      padding: 10px 20px;
      color: white;
      text-decoration: none;
      transition: background 0.3s ease-in-out;
    }

    .shop-now-btn:hover {
      background: rgba(255, 255, 255, 0.2);
    }

    #btn-back-to-top {
  position: fixed;
  bottom: 20px;
  right: 20px;
  display: none;
  border-radius: 55%;
}

.navbar-nav .nav-link.dropdown-toggle2::after {
    display: none;
}


  </style>
</head>

<body>

  <header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
      <a href="index.php">
  <img class="navbar-brand" src="assets/AromaAlchemy.png" alt="Logo" width="70" height="70">
</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            </ul>
            </li>

            <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../AromaAlchemy/products/productdisplay.php">Product</a>
            </li>
            </ul>
            <ul class="navbar-nav">
           
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../AromaAlchemy/products/comingsoon.php">Sale</a>
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
                <li><a class="dropdown-item" href="../AromaAlchemy/login/logout.php">Logout</a></li>
            </ul>
        </li>
    ';
} else {
   
    echo '<li class="nav-item"><a class="nav-link" href="../AromaAlchemy/login/login.php"><i class="bi bi-person"></i></a></li>';
}
?>

            <li class="nav-item">
              <a class="nav-link" href="../AromaAlchemy/cart/cart.php">
                <i class="bi bi-cart"></i> <span id="cart-item" > </span></a>
            </li>
          
        </div>
      </div>
    </nav>
  </header>



  <div class="blur-background"> 

  

  <div class="text-white fs-1 text-center p-5">
  <h2 class="text-white fs-1 text-center p-5" >Welcome to AromaAlchemy</h2>
  <p class="text-white p-5 text-center fs-4">
      Explore our exquisite collection of fine fragrances. Each perfume is crafted with passion and precision to elevate
      your senses. Find the perfect scent that resonates with your style and personality.
    </p>
    <a href="../AromaAlchemy/products/productdisplay.php" class="btn btn-primary shop-now-btn">Shop Now</a>

    <button
        type="button"
        class="btn btn-danger btn-floating btn-lg"
        id="btn-back-to-top"
        >
  <i class="bi bi-arrow-up"></i>
</button>

  </div>
    
</div>




  <div class="container">



 



  </div>
  




<script>
  let mybutton = document.getElementById("btn-back-to-top");


window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (
    document.body.scrollTop > 20 ||
    document.documentElement.scrollTop > 20
  ) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

mybutton.addEventListener("click", backToTop);

function backToTop() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>

  <footer class="footer  bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h5>Quick Links</h5>
          <ul class="list-unstyled">
            <li><a href="index.php">Home</a></li>
            <li><a href="../AromaAlchemy/products/productdisplay.php">Products</a></li>
            
            <li><a href="../AromaAlchemy/products/comingsoon.php">Sale</a></li>
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



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
