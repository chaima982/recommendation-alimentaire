/* document.getElementById('bmiForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const height = parseFloat(document.getElementById('height').value);
  const weight = parseFloat(document.getElementById('weight').value);

  fetch('save-imc.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({ height, weight })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      const bmi = data.bmi;
      const status = data.status;
      let advice = "";

      if (bmi < 18.5) {
        advice = "Essayez des repas riches en protéines et graisses saines.";
      } else if (bmi < 25) {
        advice = "Maintenez une alimentation équilibrée.";
      } else {
        advice = "Réduisez les sucres et graisses, buvez beaucoup d’eau.";
      }

      document.getElementById('bmiValue').textContent = bmi;
      document.getElementById('status').textContent = status;
      document.getElementById('advice').innerHTML = `<p><strong>Conseil :</strong> ${advice}</p>`;
      document.getElementById('resultBox').style.display = 'block';
    } else {
      alert("Erreur : " + (data.error || "Calcul impossible."));
    }
  });
}); */