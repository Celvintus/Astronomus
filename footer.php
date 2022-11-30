<div id="popup_2" class="popup <?php 
    if ($_SESSION['message']) {
		echo 'open';
	}?>">
        <div class="popup-body">
            <div class="popup-content">
                <h2 class="popup-title">Вход</h2>
                <a class="popup-close close-popup" href="#header"><img alt="svgImg"
                        src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHg9IjBweCIgeT0iMHB4Igp3aWR0aD0iMjQiIGhlaWdodD0iMjQiCnZpZXdCb3g9IjAgMCAyNCAyNCIKc3R5bGU9IiBmaWxsOiMwMDAwMDA7Ij48cGF0aCBkPSJNIDQuNzA3MDMxMiAzLjI5Mjk2ODggTCAzLjI5Mjk2ODggNC43MDcwMzEyIEwgMTAuNTg1OTM4IDEyIEwgMy4yOTI5Njg4IDE5LjI5Mjk2OSBMIDQuNzA3MDMxMiAyMC43MDcwMzEgTCAxMiAxMy40MTQwNjIgTCAxOS4yOTI5NjkgMjAuNzA3MDMxIEwgMjAuNzA3MDMxIDE5LjI5Mjk2OSBMIDEzLjQxNDA2MiAxMiBMIDIwLjcwNzAzMSA0LjcwNzAzMTIgTCAxOS4yOTI5NjkgMy4yOTI5Njg4IEwgMTIgMTAuNTg1OTM4IEwgNC43MDcwMzEyIDMuMjkyOTY4OCB6Ij48L3BhdGg+PC9zdmc+" /></a>
                    <?php
                    if ($_SESSION['message']) {
                        echo '<span class="error">' . $_SESSION['message'] . '</span>';
                    }
                    unset($_SESSION['message']);
                    ?>
                <form action="login.php" class="popup-form" method="post">
                    <ul>
                        <li>
                            <label for="theme">Email</label>
                            <input id="emailInput" class="email" type="text" name="email_login" value="">
                        </li>
                        <li>
                            <label for="message">Пароль</label>
                            <input id="passwordlInput" class="password" type="password" name="password_login">
                        </li>
                        
                    </ul>
                    <button type="submit" id="signin_btn" name="submit_login">Войти в аккаунт</button>
                </form>

            </div>
        </div>
    </div>
    <div id="popup_3" class="popup <?php 
    if ($_SESSION['message_error']) {
		echo 'open';
	}?>">
        <div class="popup-body">
            <div class="popup-content">
                <h2 class="popup-title">Регистрация</h2>
                <a class="popup-close close-popup" href="#header"><img alt="svgImg"
                        src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHg9IjBweCIgeT0iMHB4Igp3aWR0aD0iMjQiIGhlaWdodD0iMjQiCnZpZXdCb3g9IjAgMCAyNCAyNCIKc3R5bGU9IiBmaWxsOiMwMDAwMDA7Ij48cGF0aCBkPSJNIDQuNzA3MDMxMiAzLjI5Mjk2ODggTCAzLjI5Mjk2ODggNC43MDcwMzEyIEwgMTAuNTg1OTM4IDEyIEwgMy4yOTI5Njg4IDE5LjI5Mjk2OSBMIDQuNzA3MDMxMiAyMC43MDcwMzEgTCAxMiAxMy40MTQwNjIgTCAxOS4yOTI5NjkgMjAuNzA3MDMxIEwgMjAuNzA3MDMxIDE5LjI5Mjk2OSBMIDEzLjQxNDA2MiAxMiBMIDIwLjcwNzAzMSA0LjcwNzAzMTIgTCAxOS4yOTI5NjkgMy4yOTI5Njg4IEwgMTIgMTAuNTg1OTM4IEwgNC43MDcwMzEyIDMuMjkyOTY4OCB6Ij48L3BhdGg+PC9zdmc+" /></a>
                    <?php
                        if ($_SESSION['message_error']) {
                            echo '<span class="error">' . $_SESSION['message_error'] . '</span>';
                        }
                        unset($_SESSION['message_error']);
                        ?>
                <form action="registration.php" class="popup-form" method="post">
                    <ul>
                        <li>
                            <label for="theme">Email</label>
                            <input id="emailInput" class="email" type="text" name="email_login" value="">
                        </li>
                        <li>
                            <label for="message">Пароль</label>
                            <input id="passwordlInput" class="password" type="password" name="password_login">
                        </li>
                        <li>
                            <label for="message">Подтвердите пароль</label>
                            <input id="passwordlInputRepeate" class="password" type="password" name="password_login_Repeate">
                        </li>
                    </ul>
                    <button type="submit" id="registration_btn" name="submit_registration">Зарегистрироваться</button>
                </form>

            </div>
        </div>