<?php
session_start();
?>
<?php if(isset($msg)): ?>
    <p> <?php echo $msg; ?> </p>
<?php endif; ?>
<div>
    <a href="auth.php">Вхід</a> 
    <?php if(isset($_SESSION['user']['role'])): ?>
    <a href="allbriefs.php">Усі брифи</a> 
<?php endif; ?>
</div>
<form action="/controllers/authController.php" method="POST">
 <h2>Особисті дані</h1>
  <label for="username">ПІБ:</label><br>
<input type="text" id="username" name="username" value="<?php echo isset($info['username']) ? $info['username'] : ''; ?>" ><br><br>

<label for="position">Посада:</label><br>
<input type="text" id="position" name="position" value="<?php echo isset($info['position']) ? $info['position'] : ''; ?>" ><br><br>

<label for="email">Email:</label><br>
<input type="email" id="email" name="email" value="<?php echo isset($info['email']) ? $info['email'] : ''; ?>"><br><br>

<label for="phone">Контактний телефон:</label><br>
<input type="tel" id="phone" name="phone" value="<?php echo isset($info['phone']) ? $info['phone'] : ''; ?>"><br><br>

<label>Зручний спосіб зв'язку:</label><br>
    <input type="checkbox" id="contact_method_email" name="contact_method[]" value="Email" <?php
if(isset($info['contact_method']) && is_array($info['contact_method'])) {
    $checked = (in_array('Email', $info['contact_method'])) ? 'checked' : '';
} else {
    $checked = '';
}
?>>Email<br>
    <input type="checkbox" id="contact_method_phone" name="contact_method[]" value="Телефон"
    <?php
if(isset($info['contact_method']) && is_array($info['contact_method'])) {
    $checked = (in_array('Телефон', $info['contact_method'])) ? 'checked' : '';
} else {
    $checked = '';
}
?>>Телефон<br>
<br>

<label for="contact_time">Зручний час для контакту:</label><br>
<input type="text" id="contact_time" name="contact_time" value="<?php echo isset($info['contact_time']) ? $info['contact_time'] : ''; ?>"><br><br>

<label for="communication_format">Якому формату спілкування Ви віддаєте перевагу?</label><br>
<select id="communication_format" name="communication_format">
    <?php
    if(isset($info['communication_format']) && is_string($info['communication_format'])) {
        $onlineSelected = ($info['communication_format'] == 'Онлайн') ? 'selected' : '';
        $offlineSelected = ($info['communication_format'] == 'Оффлайн') ? 'selected' : '';
    } else {
        $onlineSelected = '';
        $offlineSelected = '';
    }
    ?>
    <option value="Онлайн" <?php echo $onlineSelected; ?>>Онлайн</option>
    <option value="Оффлайн" <?php echo $offlineSelected; ?>>Оффлайн</option>
</select><br><br>


<input type='button' id="toggleButton" value='Додати додаткову контактну особу'>
<input type='button' id="clearFieldsButton" value='Очистити поля'>

<div id="additionalContactBlock" style="display: none;">
    <h4>Додаткова контактна особа</h4>
    <label for="additional_name">ПІБ:</label><br>
    <input type="text" id="additional_name" name="additional_name" value="<?php echo isset($info['additional_name']) ? $info['additional_name'] : ''; ?>"><br><br>
    
    <label for="additional_email">Email:</label><br>
    <input type="email" id="additional_email" name="additional_email" value="<?php echo isset($info['additional_email']) ? $info['additional_email'] : ''; ?>"><br><br>
    
    <label for="additional_phone">Контактний телефон:</label><br>
    <input type="tel" id="additional_phone" name="additional_phone" value="<?php echo isset($info['additional_phone']) ? $info['additional_phone'] : ''; ?>"><br><br>
    
    <label for="additional_comments">Коментарі:</label><br>
    <textarea id="additional_comments" name="additional_comments" rows="4" cols="50"><?php echo isset($info['additional_comments']) ? $info['additional_comments'] : ''; ?></textarea><br><br>
</div>



 <h2>Про компанію:</h2>

<label for="company_name">Назва компанії:</label><br>
<input type="text" id="company_name" name="company_name" value="<?php echo isset($info['company_name']) ? $info['company_name'] : ''; ?>"><br><br>

<label for="company_description">Коротко опишіть, чим займається Ваша компанія:</label><br>
<textarea id="company_description" name="company_description" rows="4" cols="50"><?php echo isset($info['company_description']) ? $info['company_description'] : ''; ?></textarea><br><br>

<label for="unique_differentiators">Чим Ваша компанія відрізняється від інших? Що робить вас унікальними?:</label><br>
<textarea id="unique_differentiators" name="unique_differentiators" rows="4" cols="50"><?php echo isset($info['unique_differentiators']) ? $info['unique_differentiators'] : ''; ?></textarea><br><br>

<label for="key_values">Опишіть 3-4 ключові цінності Вашої компанії/бренду:</label><br>
<textarea id="key_values" name="key_values" rows="4" cols="50"><?php echo isset($info['key_values']) ? $info['key_values'] : ''; ?></textarea><br><br>

