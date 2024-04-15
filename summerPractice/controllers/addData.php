<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        include("addDataPage.php");
      }
      
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $db = getDb();

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