<?php
session_start();
include '../database/database.php';


$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    function addToCart($productId, $Name, $price, $quantity) {
        $cartItem = array(
            'productId' => $productId,
            'productName' => $Name,
            'price' => $price,
            'quantity' => $quantity
        );

        
        if (array_key_exists($productId, $_SESSION['cart'])) {
            $_SESSION['cart'][$productId]['quantity'] += $quantity;
        } else {
            
            $_SESSION['cart'][$productId] = $cartItem;
        }
    }

 
    function removeFromCart($productId) {
        if (array_key_exists($productId, $_SESSION['cart'])) {
            unset($_SESSION['cart'][$productId]);
        }
    }

   
    if (isset($_POST['productId'], $_POST['Name'], $_POST['price'], $_POST['quantity'])) {
        $productId = $_POST['productId'];
        $Name = $_POST['Name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        addToCart($productId, $Name, $price, $quantity);
    }

    
    if (isset($_POST['removeProductId'])) {
        $removeProductId = $_POST['removeProductId'];
        removeFromCart($removeProductId);
    }

    
    if (isset($_POST['productId'], $_POST['newQuantity'])) {
        $productId = $_POST['productId'];
        $newQuantity = $_POST['newQuantity'];

        
        if ($newQuantity > 0) {
            $_SESSION['cart'][$productId]['quantity'] = $newQuantity;
        } else {
            
            removeFromCart($productId);
        }
    }

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href = "../asset/cart.css">
   
   
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
  <section class="shopping">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="continue"><a href="#!" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                                <hr>
                                <h1 class="mb-4">Shopping cart</h1>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $subtotal = 0;
                                                foreach ($_SESSION['cart'] as $productId => $cartItem) {
                                                    $subtotal += $cartItem['price'] * $cartItem['quantity'];
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $cartItem['productName']; ?></td>
                                                        <td>$ <?php echo $cartItem['price']; ?></td>
                                                        <td>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="productId" value="<?php echo $cartItem['productId']; ?>">
                                                                <input type="number" name="newQuantity" value="<?php echo $cartItem['quantity']; ?>" min="1" class="form-control">
                                                                <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="removeProductId" value="<?php echo $cartItem['productId']; ?>">
                                                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <p class="subtotal">Subtotal: $<?php echo number_format($subtotal, 2); ?></p>
                                    <form action="" method="post">
                                        <input type="hidden" name="clearCart" value="true">
                                        <button type="submit" class="btn btn-danger">
    <i class="fas fa-trash-alt"></i> Clear Cart
</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
    <div class="card-body">
    <div class="checkout-button pr-5 d-flex flex-column align-items-center">
    <?php if ($subtotal > 0): ?>
        <?php if (isset($_SESSION["user"])): ?>
            <button onclick="window.location.href='../checkout/checkout.php';" class="btn btn-success btn-checkout">Checkout</button>
        <?php else: ?>
            <button disabled class="btn btn-secondary btn-checkout">Checkout</button>
            <p class="text-danger mt-2">Please log in to proceed to checkout.</p>
        <?php endif; ?>
    <?php else: ?>
        <button disabled class="btn btn-secondary btn-checkout">Checkout</button>
        <p class="text-danger mt-2">Your cart is empty. Please add items to proceed to checkout.</p>
    <?php endif; ?>
</div>
    </div>
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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

</body>
</html>
    <?php
} else {
    echo "0 results found.";
}

mysqli_close($conn);
?>