<label for="customer_interests">Чим Ваш бренд/продукт/послуга може зацікавити клієнта?</label><br>
<textarea id="customer_interests" name="customer_interests" rows="4" cols="50"><?php echo isset($info['customer_interests']) ? $info['customer_interests'] : ''; ?></textarea><br><br>

<label>Оберіть класифікацію послуги/товару:</label><br>
<input type="checkbox" id="general_use" name="classification[]" value="Широкого вжитку" <?php echo (isset($info['classification']) && in_array('Широкого вжитку', $info['classification'])) ? 'checked' : ''; ?>>
<label for="general_use">Широкого вжитку</label><br>

<input type="checkbox" id="industrial" name="classification[]" value="Промислового призначення" <?php echo (isset($info['classification']) && in_array('Промислового призначення', $info['classification'])) ? 'checked' : ''; ?>>
<label for="industrial">Промислового призначення</label><br>

<input type="checkbox" id="everyday_demand" name="classification[]" value="Повсякденного попиту" <?php echo (isset($info['classification']) && in_array('Повсякденного попиту', $info['classification'])) ? 'checked' : ''; ?>>
<label for="everyday_demand">Повсякденного попиту</label><br>

<input type="checkbox" id="selective_demand" name="classification[]" value="Вибіркового попиту" <?php echo (isset($info['classification']) && in_array('Вибіркового попиту', $info['classification'])) ? 'checked' : ''; ?>>
<label for="selective_demand">Вибіркового попиту</label><br>

<input type="checkbox" id="prestigious" name="classification[]" value="Престижні" <?php echo (isset($info['classification']) && in_array('Престижні', $info['classification'])) ? 'checked' : ''; ?>>
<label for="prestigious">Престижні</label><br>

<input type="checkbox" id="luxury_items" name="classification[]" value="Предмети розкоші" <?php echo (isset($info['classification']) && in_array('Предмети розкоші', $info['classification'])) ? 'checked' : ''; ?>>
<label for="luxury_items">Предмети розкоші</label><br>

<label for="other_classification">Інше:</label><br>
<textarea id="other_classification" name="other_classification" rows="4" cols="50"><?php echo isset($info['other_classification']) ? $info['other_classification'] : ''; ?></textarea><br><br>

<label for="website_description">Чи є у вас сайт (якщо так, за можливості вставте посилання, опишіть, що вам подобається і що не подобається в ньому):</label><br>
URL
<input type="text" id="website_description" name="website_description" value="<?php echo isset($info['website_description']) ? $info['website_description'] : ''; ?>"><br>
<label for="website_comments">Опис сайту</label><br>
<textarea id="website_comments" name="website_comments" rows="4" cols="50"><?php echo isset($info['website_comments']) ? $info['website_comments'] : ''; ?></textarea><br><br>

<h2>Цільова аудиторія:</h2>

<label for="target_audience">Сформуйте короткий портрет вашої цільової аудитрії (стать, вік, інтереси, сімейний стан, сфера роботи тощо):</label><br>
<textarea id="target_audience" name="target_audience" rows="4" cols="50"><?php echo isset($info['target_audience']) ? $info['target_audience'] : ''; ?></textarea><br><br>

<label for="how_users_find_you">Як користувачі будуть дізнаватись про вас?</label><br>
<textarea id="how_users_find_you" name="how_users_find_you" rows="4" cols="50"><?php echo isset($info['how_users_find_you']) ? $info['how_users_find_you'] : ''; ?></textarea><br><br>

    
    
<h2>Сайт:</h2>

<label for="website_problem">Опишіть основну проблему, яку буде вирішувати Ваш сайт:</label><br>
<textarea id="website_problem" name="website_problem" rows="4" cols="50"><?php echo isset($info['next_step']) ? $info['website_problem'] : ''; ?></textarea></textarea><br><br>

<label for="next_step">Оберіть наступне:</label><br>
<input type="radio" id="modernization" name="next_step" value="Мені потрібна модернізація існуючого проекту" <?php echo (isset($info['next_step']) && is_string($info['next_step']) && $info['next_step'] == "Мені потрібна модернізація існуючого проекту") ? 'checked' : ''; ?>>
<label for="modernization">Мені потрібна модернізація існуючого проекту</label><br>

<input type="radio" id="new_website" name="next_step" value="Я хочу сайт з нуля" <?php echo (isset($info['next_step']) && is_string($info['next_step']) && $info['next_step'] == "Я хочу сайт з нуля") ? 'checked' : ''; ?>>
<label for="new_website">Я хочу сайт з нуля</label><br>

<input type="radio" id="undecided" name="next_step" value="Я ще не визначився/визначилась" <?php echo (isset($info['next_step']) && is_string($info['next_step']) && $info['next_step'] == "Я ще не визначився/визначилась") ? 'checked' : ''; ?>>
<label for="undecided">Я ще не визначився/визначилась</label><br><br>

<label for="work_process1">Чи бажаєте ви спостерігати за процесом роботи</label><br>
<input type="radio" id="work_process1" name="work_process" value="Хочу контролювати усі процеси" <?php echo (isset($info['work_process']) && is_string($info['work_process']) && $info['work_process'] == "Хочу контролювати усі процеси") ? 'checked' : ''; ?>>
<label for="work_process1">Хочу контролювати усі процеси</label><br>

