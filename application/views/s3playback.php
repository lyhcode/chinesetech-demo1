<div class="container">
	<a href="<?php echo site_url('/')?>" class="btn">back</a>
	<hr class="soften" />
	<pre>location: application/views/s3playback.php, application/controller/s3service.php</pre>
	<div class="row">
		<div class="span5">
			<video id="my_video_1" class="video-js vjs-default-skin" controls
				preload="auto" width="100%" height="320" poster="<?php echo base_url('assets/img/colorbars-small.png') ?>"
				data-setup="{}">
				<source type="<?php echo $object_type ?>" src="<?php echo $object_url ?>">
			</video>
		</div>
		<div class="span7">
			<p>S3 Object Path:</p>
			<pre><?php echo $object ?></pre>
			<p>S3 Protected URL:</p>
			<pre><?php echo $object_url ?></pre>
		</div>
	</div>
</div>
