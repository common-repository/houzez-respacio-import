<!-- The Modal -->
<div class="respacio-notice respacio-notice-export">
	<div id="myModal" class="modal">
	  <!-- Modal content -->
	  <div class="modal-content">
		<span class="close" onclick="respacio_hideModal();">&times;</span>
		<div class="modal-header"><h2>Exported URL</h2></div>
		<div class="modal-body">
			<p id="contentText"></p>
			<input type="text" id="contentText1" valuae="" />
			<a id="copyClip" class="copyClip" onclick="respacio_copyURL();">Copy URL</a>
		</div>
	  </div>
	</div>
</div>

<?php
if(sanitize_text_field($_POST['submit']) == 'Submit'){

	global $wpdb;
	$exportType = !empty(sanitize_text_field($_POST['export_type'])) ? trim(sanitize_text_field($_POST['export_type'])) : 'XML' ;

	$uploadFolderPath = wp_upload_dir();
	$uploadBaseDir = $uploadFolderPath['basedir'] ;
	$uploadBaseUrl = $uploadFolderPath['baseurl'] ;

	$finalFilePath = $uploadBaseDir.'/properties_export/';
	$finalFileSrc = $uploadBaseUrl.'/properties_export/';

	if (!file_exists($finalFilePath)) {
		mkdir($finalFilePath, 0777, true);
	}

	if($exportType == 'XML'){

		$fileName = 'properties_export_'.date('dmYhis').'.xml';
		$finalFilePath .= $fileName ;
		$finalFileSrc .= $fileName ;

		respacio_export_XML($finalFilePath,$finalFileSrc);
	} else {

		$fileName = 'properties_export_'.date('dmYhis').'.xls';
		$finalFilePath .= $fileName ;
		$finalFileSrc .= $fileName ;

		respacio_export_XLS($finalFilePath,$finalFileSrc);
	}
}
?>

<div class="respacio-notice">
	<h2 class="activation_title">Export Properties</h2>

	<form action="" method="post">
		<div id="title-wrap" class="input-text-wrap">
			<input type="radio" name="export_type" class="export_type" id="export_type" value="XML" checked="checked" /> XML
			<input type="radio" name="export_type" class="export_type" id="export_type" value="Excel" /> Excel
		</div>
		<input type="submit" name="submit" class="submit btn btn-submit" id="submit" value="Submit" />
	</form>
</div>