<input type="radio" id="work_process2" name="work_process" value="Хочу бачити ключові моменти" <?php echo (isset($info['work_process']) && is_string($info['work_process']) && $info['work_process'] == "Хочу бачити ключові моменти") ? 'checked' : ''; ?>>
<label for="work_process2">Хочу бачити ключові моменти</label><br>

<input type="radio" id="work_process23" name="work_process" value="Цікавить лише фінальний результат" <?php echo (isset($info['work_process']) && is_string($info['work_process']) && $info['work_process'] == "Цікавить лише фінальний результат") ? 'checked' : ''; ?>>
<label for="undecided">Цікавить лише фінальний результат</label><br><br>


<label for="next_step">Чи потрібен вам хостинг та домент для сайту?</label><br>
<input type="radio" id="host_yes" name="host" value="Так" <?php echo (isset($info['host']) && is_string($info['host']) && $info['host'] == "Так") ? 'checked' : ''; ?>>
<label for="host_yes">Так</label><br>

<input type="radio" id="host_no" name="host" value="Ні" <?php echo (isset($info['host']) && is_string($info['host']) && $info['host'] == "Ні") ? 'checked' : ''; ?>>
<label for="host_no">Ні</label><br>

<input type="radio" id="host_mb1" name="host" value="Лише хостинг" <?php echo (isset($info['host']) && is_string($info['host']) && $info['host'] == "Лише хостинг") ? 'checked' : ''; ?>>
<label for="host_mb1">Лише хостинг</label><br>

<input type="radio" id="host_mb2" name="host" value="Лише домен" <?php echo (isset($info['host']) && is_string($info['host']) && $info['host'] == "Лише домен") ? 'checked' : ''; ?>>
<label for="host_mb2">Лише домен</label><br>

<input type="radio" id="host_undecided" name="host" value="Я ще не визначився/визначилась" <?php echo (isset($info['host']) && is_string($info['host']) && $info['host'] == "Я ще не визначився/визначилась") ? 'checked' : ''; ?>>
<label for="host_undecided">Я ще не визначився/визначилась</label><br><br>

<label for="website_type">Який тип сайту вам потрібен:</label><br>
<select id="website_type" name="website_type">
    <?php
    $website_types = array(
        'Блог',
        'Сайт-портфоліо',
        'Сайт електронної комерції',
        'Landing Page (Сторінка-вітрина)',
        'Освітній/інформаційний портал',
        'Інше',
        'Я не можу визначитись'
    );
    foreach ($website_types as $type) {
        $selected = isset($info['website_type']) && $info['website_type'] == $type ? 'selected' : '';
        echo "<option value=\"$type\" $selected>$type</option>";
    }
    ?>
</select><br><br>

<label for="promotion">Чи бажаєте Ви щоб ми детальніше дослідили і виконали просування вашого сайту?</label><br>
<input type="radio" id="promotion_yes" name="promotion" value="Так" <?php echo (isset($info['promotion']) && $info['promotion'] == 'Так') ? 'checked' : ''; ?>>
<label for="promotion_yes">Так</label><br>
<input type="radio" id="promotion_no" name="promotion" value="Ні" <?php echo (isset($info['promotion']) && $info['promotion'] == 'Ні') ? 'checked' : ''; ?>>
<label for="promotion_no">Ні</label><br>
<input type="radio" id="promotion_maybe" name="promotion" value="Потрібно уточнити" <?php echo (isset($info['promotion']) && $info['promotion'] == 'Потрібно уточнити') ? 'checked' : ''; ?>>
<label for="promotion_maybe">Потрібно уточнити</label><br><br>


  <label for="key_words">Визначте ключові слова для даного проекту</label><br>
<input type="text" id="key_words" name="key_words" value="<?php echo isset($info['key_words']) ? $info['key_words'] : ''; ?>" ><br><br>

<h2>Дизайн:</h2>
    <label>Який стиль дизайну ви бажаєте? (оберіть від 1 до 3)</label><br>
   <input type="checkbox" id="minimalistic" name="design_style[]" value="Мінімалістичний" <?php echo (isset($info['design_style']) && in_array('Мінімалістичний', $info['design_style'])) ? 'checked' : ''; ?>>
<label for="minimalistic">Мінімалістичний</label><br>

<input type="checkbox" id="colorful" name="design_style[]" value="Кольоровий" <?php echo (isset($info['design_style']) && in_array('Кольоровий', $info['design_style'])) ? 'checked' : ''; ?>>
<label for="colorful">Кольоровий</label><br>

<input type="checkbox" id="organic" name="design_style[]" value="Organic & Natural(використання різних «природних» текстур)" <?php echo (isset($info['design_style']) && in_array('Organic & Natural(використання різних «природних» текстур)', $info['design_style'])) ? 'checked' : ''; ?>>
<label for="organic">Organic & Natural(використання різних «природних» текстур)</label><br>

<input type="checkbox" id="corporate" name="design_style[]" value="Корпоративний" <?php echo (isset($info['design_style']) && in_array('Корпоративний', $info['design_style'])) ? 'checked' : ''; ?>>
<label for="corporate">Корпоративний</label><br>

