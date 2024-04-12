<?php 
    
    $user = 'u67344'; 
    $pass = '7915464'; 
    $db = new PDO('mysql:host=localhost;dbname=u67344', $user, $pass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $films = array();
        $films = GetFilms($db);
        //$films = [["title"=> "dhshd", "film_id"=>"1","director"=>"kjdshj", "year"=>"2003", "genre"=>"dsjhjds", "description" => "djskjjkdsg"],["film_id"=>"2","title"=> "dddddddddd", "director"=>"kjdshj", "year"=>"2003", "genre"=>"dsjhjds", "description" => "hhhhhhhh"]];
        include("dataPage.php");
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
                $result['fio'] = $row[$h]['Fio'];
                $result['field-tel'] = $row[$h]['Phone'];
                $result['field-email'] = $row[$h]['Email'];
                $result['gender'] = $row[$h]['Gender'];
                $result['field-date'] = $row[$h]['FormDate'];
                $result['bio'] = $row[$h]['Biography']; 
                $result['check-1'] = $row[$h]['AgreeCheck'];
                $result['id'] = $row[$h]['Id'];
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