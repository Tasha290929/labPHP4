<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
    // объявляем переменные и устанавливаем пустые значения
    $nameErr = "";
    $name ="";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Введите имя";
        } else {
            $name = test_input($_POST["name"]);
            // проверяем, содержит ли имя только буквы и пробелы
            if (!preg_match("/^(([a-zA-Z' -]{3,20})|([а-яА-ЯЁёІіЇїҐґЄє' -]{3,20}))$/u", $name)) {
                $nameErr = "Имя должно содержать только буквы и пробелы";
            }
        }
    }
    
    ?>

<div class="block">
<h1> Пройти тест </h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label name="name"> Name:
                <input type="text" name="name" value="<?php echo $name; ?>">
                <span class="error">* <?php echo $nameErr; ?></span>
                <br> <br>
            </label>

 <h3>Какое животное не умеет чихать ?</h3>
            <div class="group">
	<input type="radio" name="test" value="1"> - Собака<br>
	<input type="radio" name="test" value="2"> - Слон<br>
	<input type="radio" name="test" value="3"> - Кролик<br>
    <input type="radio" name="test" value="4"> - Кошка<br>

</div>

<h3>Какое животное видит мир в черно - белых цветах ?</h3>

<div class="group">
	<input type="radio" name="test" value="1"> - Собака<br>
	<input type="radio" name="test" value="2"> - Сова<br>
	<input type="radio" name="test" value="3"> - Гепард<br>
    <input type="radio" name="test" value="4"> - Змея<br>//
</div>

<h3>Какому народу приписывается изобретение шахмат ?</h3>

<div class="group">
	<input type="radio" name="test" value="1"> - Китайцы<br>
	<input type="radio" name="test" value="2"> - Египтяне<br>
	<input type="radio" name="test" value="3"> - Индийцы<br>//
    <input type="radio" name="test" value="4"> - Греки<br>
</div>


<h3>Какой алкогольный напиток самый популярный в мире ?</h3>

<div class="group">
	<input type="radio" name="test" value="1"> - Водка<br>
	<input type="radio" name="test" value="2"> - Виски<br>//
	<input type="radio" name="test" value="3"> - Вино<br>
    <input type="radio" name="test" value="4"> - Пиво<br>
</div>

</form>


</div>    

</body>
</html>