<div class="container">
	<pre>location: application/views/frontpage.php</pre>
	<div class="row">
		<div class="span5">
			<video width="320" height="240" controls="controls" preload="none"
				poster="<?php echo base_url('assets/img/colorbars-small.png')?>">
				<source type="video/ogg" src="http://storage1.chinesetech.com.tw.s3.amazonaws.com/demo/ed_1024.ogv" >
				<source type="video/mp4" src="http://storage1.chinesetech.com.tw.s3.amazonaws.com/demo/ed_hd_512kb.mp4" >
				<object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo base_url('assets/mediaelement/flashmediaelement.swf')?>">
					<param name="movie" value="<?php echo base_url('assets/mediaelement/flashmediaelement.swf')?>" />
					<param name="flashvars" value="controls=true&file=<?php echo urlencode('http://storage1.chinesetech.com.tw.s3.amazonaws.com/demo/ed_hd_512kb.mp4') ?>" />
					<!-- Image as a last resort -->
					<img src="<?php echo base_url('assets/img/colorbars-small.png') ?>" width="320" height="240" title="No video playback capabilities" />
				</object>
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