<input type="checkbox" id="typography" name="design_style[]" value="Красива типографіка" <?php echo (isset($info['design_style']) && in_array('Красива типографіка', $info['design_style'])) ? 'checked' : ''; ?>>
<label for="typography">Красива типографіка</label><br>

<input type="checkbox" id="classic" name="design_style[]" value="Класичний стиль" <?php echo (isset($info['design_style']) && in_array('Класичний стиль', $info['design_style'])) ? 'checked' : ''; ?>>
<label for="classic">Класичний стиль</label><br>

<input type="checkbox" id="skeuomorphic" name="design_style[]" value="Скевоморфізм" <?php echo (isset($info['design_style']) && in_array('Скевоморфізм', $info['design_style'])) ? 'checked' : ''; ?>>
<label for="skeuomorphic">Скевоморфізм</label><br>

<input type="checkbox" id="art_deco" name="design_style[]" value="Стиль Ар-Деко" <?php echo (isset($info['design_style']) && in_array('Стиль Ар-Деко', $info['design_style'])) ? 'checked' : ''; ?>>
<label for="art_deco">Стиль Ар-Деко</label><br>

<input type="checkbox" id="flat_design" name="design_style[]" value="Flat Design" <?php echo (isset($info['design_style']) && in_array('Flat Design', $info['design_style'])) ? 'checked' : ''; ?>>
<label for="flat_design">Flat Design</label><br>
    
    <label for="other_design_style">Не знайшли потрібні стилі? Напишіть їх тут:</label><br>
    <textarea id="other_design_style" name="other_design_style" rows="4" cols="50"><?php echo isset($info['other_design_style']) ? $info['phone'] : ''; ?></textarea><br><br>

    <label>Які кольори ви б хотіли використовувати на сайті? (оберіть від 1 до 3)</label><br>
    <input type="checkbox" id="blue" name="color_scheme[]" value="Синій" <?php echo (isset($info['color_scheme']) && in_array('Синій', $info['color_scheme'])) ? 'checked' : ''; ?>>
<label for="blue">Синій</label><br>
<input type="checkbox" id="red" name="color_scheme[]" value="Червоний" <?php echo (isset($info['color_scheme']) && in_array('Червоний', $info['color_scheme'])) ? 'checked' : ''; ?>>
<label for="red">Червоний</label><br>
<input type="checkbox" id="green" name="color_scheme[]" value="Зелений" <?php echo (isset($info['color_scheme']) && in_array('Зелений', $info['color_scheme'])) ? 'checked' : ''; ?>>
<label for="green">Зелений</label><br>
<input type="checkbox" id="yellow" name="color_scheme[]" value="Жовтий" <?php echo (isset($info['color_scheme']) && in_array('Жовтий', $info['color_scheme'])) ? 'checked' : ''; ?>>
<label for="yellow">Жовтий</label><br>
<input type="checkbox" id="purple" name="color_scheme[]" value="Фіолетовий" <?php echo (isset($info['color_scheme']) && in_array('Фіолетовий', $info['color_scheme'])) ? 'checked' : ''; ?>>
<label for="purple">Фіолетовий</label><br>
<input type="checkbox" id="grey" name="color_scheme[]" value="Сірий" <?php echo (isset($info['color_scheme']) && in_array('Сірий', $info['color_scheme'])) ? 'checked' : ''; ?>>
<label for="grey">Сірий</label><br>
<input type="checkbox" id="orange" name="color_scheme[]" value="Помаранчевий" <?php echo (isset($info['color_scheme']) && in_array('Помаранчевий', $info['color_scheme'])) ? 'checked' : ''; ?>>
<label for="orange">Помаранчевий</label><br>

    <label for="other_color_scheme">Не знайшли потрібні кольори? Напишіть їх тут:</label><br>
    <textarea id="other_color_scheme" name="other_color_scheme" rows="4" cols="50"><?php echo isset($info['other_color_scheme']) ? $info['other_color_scheme'] : ''; ?></textarea><br><br>

   <label>Чи є у вас логотип або брендовий елемент, який потрібно включити?</label><br>
<input type="radio" id="logo_branding_yes" name="logo_branding" value="Так" <?php echo (isset($info['logo_branding']) && $info['logo_branding'] == 'Так') ? 'checked' : ''; ?>>
<label for="logo_branding_yes">Так</label><br>
<input type="radio" id="logo_branding_no" name="logo_branding" value="Ні" <?php echo (isset($info['logo_branding']) && $info['logo_branding'] == 'Ні') ? 'checked' : ''; ?>>
<label for="logo_branding_no">Ні</label><br>
<input type="radio" id="logo_branding_create" name="logo_branding" value="Бажаю розробити" <?php echo (isset($info['logo_branding']) && $info['logo_branding'] == 'Бажаю розробити') ? 'checked' : ''; ?>>
<label for="logo_branding_create">Бажаю розробити</label><br><br>



    <label for="design_description">Коротко опишіть, яким Ви уявляєте сайт з точки зору дизайну. Можете вказати сайти, дизайни яких вам не подобаються:</label><br>
    <textarea id="design_description" name="design_description" rows="4" cols="50"><?php echo isset($info['design_description']) ? $info['design_description'] : ''; ?></textarea><br><br>

    <label for="undesired_elements">Чого ви не хочете бачити на сайті? Можете вказати сайти, дизайни яких вам не подобаються:</label><br>
    <textarea id="undesired_elements" name="undesired_elements" rows="4" cols="50"><?php echo isset($info['undesired_elements']) ? $info['undesired_elements'] : ''; ?></textarea><br><br>


   <h2>Навігація та структура:</h2>
