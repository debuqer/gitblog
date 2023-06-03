<?php $this->layout('layout::base', ['title' => $title]) ?>

<?php $this->start('content_') ?>
<!-- Begin Top Author Page
================================================== -->
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8 col-md-offset-2">
			<div class="mainheading">
				<div class="row post-top-meta authorpage">
					<div class="col-md-10 col-xs-12">
						<h1><?= $user->username ?></h1>
						<span class="author-description"><?= $user->summary ?></span>
					</div>

                    <hr>
					<div class="col-md-2 col-xs-12">
						<img class="author-thumb" src="<?= $user->profile ?>" alt="<?= $user->username ?>">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Top Author Meta
================================================== -->
<div class="authorpage">
    <div class="container">
        <?= \Michelf\Markdown::defaultTransform($user->resume) ?>
    </div>
</div>
<!-- Begin Author Posts
================================================== -->
<div class="graybg authorpage">
	<div class="container">
		<div class="listrecent listrelated">
            <?php foreach ($user->top_articles as $article): ?>
				<!-- begin post -->
				<div class="authorpostbox">
					<div class="card">
						<a href="<?= $user->profile ?>"></a>
						<div class="card-block">
							<h2 class="card-title"><a href="<?= $article->link ?>"><?= \Michelf\Markdown::defaultTransform($article->title) ?></a></h2>
              <h4 class="card-text"><?= \Michelf\Markdown::defaultTransform($article->summary) ?></h4>
            	<div class="metafooter">
								<div class="wrapfooter">
									<span class="meta-footer-thumb">
									<a href="<?= url('u/'.$user->username) ?>"><img class="author-thumb" src="<?= $user->profile ?>" alt="<?= $user->username ?>"></a>
									</span>
									<span class="author-meta">
									<span class="post-name"><a href="<?= $user->link ?>"><?= $user->username ?></a></span><br/>
									<span class="post-date"><?= $article->date ?></span><span class="dot"></span><span class="post-read"><?= $article->estimated_time ?> min read</span>
									</span>
									<span class="post-read-more"><a href="<?= $article->link ?>" title="Read Story"><svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25"><path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path></svg></a></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- end post -->
            <?php endforeach; ?>
		</div>
	</div>
</div>
<!-- End Author Posts
================================================== -->
<?php $this->stop() ?>