<link rel="stylesheet" href="/css/profile.css">

<div class="container">
    <div class="container-profile">
        <div class="profile-main">
            <div class="profile-name">
                <h2>Профиль: Mafof</h2>
            </div>

            <div class="profile-posts profile-item">
                <h2>Список постов:</h2>
                <div class="post item" onclick="selectItem(this)">
                    <div class="title">
                        <i class="fas fa-sort-down"></i>
                        <p>Заголовок статьи</p>
                    </div>
                    <div class="control">
                        <span><i class="fas fa-edit"></i>Отредактировать</span>
                        <span><i class="fas fa-trash"></i>Удалить</span>
                    </div>
                    <div class="container-post">
                        <img src="/upload/5c27e93b1bcdd.jpeg" alt="">
                        <p class="text-prev">Первый пост, посвящен тому что тут будут описаны основные возможности системы.<br>Специальные теги =&gt;<br><b>Жирный текст</b><br><s>Подчеркивание</s><br></p>
                        <div class="spoiler">Спрятанный текст(аля спойлер)</div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<script>
    function selectItem(ev) {
        console.dir(ev);
        ev.children[0].children[0].className = "fas fa-sort-down";
        if(ev.isClick === undefined) {
            ev.isClick = true;
            ev.children[2].style.display = "block";
            ev.children[0].children[0].className = "fas fa-sort-up";
        } else {
            ev.children[2].style.display = ev.isClick ? "none" : "block";
            ev.children[0].children[0].className = ev.isClick ? "fas fa-sort-down" : "fas fa-sort-up";
            ev.isClick = !ev.isClick;
        }
    }
</script>