<label>Які розділи або сторінки ви бажаєте мати на сайті? (оберіть декілька)</label><br>
<input type="checkbox" id="home" name="site_sections[]" value="Домашня сторінка" <?php echo (isset($info['site_sections']) && in_array('Домашня сторінка', $info['site_sections'])) ? 'checked' : ''; ?>>
<label for="home">Домашня сторінка</label><br> 
<input type="checkbox" id="about" name="site_sections[]" value="Про нас"  <?php echo (isset($info['site_sections']) && in_array('Про нас', $info['site_sections'])) ? 'checked' : ''; ?>>
<label for="about">Про нас</label><br>
<input type="checkbox" id="blog" name="site_sections[]" value="Блог" <?php echo (isset($info['site_sections']) && in_array('Блог', $info['site_sections'])) ? 'checked' : ''; ?>>
<label for="blog">Блог</label><br>
<input type="checkbox" id="services" name="site_sections[]" value="Послуги" <?php echo (isset($info['site_sections']) && in_array('Послуги', $info['site_sections'])) ? 'checked' : ''; ?>>
<label for="services">Послуги</label><br>
<input type="checkbox" id="contact" name="site_sections[]" value="Контакти" <?php echo (isset($info['site_sections']) && in_array('Контакти', $info['site_sections'])) ? 'checked' : ''; ?>>
<label for="contact">Контакти</label><br>
<input type="checkbox" id="catalog" name="site_sections[]" value="Каталог" <?php echo (isset($info['site_sections']) && in_array('Каталог', $info['site_sections'])) ? 'checked' : ''; ?>>
<label for="catalog">Каталог</label><br>
<input type="checkbox" id="admin_panel" name="site_sections[]" value="Панель адміністратора" <?php echo (isset($info['site_sections']) && in_array('Панель адміністратора', $info['site_sections'])) ? 'checked' : ''; ?>>
<label for="admin_panel">Панель адміністратора</label><br>
<input type="checkbox" id="faq" name="site_sections[]" value="FAQ (Часті питання)" <?php echo (isset($info['site_sections']) && in_array('FAQ (Часті питання)', $info['site_sections'])) ? 'checked' : ''; ?>>
<label for="faq">FAQ (Часті питання)</label><br>
<input type="checkbox" id="user_panel" name="site_sections[]" value="Панель користувача" <?php echo (isset($info['site_sections']) && in_array('Панель користувача', $info['site_sections'])) ? 'checked' : ''; ?>>
<label for="user_panel">Панель користувача</label><br>
<input type="checkbox" id="partners" name="site_sections[]" value="Партнери/співпраця" <?php echo (isset($info['site_sections']) && in_array('Партнери/співпраця', $info['site_sections'])) ? 'checked' : ''; ?>>
<label for="partners">Партнери/співпраця</label><br>
<input type="checkbox" id="customer_support" name="site_sections[]" value="Підтримка клієнтів" <?php echo (isset($info['site_sections']) && in_array('Підтримка клієнтів', $info['site_sections'])) ? 'checked' : ''; ?>>
<label for="customer_support">Підтримка клієнтів</label><br>

<label for="other_site_sections">Не знайшли потрібні варіанти? Напишіть їх тут:</label><br>
<textarea id="other_site_sections" name="other_site_sections" rows="4" cols="50"><?php echo isset($info['other_site_sections']) ? $info['other_site_sections'] : ''; ?></textarea><br><br>

<label for="user_interaction">Опишіть як користувачі мають використовувати ваш сайт? Сформулюйте ланцюжок подій:</label><br>
<textarea id="user_interaction" name="user_interaction" rows="4" cols="50"><?php echo isset($info['user_interaction']) ? $info['user_interaction'] : ''; ?></textarea><br><br>

<label for="structure_navigation">Опишіть, яким Ви уявляєте сайт з точки зору структури та навігації? Можете вказати сайти, структура яких вам подобається</label><br>
<textarea id="structure_navigation" name="structure_navigation" rows="4" cols="50"><?php echo isset($info['structure_navigation']) ? $info['structure_navigation'] : ''; ?></textarea><br><br>

<label for="undesired_structure">Чи можете Ви описати структуру сайту, яка вам НЕ подобається? Можете вказати сайти, структура яких вам НЕ подобається</label><br>
<textarea id="undesired_structure" name="undesired_structure" rows="4" cols="50"><?php echo isset($info['undesired_structure']) ? $info['undesired_structure'] : ''; ?></textarea><br><br>

    <h2>Контент:</h2>
