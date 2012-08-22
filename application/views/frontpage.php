<div class="container">
	<pre>location: application/views/frontpage.php</pre>
	<div class="row">
		<div class="span5">
			<video id="my_video_1" class="video-js vjs-default-skin" controls
				preload="auto" width="100%" height="320" poster="<?php echo base_url('assets/img/colorbars-small.png')?>"
				data-setup="{}">
<!--
				<source type="video/ogg" src="http://storage1.chinesetech.com.tw.s3.amazonaws.com/demo/ed_1024.ogv" >
-->
				<source type="video/mp4" src="http://storage1.chinesetech.com.tw.s3.amazonaws.com/demo/ed_hd_512kb.mp4" >
			</video>
		</div>
		<div class="span7">
			<div class="hero-unit">
				<h2>HTML5 Video Playback Demo</h2>
				<p>This sample use <a href="http://videojs.com/" target="_blank">video.js</a> HTML5 video library.</p>
				<p>Demo functions:</p>
				<ul>
					<li><a href="<?php echo site_url('s3service/listall')?>">S3: List all files</a></li>
					<li><a href="<?php echo site_url('s3service/upload')?>">S3: Upload files</a></li>
				</ul>
				<a class="btn btn-primary btn-large" href="#">Learn more</a>
			</div>
		</div>
	</div>
	<hr class="soften" />
	<h2>Links</h2>
	<ul>
		<li><a href="http://aws.amazon.com/documentation/sdkforphp/" target="_blank">AWS SDK for PHP Documentation</a></li>
	</ul>
</div>
