<link rel="stylesheet" href="/css/auth.css">
<link rel="stylesheet" href="/css/form.css">

<div class="container">
    <?php if(!empty($data["errors"])): ?>
        <div class="card card-error">
            <?php foreach ($data["errors"] as $value): ?>
                <p><?= $value ?></p>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <form action="/editPost/<?= $GLOBALS['idPost'] ?>" method="post" onsubmit="addNewLines(this)" enctype="multipart/form-data" class="card card-register" id="form-register">
            <div class="row">
                <div class="form-group">
                    <label for="title">Заголовок статьи</label>
                    <input type="text" name="title" id="title" placeholder="Заголовок" maxlength="50" value="<?= !empty($data['title']) ? $data['title'] : ''; ?>" required>
                    <small class="error-code"></small>
                </div>
                <div class="form-group">
                    <label for="prev-text">Превью тектса</label>
                    <div class="buttons">
                        <i onclick="doAddTags('prev-text', '[b]')" class="fas fa-bold" title="Жирный текст"></i>
                        <i onclick="doAddTags('prev-text', '[s]')" class="fas fa-strikethrough" title="Зачеркивание"></i>
                        <i onclick="doAddTags('prev-text', '[h]')" class="fas fa-eye-slash" title="Скрыть текст"></i>
                    </div>
                    <textarea type="text" name="prev-text" id="prev-text" placeholder="Превью текста" maxlength="255" required><?= !empty($data['prevText']) ? $data['prevText'] : ''; ?></textarea>
                    <small class="error-code"></small>
                </div>
                <div class="form-group">
                    <label for="text">Полный текст</label>
                    <div class="buttons">
                        <i onclick="doAddTags('text', '[b]')" class="fas fa-bold" title="Жирный текст"></i>
                        <i onclick="doAddTags('text', '[s]')" class="fas fa-strikethrough" title="Зачеркивание"></i>
                        <i onclick="doAddTags('text', '[h]')" class="fas fa-eye-slash" title="Скрыть текст"></i>
                        <i onclick="doAddTags('text', '[inpImg]')" class="fas fa-images" title="Вставить изображение"></i>
                    </div>
                    <textarea type="text" name="text" id="text" placeholder="Полный текст" required><?= !empty($data['text']) ? $data['text'] : ''; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="category-name">Напишите категорию в которой будет распологаться данный пост</label>
                    <input type="text" name="category-name" onkeyup="checkSymbol(this)" id="category-name" placeholder="Категория" maxlength="50" value="<?= !empty($data['categoryName']) ? $data['categoryName'] : ''; ?>" required>
                    <small class="error-code"></small>
                </div>
                <input type="file" accept="image/*" name="photo" id="photo">
                <input class="submit-form-button" type="submit" value="Обновить">
            </div>
        </form>
    <?php endif; ?>
</div>

<script>
    function checkSymbol(ev) {
        var regex = /( )/gm;
        var text = ev.value;
        document.getElementById('category-name').value = text.replace(regex, '');
    }

    function doAddTags(textAreaInput, tagStart) {
        var textArea = document.getElementById(textAreaInput);
        if(tagStart === '[inpImg]') {
            var uri = prompt('Вставьте ссылку на картинку');

            if(uri.length !== 0) {
                textArea.value += '\n[inpImg=' + uri + ']\n';
            }
        } else {
            var tagEnd = tagStart.substr(0, 1) + '/' + tagStart.substr(1);
            var value = textArea.value;

            var startString = value.substring(0, textArea.selectionStart),
                beetwenTag = value.substring(textArea.selectionStart, textArea.selectionEnd),
                endString = value.substring(textArea.selectionEnd, value.length);

            textArea.value = startString + tagStart + beetwenTag + tagEnd + endString;
        }
    }

    function addNewLines(ev) {
        var prevText = ev[1].value,
            fullText = ev[2].value;

        prevText = prevText.replace(/\n/g, "[nl]");
        fullText = fullText.replace(/\n/g, "[nl]");

        document.getElementById('prev-text').value = prevText;
        document.getElementById('text').value = fullText;
    }
</script>