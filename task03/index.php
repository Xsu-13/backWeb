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
    print($_GET['str']);
    exit();
  }
  // if (!empty($_GET['error'])) {
  //   // Если есть параметр save, то выводим сообщение пользователю.
  //   print('Произошла ошибка.');
  // }
  // Включаем содержимое файла form.php.
  include('form.php');

  exit();
}

// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.

// Проверяем ошибки.
$errors = FALSE;
$fioExp = '/^[a-zA-Z\s]{3,150}$/';
$telExp = "/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/";
$emailExp = "/[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9_-]+/";
$genderExp = '/^(Male||Female)$/';

$fioValue = $_POST['fio'];
$tel = $_POST['field-tel'];
$email = $_POST['field-email'];
$gender = $_POST['radio-group'];
$check = $_POST['check-1'];
$bio = $_POST['bio'];
$langs = $_POST['favorite-langs'];
$date = $_POST['field-date'];

$langsValue = '(';

for($i = 0; $i < count($langs); $i++)
{
  $langsValue .= "'" . $langs[$i] . "',";
}

$langsValue = substr($langsValue, 0, -1);
$langsValue .= ")";

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

  // $fioDB = $fioValue;
  // $emailDB = $email;
  // $telDB = $tel;
  // $dateDB = $date;
  // $genderDB = $gender;
  // $langsDB = $langsValue;
  // $bioDB = $bio;
  // $checkDB = $check;

//Еще вариант
// $stmt = $db->prepare("INSERT INTO Form (fio, phone, email, formDate, gender, favoriteLanguages, biography, agreeCheck) VALUES (:fioDB, :telDB, :emailDB, :dateDB, :genderDB, :langsDB, :bioDB, :checkDB)");

// $stmt->bindParam(':fioDB', $fioDB);
// $stmt->bindParam(':emailDB', $emailDB);
// $stmt->bindParam(':telDB', $telDB);
// $stmt->bindParam(':dateDB', $dateDB);
// $stmt->bindParam(':genderDB', $genderDB);
// $stmt->bindParam(':langsDB', $langsDB);
// $stmt->bindParam(':bioDB', $bioDB);
// $stmt->bindParam(':checkDB', $checkDB);



// $stmt->execute();

try {
  $stmt = $db->prepare("INSERT INTO Form (fio, phone, email, formDate, gender, favoriteLanguages, biography, agreeCheck) VALUES (:fioDB, :telDB, :emailDB, :dateDB, :genderDB, :langsDB, :bioDB, :checkDB)");
  $stmt -> execute(['fioDB'=>$fioValue, 'telDB'=>$tel, 'emailDB'=>$email,'dateDB'=>$date,'genderDB'=>$gender,'langsDB'=>$langsValue,'bioDB'=>$bio, 'checkDB'=>$check]);
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  print($langsValue);
  exit();
}


// Делаем перенаправление.
// Если запись не сохраняется, но ошибок не видно, то можно закомментировать эту строку чтобы увидеть ошибку.
// Если ошибок при этом не видно, то необходимо настроить параметр display_errors для PHP.
header('Location: ?save=1&str=' . $fioValue . " " . $tel . "" . $email . "" . $gender . "" . $langsValue . "" . $date . "" . $bio . "" . $check);

//  stmt - это "дескриптор состояния".
 
//  Именованные метки.
//$stmt = $db->prepare("INSERT INTO test (label,color) VALUES (:label,:color)");
//$stmt -> execute(['label'=>'perfect', 'color'=>'green']);
 
//Еще вариант
/*$stmt = $db->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':email', $email);
$firstname = "John";
$lastname = "Smith";
$email = "john@test.com";
$stmt->execute();
*/
