<!-- HEADER -->
<header>
    <div class="text">
        <p>Блог для...</p>
        <p>...народа</p>
    </div>
</header>
<div class="container container-main-page">
    <div class="posts-list">
        <?php if (!empty($data['posts'])): ?>
            <?php foreach ($data['posts'] as $item): ?>
                <div class="post">
                    <h2 class="title"><?= $item['title'] ?></h2>
                    <img src="<?php echo $item['prevImage'] ? "upload/" . $item['prevImage'] : ""; ?>" alt="" class="image-prev">
                    <p class="text-prev"><?= $item['prevText'] ?></p>
                    <div class="post-footer">
                        <div class="post-footer-part author">
                            <i class="fas fa-user"></i>
                            <a href="/profile/<?= $item['author'] ?>"><?= $item['author'] ?></a>
                        </div>
                        <div class="post-footer-part">
                            <i class="fas fa-calendar-alt"></i>
                            <p><?= $item['dateCreate'] ?></p>
                        </div>
                        <div class="post-footer-part category">
                            <i class="fas fa-archive"></i>
                            <a href="/category/<?= \App\Core\TranslateConverterCirricle::translateToEnglish($item['categoryName']) ?>"><?= $item['categoryName'] ?></a>
                        </div>
                        <div class="post-footer-part reading-more">
                            <i class="fab fa-readme"></i>
                            <a href="/post/<?= $item['id'] ?>">Читать далее</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="posts-popular">
        <div class="container-post-popular">
            <h2>Популярные категории:</h2>
            <div class="category">
                <?php foreach($data['categories'] as $item): ?>
                    <a href="/category/<?= \App\Core\TranslateConverterCirricle::translateToEnglish($item['categoryName']) ?>"><?= $item['categoryName'] ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>