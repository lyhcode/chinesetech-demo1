<div class="container">
	<a href="<?php echo site_url('/')?>" class="btn">back</a>
	<h2>S3: List all files</h2>
	<ul>
		<?php foreach($result as $key): ?>
		<li><?php echo $key ?></li>
		<?php endforeach ?>
	</ul>
</div>
