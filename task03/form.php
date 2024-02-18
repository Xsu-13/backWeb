<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css" />
  <title>Task3</title>
</head>

<body>

  <div class="form">
    <span>Оставьте свою заявку для публикаций статей</span>
    <form action="" method="POST">
      <label>
        ФИО:
        <br />
        <input name="fio" value="Иванов Иван Иванович" />
      </label>
      <br />
      <label>
        Телефон:<br />
        <input name="field-tel" type="tel" placeholder="Введите ваш телефон" />
      </label><br />
      <label>
        Email:<br />
        <input name="field-email" type="email" placeholder="Введите вашу почту" />
      </label><br />
      <label>
        Введите дату рождения:<br />
        <input name="field-date" value="2003-10-13" type="date" />
      </label><br />
      Выберете ваш пол:<br />
      <label><input type="radio" checked="checked" name="radio-group" value="Male" />
        Мужчина</label>
      <label><input type="radio" name="radio-group" value="Female" />
        Женщина</label><br />
      <br />
      <label>
        Выберете ваши любимые языки программирования:
        <br />
        <select name="favorite-langs" multiple="multiple">
          <option value="Pascal">Pascal</option>
          <option value="C#" selected="selected">C#</option>
          <option value="C++">C++</option>
          <option value="JavaScript">JavaScript</option>
          <option value="PHP">PHP</option>
          <option value="Python">Python</option>
          <option value="Haskel">Haskel</option>
          <option value="Clojure">Clojure</option>
          <option value="Prolog">Prolog</option>
          <option value="Scala">Scala</option>
        </select>
        <br />
      </label><br />
      <label>
        Ваша биография:<br />
        <textarea name="bio" cols="90" rows="10">A long time ago, back in the early 1900s...</textarea>
      </label><br />
      <br />
      <label><input type="checkbox" checked="checked" name="check-1" />
        с контрактом ознакомлен(а)</label><br />
      <br />
      <input class="button" type="submit" value="Сохранить" />
    </form>
</body>

</html>