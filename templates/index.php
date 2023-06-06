<?php $this->layout('layout::base', ['title' => $title]) ?>

<?php $this->start('content_') ?>

    <?= \Michelf\Markdown::defaultTransform($readme) ?>

<?php $this->stop() ?>