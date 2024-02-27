<?php
// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // В суперглобальном массиве $_GET PHP хранит все параметры, переданные в текущем запросе через URL.
  if (!empty($_GET['save'])) {
    // Если есть параметр save, то выводим сообщение пользователю.
    print('Спасибо, результаты сохранены.');
    exit();
  }
  // Включаем содержимое файла form.php.
  include('form.php');

  exit();
}

// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.

// Проверяем ошибки.
$errors = FALSE;
$fioExp = '/^[\p{Cyrillic}a-zA-Z\s]{3,150}$/u';
$telExp = "/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/";
$emailExp = "/[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9_-]+/";
$genderExp = '/^(Male||Female)$/';
$bioExp = '/^(.*?){10,300}$/';

$fioValue = $_POST['fio'];
$tel = $_POST['field-tel'];
$email = $_POST['field-email'];
$gender = $_POST['gender'];
$check = !empty($_POST['check-1']);
$bio = $_POST['bio'];
$langs = !empty($_POST['favorite-langs']);
$date = $_POST['field-date'];

$langsValue = "'";
if(!empty($langs))
{
  $langs = array($langs);
      for($i = 0; $i < count($langs); $i++)
      {
        $langsValue .= $langs[$i] . ",";
      }

    $langsValue = substr($langsValue, 0, -1);
}
else{
  print('Выберете хотя бы один язык.<br/>');
  $errors = TRUE;
}
$langsValue .= "'";

if (empty($fioValue) || preg_match($fioExp, $fioValue) == 0) {
  print('Имя должно содержать только буквы и быть не длинее 150 символов.<br/>');
  $errors = TRUE;
}

if (empty($tel) || preg_match($telExp, $tel) == 0) {
  print('Введите корректный номер телефона.<br/>');
  $errors = TRUE;
}

if (empty($email) || preg_match($emailExp, $email) == 0) {
  print('Email не корректен либо не содержит @.<br/>');
  $errors = TRUE;
}

if (empty($gender) || preg_match($genderExp, $gender) == 0) {
  print('Пол не корректен.<br/>');
  $errors = TRUE;
}

if (empty($bio) || preg_match($bioExp, $bio) == 0){
  print('Напишите что-нибудь о себе.<br/>');
  $errors = TRUE;
}

if (empty($check)) {
  print('Согласие обязательно.<br/>');
  $errors = TRUE;
}

if ($errors) {
  // При наличии ошибок завершаем работу скрипта.
  exit();
}

// Сохранение в базу данных.

$user = 'u67344'; // Заменить на ваш логин uXXXXX
$pass = '7915464'; // Заменить на пароль, такой же, как от SSH
$db = new PDO('mysql:host=localhost;dbname=u67344', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); // Заменить test на имя БД, совпадает с логином uXXXXX

try {

  $stmt = $db->prepare("INSERT INTO Forms (Fio, Phone, Email, FormDate, Gender, Biography, AgreeCheck) VALUES (:fioDB, :telDB, :emailDB, :dateDB, :genderDB, :bioDB, :checkDB)");
  $stmt -> execute(['fioDB'=>$fioValue, 'telDB'=>$tel, 'emailDB'=>$email,'dateDB'=>$date,'genderDB'=>$gender,'bioDB'=>$bio, 'checkDB'=>$check]);

  $UserId = $db->lastInsertId();

  foreach($langs as $lang)
  {
    $langId;
    try{
      $sth = $db->prepare('SELECT Id FROM Languages Where LanguageName = '.$lang);
      $sth->execute();
      $langId = ($sth->fetch(PDO::FETCH_ASSOC))['Id'];
    }
    catch(PDOException $e){
      $stmt = $db->prepare("INSERT INTO Languages (LanguageName) VALUES (:languageNameDB)");
      $stmt -> execute(['languageNameDB'=>$lang]);

      $langId = $db->lastInsertId();
    }
    $stmt = $db->prepare("INSERT INTO FormLanguages (FormId, LanguageId) VALUES (:userIdDB, :languageIdDB)");
    $stmt -> execute(['userIdDB'=>$UserId, 'languageIdDB'=>$langId]);
  }

}
catch(PDOException $e){
  print('Error : ' . $e->getMessage()) . '\n';
  print($langId);
  exit();
}

// Делаем перенаправление.
// Если запись не сохраняется, но ошибок не видно, то можно закомментировать эту строку чтобы увидеть ошибку.
// Если ошибок при этом не видно, то необходимо настроить параметр display_errors для PHP.
header('Location: ?save=1');
