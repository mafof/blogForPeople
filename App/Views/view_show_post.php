<link rel="stylesheet" href="/css/showPost.css">

<div class="container">
    <div class="card post">
        <?php if(!empty($data['title'])): ?>
            <h2 class="title"><?= $data['title'] ?></h2>
            <p class="text-full"><?= $data['text'] ?></p>
        <?php endif; ?>
    </div>

    <div class="main-comment">
        <?php if(empty($data['errors'])): ?>
            <form action="/sendComment" method="post" class="form-send-comment">
                <p>Оставить коментарий:</p>
                <div class="group">
                    <label for="message">Ваше сообщение</label>
                    <textarea name="message" id="message"></textarea>
                </div>
                <input class="submit-form-button" type="submit" value="Отправить сообщение">
            </form>
        <?php else: ?>
            <div class="card-error">
                <?php foreach ($data['errors'] as $item): ?>
                    <p><?= $item ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if(!empty($data['title'])): ?>
            <div class="list-comment">
                <div class="row-list-comments">
                    <?php if(empty($data['comments'])): ?>
                        <h2>Нет коментариев</h2>
                    <?php else: ?>
                        <h2><?= count($data['comments']) ?> Комментариев</h2>

                        <?php foreach($data['comments'] as $item): ?>
                            <div class="comment">
                                <div class="title">
                                    <b class="author"><?= $item['author'] ?></b>
                                    <p><?= $item['dateCreate'] ?></p>
                                </div>
                                <p class="text"><?= $item['text'] ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>