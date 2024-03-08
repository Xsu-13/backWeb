<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  print('Страничка редактирования.');
  $langs = $_COOKIE['langs_value'];
  $id = $_COOKIE["id"];

  include("editUserPage.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST["Close"])){
    header('Location: ./admin.php');
    exit();
  } 

  if(isset($_POST["Edit"])){
    SaveUser();
    header('Location: ./admin.php');
    exit();
  }
}


function SaveUser()
{
  $user = 'u67344'; // Заменить на ваш логин uXXXXX
  $pass = '7915464'; // Заменить на пароль, такой же, как от SSH
  $db = new PDO('mysql:host=localhost;dbname=u67344', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    $formId = $_COOKIE["id"];

    $agree = empty($_POST["editAgreeCheck"])?'off':"on";
    $stmt = $db->prepare("UPDATE Forms SET Fio = :fio, Phone = :phone, Email = :email, FormDate = :formDate, Gender = :gender, Biography = :biography, AgreeCheck = :agreeCheck WHERE Id = :id");
    $stmt -> execute(['fio'=>$_POST["editFio"], 'phone'=>$_POST["editPhone"], 'email'=>$_POST["editEmail"],'formDate'=>$_POST["editFormDate"],'gender'=>$_POST["gender"],'biography'=>$_POST["editBiography"], 'agreeCheck'=>$agree, 'id' => $formId]);

    $stmt = $db->prepare("DELETE FROM FormLanguages WHERE FormId = :formId");
    $stmt -> execute(['formId'=>$formId]);
    
    $langs = array();
    $langs = $_POST["favorite-langs"];
    for($i = 0; $i < count($langs); $i++)
    {
        $langId = null;
        $sth = $db->prepare('SELECT Id FROM Languages WHERE LanguageName = :langName');
        $sth->execute(['langName' => $langs[$i]]);
        while ($row = $sth->fetch()) {
          $langId = $row['Id'];
        }
        if($langId == null)
        {
          $stmt = $db->prepare("INSERT INTO Languages (LanguageName) VALUES (:languageNameDB)");
          $stmt -> execute(['languageNameDB'=>$langs[$i]]);

          $langId = $db->lastInsertId();
        }

        $stmt = $db->prepare("INSERT INTO FormLanguages (FormId, LanguageId) VALUES (:formId, :languageIdDB)");
        $stmt -> execute(['formId'=>$formId, 'languageIdDB'=>$langId]);
    }
    
}
?>