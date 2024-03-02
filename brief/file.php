<?php
require('mpdf/vendor/autoload.php') ;
require 'db.php';

if(!(isset($_SESSION['user']))){
    session_start();
}

if(isset($_SESSION['user']['role']) && isset($_GET['id'])) {
    $data = Select('info', "*", null, ['id' => $_GET['id']])[0];
    
    if(!empty($data)){
         foreach($data as $key => $value){

        // Перевіряємо, чи є значення масиву
        if ($value == null){
         
            // Якщо значення - масив, об'єднуємо його значення в один рядок
            $data[$key] = "-";
        }
        }
        $info = [
    'ПІБ' => $data["username"],
    'Посада' => $data["position"],
    'Email' => $data["email"],
    'Контактний телефон' => $data["phone"],
    'Зручний спосіб зв\'язку' => $data["contact_method"],
    'Зручний час для контакту' => $data["contact_time"],
    'Формату спілкування' =>  $data["communication_format"],
    'Додаткова контактна особа: ПІБ' =>  $data["additional_name"],
    'Додаткова контактна особа: Email' => $data["additional_email"],
    'Додаткова контактна особа: Контактний телефон' => $data["additional_phone"],
    'Додаткова контактна особа: Коментар' => $data["additional_comments"],
    'Назва компанії' => $data["company_name"],
    'Короткий опис, чим займається компанія' => $data["company_description"],
    'Чим компанія відрізняється від інших? Що робить її унікальною?' => $data["unique_differentiators"],
    'Ключові цінності компанії/бренду' => $data["key_values"],
    'Чим бренд/продукт/послуга може зацікавити клієнта?' => $data["customer_interests"],
    'Класифікацію послуги/товару?' => $data["classification"],
    'Додаткова класифікація послуги/товару' => $data["other_classification"],
    'Існуючий сайт клієнта (посилання)' => $data["website_description"],
    'Існуючий сайт клієнта (опис)' => $data["website_comments"],
    'Портрет цільової аудиторії' => $data["target_audience"],
    'Як користувачі зможуть дізнатись про сайт' => $data["how_users_find_you"],
    'Основна проблема, яку буде вирішувати сайт' => $data["next_step"],
    'Запит користувача' => $data["website_problem"],
    'Звітність про роботу' => $data["work_process"],
    'Хост і домен' => $data["host"],
    'Тип сайту' => $data["website_type"],
    'Просування' => $data["promotion"],
    'Ключові слова для даного проекту' => $data["key_words"],
    'Стиль дизайну' => $data["design_style"],
    'Стиль дизайну: Інше' => $data["other_design_style"],
    'Кольори' => $data["color_scheme"],
    'Кольори: Інше' => $data["other_color_scheme"],
    'Логотип або брендовий елемент, який потрібно включити' => $data["logo_branding"],
    'Яким клієнт уявляєте сайт з точки зору дизайну' => $data["design_description"],
    'Чого клієнт не хочете бачити на сайті. Дизайни які не подобаються' => $data["undesired_elements"],
    'Розділи або сторінки необхідні на сайті' => $data["site_sections"],
    'Розділи або сторінки необхідні на сайті: Інше' => $data["other_site_sections"],
    'Як користувачі мають використовувати ваш сайт' => $data["user_interaction"],
    'Сайт з точки зору структури та навігації' => $data["structure_navigation"],
    'Чого клієнт не хочете бачити на сайті. Структура яка не подобається' => $data["undesired_structure"],
    'Тип контенту' => $data["content_type"],
    'Тип контенту: Інше' => $data["other_content_types"],
    'Контент потрібно перенести' => $data["existing_content"],
    'Основні мови сайту' => $data["languages"],
    'Допомога з наповненням сайту контентом' => $data["content_assistance"],
    'Чи визначився клієнт, хто буде обслуговувати сайт' => $data["site_maintenance"],
    'Передбачувана частота відвідування сайту користувачами' => $data["visitation_frequency"],
    'Додаткові функціональні можливості' => $data["additional_features"],
    'Компанія конкурент №1: Назва' => $data["company1_name"],
    'Компанія конкурент №1: Url' => $data["company1_url"],
    'Компанія конкурент №1: Переваги та недоліки' => $data["company1_strengths_weaknesses"],
    'Компанія конкурент №2: Назва' => $data["company2_name"],
    'Компанія конкурент №2: Url' => $data["company2_url"],
    'Компанія конкурент №2: Переваги та недоліки' => $data["company2_strengths_weaknesses"],
    'Що клієнт хотів би запозичити у конкурентів, а чого категорично уникнути' => $data["borrow_avoid"],
    'Детальніше дослідження ринку конкурентів' => $data["market_research"],
    'Термін здачі проекту (місяці)' => $data["deadline"],
    'Бюджет ($)' => $data["price"],
    'Геолокація' => $data["next_location"],
    'Коментарі/запитання/побажання' => $data["last_comment"],
    
     
];

$html = '
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>
<h3>Бриф на розробку веб-сайту</h3>
<table border="1">
';

foreach ($info as $field => $value) {
    $html .= '
    <tr>
    <td>' . $field . '</td>
    <td>' . $value . '</td>
    </tr>';
}

$html .= '
</table>
</body>
</html>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output();
    }else{
          header("Location: /index.php");
    }
}

