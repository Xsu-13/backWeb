<?php

// Обработчик запросов методом GET.
function admin_get($request) {
  // Достаем данные из БД, форматируем, санитизуем, складываем в массив, передаем в шаблон для вывода в HTML.
  $params = [
    0 => ['Колонка 1', 'Колонка 2'],
    1 => ['Колонка 1', 'Колонка 2'],
    2 => ['Колонка 1', 'Колонка 2']];
  // Пример возврата html из шаблона с передачей параметров.
  return theme('admin', ['admin' => $params]);
}

// Обработчик запросов методом POST.
function admin_post($request, $url_param_1) {
  // Санитизуем параметр в URL и удаляем строку в БД.
  $id = intval($url_param_1);
  
  // Пример возврата редиректа после обработки формы для реализации принципа Post-redirect-Get.
  return redirect('admin');
}
