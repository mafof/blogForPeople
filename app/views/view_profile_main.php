<link rel="stylesheet" href="/css/profile.css">

<div class="container">
    <div class="container-profile">
        <div class="profile-main">
            <div class="profile-name">
                <h2>Профиль: Mafof</h2>
            </div>

            <div class="profile-posts profile-item">
                <h2>Список постов:</h2>
                <div class="post item">
                    <div class="title">
                        <div class="info" onclick="selectItem(this)">
                            <i class="fas fa-sort-down"></i>
                            <p>Заголовок статьи</p>
                        </div>
                        <div class="control">
                            <a href="/editPost/1"><i class="fas fa-edit"></i>Редактировать</a>
                            <a href="/removePost/1"><i class="fas fa-trash"></i>Удалить</a>
                        </div>
                    </div>
                    <div class="container-post">
                        <img src="/upload/5c27e93b1bcdd.jpeg" alt="">
                        <p class="text-prev">Первый пост, посвящен тому что тут будут описаны основные возможности системы.<br>Специальные теги =&gt;<br><b>Жирный текст</b><br><s>Подчеркивание</s><br></p>
                        <div class="spoiler">Спрятанный текст(аля спойлер)</div>
                    </div>
                </div>
            </div>

            <div class="profile-comments profile-item">
                <h2>Список Комментариев:</h2>
                <div class="comment item">
                    <p>Дата создания: 10.02.2018</p>
                    <p>Комментарий к посту: <a href="/post/1">Ссылка на пост</a></p>
                    <p>Текст комментария:</p>
                    <p>Тестовый коммент</p>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function selectItem(ev) {
        var fasFa = ev.children[0],
            content = ev.parentNode.parentNode.children[1];

        fasFa.className = "fas fa-sort-down";
        if(ev.isClick === undefined) {
            ev.isClick = true;
            content.style.display = "block";
            fasFa.className = "fas fa-sort-up";
        } else {
            content.style.display = ev.isClick ? "none" : "block";
            fasFa.className = ev.isClick ? "fas fa-sort-down" : "fas fa-sort-up";
            ev.isClick = !ev.isClick;
        }
    }
</script>