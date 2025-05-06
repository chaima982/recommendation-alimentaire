document.getElementById('bmiForm').addEventListener('submit', function (e) {
  e.preventDefault();
  const height = parseFloat(document.getElementById('height').value);
  const weight = parseFloat(document.getElementById('weight').value);
  const bmi = weight / (height * height);
  const resultBox = document.getElementById('resultBox');
  const bmiValue = document.getElementById('bmiValue');
  const status = document.getElementById('status');
  const advice = document.getElementById('advice');

  bmiValue.textContent = bmi.toFixed(2);

  let diagnosis = '';
  let tips = '';

  if (bmi < 18.5) {
    diagnosis = 'Underweight';
    tips = 'Try meals rich in protein, healthy fats, and more frequent meals.';
  } else if (bmi >= 18.5 && bmi <= 24.9) {
    diagnosis = 'Normal';
    tips = 'Maintain your balanced diet and stay active!';
  } else {
    diagnosis = 'Overweight / Obese';
    tips = 'Eat more vegetables, reduce sugar and fats, and drink plenty of water.';
  }

  status.textContent = diagnosis;
  advice.innerHTML = `<p><strong>Advice:</strong> ${tips}</p>`;

  resultBox.style.display = 'block';
});
