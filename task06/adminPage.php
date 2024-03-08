<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Data Table</title>
  <style>
    /* Стили таблицы остаются такими же */

    /* Стили модального окна */
    .modal {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #f2f2f2;
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
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }

    td{
      padding: 0 20px;
    }

    .column{
      width: 20px;
      background-color: #aaa;
      margin: 10px 20px;
    }
    .stat{
      width: 80%;
      display: flex;
      flex-direction: row;
      margin-top: 30px;
      height: 500px;
    }

    .line{
        display: flex;
        flex-direction: column;
        justify-content: end;
        text-align: center;
        align-items: center;
    }
    .btn-reset {
      padding: 0;
      border: none;
      background-color: transparent;
      cursor: pointer;
    }
    .tur {
      width: 107px;
      height: 42px;
      margin-right: 40px;
    }
    .btn {
      border-radius: 10px;
      border: 1px solid rgba(204, 153, 51, 1);
      color: rgba(204, 153, 51, 1);
    }
    
    <?php 
    foreach ($result as $name => $count) :?>
    <?php print(".".$name."{ height:".$count*100/$sum."%;}");?>
  <?php endforeach;?>
  </style>
</head>
<body>

<h2>User Data Table</h2>

<table id="userTable">
  <thead>
    <tr>
      <th>Fio</th>
      <th>Phone</th>
      <th>Email</th>
      <th>FormDate</th>
      <th>Gender</th>
      <th>Languages</th>
      <th>Biography</th>
      <th>AgreeCheck</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  foreach ($users as $user) :?>
  <tr class="item_row">
        <td> <?php echo $user['fio']; ?></td>
        <td> <?php echo $user['field-tel']; ?></td>
        <td> <?php echo $user['field-email']; ?></td>
        <td> <?php echo $user['field-date']; ?></td>
        <td> <?php echo $user['gender']; ?></td>
        <td> <?php echo $user['favorite-langs']; ?></td>
        <td> <?php echo $user['bio']; ?></td>
        <td> <?php echo $user['check-1']; ?></td>
        <td>
        <form action="" method="post"> 
          <button class="btn tur btn-reset" name="Edit" value="Редактировать" type="submit">Редактировать</button>  | 
          <button class="btn tur btn-reset" name="Delete" value="Удалить" type="submit">Удалить</button> 
          <input name="Id" value="<?=$user['id']?>" type="hidden"/>
          <input name="Fio" value="<?=$user['fio']?>" type="hidden"/>
          <input name="Field-tel" value="<?=$user['field-tel']?>" type="hidden"/>
          <input name="Field-email" value="<?=$user['field-email']?>" type="hidden"/>
          <input name="Field-date" value="<?=$user['field-date']?>" type="hidden"/>
          <input name="Gender" value="<?=$user['gender']?>" type="hidden"/>
          <input name="Favorite-langs" value="<?=$user['favorite-langs']?>" type="hidden"/>
          <input name="Bio" value="<?=$user['bio']?>" type="hidden"/>
          <input name="Check-1" value="<?=$user['check-1']?>" type="hidden"/>
        </form>
      </td>
  </tr>
<?php endforeach;?>
  </tbody>
</table>
<div class="stat">
<?php 
  foreach ($result as $name => $count) :?>
  <div class="line">
    <div class="column <?php print $name?>"></div>
    <p><?=$name?></p>
    <div><?=$count?></div>
  </div>
<?php endforeach;?>
</div>
</body>
</html>