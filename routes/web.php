<?php

router()->get('/article', function () {
    echo template()->render('article');
});

router()->get('/author', function () {
    echo template()->render('author');
});

router()->get('/index', function () {
    echo template()->render('index');
});