<label>Який тип контенту ви плануєте розміщувати?</label><br>
<input type="checkbox" id="articles" name="content_type[]" value="Статті" <?php echo (isset($info['content_type']) && in_array('Статті', $info['content_type'])) ? 'checked' : ''; ?>>
<label for="articles">Статті</label><br>
<input type="checkbox" id="photos" name="content_type[]" value="Фотографії" <?php echo (isset($info['content_type']) && in_array('Фотографії', $info['content_type'])) ? 'checked' : ''; ?>>
<label for="photos">Фотографії</label><br>
<input type="checkbox" id="videos" name="content_type[]" value="Відео" <?php echo (isset($info['content_type']) && in_array('Відео', $info['content_type'])) ? 'checked' : ''; ?>>
<label for="videos">Відео</label><br>
<input type="checkbox" id="advertisement" name="content_type[]" value="Реклама" <?php echo (isset($info['content_type']) && in_array('Реклама', $info['content_type'])) ? 'checked' : ''; ?>>
<label for="advertisement">Реклама</label><br>
<input type="checkbox" id="products" name="content_type[]" value="Продукти/Послуги" <?php echo (isset($info['content_type']) && in_array('Продукти/Послуги', $info['content_type'])) ? 'checked' : ''; ?>>
<label for="products">Продукти/Послуги</label><br>
<input type="checkbox" id="comments" name="content_type[]" value="Коментарі" <?php echo (isset($info['content_type']) && in_array('Коментарі', $info['content_type'])) ? 'checked' : ''; ?>>
<label for="comments">Коментарі</label><br>
<input type="checkbox" id="audio" name="content_type[]" value="Аудіо" <?php echo (isset($info['content_type']) && in_array('Аудіо', $info['content_type'])) ? 'checked' : ''; ?>>
<label for="audio">Аудіо</label><br>
<input type="checkbox" id="maps" name="content_type[]" value="Карти" <?php echo (isset($info['content_type']) && in_array('Карти', $info['content_type'])) ? 'checked' : ''; ?>>
<label for="maps">Карти</label><br>
<input type="checkbox" id="external_resources" name="content_type[]" value="Посилання на сторонні ресурси" <?php echo (isset($info['content_type']) && in_array('Посилання на сторонні ресурси', $info['content_type'])) ? 'checked' : ''; ?>>
<label for="external_resources">Посилання на сторонні ресурси</label><br>
<input type="checkbox" id="usage_policy" name="content_type[]" value="Правила використання та політика конфіденційності" <?php echo (isset($info['content_type']) && in_array('Правила використання та політика конфіденційності', $info['content_type'])) ? 'checked' : ''; ?>>
<label for="usage_policy">Правила використання та політика конфіденційності</label><br>

<label for="other_content_types">Не знайшли потрібні варіанти? Напишіть їх тут:</label><br>
<textarea id="other_content_types" name="other_content_types" rows="4" cols="50"><?php echo isset($info['other_content_types']) ? $info['other_content_types'] : ''; ?></textarea><br><br>

          

    <label>Чи є у вас вже контент, який потрібно перенести на сайт?</label><br>
<input type="radio" id="content_yes" name="existing_content" value="Так" <?php echo (isset($info['existing_content']) && $info['existing_content'] == 'Так') ? 'checked' : ''; ?>>
<label for="content_yes">Так</label><br>
<input type="radio" id="content_no" name="existing_content" value="Ні" <?php echo (isset($info['existing_content']) && $info['existing_content'] == 'Ні') ? 'checked' : ''; ?>>
<label for="content_no">Ні</label><br>

<label for="languages">Перерахуйте основні мови сайту</label><br>
<input type="text" id="languages" name="languages" value="<?php echo isset($info['languages']) ? $info['languages'] : ''; ?>"><br><br>

<label>Чи потрібна Вам допомога з наповненням сайту контентом?</label><br>
<input type="radio" id="content_assistance_yes" name="content_assistance" value="Так" <?php echo (isset($info['content_assistance']) && $info['content_assistance'] == 'Так') ? 'checked' : ''; ?>>
<label for="content_assistance_yes">Так</label><br>
<input type="radio" id="content_assistance_no" name="content_assistance" value="Ні" <?php echo (isset($info['content_assistance']) && $info['content_assistance'] == 'Ні') ? 'checked' : ''; ?>>
<label for="content_assistance_no">Ні</label><br>
<input type="radio" id="content_assistance_maybe" name="content_assistance" value="Потрібно уточнити" <?php echo (isset($info['content_assistance']) && $info['content_assistance'] == 'Потрібно уточнити') ? 'checked' : ''; ?>>
<label for="content_assistance_maybe">Потрібно уточнити</label><br>

<label>Чи визначились ви з тим, хто буде обслуговувати сайт?</label><br>
<input type="radio" id="site_maintenance_yes" name="site_maintenance" value="Так" <?php echo (isset($info['site_maintenance']) && $info['site_maintenance'] == 'Так') ? 'checked' : ''; ?>>
<label for="site_maintenance_yes">Так</label><br>
<input type="radio" id="site_maintenance_no" name="site_maintenance" value="Ні" <?php echo (isset($info['site_maintenance']) && $info['site_maintenance'] == 'Ні') ? 'checked' : ''; ?>>
<label for="site_maintenance_no">Ні</label><br>
<input type="radio" id="site_maintenance_maybe" name="site_maintenance" value="Потрібно уточнити" <?php echo (isset($info['site_maintenance']) && $info['site_maintenance'] == 'Потрібно уточнити') ? 'checked' : ''; ?>>
<label for="site_maintenance_maybe">Потрібно уточнити</label><br>


