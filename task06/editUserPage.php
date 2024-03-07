<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style.css" rel="stylesheet"/>
  <title>User Data Table</title>
  <style>
    /* Стили таблицы остаются такими же */

    /* Стили модального окна */
    .modal {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      z-index: 1;
    }

    .modal-content {
      width: 80%;
      margin: auto;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
      position: absolute;
      right: 10px;
      top: 10px;
      border: none;
      width: 30px;
      height: 30px;
      background-color: transparent;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
      border: none;
    }
  </style>
</head>
<body>
<div class="modal">
  <div class="modal-content">
    
    <h3>Edit User</h3>
    <!-- Форма для редактирования данных пользователя -->
    <form action="" method="post">
      <input class="close" name="Close" value="&times;" type="submit"/>
      <!-- Здесь можно добавить поля для редактирования данных пользователя -->
      <label for="editFio">ФИО:</label>
      <input type="text" id="editFio" name="editFio" value="<?=$_COOKIE['fio_value']?>"><br>

      <label for="editPhone">Телефон:</label>
      <input type="tel" id="editPhone" name="editPhone" value="<?=$_COOKIE['tel_value']?>"><br>

      <label for="editEmail">Email:</label>
      <input type="email" id="editEmail" name="editEmail" value="<?=$_COOKIE['email_value']?>"><br>

      <label for="editFormDate">Дата рождения:</label>
      <input type="date" id="editFormDate" name="editFormDate" value="<?php print date('Y-m-d', strtotime($_COOKIE['date_value'])); ?>"><br>

        Пол:
        <label><input name="gender" type="radio" value="Male" <?php if($_COOKIE['gender_value']=="Male") {print "checked";} else print($_COOKIE['gender_value']); ?>/> Мужчина </label>
        <label><input name="gender" type="radio" value="Female" <?php if($_COOKIE['gender_value']=="Female") {print "checked";}  else print($_COOKIE['gender_value']); ?>/> Женщина </label>
        <br/>
        Выберете ваши любимые языки программирования:
        <br />
        <select name="favorite-langs[]" multiple="multiple">
          <option <?php SelectLang($langs, "Pascal") ?> value="Pascal">Pascal</option>
          <option <?php SelectLang($langs, "C++") ?> value="C++">C++</option>
          <option <?php SelectLang($langs, "JavaScript") ?> value="JavaScript">JavaScript</option>
          <option <?php SelectLang($langs, "PHP") ?> value="PHP">PHP</option>
          <option <?php SelectLang($langs, "Python") ?> value="Python">Python</option>
          <option <?php SelectLang($langs, "Haskel") ?> value="Haskel">Haskel</option>
          <option <?php SelectLang($langs, "Clojure") ?> value="Clojure">Clojure</option>
          <option <?php SelectLang($langs, "Prolog") ?> value="Prolog">Prolog</option>
          <option <?php SelectLang($langs, "Scala") ?> value="Scala">Scala</option>
        </select>
      </label>
      <br/>
      <br/>
      <label for="editBiography">Биография:</label>
      <br/>
      <textarea id="editBiography" name="editBiography" rows="4"><?=$_COOKIE['bio_value']?></textarea><br>

      <br/>
      <label for="editAgreeCheck">Согласие:</label>
      <input type="checkbox" class="checkbox" id="editAgreeCheck" <?php if($_COOKIE['check_value'] == 1) print "checked" ?> name="editAgreeCheck"><br>

      <input class="save-button" type="submit" value="Сохранить" name="Edit">
    </form>
  </div>
</div>
</body>

<?php 
function SelectLang($langs, $value){
  $langArray = str_getcsv($langs, ',');
  for($i = 0; $i < count($langArray); $i++)
  {
     if($langArray[$i] == $value)
       print "selected";
  }
}
?>