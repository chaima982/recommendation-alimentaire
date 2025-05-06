<!DOCTYPE html>
<html lang="en">
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

    <title>HealthyBite </title>
  </head>
  <body>
    <?php  
      include 'header.php';
    ?>
   <!--  <header class="header">
      <a href="#">
        <img class="logo" alt="HealthyBite logo" src="img/bite.png" />
      </a>

      <nav class="main-nav">
        <ul class="main-nav-list">
          <li><a class="main-nav-link" href="imc.html">IMC</a></li>
          <li><a class="main-nav-link" href="meals.html">Meals</a></li>
          <li>
            <a class="main-nav-link" href="#testimonials">Testimonials</a>
          </li>
          <li><a class="main-nav-link" href="dashboard.html">Dashboard</a></li>
         
          <li><a class="main-nav-link nav-cta" href="connexion.html">Try for free</a></li>
        </ul>
      </nav>

      <button class="btn-mobile-nav">
        <ion-icon class="icon-mobile-nav" name="menu-outline"></ion-icon>
        <ion-icon class="icon-mobile-nav" name="close-outline"></ion-icon>
      </button>
    </header>
 -->
    <main>
      <section class="section-hero">
        <div class="hero">
          <div class="hero-text-box">
            <h1 class="heading-primary">
              Your health, your taste — smart meals made just for you
            </h1>
            <p class="hero-description">
              Discover a new way to eat better every day. Our intelligent food recommendation system tailors meal suggestions to your unique body, goals,
               and taste preferences. Whether you're looking to lose weight, gain energy, or simply eat healthier,
               we've got the perfect plate waiting for you — powered by data, designed for you.
            </p>
            <a href="connexion.html" class="btn btn--full margin-right-sm"
              >Start eating well</a
            >

            <a href="how.html" class="btn btn--outline">Learn more &darr;</a>
           
          </div>
          <div class="hero-img-box">
            <picture>
              <source srcset="img/hero.webp" type="image/webp" />
              <source srcset="img/hero-min.png" type="image/png" />

              <img
                src="img/hero-min.png"
                class="hero-img"
                alt="Woman enjoying food, meals in storage container, and food bowls on a table"
              />
            </picture>
          </div>
        </div>
      </section>

      <section class="section-featured">
       
      </section>

  

      <section class="section-testimonials" id="testimonials">
        <div class="testimonials-container">
          <span class="subheading">Testimonials</span>
          <h2 class="heading-secondary">Welcome to Food Recommender - Your Personalized Guide to Healthy Eating!</h2>

          <div class="testimonials">
              <blockquote class="testimonial-text">
                

                Discover the best food recommendations tailored to your preferences. Whether you're looking for high-protein meals, low-calorie options, or delicious snacks, our system offers customized suggestions that meet your dietary needs. With our intuitive dashboard, you can easily view recommendations, edit your preferences, and track your progress.
                
                Join us today to make smarter food choices and improve your overall health. Healthy eating starts with the right recommendations!
              </blockquote>
            </figure>

          
          </div>
        </div>

        <div class="gallery">
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-1.jpg"
              alt="Photo of beautifully
            arranged food"
            />
            <!-- <figcaption>Caption</figcaption> -->
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-2.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-3.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-4.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-5.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-6.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-7.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-8.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-9.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-10.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-11.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-12.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
        </div>
      </section>

  

      <section class="section-cta" id="cta">
        <div class="container">
          <div class="cta">
            <div class="cta-text-box">
              <h2 class="heading-secondary">Not just food. Food that fits you !</h2>
              <p class="cta-text">
                Healthy, tasty and hassle-free meals are waiting for you. Start
                eating well today. You can cancel or pause anytime. And the
                first meal is on us!
              </p>

              <form class="cta-form" name="sign-up" netlify>
                <div>
                  <label for="full-name">Full Name</label>
                  <input
                    id="full-name"
                    type="text"
                    placeholder="tap your name"
                    name="full-name"
                    required
                  />
                </div>

                <div>
                  <label for="email">Email address</label>
                  <input
                    id="email"
                    type="email"
                    placeholder="name@example.com"
                    name="email"
                    required
                  />
                </div>

                <div>
                  <label for="select-where">Where did you hear from us?</label>
                  <select id="select-where" name="select-where" required>
                    <option value="">Please choose one option:</option>
                    <option value="friends">Friends and family</option>
                    <option value="youtube">YouTube video</option>
                    <option value="podcast">Podcast</option>
                    <option value="ad">Facebook ad</option>
                    <option value="others">Others</option>
                  </select>
                </div>

                <button class="btn btn--form">Sign up now</button>

                <!-- <input type="checkbox" />
                <input type="number" /> -->
              </form>
            </div>
            <div
              class="cta-img-box"
              role="img"
              aria-label="Woman enjoying food"
            ></div>
          </div>
        </div>
      </section>
    </main>
    <?php  
      include 'footer.php';
    ?>
   <!--  <footer class="footer">
      <div class="container grid grid--footer">
        <div class="logo-col">
          <a href="#" class="footer-logo">
            <img class="logo" alt="health" src="img/bite.png" />
          </a>

          <ul class="social-links">
            <li>
              <a class="footer-link" href="#"
                ><ion-icon class="social-icon" name="logo-instagram"></ion-icon
              ></a>
            </li>
            <li>
              <a class="footer-link" href="#"
                ><ion-icon class="social-icon" name="logo-facebook"></ion-icon
              ></a>
            </li>
            <li>
              <a class="footer-link" href="#"
                ><ion-icon class="social-icon" name="logo-twitter"></ion-icon
              ></a>
            </li>
          </ul>

          <p class="copyright">
            Made with ❤️ 
          </p>
        </div>

        <div class="address-col">
          <p class="footer-heading">Contact us</p>
          <address class="contacts">
            <p class="address">
              Rue de Martyrs, NO ., Jemmel,Monastir, Tunisia
            </p>
            <p>
              <a class="footer-link" href="tel:415-201-6370">+216 </a
              ><br />
              <a class="footer-link" href="mailto:hello@healthyBite.com"
                >HealthyBite@gmail.com</a
              >
            </p>
          </address>
        </div>

        <nav class="nav-col">
          <p class="footer-heading">Account</p>
          <ul class="footer-nav">
            <li><a class="footer-link" href="#">Create account</a></li>
            <li><a class="footer-link" href="#">Sign in</a></li>
            <li><a class="footer-link" href="#">iOS app</a></li>
            <li><a class="footer-link" href="#">Android app</a></li>
          </ul>
        </nav>

        <nav class="nav-col">
          <p class="footer-heading">Company</p>
          <ul class="footer-nav">
            <li><a class="footer-link" href="#">About healthyBite</a></li>
            <li><a class="footer-link" href="#">For Business</a></li>
            <li><a class="footer-link" href="#">Cooking partners</a></li>
            <li><a class="footer-link" href="#">Careers</a></li>
          </ul>
        </nav>

        <nav class="nav-col">
          <p class="footer-heading">Resources</p>
          <ul class="footer-nav">
            <li><a class="footer-link" href="#">Recipe directory </a></li>
            <li><a class="footer-link" href="#">Help center</a></li>
            <li><a class="footer-link" href="#">Privacy & terms</a></li>
          </ul>
        </nav>
      </div>
    </footer> -->
  </body>
</html>
