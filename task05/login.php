<?php

/**
 * Файл login.php для не авторизованного пользователя выводит форму логина.
 * При отправке формы проверяет логин/пароль и создает сессию,
 * записывает в нее логин и id пользователя.
 * После авторизации пользователь перенаправляется на главную страницу
 * для изменения ранее введенных данных.
 **/

// Отправляем браузеру правильную кодировку,
// файл login.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SESSION хранятся переменные сессии.
// Будем сохранять туда логин после успешной авторизации.
$session_started = false;
if (session_start() && $_COOKIE[session_name()]) {
  $session_started = true;
  if (!empty($_SESSION['login'])) {
    // Если есть логин в сессии, то пользователь уже авторизован.
    // TODO: Сделать выход (окончание сессии вызовом session_destroy()
    //при нажатии на кнопку Выход).
    include("logoutPage.php");
    if (isset($_POST['Logout']))
    {
      session_destroy();
      header('Location: ./');
    }
    
    exit();
  }
}

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
include("loginPage.php");
}
// Иначе, если запрос был методом POST, т.е. нужно сделать авторизацию с записью логина в сессию.
else {
  // TODO: Проверть есть ли такой логин и пароль в базе данных.
  

  $user = 'u67344';
  $pass = '7915464';
  $db = new PDO('mysql:host=localhost;dbname=u67344', $user, $pass,
  [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  $passDB = null;
  $login = $_POST['login'];
  $pass = $_POST['pass'];
  $shapass = sha1($pass);
  try{
    $sth = $db->prepare('SELECT Password FROM Users WHERE Login = :login');
    $sth->execute(['login' => $login]);
    
    while ($row = $sth->fetch()) {
      $passDB = $row['Password'];
    }
  }
  catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    exit();
  }
  

  if($passDB == "" || $passDB != $shapass)
  {
    // Выдать сообщение об ошибках.
    print("No such login or incorrect password");
  }
  else{
    if (!$session_started) {
      session_start();
    }
    // Если все ок, то авторизуем пользователя.
    $_SESSION['login'] = $_POST['login'];
    // Делаем перенаправление.
    header('Location: ./');
  }
  // Записываем ID пользователя.
  //$_SESSION['uid'] = 123;
  
}
