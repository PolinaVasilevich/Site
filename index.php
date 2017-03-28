<?php
session_start();
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Главная страница</title>
    </head>
    <body>
        <div align="center"><h2>Авторизация на сайте</h2>
            <form action="index.php" method="post">

                <!--****  testreg.php - это адрес обработчика. То есть, после нажатия на кнопку  "Войти", данные из полей отправятся на страничку testreg.php методом  "post" ***** -->
                <p>
                    <label>Ваш логин:<br></label>
                    <input name="login" type="text" size="15" maxlength="15">
                </p>


                <!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->

                <p>

                    <label>Ваш пароль:<br></label>
                    <input name="password" type="password" size="15" maxlength="15">
                </p>

                <!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** --> 

                <p>
                    <input type="submit" name="submit" value="Войти">

                    <!--**** Кнопочка (type="submit") отправляет данные на страничку testreg.php ***** --> 
                   
                </p></form>
            <br>
<?php
$connection = mysqli_connect('localhost', 'root', '', 'sql') or die(mysqli_error()); 

 if (isset($_POST['submit'])) // Отлавливаем нажатие кнопки "Отправить"
{
if (empty($_POST['login'])) // Если поле логин пустое
{
echo '<script>alert("Поле логин не заполненно");</script>'; // То выводим сообщение об ошибке
}
elseif (empty($_POST['password'])) // Если поле пароль пустое
{
echo '<script>alert("Поле пароль не заполненно");</script>'; // То выводим сообщение об ошибке
}
else  // Иначе если все поля заполненны
{    
$login = $_POST['login']; // Записываем логин в переменную 
$password = $_POST['password']; // Записываем пароль в переменную           
$query = mysqli_query($connection, "SELECT `id` FROM `users` WHERE `login` = '$login' AND `password` = '$password'"); // Формируем переменную с запросом к базе данных с проверкой пользователя
$result = mysqli_fetch_array($query); // Формируем переменную с исполнением запроса к БД 
if (empty($result['id'])) // Если запрос к бд не возвразяет id пользователя
{
echo '<script>alert("Неверные Логин или Пароль");</script>'; // Значит такой пользователь не существует или не верен пароль
}
else // Если возвращяем id пользователя, выполняем вход под ним
{
$_SESSION['password'] = $password; // Заносим в сессию  пароль
$_SESSION['login'] = $login; // Заносим в сессию  логин
$_SESSION['id'] = $result['id']; // Заносим в сессию  id
echo '<div align="center">Вы успешно вошли в систему, как '.$_SESSION['login'].'</div>';
echo "<img src = 'http://kot-pes.com/wp-content/uploads/2016/06/dsd-650x366.jpg'> ";// Выводим сообщение что пользователь авторизирован        
}     
}		
} ?>

<?php if (isset($_GET['exit'])) { // если вызвали переменную "exit"
unset($_SESSION['password']); // Чистим сессию пароля
unset($_SESSION['login']); // Чистим сессию логина
unset($_SESSION['id']); // Чистим сессию id
} ?>

<?php if (isset($_SESSION['login']) && isset($_SESSION['id'])) // если в сессии загружены логин и id
{
echo '<div align="center"><a href="index.php?exit">Выход</a></div>'; // Выводим нашу ссылку выхода
} ?>
<?php if (!isset($_SESSION['login']) || !isset($_SESSION['id'])) // если в сессии не загружены логин и id
{
echo '<div align="center"><a href="reg.php">Регистрация</a></div>'; // Выводим нашу ссылку регистрации
} ?>