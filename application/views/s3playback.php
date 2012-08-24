<div class="container">
	<a href="<?php echo site_url('/')?>" class="btn">back</a>
	<hr class="soften" />
	<pre>location: application/views/s3playback.php, application/controller/s3service.php</pre>
	<div class="row">
		<div class="span5">
			<video width="320" height="240" controls="controls" preload="none"
				poster="<?php echo base_url('assets/img/colorbars-small.png') ?>">
				<source type="<?php echo $object_type ?>" src="<?php echo $object_url ?>">
				<object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo base_url('assets/mediaelement/flashmediaelement.swf')?>">
					<param name="movie" value="<?php echo base_url('assets/mediaelement/flashmediaelement.swf')?>" />
					<param name="flashvars" value="controls=true&file=<?php echo urlencode($object_url) ?>" />
					<!-- Image as a last resort -->
					<img src="<?php echo base_url('assets/img/colorbars-small.png') ?>" width="320" height="240" title="No video playback capabilities" />
				</object>
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