<label>Вкажіть передбачувану вами частоту відвідування сайту користувачами:</label><br>
<input type="radio" id="visitation_hourly" name="visitation_frequency" value="Щогодини (завжди під рукою)" <?php echo (isset($info['visitation_frequency']) && $info['visitation_frequency'] == 'Щогодини (завжди під рукою)') ? 'checked' : ''; ?>>
<label for="visitation_hourly">Щогодини (завжди під рукою)</label><br>
<input type="radio" id="visitation_daily" name="visitation_frequency" value="Щоденно" <?php echo (isset($info['visitation_frequency']) && $info['visitation_frequency'] == 'Щоденно') ? 'checked' : ''; ?>>
<label for="visitation_daily">Щоденно</label><br>
<input type="radio" id="visitation_weekly" name="visitation_frequency" value="Щотижня або щомісяця" <?php echo (isset($info['visitation_frequency']) && $info['visitation_frequency'] == 'Щотижня або щомісяця') ? 'checked' : ''; ?>>
<label for="visitation_weekly">Щотижня або щомісяця</label><br>
<input type="radio" id="visitation_as_needed" name="visitation_frequency" value="При потребі" <?php echo (isset($info['visitation_frequency']) && $info['visitation_frequency'] == 'При потребі') ? 'checked' : ''; ?>>
<label for="visitation_as_needed">При потребі</label><br>
<input type="radio" id="visitation_via_ads" name="visitation_frequency" value="Перенаправлені через реклами або рекомендації" <?php echo (isset($info['visitation_frequency']) && $info['visitation_frequency'] == 'Перенаправлені через реклами або рекомендації') ? 'checked' : ''; ?>>
<label for="visitation_via_ads">Перенаправлені через реклами або рекомендації</label><br>


<label>Вкажіть додаткові функціональні можливості, які б ви хотіли бачити на сайті:</label><br>
<input type="checkbox" id="chat" name="additional_features[]" value="Чат" <?php echo (isset($info['additional_features']) && in_array('Чат', $info['additional_features'])) ? 'checked' : ''; ?>>
<label for="chat">Чат</label><br>
<input type="checkbox" id="payment" name="additional_features[]" value="Оплата на сайті" <?php echo (isset($info['additional_features']) && in_array('Оплата на сайті', $info['additional_features'])) ? 'checked' : ''; ?>>
<label for="payment">Оплата на сайті</label><br>
<input type="checkbox" id="statistics" name="additional_features[]" value="Статистика" <?php echo (isset($info['additional_features']) && in_array('Статистика', $info['additional_features'])) ? 'checked' : ''; ?>>
<label for="statistics">Статистика</label><br>
<input type="checkbox" id="popular_content" name="additional_features[]" value="Визначення популярних статей/новин/товарів" <?php echo (isset($info['additional_features']) && in_array('Визначення популярних статей/новин/товарів', $info['additional_features'])) ? 'checked' : ''; ?>>
<label for="popular_content">Визначення популярних статей/новин/товарів</label><br>
<input type="checkbox" id="registration" name="additional_features[]" value="Реєстрація та різні ролі користувачів" <?php echo (isset($info['additional_features']) && in_array('Реєстрація та різні ролі користувачів', $info['additional_features'])) ? 'checked' : ''; ?>>
<label for="registration">Реєстрація та різні ролі користувачів</label><br>
<input type="checkbox" id="delivery" name="additional_features[]" value="Оформлення доставки" <?php echo (isset($info['additional_features']) && in_array('Оформлення доставки', $info['additional_features'])) ? 'checked' : ''; ?>>
<label for="delivery">Оформлення доставки</label><br>
<input type="checkbox" id="search" name="additional_features[]" value="Пошук і фільтри" <?php echo (isset($info['additional_features']) && in_array('Пошук і фільтри', $info['additional_features'])) ? 'checked' : ''; ?>>
<label for="search">Пошук і фільтри</label><br>
<input type="checkbox" id="newsletter" name="additional_features[]" value="Розсилка новин" <?php echo (isset($info['additional_features']) && in_array('Розсилка новин', $info['additional_features'])) ? 'checked' : ''; ?>>
<label for="newsletter">Розсилка новин</label><br>
<input type="checkbox" id="blog2" name="additional_features[]" value="Блог" <?php echo (isset($info['additional_features']) && in_array('Блог', $info['additional_features'])) ? 'checked' : ''; ?>>
<label for="blog2">Блог</label><br>
<input type="checkbox" id="social_media_integration" name="additional_features[]" value="Інтеграція з соціальними медіа" <?php echo (isset($info['additional_features']) && in_array('Інтеграція з соціальними медіа', $info['additional_features'])) ? 'checked' : ''; ?>>
<label for="social_media_integration">Інтеграція з соціальними медіа</label><br><br>


    
   <h2>Конкуренти:</h2>
