<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="checkout.css">
 
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
              <a class="nav-link active" aria-current="page" href="../products/productdisplay.php">Product</a>
            </li>
            </ul>
            <ul class="navbar-nav">
           
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../products/comingsoon.php">Sale</a>
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
  <div class="container p-auto ">
    <div class="rounded">
        <h1>Checkout</h1>
        <form action="process_payment.php" method="post">
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="fullName" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"required >
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone"required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address"required></textarea>
            </div>
            <div class="mb-3">
                <label for="paymentMethod" class="form-label">Payment Method</label>
                <select class="form-select" id="paymentMethod" name="paymentMethod">
                    <option value="Mastercard">Mastercard</option>
                    <option value="Visa">Visa</option>
                    <option value="American Express">American Express</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="cardNumber" class="form-label">Card Number</label>
                <input type="text" class="form-control" id="cardNumber" name="cardNumber"required>
            </div>
            <div class="mb-3">
                <label for="cvc" class="form-label">CVC</label>
                <input type="text" class="form-control" id="cvc" name="cvc"required>
            </div>
            <div class="row">
    <div class="col">
        <label for="expiryMonth" class="form-label">Expiry Month</label>
        <select class="form-select" id="expiryMonth" name="expiryMonth" required>
            <option value="" selected disabled>Select Month</option>
            <?php for ($i = 1; $i <= 12; $i++): ?>
                <option value="<?php echo $i; ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></option>
            <?php endfor; ?>
        </select>
    </div>
    <div class="col">
        <label for="expiryYear" class="form-label">Expiry Year</label>
        <select class="form-select" id="expiryYear" name="expiryYear" required>
            <option value="" selected disabled>Select Year</option>
            <?php
            $currentYear = date('Y');
            for ($i = $currentYear; $i <= $currentYear + 10; $i++): ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
    </div>
</div>
            <div class="mb-3">
                <label for="nameOnCard" class="form-label">Name on Card</label>
                <input type="text" class="form-control" id="nameOnCard" name="nameOnCard"required>
            </div>
</div>

<?php
                                                $subtotal = 0;
                                                foreach ($_SESSION['cart'] as $productId => $cartItem) {
                                                    $subtotal += $cartItem['price'] * $cartItem['quantity'];
                                                }?>
                                                    
        <div class="mb-3">
    
    <p class="subtotal">Subtotal: $<?php echo number_format($subtotal, 2); ?></p>
</div>
<div class="mb-3">
    <label for="promoCode" class="form-label">Promo Code</label>
    <input type="text" class="form-control" id="promoCode" name="promoCode">
</div>
<button type="button" class="btn btn-primary" id="applyPromoBtn">Apply</button>

          
            <input type="hidden" name="totalAmount" value="<?php echo $subtotal; ?>">
            <button type="submit" class="btn btn-primary">Pay Now</button>
        </form>
    </div>
</body>
<footer class="footer  bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h5>Quick Links</h5>
          <ul class="list-unstyled">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#">Brands</a></li>
            <li><a href="#">Sale</a></li>
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
  
  

</html>

