<link rel="stylesheet" href="/css/showPost.css">

<div class="container">
    <div class="card post">
        <?php if(empty($data['errors'])): ?>
            <h2 class="title"><?= $data['title'] ?></h2>
            <p class="text-full"><?= $data['text'] ?></p>
        <?php else: ?>
            <div class="card-error">
                <?php foreach ($data['errors'] as $item): ?>
                    <p><?= $item ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="main-comment">
        <form action="/sendComment" method="post" class="form-send-comment">
            <p>Оставить коментарий:</p>
            <div class="group">
                <label for="message">Ваше сообщение</label>
                <textarea name="message" id="message"></textarea>
            </div>
            <input class="submit-form-button" type="submit" value="Отправить сообщение">
        </form>

        <div class="list-comment">
            <div class="row-list-comments">
                <h2>30 коментариев</h2>
                <div class="comment">
                    <b class="author">Mafof</b>
                    <p class="text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto,
                        debitis eum mollitia necessitatibus nisi porro? Cum, ea eum exercitationem fugit illo nihil pariatur possimus, praesentium quae sed ut, vel!
                    </p>
                </div>
                <div class="comment">
                    <b class="author">Mafof</b>
                    <p class="text">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid architecto,
                        debitis eum mollitia necessitatibus nisi porro? Cum, ea eum exercitationem fugit illo nihil pariatur possimus, praesentium quae sed ut, vel!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>