<label for="company1_name">Назва компанії</label><br>
<input type="text" id="company1_name" name="company1_name" value="<?php echo isset($info['company1_name']) ? $info['company1_name'] : ''; ?>" ><br><br>
<label for="company1_url">URL</label><br>
<input type="text" id="company1_url" name="company1_url" value="<?php echo isset($info['company1_url']) ? $info['company1_url'] : ''; ?>" ><br><br>
<label for="company1_strengths_weaknesses">Cильні та слабкі сторони конкурента: </label><br>
<textarea id="company1_strengths_weaknesses" name="company1_strengths_weaknesses" rows="4" cols="50"><?php echo isset($info['company1_strengths_weaknesses']) ? $info['company1_strengths_weaknesses'] : ''; ?></textarea><br><br>

<label for="company2_name">Назва компанії</label><br>
<input type="text" id="company2_name" name="company2_name" value="<?php echo isset($info['company2_name']) ? $info['company2_name'] : ''; ?>" ><br><br>
<label for="company2_url">URL</label><br>
<input type="text" id="company2_url" name="company2_url" value="<?php echo isset($info['company2_url']) ? $info['company2_url'] : ''; ?>" ><br><br>
<label for="company2_strengths_weaknesses">Cильні та слабкі сторони конкурента: </label><br>
<textarea id="company2_strengths_weaknesses" name="company2_strengths_weaknesses" rows="4" cols="50"><?php echo isset($info['company2_strengths_weaknesses']) ? $info['company2_strengths_weaknesses'] : ''; ?></textarea><br><br>

<label for="borrow_avoid">Що б ви хотіли запозичити у конкурентів, а чого категорично уникнути?</label><br>
<textarea id="borrow_avoid" name="borrow_avoid" rows="4" cols="50"><?php echo isset($info['borrow_avoid']) ? $info['borrow_avoid'] : ''; ?></textarea><br><br>

<label for="market_research">Чи бажаєте Ви щоб ми детальніше дослідили ринок конкурентів?</label><br>

<input type="radio" id="market_research_yes" name="market_research" value="Так" <?php echo (isset($info['market_research']) && $info['market_research'] == 'Так') ? 'checked' : ''; ?>>
<label for="market_research_yes">Так</label><br>
<input type="radio" id="market_research_no" name="market_research" value="Ні" <?php echo (isset($info['market_research']) && $info['market_research'] == 'Ні') ? 'checked' : ''; ?>>
<label for="market_research_no">Ні</label><br>
<input type="radio" id="market_research_maybe" name="market_research" value="Потрібно уточнити" <?php echo (isset($info['market_research']) && $info['market_research'] == 'Потрібно уточнити') ? 'checked' : ''; ?>>
<label for="market_research_maybe">Потрібно уточнити</label><br><br>

<h2>Додаткові питання</h2>
  <label for="deadline">Очікуваний термін здачі проекту (місяці)</label><br>
<input type="text" id="deadline" name="deadline" value="<?php echo isset($info['deadline']) ? $info['deadline'] : ''; ?>" ><br><br>
 <label for="price">Очікувана вартість ($)</label><br>
<input type="text" id="price" name="price" value="<?php echo isset($info['price']) ? $info['price'] : ''; ?>" ><br><br>
<label for="next_location">Як буде розповсюджуватись проект?</label><br>
<input type="radio" id="local" name="next_location" value="Локально" <?php echo (isset($info['next_location']) && is_string($info['next_location']) && $info['next_location'] == "Локально") ? 'checked' : ''; ?>>
<label for="local">Локально (місто/регіон)</label><br>

<input type="radio" id="international" name="next_location" value="Міжнародно" <?php echo (isset($info['next_location']) && is_string($info['next_location']) && $info['next_location'] == "Міжнародно") ? 'checked' : ''; ?>>
<label for="international">Міжнародно</label><br>

<input type="radio" id="global" name="next_location" value="Глобально" <?php echo (isset($info['next_location']) && is_string($info['next_location']) && $info['next_location'] == "Глобально") ? 'checked' : ''; ?>>
<label for="global">Глобально</label><br><br>

<label for="last_comment">Коментарі/запитання/побажання</label><br>
<textarea id="last_comment" name="last_comment" rows="4" cols="50"><?php echo isset($info['last_comment']) ? $info['last_comment'] : ''; ?></textarea><br><br>


<button type="submit" name='brief-btn'>Надіслати</button>

</form>

<script>
    var additionalContactBlock = document.getElementById("additionalContactBlock");
    
    document.getElementById("toggleButton").addEventListener("click", function() {
        if (additionalContactBlock.style.display === "none") {
            additionalContactBlock.style.display = "block";
        } else {
            additionalContactBlock.style.display = "none";
        }
    });
    
    document.getElementById("clearFieldsButton").addEventListener("click", function() {
        var additionalContactFields = additionalContactBlock.querySelectorAll("input, textarea");
        additionalContactFields.forEach(function(field) {
            field.value = ""; // Очищаємо значення полів
        });
    });
</script>
