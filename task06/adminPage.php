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
          <input name="Edit" value="Редактировать" type="submit" onclick="editUser()"/>  | 
          <input name="Delete" value="Удалить" type="submit"/> 
          <input name="Id" value="<?=$user['id']?> " type="hidden"/>
        </form>
      </td>
  </tr>
<?php endforeach;?>
  </tbody>
</table>
</body>
</html>