<?php

/**
 * Задача 6. Реализовать вход администратора с использованием
 * HTTP-авторизации для просмотра и удаления результатов.
 **/


// Пример HTTP-аутентификации.
// PHP хранит логин и пароль в суперглобальном массиве $_SERVER.
// Подробнее см. стр. 26 и 99 в учебном пособии Веб-программирование и веб-сервисы.


$user = 'u67344';
$pass = '7915464';
$db = new PDO('mysql:host=localhost;dbname=u67344', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  $sth = $db->prepare('SELECT Login, Password FROM Admin');
  $sth->execute();

  $adminLogin;
  $adminPass;
  while ($row = $sth->fetch()) {
    $adminLogin = $row["Login"];
    $adminPass = $row["Password"];
  }
  
/*
if (empty($_SERVER['PHP_AUTH_USER']) ||
    empty($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] != 'admin' ||
    sha1($_SERVER['PHP_AUTH_PW']) != sha1('123')) {
  header('HTTP/1.1 401 Unanthorized');
  header('WWW-Authenticate: Basic realm="My site"');
  print('<h1>401 Требуется авторизация</h1>');
  exit();
}
*/

if (empty($_SERVER['PHP_AUTH_USER']) ||
    empty($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] != $adminLogin ||
    sha1($_SERVER['PHP_AUTH_PW']) != $adminPass) {
  header('HTTP/1.1 401 Unanthorized');
  header('WWW-Authenticate: Basic realm="My site"');
  print('<h1>401 Требуется авторизация</h1>');
  exit();
}


if (isset($_POST))
{ 
  if(isset($_POST["Delete"])){
    DeleteUser($_POST["Id"]);
    header('Location: ./');
  } 
  if(isset($_POST["Edit"])){

    setcookie('id', $_POST["Id"], time() + 30 * 24 * 60 * 60);
    setcookie('fio_value', $_POST["Fio"], time() + 30 * 24 * 60 * 60);
    setcookie('tel_value', $_POST["Field-tel"], time() + 30 * 24 * 60 * 60);
    setcookie('email_value', $_POST["Field-email"], time() + 30 * 24 * 60 * 60);
    setcookie('bio_value', $_POST["Bio"], time() + 30 * 24 * 60 * 60);
    setcookie('check_value', $_POST["Check-1"], time() + 30 * 24 * 60 * 60);
    setcookie('gender_value', $_POST["Gender"], time() + 30 * 24 * 60 * 60);
    setcookie('langs_value', $_POST["Favorite-langs"], time() + 30 * 24 * 60 * 60);
    setcookie('date_value', $_POST["Field-date"], time() + 30 * 24 * 60 * 60);

    header('Location: ./editUser.php');
  } 
}


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  print('Вы успешно авторизовались и видите защищенные паролем данные.');
  $users = GetUsers();
  $result = GetLanguageStats();
  $sum = LanguageSum($result);

  include("adminPage.php");
}
else{
  
}


function GetUsers()
{
  
  /*
  $users = array();
  $values = array();
  $values['id'] = "0";
  $values['fio'] = "Hhhh";
  $values['field-tel'] = "6787821";
  $values['field-email'] = "hdsj@jkjs.com";
  $values['gender'] = "Female";
  $values['field-date'] = "12.34.2004";
  $values['favorite-langs'] = "PHP";
  $values['bio'] = "бубубу";
  $values['check-1'] = "1";


  $users[0] = $values;

  $values = array();
  $values['id'] = "1";
  $values['fio'] = "dfsdfs";
  $values['field-tel'] = "5553535";
  $values['field-email'] = "hdsj@xsu.com";
  $values['gender'] = "Male";
  $values['field-date'] = "12.12.2012";
  $values['favorite-langs'] = "Pascal,Scala";
  $values['bio'] = "блпблпблп";
  $values['check-1'] = "0";

  $users[1] = $values;
  */
  
  $user = 'u67344';
  $pass = '7915464';
  $db = new PDO('mysql:host=localhost;dbname=u67344', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  try{
      $sth = $db->prepare('SELECT Id, Fio, Phone, Email, FormDate, Gender, Biography, AgreeCheck FROM Forms');
      $sth->execute();
      $k = 0;
      $values = array();
      while ($row = $sth->fetch()) {
        $values['fio'] = $row['Fio'];
        $values['field-tel'] = $row['Phone'];
        $values['field-email'] = $row['Email'];
        $values['gender'] = $row['Gender'];
        $values['field-date'] = $row['FormDate'];
        $values['bio'] = $row['Biography']; 
        $values['check-1'] = $row['AgreeCheck'];
        $formId = $row['Id'];
        $sth = $db->prepare('SELECT LanguageId FROM FormLanguages WHERE FormId = :id');
        $sth->execute(['id' => $formId]);
        $j = 0;
        $langs = [];
        $row = $sth->fetchAll();
        for($i = 0; $i < count($row); $i++) {
          $sth = $db->prepare('SELECT LanguageName FROM Languages WHERE Id = :id');
          $sth->execute(['id' => ($row[$i])['LanguageId']]);
          while ($langrow = $sth->fetch()) {
            $langs[$j++] = $langrow['LanguageName'];
          }
        }
        $langsValue = '';
        for($i = 0; $i < count($langs); $i++)
        {
          $langsValue .= $langs[$i] . ",";
        }
        $values['favorite-langs'] = $langsValue;
        $users[$k++] = $values;
      }
  }
  catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    print_r($e->getTrace());
    exit();
  }
  

  return $users;
}

function DeleteUser($id)
{
  $user = 'u67344';
  $pass = '7915464';
  $db = new PDO('mysql:host=localhost;dbname=u67344', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  try{
    $sth = $db->prepare('DELETE FROM Forms WHERE FormId = :id');
    $sth->execute(['id' => $id]);
  }
  catch(PDOException $e){
    print_r($e->getTrace());
    exit();
  }
}

function GetLanguageStats()
{
  $user = 'u67344';
  $pass = '7915464';
  $db = new PDO('mysql:host=localhost;dbname=u67344', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  try{
    $sth = $db->prepare('SELECT LanguageName, COUNT(*) AS LanguageCount FROM FormLanguages JOIN Languages ON FormLanguages.LanguageId = Languages.Id GROUP BY LanguageName ORDER BY LanguageCount DESC');
    $sth->execute();
    $result = array();
    while ($row = $sth->fetch()) {
      $result[$row["LanguageName"]]= $row['LanguageCount'];
    }
  }
  catch(PDOException $e){
    print_r($e->getTrace());
    exit();
  }

  return $result;
}

function LanguageSum($arr)
{
  $sum = 0;
  foreach($arr as $count)
  {
    $sum += $count;
  }
  return $sum;
}


?>