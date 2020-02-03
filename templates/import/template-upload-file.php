<div class="wrap">
	<h1 class="wp-heading-inline">Import CSV</h1>
    <hr class="wp-header-end">
	<div class="upload-file-wrap">
		<div class="upload">
	        <p class="install-help">Uplaod your desired CSV file to initiate import.</p>
	        <form method="post" enctype="multipart/form-data" class="wp-upload-form">
		        <input type="file" id="file" name="file">
		        <div class="import-type-radio-wrapper">
		        	<p><input type="radio" name="import-type" value="avoxi" /><label>Avoxi</label></p>
					<p><input type="radio" name="import-type" value="dynamic" /><label>Dynamic Import</label></p>
		        </div>
		        <input type="submit" name="import-file-submit" id="import-csv-submit" class="button" value="Import Now" disabled="">
	        </form>
	    </div>
	</div>
</div>
