<?php
session_start();
include '../database/database.php';


$orderSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $paymentMethod = mysqli_real_escape_string($conn, $_POST['paymentMethod']);
    $totalAmount = mysqli_real_escape_string($conn, $_POST['totalAmount']);
    $cardNumber = isset($_POST['cardNumber']) ? mysqli_real_escape_string($conn, $_POST['cardNumber']) : '';
    $cvc = isset($_POST['cvc']) ? mysqli_real_escape_string($conn, $_POST['cvc']) : '';
    $expiryDate = isset($_POST['expiryDate']) ? mysqli_real_escape_string($conn, $_POST['expiryDate']) : '';
    $nameOnCard = isset($_POST['nameOnCard']) ? mysqli_real_escape_string($conn, $_POST['nameOnCard']) : '';

    
    $sql = "INSERT INTO Users (FullName, Email, Phone, Address) VALUES ('$fullName', '$email', '$phone', '$address')";
    if (!mysqli_query($conn, $sql)) {
        
        echo "Error: " . mysqli_error($conn);
        exit();
    }
    
    $userID = mysqli_insert_id($conn);
    $_SESSION['userId'] = $userID; 

    
    foreach ($_SESSION['cart'] as $productId => $cartItem) {
        $orderDate = date("Y-m-d H:i:s");
        $productID = $cartItem['productId'];
        $quantity = $cartItem['quantity'];
        $paymentStatus = 'Success';
        $totalAmount = $cartItem['price'] * $quantity;

        
        $orderQuery = "INSERT INTO Orders (UserID, ProductID, OrderDate, TotalAmount, Quantity, PaymentStatus) VALUES ('$userID', '$productID', '$orderDate', '$totalAmount', '$quantity', '$paymentStatus')";
        if (!mysqli_query($conn, $orderQuery)) {
            
            echo "Error: " . mysqli_error($conn);
            exit();
        }

       
        $orderID = mysqli_insert_id($conn);

        
        $paymentDate = date("Y-m-d");
        $paymentQuery = "INSERT INTO Payment (OrderID, UserID, PaymentDate, PaymentAmount, PaymentMethod, CardNumber, Cvc, ExpiryDate, NameOnCard) VALUES ('$orderID', '$userID', '$paymentDate', '$totalAmount', '$paymentMethod', '$cardNumber', '$cvc', '$expiryDate', '$nameOnCard')";
        if (!mysqli_query($conn, $paymentQuery)) {
            
            echo "Error: " . mysqli_error($conn);
            exit();
        }
    }

    unset($_SESSION['cart']);
    
    $orderSuccess = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
</head>
<body>
    <?php if ($orderSuccess): ?>
        <h1>Order Placed Successfully!</h1>
        <p>Thank you for your order. You will receive a confirmation email shortly.</p>
        <script>
            setTimeout(function(){
                window.location.href = '../index.php';
            }, 2000);
        </script>
    <?php endif; ?>
</body>
</html>
