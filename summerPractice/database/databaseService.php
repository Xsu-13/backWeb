<?php

function SaveClient($db)
    {
      
      try{
        $stmt = $db->prepare("INSERT INTO clients (name, email, phone) VALUES (:namedb, :emaildb, :phonedb)");
        $stmt -> execute(['namedb'=>$_POST["client_name"], 'emaildb'=>$_POST["client_email"], 'phonedb'=>$_POST["client_phone"]]);
      }
      catch(PDOException $e){
        print('Error : ' . $e->getMessage());
        print_r($e->getTrace());
      }
      
    }

    function SaveLibrarien($db)
    {
      try{
        $stmt = $db->prepare("INSERT INTO librarians (name, email, phone) VALUES (:namedb, :emaildb, :phonedb)");
        $stmt -> execute(['namedb'=>$_POST["librarian_name"], 'emaildb'=>$_POST["librarian_email"], 'phonedb'=>$_POST["librarian_phone"]]);
      }
      catch(PDOException $e){
        print('Error : ' . $e->getMessage());
        print_r($e->getTrace());
      }
        
    }

    function SaveFilm($db)
    {
      try{
        $stmt = $db->prepare("INSERT INTO films (title, director, year, genre, description) VALUES (:titledb, :directordb, :yeardb, :genredb, :descriptiondb)");
        $stmt -> execute(['titledb'=>$_POST["title"], 'directordb'=>$_POST["director"], 'yeardb'=>$_POST["year"], 'genredb'=>$_POST["genre"], 'descriptiondb'=>$_POST["description"]]);
      }
      catch(PDOException $e){
        print('Error : ' . $e->getMessage());
        print_r($e->getTrace());
      }
        
    }

    function SaveLog($db)
    {
      $status = $_POST["return_status"]=1?"возвращен":"не возвращен";
      try{
        $stmt = $db->prepare("INSERT INTO issue_log (film_id, client_id, librarian_id, issue_date, return_date, return_status) VALUES (:film_id, :client_id, :librarian_id, :issue_date, :return_date, :return_status)");
        $stmt -> execute(['film_id'=>$_POST["filmActive_id"], 'client_id'=>$_POST["clientActive_id"], 'librarian_id'=>$_POST["librarianActive_id"], 'issue_date'=>$_POST["issue_date"], 'return_date'=>$_POST["return_date"], 'return_status'=>$status]);
      }
      catch(PDOException $e){
        print('Error : ' . $e->getMessage());
        print_r($e->getTrace());
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

    function GetLogs($db)
    {
      try{
        $sth = $db->prepare('SELECT issue_id, issue_date, return_date, return_status, title, c.name as clientName, l.name as libName FROM issue_log i Join films f On i.film_id=f.film_id Join librarians l On i.librarian_id=l.librarian_id Join clients c On i.client_id=c.client_id');
        $logs = array();
        $result = $sth->execute();
        $row = $sth->fetchAll();
        for($h = 0; $h < count($row); $h++) {
            $result = array();
            $result['issue_id'] = $row[$h]['issue_id'];
            $result['issue_date'] = $row[$h]['issue_date'];
            $result['return_date'] = $row[$h]['return_date'];
            $result['return_status'] = $row[$h]['return_status'];
            $result['title'] = $row[$h]['title'];
            $result['clientName'] = $row[$h]['clientName'];
            $result['libName'] = $row[$h]['libName'];
            $logs[$h] = $result;
        }
      }
      catch(PDOException $e){
        print_r($e->getTrace());
        exit();
      }
      return $logs;
    }

    function DeleteFilm($db, $id)
    {
        try{
            $sth = $db->prepare('DELETE FROM issue_log WHERE film_id = :id');
            $sth->execute(['id' => $id]);
            $sth = $db->prepare('DELETE FROM films WHERE film_id = :id');
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
            $sth = $db->prepare('DELETE FROM issue_log WHERE client_id = :id');
            $sth->execute(['id' => $id]);
            $sth = $db->prepare('DELETE FROM clients WHERE client_id = :id');
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
            $sth = $db->prepare('DELETE FROM issue_log WHERE librarian_id = :id');
            $sth->execute(['id' => $id]);
            $sth = $db->prepare('DELETE FROM librarians WHERE librarian_id = :id');
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

    function GetClientById($db, $id)
    {
        $result = array();
        $sth = $db->prepare('SELECT * FROM clients WHERE client_id = :id');
        $sth->execute(["id" => $id]);
            while($row = $sth->fetch()) {
                $result = array();
                $result['client_id'] = $row['client_id'];
                $result['name'] = $row['name'];
                $result['email'] = $row['email'];
                $result['phone'] = $row['phone'];
            }
        return $result;
    }

    function GetLibrarianById($db, $id)
    {
        $result = array();
        $sth = $db->prepare('SELECT * FROM librarians WHERE librarian_id = :id');
        $sth->execute(["id" => $id]);
            while($row = $sth->fetch()) {
                $result = array();
                $result['librarian_id'] = $row['librarian_id'];
                $result['name'] = $row['name'];
                $result['email'] = $row['email'];
                $result['phone'] = $row['phone'];
            }
        return $result;
    }

    function UpdateFilm($db, $id, $title, $director, $year, $genre, $description)
    {
        $stmt = $db->prepare("UPDATE films SET title = :title, director = :director, year = :year, genre = :genre, description = :description WHERE film_id = :id");
        $stmt -> execute(['title'=>$title, 'director'=>$director, 'year'=>$year,'genre'=>$genre,'description'=>$description, 'id'=>$id]);
    }

    function UpdateClient($db, $id, $name, $email, $phone)
    {
        $stmt = $db->prepare("UPDATE clients SET name = :name, email = :email, phone = :phone WHERE client_id = :id");
        $stmt -> execute(['name'=>$name, 'email'=>$email, 'phone'=>$phone, 'id'=>$id]);
    }

    function UpdateLibrarian($db, $id, $name, $email, $phone)
    {
        $stmt = $db->prepare("UPDATE librarians SET name = :name, email = :email, phone = :phone WHERE librarian_id = :id");
        $stmt -> execute(['name'=>$name, 'email'=>$email, 'phone'=>$phone, 'id'=>$id]);
    }
?>
