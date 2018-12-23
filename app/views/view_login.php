<link rel="stylesheet" href="css/auth.css">
<link rel="stylesheet" href="css/form.css">

<div class="container">
    <?php if(!empty($data["errors"])): ?>
        <div class="card card-error">
            <?php foreach ($data["errors"] as $value): ?>
                <p><?= $value ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form action="/login" method="post" class="card card-register" id="form-register" required>
        <div class="row">
            <div class="form-group">
                <label for="nickname">Никнейм</label>
                <input type="text" name="nickname" id="nickname" placeholder="nickname" required>
                <small class="error-code"></small>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password" placeholder="********" required>
                <small class="error-code"></small>
            </div>
            <input class="submit-form-button" type="submit" value="Войти">
        </div>
    </form>
</div>

<script src="js/checkForm.js"></script>
<script>
    window.addEventListener('load', function (ev) {
        var nick = document.getElementById("nickname"),
            password = document.getElementById("password"),
            formRegister = document.getElementById("form-register");

        nick.addEventListener('keyup', function (ev) {
            var value = ev.srcElement.value;
            var elErrorCode = ev.path[1].children[2];
            if(value.length !== 0) {
                if (checkStringToRussianLaungage(value)) {
                    elErrorCode.style.display = "block";
                    elErrorCode.innerText = 'Никнейм может содержать только латинские буквы, цифры и символы подчёркивания';
                } else if (checkFirstSymbolToNumber(value[0])) {
                    elErrorCode.style.display = "block";
                    elErrorCode.innerText = 'Никнейм должен начинаться с латинской буквы';
                } else if (value.length > 50) {
                    elErrorCode.style.display = "block";
                    elErrorCode.innerText = 'Никнейм Может быть не более 50 символов';
                } else {
                    elErrorCode.style.display = "none";
                    elErrorCode.innerText = '';
                }
            } else {
                elErrorCode.style.display = "none";
                elErrorCode.innerText = '';
            }
        });

        password.addEventListener('keyup', function (ev) {
            var value = ev.srcElement.value;
            var elErrorCode = ev.path[1].children[2];

            if(value.length !== 0) {
                if(value.length < 8) {
                    elErrorCode.style.display = "block";
                    elErrorCode.innerText = 'Пароль должен иметь более 8 символов';
                } else {
                    elErrorCode.style.display = "none";
                    elErrorCode.innerText = '';
                }
            } else {
                elErrorCode.style.display = "none";
                elErrorCode.innerText = '';
            }
        });

        formRegister.addEventListener('submit', function (ev) {
            var elements = document.getElementsByClassName("error-code");

            for(var i=0; i < (elements.length-1); i++) {
                if(elements[i].style.display !== "none") {
                    ev.preventDefault();
                    alert("Вы указали что-то не корректно");
                    return;
                }
            }
        });
    });
</script>