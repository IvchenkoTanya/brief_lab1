<?php
 session_start();
echo 'Дані було успішно збережено<br><br>';
?>
<div>
    <a href="index.php">Повернутися на головну сторінку</a>
    <a href="auth.php">Вхід</a> 
    <?php if(isset($_SESSION['user']['role'])): ?>
    <a href="allbriefs.php">Усі брифи</a> 
    <?php endif; ?>
</div>