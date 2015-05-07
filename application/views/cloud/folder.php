	<p><?= anchor('auth/logout', 'Log Out'); ?></p>
	<ol class="breadcrumb">
		<li>
			<?= anchor('cloud/folder', 'My Cloud'); ?>
		</li>
<?php
// BREADCRUMBS ---------------------------------->>>
$path_segments = array_filter(explode('/', $path));
$segment_url = '';
foreach($path_segments as $segment) { 
	$segment_url = $segment_url . '/' . $segment;
?>
		<li>
			<?= anchor('cloud/folder?path=' . urlencode($segment_url), $segment); ?>
		</li>
<?php }
// <<<----------------------------------------------
?>
	</ol>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Name</th>
				<th>Type</th>
				<th>Size</th>
				<th>Date Modified</th>
				<th>Path</th>
			</tr>
		</thead>
		<tbody>
			
<?php
// FOLDER --------------------------------------->>>
if(!empty($folders)) foreach($folders as $folder){ ?>
			<tr>
				<td><?= anchor('cloud/folder?path=' . urlencode('/' . $folder['name']), $folder['name']) ?></td>
				<td>Folder</td>
				<td><?= $folder['size'] ?></td>
				<td><?= $folder['date'] ?></td>
				<td><?= $folder['server_path'] ?></td>
			</tr>
<?php }
// <<<----------------------------------------------

// FILE ----------------------------------------->>>
if(!empty($files)) foreach($files as $file){ ?>
			<tr>
				<td><?= $file['name'] ?></td>
				<td><?= $file['file_type'] ?></td>
				<td><?= $file['size'] ?></td>
				<td><?= $file['date'] ?></td>
				<td><?= $file['server_path'] ?></td>
			</tr>
<?php }
// <<<----------------------------------------------
?>
		</tbody>
	</table>