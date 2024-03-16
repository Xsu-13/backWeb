<html>
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self'">
    <style>
/* Сообщения об ошибках и поля с ошибками выводим с красным бордюром. */
.error {
  border: 2px solid red;
}
    </style>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="form">
    <form action="" method="POST">
      <label>
        ФИО:
        <br />
        <input name="fio" <?php if ($errors['fio']) {print 'class="error"';} ?> value="<?php print $values['fio']; ?>" />
      </label>
      <br />
      <label>
        Телефон:<br />
        <input name="field-tel" <?php if ($errors['field-tel']) {print 'class="error"';} ?> value="<?php print $values['field-tel']; ?>" type="tel" placeholder="Введите ваш телефон" />
      </label><br />
      <label>
        Email:<br />
        <input name="field-email" <?php if ($errors['field-email']) {print 'class="error"';} ?> value="<?php print $values['field-email']; ?>" type="email" placeholder="Введите вашу почту" />
      </label><br />
      <label>
        Введите дату рождения:<br />
        <input name="field-date" <?php if ($errors['field-date']) {print 'class="error"';} ?> value="<?php print date('Y-m-d', strtotime($values['field-date'])); ?>" type="date" />
      </label><br />
      Выберете ваш пол:<br />
      <label><input type="radio" <?php if($values['gender']=="Male") {print("checked");}  ?> name="gender" value="Male" />
        Мужчина</label>
      <label><input type="radio" <?php if ($errors['gender']) {print 'class="error"';} ?> <?php if($values['gender']=="Female") {print("checked");} ?> name="gender" value="Female" />
        Женщина</label><br />
      <br />
      <label>
        Выберете ваши любимые языки программирования:
        <br />
        <select name="favorite-langs[]" <?php if ($errors['favorite-langs']) {print 'class="error"';} ?> multiple="multiple">
          <option <?php SelectLang($values['favorite-langs'], "Pascal") ?> value="Pascal">Pascal</option>
          <option <?php SelectLang($values['favorite-langs'], "JavaScript") ?> value="JavaScript">JavaScript</option>
          <option <?php SelectLang($values['favorite-langs'], "PHP") ?> value="PHP">PHP</option>
          <option <?php SelectLang($values['favorite-langs'], "Python") ?> value="Python">Python</option>
          <option <?php SelectLang($values['favorite-langs'], "Haskel") ?> value="Haskel">Haskel</option>
          <option <?php SelectLang($values['favorite-langs'], "Clojure") ?> value="Clojure">Clojure</option>
          <option <?php SelectLang($values['favorite-langs'], "Prolog") ?> value="Prolog">Prolog</option>
          <option <?php SelectLang($values['favorite-langs'], "Scala") ?> value="Scala">Scala</option>
        </select>
        <br />
      </label><br />
      <label>
        Ваша биография:<br />
        <textarea name="bio" <?php if ($errors['bio']) {print 'class="error"';} ?> cols="90" rows="10"><?php print $values['bio']; ?></textarea>
      </label><br />
      <br />
      <label><input type="checkbox" class="checkbox" <?php if ($errors['check-1']) {print 'class="error"';} ?> <?php if($values['check-1'] == 1) print "checked" ?> name="check-1" />
        с контрактом ознакомлен(а)</label><br />
      <br />
      <input type="hidden" name="csrf_form_token" value="<?=$val?>">
      <input class="button" type="submit" value="Сохранить" />
    </form>
    <?php
if (!empty($messages)) {
  print('<div id="messages">');
  // Выводим все сообщения.
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}
function SelectLang($langs, $value){
  $langArray = str_getcsv($langs, ',');
  for($i = 0; $i < count($langArray); $i++)
  {
     if($langArray[$i] == $value)
       print "selected";
  }
}
// Далее выводим форму отмечая элементы с ошибками классом error
// и задавая начальные значения элементов ранее сохраненными.
?>
  </body>
</html>
