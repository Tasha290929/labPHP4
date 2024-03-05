<div class="form">
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
        <fieldset>
            <legend>Оставьте отзыв!</legend>
            <div id="main_info" style="display: flex; flex-direction:
column; gap: 10px;">
                <div>
                    <label for="name">Имя:
                        <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" />
                    </label>
                </div>
                <div>
                    <label for="email">Email:
                        <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" />
                    </label>
                </div>
            </div>
            <div id="extra_info">
                <div>
                    <p><label for="review">Оцените наш сервис!</label></p>
                    <div style="display: flex; flex-direction: column;">
                        <p><input id="review" type="radio" name="review" value="10" checked>Хорошо</p>
                        <p><input id="review" type="radio" name="review" value="8">Удовлетворительно</p>
                        <p><input id="review" type="radio" name="review" value="5">Плохо</p>
                    </div>
                </div>
            </div>
            <div id="message_info">
                <div>
                    <p><label for="comment">Ваш комментарий: </label></p>
                    <textarea id="comment" name="comment" cols="30" rows="10" class="comment"><?php echo isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : ''; ?></textarea>
                </div>
            </div>
            <div id="buttons" style="display: flex; flex-direction: row;
gap: 10px; margin-top: 10px;">
                <input type="submit" value="Отправить" />
                <input type="reset" value="Удалить" />
            </div>
        </fieldset>
    </form>
    <!-- Добавьте в эту область код, который будет отображать сообщение
только после отправки формы -->


    <?php
    $array = [];
    function dataerror($data)
    {
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $errors[$key] = "Вы ввели неверное поле $key";
            }
            
        }

        if  (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Пожалуйста, введите корректный email';
        }

        return $errors;
    }
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $validationErrors = dataerror($_POST);

        // If there are no validation errors, display the result
        if (empty($validationErrors)) { ?>
           <div id="result">
 <p>Ваше имя: <b><?php echo $_POST["name"] ?></b></p>
 <p>Ваш e-mail: <b><?php echo $_POST["email"] ?></b></p>
 <p>Оценка товара: <b><?php echo $_POST["review"] ?></b></p>
 <p>Ваше сообщение: <b><?php echo $_POST["comment"] ?></b></p>
 </div>
</div>
<?php
        } else {
            // If there are validation errors, display them
            echo '<div id="error">';
            echo '<p>Пожалуйста, исправьте следующие ошибки:</p>';
            echo '<ul>';
            foreach ($validationErrors as $error) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul>';
            echo '</div>';
        }
    }
    ?>