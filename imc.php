<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="HealthyBite is an AI-powered food subscription that will make you eat healthy again, 365 days per year." />
  
  <title>IMC Calculator</title>

  <link rel="stylesheet" href="css/style.css" />


  <script defer src="imc.js"></script>
</head>

<body>
<?php  
      include 'header.php';
    ?>
    
  <div style="background: #fff;
  padding: 30px;
  margin-top: 40px;
  box-shadow: 0 0 15px rgba(0,0,0,0.1);
  border-radius: 15px;
  width: 800px;
  text-align: center;"class="container">
    <h1 style="font-size:34px;">Calculate Your BMI (IMC)</h1>
    <form id="bmiForm">
      <input style="  display: block;
  width: 100%;
  
  margin: 10px auto;
  padding: 12px;
  border-radius: 10px;
  height:100%;
  border: 1px solid #ccc;
  font-size: 14px;"type="number" id="height" placeholder="Height (in meters)" step="0.01" required />
      <input style="  display: block;
  width: 90%;
  margin: 10px auto;
  padding: 12px;
  border-radius: 10px;
  border: 1px solid #ccc;
  font-size: 14px;" type="number" id="weight" placeholder="Weight (in kg)" step="0.1" required />
      <button style="  background-color: #2a9d8f;
  color: white;
  font-weight: bold;
  width:40%;
  margin-top:25px;
  cursor: pointer;
  font-size: 34px;
 "type="submit">Calculate</button>
    </form>

    <div style="  margin-top: 20px;
  padding: 20px;
  background-color: #e9f5f3;
  border-radius: 10px;" class="result" id="resultBox" style="display: none;">
      <img style="
  width: 200px;
  margin-bottom: 15px;"src="img/bite.png" alt="Logo" class="logo"/>
<p style="font-size: 28px; font-weight: bold; color: black;">
  <strong>Your BMI:</strong> <span id="bmiValue"></span>
</p>
<p style="font-size: 28px; font-weight: bold; color: black;">
  <strong>Status:</strong> <span id="status"></span>
</p>
      <div style="font-size: 28px; color: black;" id="advice"></div>
      <a style="  display: inline-block;
  margin-top: 10px;
  font-size: 26px;
  color: #2a9d8f;
  text-decoration: none;" href="recipes.html" class="arrow">→ See Recipes</a>
    </div>
  </div>

  <script src="imc.js"></script>
  <?php  
      include 'footer.php';
    ?>
</body>
</html>
