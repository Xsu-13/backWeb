<?php 
    $user = 'u67344'; 
    $pass = '7915464'; 
    $db = new PDO('mysql:host=localhost;dbname=u67344', $user, $pass,
    [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        include("adminEditorPage.php");
        
      }
      
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST["AddClient"])){
          SaveClient($db);
          header('Location: ./dataController.php');
          exit();
        }
      }
    
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
        $stmt -> execute(['namedb'=>$_POST["client_name"], 'emaildb'=>$_POST["client_email"], 'phonedb'=>$_POST["client_phone"]]);
      }
      catch(PDOException $e){
        print('Error : ' . $e->getMessage());
        print_r($e->getTrace());
      }
        
    }

    function SaveFilm($db)
    {
      try{
        $stmt = $db->prepare("INSERT INTO librarians (name, email, phone) VALUES (:namedb, :emaildb, :phonedb)");
        $stmt -> execute(['namedb'=>$_POST["client_name"], 'emaildb'=>$_POST["client_email"], 'phonedb'=>$_POST["client_phone"]]);
      }
      catch(PDOException $e){
        print('Error : ' . $e->getMessage());
        print_r($e->getTrace());
      }
        
    }
?>