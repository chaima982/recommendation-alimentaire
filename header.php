
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="description"
      content="HealthyBite is an AI-powered food subscription that will make you eat healthy again, 365 days per year. It's tailored to your personal tastes and nutritional needs."
    />

    <!-- Always include this line of code!!! -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


   
    <link rel="manifest" href="manifest.webmanifest" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="css/general.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/queries.css" />

    <script
      type="module"
      src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule=""
      src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"
    ></script>

    <script
      defer
      src="https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js"
    ></script>
    <script defer src="js/script.js"></script>

    <title> &mdash; HealthyBite!</title>
</head>
<body>
      <header class="header">
      <a href="#">
        <img class="logo" alt="HealthyBite logo" src="img/bite.png" />
      </a>

      <nav class="main-nav">
        <ul class="main-nav-list">
        <li>
            <a class="main-nav-link" href="index.php">Home</a>
          </li>
          <li><a class="main-nav-link" href="imc.php">IMC</a></li>
          <!-- <li><a class="main-nav-link" href="meals.php">Meals</a></li> -->
        
          <?php if (isset($_SESSION['user_id'])): ?>
    <?php if ($_SESSION['user_id'] == 1): ?>
        <!-- Admin -->
        <li><a class="main-nav-link" href="admindashboard.php">Dashboard</a></li>
    <?php else: ?>
        <!-- Client -->
        <li><a class="main-nav-link" href="dashboard.php">Dashboard</a></li>
    <?php endif; ?>
<?php endif; ?>

         
          <li><a class="main-nav-link nav-cta" href="register.php">Try for free</a></li>
        </ul>
      </nav>

      <button class="btn-mobile-nav">
        <ion-icon class="icon-mobile-nav" name="menu-outline"></ion-icon>
        <ion-icon class="icon-mobile-nav" name="close-outline"></ion-icon>
      </button>
    </header>
</body>
</html>