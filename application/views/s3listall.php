<div class="container">
	<a href="<?php echo site_url('/')?>" class="btn">back</a>
	<hr class="soften" />
	<pre>Location: application/view/s3listall.php, application/controller/s3service.php</pre>
	<h2>S3: List all files</h2>
	<ul>
		<?php foreach($result as $key): ?>
		<li>
			<?php echo $key ?>
			<?php if(in_array(substr($key, -4), array('.ogg', '.mov', '.mp4', '.ogv'))): ?>
				(<a href="<?php echo site_url('/s3service/playback').'?object='.urlencode($key) ?>">playback</a>)
			<?php endif; ?>
		</li>
		<?php endforeach ?>
	</ul>
</div>
