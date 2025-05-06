<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="img/favicon.png" />
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png" />
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
</head>
<body>
<?php  
      include 'header.php';
    ?>
    <section class="section-meals" id="meals">
        <div class="container center-text">
          <span class="subheading">Meals</span>
          <h2 class="heading-secondary">
           HealthyBite
          </h2>
        </div>

        <div class="container grid grid--3-cols margin-bottom-md">
          <div class="meal">
            <img
              src="img/meals/meal-1.jpg"
              class="meal-img"
              alt="Japanese Gyozas"
            />
            <div class="meal-content">
              <div class="meal-tags">
                <span class="tag tag--vegetarian">Vegetarian</span>
              </div>
              <p class="meal-title">Japanese Gyozas</p>
              <ul class="meal-attributes">
                <li class="meal-attribute">
                  <ion-icon class="meal-icon" name="flame-outline"></ion-icon>
                  <span><strong>650</strong> calories</span>
                </li>
                <li class="meal-attribute">
                  <ion-icon
                    class="meal-icon"
                    name="restaurant-outline"
                  ></ion-icon>
                  <span>NutriScore &reg; <strong>74</strong></span>
                </li>
                <li class="meal-attribute">
                  <ion-icon class="meal-icon" name="star-outline"></ion-icon>
                  <span><strong>4.9</strong> rating (537)</span>
                </li>
              </ul>
            </div>
          </div>

          <div class="meal">
            <img
              src="img/meals/meal-2.jpg"
              class="meal-img"
              alt="Avocado Salad"
            />
            <div class="meal-content">
              <div class="meal-tags">
                <span class="tag tag--vegan">Vegan</span>
                <span class="tag tag--paleo">Paleo</span>
              </div>
              <p class="meal-title">Avocado Salad</p>
              <ul class="meal-attributes">
                <li class="meal-attribute">
                  <ion-icon class="meal-icon" name="flame-outline"></ion-icon>
                  <span><strong>400</strong> calories</span>
                </li>
                <li class="meal-attribute">
                  <ion-icon
                    class="meal-icon"
                    name="restaurant-outline"
                  ></ion-icon>
                  <span>NutriScore &reg; <strong>92</strong></span>
                </li>
                <li class="meal-attribute">
                  <ion-icon class="meal-icon" name="star-outline"></ion-icon>
                  <span><strong>4.8</strong> rating (441)</span>
                </li>
              </ul>
            </div>
          </div>

          <div class="diets">
            <h3 class="heading-tertiary">Works with any diet:</h3>
            <ul class="list">
              <li class="list-item">
                <ion-icon class="list-icon" name="checkmark-outline"></ion-icon>
                <span>Vegetarian</span>
              </li>
              <li class="list-item">
                <ion-icon class="list-icon" name="checkmark-outline"></ion-icon>
                <span>Vegan</span>
              </li>
              <li class="list-item">
                <ion-icon class="list-icon" name="checkmark-outline"></ion-icon>
                <span>Pescatarian</span>
              </li>
              <li class="list-item">
                <ion-icon class="list-icon" name="checkmark-outline"></ion-icon>
                <span>Gluten-free</span>
              </li>
              <li class="list-item">
                <ion-icon class="list-icon" name="checkmark-outline"></ion-icon>
                <span>Lactose-free</span>
              </li>
              <li class="list-item">
                <ion-icon class="list-icon" name="checkmark-outline"></ion-icon>
                <span>Keto</span>
              </li>
              <li class="list-item">
                <ion-icon class="list-icon" name="checkmark-outline"></ion-icon>
                <span>Paleo</span>
              </li>
              <li class="list-item">
                <ion-icon class="list-icon" name="checkmark-outline"></ion-icon>
                <span>Low FODMAP</span>
              </li>
              <li class="list-item">
                <ion-icon class="list-icon" name="checkmark-outline"></ion-icon>
                <span>Kid-friendly</span>
              </li>
            </ul>
          </div>
        </div>

        <div class="container all-recipes">
          <a href="#" class="link">See all recipes &rarr;</a>
        </div>
      </section>
</body>
</html>