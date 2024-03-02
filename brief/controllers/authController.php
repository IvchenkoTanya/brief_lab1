<?php

require '../db.php';
require '../render.php';

ob_start();

if(isset($_POST['brief-btn'])){
    print_r($_POST);
    unset($_POST['brief-btn']);
    foreach($_POST as $key => $value){
        // Перевіряємо, чи є значення масиву
        if(is_array($value)){
            // Якщо значення - масив, об'єднуємо його значення в один рядок
            $_POST[$key] = implode(', ', $value);
        }
    }
    print_r($_POST);
    if(Insert('info', $_POST) > 0){
       header('Location: ../success.php');
        exit();
    }else{
       renderView('index', $_POST);
    }
    // Рендеринг представлення "Index" з передачею даних
  
}

if(isset($_POST['btn-auth'])){
    unset($_POST['btn-auth']);

    $params['password'] = $_POST['password'];
    print_r( $params['password']);
    $user = Select('user', "*", null, ['username' => $_POST['username']])[0];
    if (password_verify($params['password'], $user['password'])){
        $_SESSION['user']['role'] = "Admin";

        header("Location: ../allbriefs.php");
    }else{
        renderView('auth', $_POST);
    }
}

if(isset($_POST['del'])) {
        if ($_SESSION['user']['role'] === 'Admin') {
    if ($_POST['id']) {
        Delete('info', ['id' => $_POST['id']]);
        echo json_encode(['msg' => 'Success']);
             } else {
                header("Location: ../allbriefs.php");
            }
          } else {
               header("Location: ../index.php");
    }
}

if(isset($_POST['params'])) {
        if ($_SESSION['user']['role']) {
    $allFields = GetAllBriefs($_POST['params'], $_POST['page']);

    $count = getCountBriefs($_POST['params']);
    echo json_encode(['briefs' => $allFields, 'countBriefs' => $count]);

 } else {
               header("Location: ../index.php");
}
}

function GetAllBriefs($params = null, $page = 1)
{
    $ConstOffset = 10;
    $offset = ($page - 1) * $ConstOffset;
    return Select('info', '*', null, $params, null, $offset, $ConstOffset);
}

function getCountBriefs($params = null)
{
    return Select('info', 'Count(*) as count', null, $params)[0]['count'];
}

//if(isset($_POST['params'])) {
//    //    if ($_SESSION['user']['role']) {
//    $allFields = GetAllBriefs($_POST['params'], $_POST['page']);
////            if (!$storages) {
////                $storages = \models\Warehouse::getAllStorages($_POST['params']);
////            }
//    $count = getCountBriefs($_POST['params']);
//    echo json_encode(['briefs' => $allFields, 'countBriefs' => $count]);
//
////        } else {
////            header("Location: /");
////        }
//}