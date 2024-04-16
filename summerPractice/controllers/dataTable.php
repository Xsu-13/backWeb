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
        $logs = GetLogs($db);
        include("../pages/dataTablePage.php");
      }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST["DeleteFilm"])){
            DeleteFilm($db, $_POST["film_id"]);
            header('Location: ./dataTable.php');
          } 

        if(isset($_POST["DeleteClient"])){
            DeleteClient($db, $_POST["client_id"]);
            header('Location: ./dataTable.php');
          } 

        if(isset($_POST["DeleteLibrarian"])){
            DeleteLibrarian($db, $_POST["librarian_id"]);
            header('Location: ./dataTable.php');
          } 
          
        if(isset($_POST["EditFilm"])){
            $currentFilm = array();
            $currentFilm = GetFilmById($db, $_POST["film_id"]);
            include('../pages/editFilm.php');
          } 

        if(isset($_POST["EditClient"])){
            $currentClient = array();
            $currentClient = GetClientById($db, $_POST["client_id"]);
            include('../pages/editClient.php');
          } 

        if(isset($_POST["EditLibrarian"])){
            $currentLibrarian = array();
            $currentLibrarian = GetLibrarianById($db, $_POST["librarian_id"]);
            include('../pages/editLibrarian.php');
          } 

          if(isset($_POST["UpdateLibrarian"])){
            UpdateLibrarian($db, $_POST["librarian_id"], $_POST["librarian_name"], $_POST["librarian_email"], $_POST["librarian_phone"]);
            header('Location: ./dataTable.php');
            exit();
          } 

          if(isset($_POST["UpdateClient"])){
            UpdateClient($db, $_POST["client_id"],  $_POST["client_name"], $_POST["client_email"], $_POST["client_phone"]);
            header('Location: ./dataTable.php');
            exit();
          } 

          if(isset($_POST["UpdateFilm"])){
            UpdateFilm($db, $_POST["film_id"],  $_POST["film_title"], $_POST["film_director"], $_POST["film_year"], $_POST["film_genre"], $_POST["film_description"]);
            header('Location: ./dataTable.php');
            exit();
          } 
          
    }
?>