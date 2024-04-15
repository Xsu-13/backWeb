<?php 
    include("../database/databaseService.php");
    global $sqlLogin; 
    global $sqlPass; 
    $db = new PDO('mysql:host=localhost;dbname=u67344', $sqlLogin, $sqlPass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $type = "film";
        $films = array();
        $clients = array();
        $librarians = array();
        $films = GetFilms($db);
        $clients = GetClients($db);
        $librarians = GetLibrarians($db);
        include("dataTablePage.php");
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
          
    }
?>