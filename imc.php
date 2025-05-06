<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>IMC Calculator</title>
  <link rel="stylesheet" href="imc.css"/>
</head>
<body>
<?php  
      include 'header.php';
    ?>
    
  <div class="container">
    <h1>Calculate Your BMI (IMC)</h1>
    <form id="bmiForm">
      <input type="number" id="height" placeholder="Height (in meters)" step="0.01" required />
      <input type="number" id="weight" placeholder="Weight (in kg)" step="0.1" required />
      <button type="submit">Calculate</button>
    </form>

    <div class="result" id="resultBox" style="display: none;">
      <img src="img/bite.png" alt="Logo" class="logo"/>
      <p><strong>Your BMI:</strong> <span id="bmiValue"></span></p>
      <p><strong>Status:</strong> <span id="status"></span></p>
      <div id="advice"></div>
      <a href="recipes.html" class="arrow">→ See Recipes</a>
    </div>
  </div>

  <script src="imc.js"></script>
  <?php  
      include 'footer.php';
    ?>
</body>
</html>
