<link rel="stylesheet" href="/css/auth.css">
<link rel="stylesheet" href="/css/form.css">
<link rel="stylesheet" href="/css/admin.css">

<div class="container">
    <?php if(!empty($data["errors"])): ?>
        <div class="card card-error">
            <?php foreach ($data["errors"] as $value): ?>
                <p><?= $value ?></p>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="navigation">
            <span onclick="selectPart(this)" id="posts">Посты</span>
            <span onclick="selectPart(this)" id="comments">Комментарии</span>
            <span onclick="selectPart(this)" id="users">Пользователи</span>
        </div>
        <div class="content">
            <!-- POSTS => -->
            <div class="posts content-item" id="list-posts" style="display: none;">
                <?php if(!empty($data['posts'])): ?>
                    <table border="1px solid black">
                        <tr>
                            <td>id поста</td>
                            <td>Название поста</td>
                            <td>Автор поста</td>
                            <td>Превью поста</td>
                            <td>Дата создания</td>
                            <td>Действия</td>
                        </tr>
                        <?php foreach ($data['posts'] as $item): ?>
                            <tr>
                                <td><?= $item['id'] ?></td>
                                <td><?= $item['author'] ?></td>
                                <td><?= $item['title'] ?></td>
                                <td><?= $item['prevText'] ?></td>
                                <td><?= $item['dateCreate'] ?></td>
                                <td class="control">
                                    <?php if($item['isShow'] == 1): ?>
                                        <a href="/hiddenPost/<?= $item['id'] ?>"><i class="fas fa-eye-slash"></i>Скрыть пост</a>
                                    <?php else: ?>
                                        <a href="/hiddenPost/<?= $item['id'] ?>"><i class="fas fa-eye"></i>Показать пост</a>
                                    <?php endif; ?>
                                    <a href="/post/<?= $item['id'] ?>"><i class="far fa-eye"></i>Открыть</a>
                                    <a href="/editPost/<?= $item['id'] ?>"><i class="fas fa-edit"></i>Редактировать</a>
                                    <a href="/removePost/<?= $item['id'] ?>" onclick="return confirm('Удалить пост?');"><i class="fas fa-trash"></i>Удалить</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else: ?>
                    <p>Нет постов</p>
                <?php endif; ?>
            </div>

            <!-- COMMENTS => -->
            <div class="comments content-item" id="list-comments" style="display: none;">
                <?php if(!empty($data['comments'])): ?>
                    <table border="1px solid black">
                        <tr>
                            <td>id комментария</td>
                            <td>Автор комментария</td>
                            <td>Название поста</td>
                            <td>Текст комментария</td>
                            <td>Дата создания</td>
                            <td>Действия</td>
                        </tr>
                        <?php foreach ($data['comments'] as $item): ?>
                            <tr>
                                <td><?= $item['id'] ?></td>
                                <td><?= $item['author'] ?></td>
                                <td><?= $item['title'] ?></td>
                                <td>Привет мир</td>
                                <td>10.08.2018</td>
                                <td class="control">
                                    <a href="/post/<?= $item['idPost'] ?>"><i class="far fa-eye"></i>Открыть</a>
                                    <a href="/removeComment/<?= $item['id'] ?>" onclick="return confirm('Удалить пост?');"><i class="fas fa-trash"></i>Удалить</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else: ?>
                    <p>Комментариев нет</p>
                <?php endif; ?>
            </div>
            <!-- USERS => -->
            <div class="users content-item" id="list-users" style="display: none;">
                <?php if(!empty($data['users'])): ?>
                    <table border="1px solid black">
                        <tr>
                            <td>id пользователя</td>
                            <td>Никнейм пользователя</td>
                            <td>Почта пользователя</td>
                            <td>Группа пользователя</td>
                            <td>Подтвержденный</td>
                            <td>Действия</td>
                        </tr>
                        <?php foreach ($data['users'] as $item): ?>
                            <tr>
                                <td><?= $item['id'] ?></td>
                                <td><?= $item['nickname'] ?></td>
                                <td><?= $item['email'] ?></td>
                                <td><?= $item['nameGroup'] ?></td>
                                <td><?php echo ($item['isConfirm'] == 0) ? '<span style="color: red">НЕТ</span>' : '<span style="color: green">ДА</span>'; ?></td>
                                <td class="control">
                                    <a href="/removeUser/<?= $item['id'] ?>" onclick="return confirm('Удалить пост?');"><i class="fas fa-trash"></i>Удалить</a>
                                    <span onclick="selectUser(this)"><i class="fas fa-layer-group"></i>Назначить группу</span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else: ?>
                    <p>Пользователей нет</p>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    window.addEventListener('load', function (ev) {
         window.onclick = function(ev) {
             document.getElementById('groups-list-main').parentNode.removeChild(document.getElementById('groups-list-main'));
         }
    });

    var userId;
    function selectUser(ev) {
        userId = ev.parentElement.parentElement.children[0].innerText;
        var prom = loadDataGroup();
        prom.then(function(data) {
            var tagP = formationTagP(data);
            console.log(tagP);
            var div = document.createElement("div");
            div.innerHTML = "<div class=\"selectGroup\" id=\"groups-list-main\"><div class=\"content\" id=\"groups-list\"><p>Выбрать группу: </p>" + tagP + "</div></div>";
            document.getElementsByTagName('body')[0].appendChild(div);
        })
        .catch(function (data) {
            alert(data);
        });
    }

    function loadDataGroup() {
        return new Promise(function(resolve, reject) {
            var xhr = new XMLHttpRequest();
            xhr.open('get', '/getAllGroups');
            xhr.send();
            xhr.onreadystatechange = function() {
                if (xhr.readyState != 4) return;

                if (xhr.status != 200) {
                    reject("Данные не загружены, попробуйте позже");
                } else {
                    resolve(xhr.responseText);
                }
            }
        });
    }

    function formationTagP(data) {
        data = JSON.parse(data);

        var result = '';

        for(var i =0; i < data.length; i++) {
            result += "<a href='/setUserGroup/" + data[i].unicalId + "/" + userId + "'>" + data[i].nameGroup + "</a>"
        }

        return result;
    }

    function selectPart(ev) {
        var idPart = ev.id;

        switch (idPart) {
            case "posts":
                document.getElementById("list-posts").style.setProperty("display", "block");

                document.getElementById("list-comments").style.setProperty("display", "none");
                document.getElementById("list-users").style.setProperty("display", "none");
            break;
            case "comments":
                document.getElementById("list-comments").style.setProperty("display", "block");

                document.getElementById("list-posts").style.setProperty("display", "none");
                document.getElementById("list-users").style.setProperty("display", "none");
            break;
            case "users":
                document.getElementById("list-users").style.setProperty("display", "block");

                document.getElementById("list-posts").style.setProperty("display", "none");
                document.getElementById("list-comments").style.setProperty("display", "none");
            break;
        }
    }
</script>
