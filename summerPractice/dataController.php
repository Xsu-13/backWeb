<?php 
    
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
        include("dataPage.php");
      }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST["DeleteFilm"])){
            DeleteFilm($db, $_POST["film_id"]);
            header('Location: ./dataController.php');
          } 
        if(isset($_POST["DeleteClient"])){
            DeleteClient($db, $_POST["client_id"]);
            header('Location: ./dataController.php');
          } 
        if(isset($_POST["DeleteLibrarian"])){
            DeleteLibrarian($db, $_POST["librarian_id"]);
            header('Location: ./dataController.php');
          } 
          
        if(isset($_POST["EditFilm"])){
            $currentFilm = array();
            $currentFilm = GetFilmById($db, $id);
            include('editFilm.php');
          } 
          
    }

    function GetFilms($db)
    {
        try{
            $sth = $db->prepare('SELECT * FROM films');
            $films = array();
            $result = $sth->execute();
            $row = $sth->fetchAll();
            for($h = 0; $h < count($row); $h++) {
                $result = array();
                $result['film_id'] = $row[$h]['film_id'];
                $result['title'] = $row[$h]['title'];
                $result['director'] = $row[$h]['director'];
                $result['year'] = $row[$h]['year'];
                $result['genre'] = $row[$h]['genre'];
                $result['description'] = $row[$h]['description']; 
                $films[$h] = $result;
            }
          }
          catch(PDOException $e){
            print_r($e->getTrace());
            exit();
          }
          return $films;
    }
    function GetClients($db)
    {
        try{
            $sth = $db->prepare('SELECT * FROM clients');
            $clients = array();
            $result = $sth->execute();
            $row = $sth->fetchAll();
            for($h = 0; $h < count($row); $h++) {
                $result = array();
                $result['client_id'] = $row[$h]['client_id'];
                $result['name'] = $row[$h]['name'];
                $result['phone'] = $row[$h]['phone'];
                $result['email'] = $row[$h]['email'];
                $clients[$h] = $result;
            }
          }
          catch(PDOException $e){
            print_r($e->getTrace());
            exit();
          }
          return $clients;
    }
    function GetLibrarians($db)
    {
        try{
            $sth = $db->prepare('SELECT * FROM librarians');
            $librarians = array();
            $result = $sth->execute();
            $row = $sth->fetchAll();
            for($h = 0; $h < count($row); $h++) {
                $result = array();
                $result['librarian_id'] = $row[$h]['librarian_id'];
                $result['name'] = $row[$h]['name'];
                $result['phone'] = $row[$h]['phone'];
                $result['email'] = $row[$h]['email'];
                $librarians[$h] = $result;
            }
          }
          catch(PDOException $e){
            print_r($e->getTrace());
            exit();
          }
          return $librarians;
    }

    function DeleteFilm($db, $id)
    {
        try{
            $sth = $db->prepare('DELETE FROM films WHERE film_id = :id');
            $sth->execute(['id' => $id]);
            $sth = $db->prepare('DELETE FROM issue_log WHERE film_id = :id');
            $sth->execute(['id' => $id]);
          }
          catch(PDOException $e){
            print_r($e->getTrace());
            exit();
          }
    }

    function DeleteClient($db, $id)
    {
        try{
            $sth = $db->prepare('DELETE FROM clients WHERE client_id = :id');
            $sth->execute(['id' => $id]);
            $sth = $db->prepare('DELETE FROM issue_log WHERE client_id = :id');
            $sth->execute(['id' => $id]);
          }
          catch(PDOException $e){
            print_r($e->getTrace());
            exit();
          }
    }

    function DeleteLibrarian($db, $id)
    {
        try{
            $sth = $db->prepare('DELETE FROM librarian WHERE librarian_id = :id');
            $sth->execute(['id' => $id]);
            $sth = $db->prepare('DELETE FROM issue_log WHERE librarian_id = :id');
            $sth->execute(['id' => $id]);
          }
          catch(PDOException $e){
            print_r($e->getTrace());
            exit();
          }
    }

    function GetFilmById($db, $id)
    {
        $result = array();
        $sth = $db->prepare('SELECT * FROM films WHERE film_id = :id');
        $sth->execute(["id" => $id]);
            while($row = $sth->fetch()) {
                $result = array();
                $result['film_id'] = $row['film_id'];
                $result['title'] = $row['title'];
                $result['director'] = $row['director'];
                $result['year'] = $row['year'];
                $result['genre'] = $row['genre'];
                $result['description'] = $row['description']; 
            }
        return $result;
    }
?>