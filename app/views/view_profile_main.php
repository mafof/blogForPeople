<link rel="stylesheet" href="/css/profile.css">

<div class="container">
    <?php if(!empty($data['errors'])): ?>
        <div class="card-error">
            <?php foreach ($data['errors'] as $item): ?>
                <p><?= $item ?></p>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="container-profile">
            <div class="profile-main">
                <div class="profile-name">
                    <h2>Профиль: <?= $data['profileNickname'] ?></h2>
                </div>
    
                <div class="profile-posts profile-item">
                    <h2>Список постов:</h2>
                    <?php if(!empty($data['posts'])): ?>
                        <?php foreach($data['posts'] as $item): ?>
                            <div class="post item">
                                <div class="title">
                                    <div class="info" onclick="selectItem(this)">
                                        <i class="fas fa-sort-down"></i>
                                        <p><?= $item['title'] ?></p>
                                    </div>
                                    <div class="control">
                                        <a href="/post/<?= $item['id'] ?>"><i class="far fa-eye"></i>Открыть пост</a>
                                        <?php if($data['isAuthor'] == true): ?>
                                            <a href="/editPost/<?= $item['id'] ?>"><i class="fas fa-edit"></i>Редактировать</a>
                                            <a href="/removePost/<?= $item['id'] ?>"><i class="fas fa-trash"></i>Удалить</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="container-post">
                                    <img src="<?php echo $item['prevImage'] ? "/upload/" . $item['prevImage'] : ""; ?>" alt="" class="image-prev">
                                    <p class="text-prev"><?= $item['prevText'] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h4>Постов нет :c</h4>
                    <?php endif; ?>
                </div>
    
                <div class="profile-comments profile-item">
                    <h2>Список Комментариев:</h2>
                    <?php if(!empty($data['comments'])): ?>
                        <?php foreach($data['comments'] as $item): ?>
                            <div class="comment item">
                                <p>Дата создания: <?= $item['dateCreate']?></p>
                                <p>Комментарий к посту: <a href="/post/<?= $item['idPost']?>"><?= $item['title']?></a></p>
                                <p>Текст комментария:</p>
                                <p><?= $item['text']?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h4>Комментариев нет :C</h4>
                    <?php endif; ?>
                </div>
    
            </div>
        </div>
    <?php endif; ?>
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