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
<div id="editModal" class="modal">
  <div class="modal-content">
    
    <h3>Edit User</h3>
    <!-- Форма для редактирования данных пользователя -->
    <form action="" method="post" id="editForm">
      <input class="close" name="Close" value="&times;" type="submit"/>
      <!-- Здесь можно добавить поля для редактирования данных пользователя -->
      <label for="editFio">Fio:</label>
      <input type="text" id="editFio" name="editFio" required><br>

      <label for="editPhone">Phone:</label>
      <input type="tel" id="editPhone" name="editPhone" required><br>

      <label for="editEmail">Email:</label>
      <input type="email" id="editEmail" name="editEmail" required><br>

      <label for="editFormDate">FormDate:</label>
      <input type="date" id="editFormDate" name="editFormDate" required><br>

      <label for="editGender">Gender:</label>
      <select id="editGender" name="editGender" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select><br>

      <label for="editBiography">Biography:</label>
      <textarea id="editBiography" name="editBiography" rows="4"></textarea><br>

      <label for="editAgreeCheck">AgreeCheck:</label>
      <input type="checkbox" id="editAgreeCheck" name="editAgreeCheck"><br>

      <input type="submit" value="Сохранить" name="Edit">
    </form>
  </div>
</div>
</body>