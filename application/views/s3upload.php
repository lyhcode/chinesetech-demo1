<div class="container">
	<a href="<?= base_url()?>" class="btn">Back</a>
	<h2>Upload files</h2>
	<form>
		<div class="row">
			<div class="span6">
				<div id="uploader">
					<p>You browser doesn't have Flash, Silverlight, Gears, BrowserPlus or HTML5 support.</p>
				</div>
			</div>
			<div class="span6">
				<button type="submit" class="btn btn-primary">開始上傳檔案</button>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
// Convert divs to queue widgets when the DOM is ready
$(function() {
	$("#uploader").pluploadQueue({
		// General settings
		runtimes : 'gears,flash,silverlight,browserplus,html5',
		url : "<?= site_url('s3service/receive') ?>",
		max_file_size : '100mb',
		chunk_size : '1mb',
		unique_names : false,

		// Resize images on clientside if we can
		resize : {width : 320, height : 240, quality : 90},

		// Specify what files to browse for
		filters : [
			{title : "Video files", extensions : "mp4,ogg,ogv,mov"},
			{title : "Text files", extensions : "txt"}
		],

		// Flash settings
		flash_swf_url : "<?= base_url('plupload/js/plupload.flash.swf')?>",

		// Silverlight settings
		silverlight_xap_url : "<?= base_url('plupload/js/plupload.silverlight.xap')?>"
	});

	// Client side form validation
	$('form').submit(function(e) {
        var uploader = $('#uploader').pluploadQueue();

        // Files in queue upload them first
        if (uploader.files.length > 0) {
            // When all files are uploaded submit form
            uploader.bind('StateChanged', function() {
                if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                    $('form')[0].submit();
                }
            });
                
            uploader.start();
        } else {
            alert('You must queue at least one file.');
        }

        return false;
    });
});
</script>


