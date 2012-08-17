<div class="container">
	<a href="<?php echo site_url('/')?>" class="btn">back</a>
	<hr class="soften" />
	<pre>location: application/views/s3playback.php, application/controller/s3service.php</pre>
	<div class="row">
		<div class="span5">
			<video id="my_video_1" class="video-js vjs-default-skin" controls
				preload="auto" width="100%" height="320" poster="assets/img/colorbars-small.png"
				data-setup="{}">
				<source type="video/ogg" src="<?php echo $url ?>">
			</video>
		</div>
		<div class="span7">
			<?php echo $url ?>
		</div>
	</div>
</div>
