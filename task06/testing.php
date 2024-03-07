<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Statistics</title>
  <style>
    .chart-container {
      width: 50%;
      display: flex;
      margin: 20px;
    }
    .chart-column {
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      margin: 0 20px;
      height: 500px;
    }
    .column{
        background-color: rgb(24, 60, 63);
        width: 50px;
        height: 100px;
    }
    .line{
        height: 400px;
        display: flex;
        flex-direction: column;
        justify-content: end;
    }
  </style>
</head>
<body>

<h2>User Statistics</h2>

<div class="chart-container"> 
  <div class="chart-column" id="maleChart">
    <h3>Male Users</h3>
    <div class="line">
        <div class="column" id="male-column"></div>
        <p id="maleCount">0</p>
    </div>
    
  </div>
  <div class="chart-column" id="femaleChart">
    <h3>Female Users</h3>
    <div class="line">
        <div class="column" id="female-column"></div>
        <p id="femaleCount">0</p>
    </div>
  </div>
  <!-- Добавьте другие столбцы для статистики по аналогии -->
</div>
<?php


  // Пример данных пользователей для статистики
  /*
  var userDataForStatistics = [
    { "Javascript": 4 },
    { "Golang" : 2 },
    { "Pascal": 7 },
    { "Java": 10 }
    // Добавьте другие записи пользователей по аналогии
  ];

  // Функция для подсчета статистики
  function calculateStatistics() {
    var maleCount = 0;
    var femaleCount = 0;
    var sum = 0;
    // Добавьте другие переменные для статистики по аналогии

    userDataForStatistics.forEach(function(user) {
      if (user.Gender === "Male") {
        maleCount++;
      } else if (user.Gender === "Female") {
        femaleCount++;
      }
      sum++;
      // Добавьте другую логику для статистики по аналогии
    });

    // Отображение статистики в HTML
    document.getElementById('maleCount').innerText = maleCount;
    document.getElementById('femaleCount').innerText = femaleCount;

    document.getElementById('male-column').style.height = 500/sum*maleCount + "px";
    document.getElementById('female-column').style.height = 500/sum*femaleCount + "px";
    // Обновите другие элементы для отображения статистики по аналогии
  }

  // Инициализация статистики при загрузке страницы
  calculateStatistics();
  */
?>

</body>
</html>