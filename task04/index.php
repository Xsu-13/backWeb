<?php
/**
 * Реализовать проверку заполнения обязательных полей формы в предыдущей
 * с использованием Cookies, а также заполнение формы по умолчанию ранее
 * введенными значениями.
 */

// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Массив для временного хранения сообщений пользователю.
  $messages = array();
  // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
  // Выдаем сообщение об успешном сохранении.
  if (!empty($_COOKIE['save'])) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('save', '', 100000);
    // Если есть параметр save, то выводим сообщение пользователю.
    $messages[] = 'Спасибо, результаты сохранены.';
  }

  // Складываем признак ошибок в массив.
  $errors = array();
  $errors['fio'] = !empty($_COOKIE['fio_error']);
  $errors['field-tel'] = !empty($_COOKIE['tel_error']);
  $errors['field-email'] = !empty($_COOKIE['email_error']);
  $errors['gender'] = !empty($_COOKIE['gender_error']);
  $errors['field-date'] = !empty($_COOKIE['date_error']);
  $errors['favorite-langs'] = !empty($_COOKIE['langs_error']);
  $errors['bio'] = !empty($_COOKIE['bio_error']);
  $errors['check-1'] = !empty($_COOKIE['check_error']);

  // Выдаем сообщения об ошибках.
  if ($errors['fio']) {
    setcookie('fio_error', '', 100000);
    $messages[] = '<div class="error">Заполните имя.</div>';
  }
  if ($errors['field-tel']) {
    setcookie('tel_error', '', 100000);
    $messages[] = '<div class="error">Заполните номер телефона.</div>';
  }
  if ($errors['field-email']) {
    setcookie('email_error', '', 100000);
    $messages[] = '<div class="error">Заполните email.</div>';
  }
  if ($errors['gender']) {
    setcookie('gender_error', '', 100000);
    $messages[] = '<div class="error">Выберете один из вариантов.</div>';
  }
  if ($errors['field-date']) {
    setcookie('date_error', '', 100000);
    $messages[] = '<div class="error">Заполните дату.</div>';
  }
  if ($errors['favorite-langs']) {
    setcookie('langs_error', '', 100000);
    $messages[] = '<div class="error">Выберете хотя бы один язык.</div>';
  }
  if ($errors['bio']) {
    setcookie('bio_error', '', 100000);
    $messages[] = '<div class="error">Заполните биографию.</div>';
  }
  if ($errors['check-1']) {
    setcookie('check_error', '', 100000);
    $messages[] = '<div class="error">Согласие обязательно.</div>';
  }

  // Складываем предыдущие значения полей в массив, если есть.
  $values = array();
  $values['fio'] = empty($_COOKIE['fio_value']) ? '' : $_COOKIE['fio_value'];
  $values['field-tel'] = empty($_COOKIE['tel_value']) ? '' : $_COOKIE['tel_value'];
  $values['field-email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
  $values['field-date'] = empty($_COOKIE['date_value']) ? '' : $_COOKIE['date_value'];
  $values['favorite-langs'] = empty($_COOKIE['langs_value']) ? '' : $_COOKIE['langs_value'];
  $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];
  $values['check-1'] = empty($_COOKIE['check_value']) ? '' : $_COOKIE['check_value'];

  include('form.php');
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
else {

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
  $langs = !empty($_POST['favorite-langs'])?$_POST['favorite-langs']:null;
  $date = $_POST['field-date'];
  

  // Проверяем ошибки.
  $errors = FALSE;
  if (empty($fioValue) || preg_match($fioExp, $fioValue) == 0) {
    setcookie('fio_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }

    setcookie('fio_value', $fioValue, time() + 30 * 24 * 60 * 60);


  if (empty($tel) || preg_match($fioExp, $fioValue) == 0) {
    setcookie('tel_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }

    setcookie('tel_value', $tel, time() + 30 * 24 * 60 * 60);


  if (empty($email) || preg_match($emailExp, $email) == 0) {
    setcookie('email_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  setcookie('email_value', $email, time() + 30 * 24 * 60 * 60);

  if (empty($gender) || preg_match($genderExp, $gender) == 0) {
    setcookie('gender_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }

  setcookie('gender_value', $gender, time() + 30 * 24 * 60 * 60);


  if (empty($bio) || preg_match($bioExp, $bio) == 0) {
    setcookie('bio_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }

  setcookie('bio_value', $bio, time() + 30 * 24 * 60 * 60);


  if (empty($langs)) {
    setcookie('langs_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else{
    setcookie('langs_value', $langs, time() + 30 * 24 * 60 * 60);
  }
  if (empty($date)) {
    setcookie('date_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }

    setcookie('date_value', $date, time() + 30 * 24 * 60 * 60);

  if (empty($check) || $check == 0) {
    setcookie('check_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }

    setcookie('check_value', $check, time() + 30 * 24 * 60 * 60);


  if ($errors) {
    // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
    header('Location: index.php');
    exit();
  }
  else {
    // Удаляем Cookies с признаками ошибок.
    setcookie('fio_error', '', 100000);
    setcookie('tel_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('date_error', '', 100000);
    setcookie('langs_error', '', 100000);
    setcookie('gender_error', '', 100000);
    setcookie('bio_error', '', 100000);
    setcookie('check_error', '', 100000);
  }

  $user = 'u67344'; // Заменить на ваш логин uXXXXX
  $pass = '7915464'; // Заменить на пароль, такой же, как от SSH
  $db = new PDO('mysql:host=localhost;dbname=u67344', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); // Заменить test на имя БД, совпадает с логином uXXXXX

try {

  $stmt = $db->prepare("INSERT INTO Forms (Fio, Phone, Email, FormDate, Gender, Biography, AgreeCheck) VALUES (:fioDB, :telDB, :emailDB, :dateDB, :genderDB, :bioDB, :checkDB)");
  $stmt -> execute(['fioDB'=>$fioValue, 'telDB'=>$tel, 'emailDB'=>$email,'dateDB'=>$date,'genderDB'=>$gender,'bioDB'=>$bio, 'checkDB'=>$check]);

  $UserId = $db->lastInsertId();
  $langId;
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
    $stmt = $db->prepare("INSERT INTO FormLanguages (FormId, LanguageId) VALUES (:userIdDB, :languageIdDB)");
    $stmt -> execute(['userIdDB'=>$UserId, 'languageIdDB'=>$langId]);
  }

}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  print("\n");
  print($UserId . " " . $langId);
  exit();
}

  // Сохраняем куку с признаком успешного сохранения.
  setcookie('save', '1');

  // Делаем перенаправление.
  header('Location: index.php');
}
