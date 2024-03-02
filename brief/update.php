<?php
require 'db.php';
require 'render.php';

 $special_keys = array('contact_method', 'classification', 'design_style', 'color_scheme', 'site_sections', 'content_type', 'additional_features');

if (isset($_SESSION['user']['role'])) {
if(isset($_POST['params'])){
     foreach($_POST['params'] as $key => $value){
        // Перевіряємо, чи є значення масиву
        if(is_array($value)){
            // Якщо значення - масив, об'єднуємо його значення в один рядок
            $_POST['params'][$key] = implode(', ', $value);
        }
    }
    $result = Update('info', $_POST['params'], ['id' => $_POST['id']]);
    echo json_encode(['message' => $result]);
}else
if(isset($_GET['id'])) {
    $brief = Select('info', "*", null, ['id' => $_GET['id']]);
    
    if(!empty($brief)){
         foreach($brief[0] as $key => $value){

        // Перевіряємо, чи є значення масиву
        if (in_array($key, $special_keys)){
         
            // Якщо значення - масив, об'єднуємо його значення в один рядок
            $brief[0][$key] = explode(', ', $value);
        }
         }
         renderView('updateBrief', ['info' => $brief[0]]);
    }else{
        header("Location: /index.php");
    }
}else{
    header("Location: /index.php");
}
}else{
    header("Location: /index.php");
}
