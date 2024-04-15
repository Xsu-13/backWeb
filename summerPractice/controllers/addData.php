<?php 

    include("../database/databaseService.php");
    global $sqlLogin; 
    global $sqlPass; 
    $db = new PDO('mysql:host=localhost;dbname=u67344', $sqlLogin, $sqlPass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        include("addDataPage.php");
      }
      
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST["AddClient"])){
          SaveClient($db);
          header('Location: ./dataTable.php');
          exit();
        }
        if(isset($_POST["AddLibrarian"])){
          SaveLibrarien($db);
          header('Location: ./dataTable.php');
          exit();
        }
        if(isset($_POST["AddFilm"])){
          SaveFilm($db);
          header('Location: ./dataTable.php');
          exit();
        }
      }
?>