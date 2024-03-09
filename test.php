<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: rgb(184, 242, 230);
            background: radial-gradient(circle, rgba(184, 242, 230, 1) 0%, rgba(250, 243, 221, 1) 100%);
        }


        .header {
            overflow: hidden;
            background-color: #aed9e0;
            padding: 10px 10px;
            color: #5e6472;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
            line-height: 25px;
            border-radius: 4px;

        }

        form {
            width: 50%;
        }

        .block {
            margin-left: 150px;
            margin: 10px auto;
            width: 50%;
            border-radius: 15px;
            background-color: #faf3dd;
            padding: 20px;
            background: #fff;
        }
    </style>
</head>

<body>

    <?php
    // объявляем переменные и устанавливаем пустые значения
    $nameErr = "";
    $name = "";
    $results_displayed = false;
    $correct_ansver = 0;


    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

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

        // Установим флаг, что результаты были выведены
        $results_displayed = true;
    }




    ?>

    <div class="header">
        <h1> Пройти тест </h1>
    </div>
    <br> <br>

    <div class="block">


        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name"> Name:
                <input type="text" name="name" value="<?php echo $name; ?>">
                <span class="error">* <?php echo $nameErr; ?></span>
                <br> <br>
            </label>

            <h3>Какое животное не умеет чихать ?</h3>
            <div class="group">
                <input type="radio" name="test1" value="Dog"> - Собака<br>
                <input type="radio" name="test1" value="Elephant"> - Слон<br>
                <input type="radio" name="test1" value="Rabbit"> - Кролик<br>
                <input type="radio" name="test1" value="Cat"> - Кошка<br>

            </div>

            <h3>Какое животное видит мир в черно - белых цветах ?</h3>

            <div class="group">
                <input type="radio" name="test2" value="dog"> - Собака<br>
                <input type="radio" name="test2" value="Owl"> - Сова<br>
                <input type="radio" name="test2" value="Cheetah"> - Гепард<br>
                <input type="radio" name="test2" value="Snake"> - Змея<br>
            </div>

            <h3>Какому народу приписывается изобретение шахмат ?</h3>

            <div class="group">
                <input type="radio" name="test3" value="Chinese"> - Китайцы<br>
                <input type="radio" name="test3" value="Egyptians"> - Египтяне<br>
                <input type="radio" name="test3" value="Indians"> - Индийцы<br>
                <input type="radio" name="test3" value="Greeks"> - Греки<br>
            </div>


            <h3>Какой алкогольный напиток самый популярный в мире ?</h3>

            <div class="group">
                <input type="checkbox" name="test4[]" value="Vodka"> - Водка<br>
                <input type="checkbox" name="test4[]" value="Whiskey"> - Виски<br>
                <input type="checkbox" name="test4[]" value="Vine"> - Вино<br>
                <input type="checkbox" name="test4[]" value="Beer"> - Пиво<br>
            </div>
            <br>
            <input type="submit" value="Отправить">
        </form>

        <?php
      // Вывод результатов, если кнопка "Отправить" была нажата и данные валидны
if ($results_displayed && empty($nameErr)) {
    if (empty($errors)) {
        ?>
        <h2>Результаты теста:</h2>
        <p>Имя пользователя: <?php echo $name; ?></p>
        <p>Ответ на вопрос 1: <?php echo isset($_POST['test1']) ? $_POST['test1'] : 'Не выбран'; ?></p>
        <p>Ответ на вопрос 2: <?php echo isset($_POST['test2']) ? $_POST['test2'] : 'Не выбран'; ?></p>
        <p>Ответ на вопрос 3: <?php echo isset($_POST['test3']) ? $_POST['test3'] : 'Не выбран'; ?></p>
        <p>Ответ на вопрос 4: <?php echo isset($_POST['test4']) ? implode(', ', $_POST['test4']) : 'Не выбран'; ?></p>
        <?php
    }
}
?>
    </div>
    

</body>

</html>
