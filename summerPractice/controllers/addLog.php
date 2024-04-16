<?php 
    include("../database/databaseService.php");
    $user = 'u67344'; 
    $pass = '7915464'; 
    $db = new PDO('mysql:host=localhost;dbname=u67344', $user, $pass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $type = "film";
        $films = array();
        $clients = array();
        $librarians = array();
        $films = GetFilms($db);
        $clients = GetClients($db);
        $librarians = GetLibrarians($db);
        include("../pages/addLogPage.php");
      }
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST["AddLog"])){
          SaveLog($db);
          header('Location: ./dataTable.php');
          exit();
        }
      }
?>