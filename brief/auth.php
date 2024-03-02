<?php
session_start();
 echo '
<div>
   
    <a href="index.php">Повернутися на головну сторінку</a>
    <a href="auth.php">Вхід</a> ' ;
    if(isset($_SESSION['user']['role'])) {
    '<a href="allbriefs.php">Усі брифи</a></div> ';
};



if(isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 'Admin') {
    echo "Ви увійшли як " . $_SESSION['user']['role'];
    // Додатковий код для сторінки, яку бачать увійшові користувачі
} else {
    // Форма для авторизації
    echo '
    <div class="container">
        <h2>Авторизація</h2>
        <form action="../controllers/authController.php" method="post">
            <label for="username">Ім\'я користувача:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" name="btn-auth" value="Увійти">
        </form>
    </div>';
}