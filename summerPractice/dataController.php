<?php 
    
    $user = 'u67344'; 
    $pass = '7915464'; 
    $db = new PDO('mysql:host=localhost;dbname=u67344', $user, $pass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $films = array();
        $films = GetFilms($db);
        include("dataPage.php");
      }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST["Delete"])){
            DeleteFilm($db, $_POST["film_id"]);
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
?>