<link rel="stylesheet" href="/css/auth.css">

<div class="container">
    <?php if(!empty($data["errors"])): ?>
        <div class="card card-error">
            <?php foreach ($data["errors"] as $value): ?>
                <p><?= $value ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
