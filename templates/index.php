<?php $this->layout('layout::base', ['title' => $title]) ?>

<?php $this->start('content_') ?>
    <div class="container">
    <!-- begin post -->
        <div class="card">
            <a href="<?= $user->profile ?>"></a>
            <div class="card-block">
                <?= \Michelf\Markdown::defaultTransform($readme) ?>
            </div>
        </div>
    <!-- end post -->
    </div>

<?php $this->stop() ?>