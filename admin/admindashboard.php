<?php

include('../database/database.php');
?>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard </title>
  <link rel="stylesheet" href="../styles/admindashboard.css" />
  
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
        <li><a href="../login/login.php" class="logout">
          <i class="fas fa-sign-out-alt"></i>
          <span class="nav-item">Log out</span>
        </a></li>
      </ul>
    </nav>
    <section class="main">
      <div class="main-top">
       

        <p id="datetime"></p>
      </div>
      <div class="main-skills">

    <section class="main">
      <div class="main-top">
        <h1>Admin Managment System</h1>
        
      </div>
      <div class="main-skills">
        <div class="card">
          <i class="fas fa-users" ></i>
          <h3>Users</h3>
          <a href="adminusers.php"><button>Click Here</button></a>
          
        </div>
        <div class="card">
          <i class="fas fa-shopping-bag"></i>
          <h3>Products</h3>
          <a href="adminproduct.php"><button>Click Here</button></a>
          
        </div>
        <div class="card">
          <i class="fas fa-archive"></i>
          <h3>Orders</h3>
          
          <a href="adminusers.php"><button>Click Here</button></a>
        </div>
        <div class="card">
          <i class="fas fa-credit-card"></i>
          <h3>Payments</h3>
        
          <a href="adminusers.php"><button>Click Here</button></a>
        </div>
      </div>


    </section>
  </div>
  <script>
    
    function updateDateTime() {
      const dateTimeElement = document.getElementById('datetime');
      const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', timeZoneName: 'short' };
      const currentDateTime = new Date().toLocaleDateString('en-US', options);
      dateTimeElement.textContent = currentDateTime;
    }

  
    updateDateTime();

    setInterval(updateDateTime, 1000);
  </script>
</body>
</html>