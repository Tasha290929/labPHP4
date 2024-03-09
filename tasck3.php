<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>task3</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to top, #cd9cf2 0%, #f6f3ff 100%);
        }

        .header {
            overflow: hidden;
            background-color: #c8b6ff;
            padding: 10px 10px;
        }

        .header a {
            float: left;
            color: white;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            line-height: 25px;
            border-radius: 4px;

        }



        .header a:hover {
            background-color: #bbd0ff;
            color: white;
        }

        h1 {
            color: white;
        }

        .header-right {
            float: right;
        }

        form {
            width: 50%;
            border-radius: 10px;
            margin-left: 50px;

        }

        .vivod {
            margin-left: 50px;
        }
    </style>

</head>

<body>
    <div class="header">
        <h1> #my-shop </h1>
        <div class="header-right">
            <a class="active" href="#home">Home</a>
            <a href="#contact">Contact</a>
            <a href="#about">About</a>
        </div>
    </div>

    <?php
    // объявляем переменные и устанавливаем пустые значения
    $nameErr = $emailErr = $commentErr = "";
    $name = $email = $comment = "";

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
    if (empty($_POST["email"])) {
        $emailErr = "Введите Email";
    } else {
        $email = test_input($_POST["email"]);
        // проверьте, правильно ли сформирован адрес электронной почты
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Неверный формат электронной почты";
        }
    }

    if (empty($_POST["comment"])) {
        $commentErr = "обязательное поле";
    } else {
        $comment = test_input($_POST["comment"]);
    }

    // Валидация чекбокса "agree"
    if (empty($_POST["agree"])) {
        $agreeErr = "<br> Поставь галочку";
    } else {
        $agree = test_input($_POST["agree"]);
    }


    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!--Функция htmlspecialchars() преобразует данные, введенные пользователем, которые могут содержать нежелательные HTML-тэги. -->
        <fieldset>
            <legend>
                <h2> # Write comment</h2>
            </legend>
            <label name="name"> Name:
                <input type="text" name="name" value="<?php echo $name; ?>">
                <span class="error">* <?php echo $nameErr; ?></span>
            </label>
                <br> <br>
                <label name="email"> Mail:
                    <input type="text" name="email" value="<?php echo $email; ?>">
                    <span class="error">* <?php echo $emailErr; ?></span>
                </label>
                <br> <br>
                Comment:
                <br>
                <textarea name="comment" rows="5" cols="40"><?php echo $comment; ?></textarea>
                <span class="error"><?php echo $commentErr; ?></span>
                <br><br>
                <input type="checkbox" name="agree" value="yes"> Do you agree with data processing?

                <span class="error"><?php echo $agreeErr; ?></span>
                <br><br>
                <div id="buttons" style="display: flex; flex-direction: row;
gap: 20px; margin-top: 10px;">
                    <input type="submit" value="send" />

                </div>
        </fieldset>

    </form>

    <div class="vivod">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "<h2>Вы ввели:</h2>";
            echo $name . "<br>" . $email . "<br>" . $comment;
        }
        ?>
    </div>
</body>

</html>