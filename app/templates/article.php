<?php $this->layout('layout::base') ?>

<?php $this->start('content_') ?>
<!-- Begin Article
================================================== -->
<div class="container">
	<div class="row">

		<!-- Begin Fixed Left Share -->
		<div class="col-md-2 col-xs-12">
			<div class="share">

			</div>
		</div>
		<!-- End Fixed Left Share -->

		<!-- Begin Post -->
		<div class="col-md-8 col-md-offset-2 col-xs-12">
			<div class="mainheading">

				<!-- Begin Top Meta -->
				<div class="row post-top-meta">
					<div class="col-md-2">
						<a href="author.html"><img class="author-thumb" src="<?= $user->profile ?>" alt="<?= $user->username ?>"></a>
					</div>
					<div class="col-md-10">
						<a class="link-dark" href="https://github.com/<?= $user->username  ?>"><?= $user->username  ?></a>
						<span class="author-description"><?= \Michelf\Markdown::defaultTransform($user->summary ) ?></span>
						<span class="post-date"><?= $article->date ?></span><span class="dot"></span><span class="post-read"><?= $article->estimated_time ?> min read</span>
					</div>
				</div>
				<!-- End Top Menta -->

				<h1 class="posttitle"><?= \Michelf\Markdown::defaultTransform($article->title) ?></h1>

			</div>

			<!-- Begin Post Content -->
			<div class="article-post">
				<?= \Michelf\Markdown::defaultTransform($article->content) ?>
			</div>
			<!-- End Post Content -->

		</div>
		<!-- End Post -->

	</div>
</div>
<!-- End Article
================================================== -->

<div class="hideshare"></div>

<?php $this->stop() ?>