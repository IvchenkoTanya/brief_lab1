<?php

function renderView($viewName, $data) {
    // Підключаємо потрібні дані
    extract($data);

    // Відкриваємо буфер виводу
    ob_start();

    // Підключаємо файл представлення
    include($viewName . '.php');

    // Отримуємо вміст буфера
    $content = ob_get_clean();

    // Виводимо вміст
    echo $content;
}

// Отримання даних
$data = [
    'key' => 'value',
    // Додайте інші дані, які ви хочете передати у представлення
];
