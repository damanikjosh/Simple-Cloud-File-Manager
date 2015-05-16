<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid content">
	<div class="">
		<div class="file-icon">
			<span class="glyphicon glyphicon-cog"></span>
		</div>
	</div>
	<div class="">
		<div class="panel panel-default">
		  <div class="panel-body">
				<?php echo form_open('admin/settings'); ?>
				<input type="hidden" name="modify" value="settings">
				<div class="form-group">
					<label for="upload_path">Upload Path</label>
					<input type="text" class="form-control" id="upload_path" name="upload_path" placeholder="/path/to/upload/folder" value="<?= $upload_path ?>" required />
				</div>
				<div id="password-group" class="form-group">
					<label for="allowed_types">Allowed Types</label>
					<input type="text" class="form-control" id="allowed_types" name="allowed_types" placeholder="some|file|extensions" value="<?= $allowed_types ?>" required />
					<small><i>or * to allow all types</i></small>
				</div>
				<div class="form-group">
					<label for="overwrite">File Overwrite</label>
					<select class="form-control" id="overwrite" name="overwrite">
						<option value="1" <?= ($overwrite)?'selected="selected"':'' ?>>YES</option>
						<option value="0" <?= (!$overwrite)?'selected="selected"':'' ?>>NO</option>
					</select>
				</div>
				<div id="password-group" class="form-group">
					<label for="max_size">Max. File Size</label>
					<input type="number" class="form-control" id="max_size" name="max_size" placeholder="10000" value="<?= $max_size ?>" required />
					<small><i>number in kilobytes</i></small>
				</div>
				<button type="submit" id="save-settings-btn" class="btn btn-success btn-bg">Save</button>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function (){

});
</script>