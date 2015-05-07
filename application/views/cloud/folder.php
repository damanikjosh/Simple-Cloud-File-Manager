	<div class="container-fluid">
		<ol class="breadcrumb">
			<li>
				<?= anchor('cloud/folder', '<span class="glyphicon glyphicon-home"></span>'); ?>
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
					<th colspan="2"><a href="<?php if($sort=='name'&&$asc==SORT_ASC) echo '?sort=name&asc=0'; else echo '?sort=name&asc=1' ?>">Name</a>
					<?php if($sort=='name') { ?>
						<span class="glyphicon glyphicon-chevron-<?php if($asc==SORT_ASC) echo 'up'; else echo 'down' ?>"></span>
					<?php } ?>
					</th>
					<th class="column-type"><a href="<?php if($sort=='file_type'&&$asc==SORT_ASC) echo '?sort=file_type&asc=0'; else echo '?sort=file_type&asc=1' ?>">Type</a>
					<?php if($sort=='file_type') { ?>
						<span class="glyphicon glyphicon-chevron-<?php if($asc==SORT_ASC) echo 'up'; else echo 'down' ?>"></span>
					<?php } ?>
					</th>
					<th class="column-size"><a href="<?php if($sort=='size'&&$asc==SORT_ASC) echo '?sort=size&asc=0'; else echo '?sort=size&asc=1' ?>">Size</a>
					<?php if($sort=='size') { ?>
						<span class="glyphicon glyphicon-chevron-<?php if($asc==SORT_ASC) echo 'up'; else echo 'down' ?>"></span>
					<?php } ?>
					</th>
					<th class="column-date"><a href="<?php if($sort=='date'&&$asc==SORT_ASC) echo '?sort=date&asc=0'; else echo '?sort=date&asc=1' ?>">Modified</a>
					<?php if($sort=='date') { ?>
						<span class="glyphicon glyphicon-chevron-<?php if($asc==SORT_ASC) echo 'up'; else echo 'down' ?>"></span>
					<?php } ?>
					</th>
				</tr>
			</thead>
			<tbody>
				
<?php
// FOLDER --------------------------------------->>>
if(!empty($folders)) foreach($folders as $folder){ ?>
				<tr class="folder-content">
					<td><span class="glyphicon glyphicon-folder-open"></span></td>
					<td><?= anchor('cloud/folder?path=' . urlencode('/' . $folder['name']), $folder['name']) ?> </td>
					<td>Folder</td>
					<td><?= $folder['size'] ?></td>
					<td><?= $folder['modified'] ?></td>
				</tr>
<?php }
// <<<----------------------------------------------

// FILE ----------------------------------------->>>
if(!empty($files)) foreach($files as $file){ ?>
				<tr class="folder-content">	
					<td><span class=<?= '"' ?>glyphicon glyphicon-<?php
							switch ($file['file_type']) {
								case 'Image': echo 'picture"></span></td><td>' . $file['name'] . '</td><td>Image</td>';break;
								case 'Video': echo 'film"></span></td><td>' . $file['name'] . '</td><td>Video</td>';break;
								case 'Text': echo 'font"></span></td><td>' . $file['name'] . '</td><td>Text</td>';break;
								case 'Audio': echo 'music"></span></td><td>' . $file['name'] . '</td><td>Audio</td>';break;
								case 'Application': echo 'tasks"></span></td><td>' . $file['name'] . '</td><td>Application</td>';break;
								case 'Compressed': echo 'compressed"></span></td><td>' . $file['name'] . '</td><td>Compressed</td>';break;
								case 'Document': echo 'briefcase"></span></td><td>' . $file['name'] . '</td><td>Document</td>';break;
								default: echo 'file"></span></td><td>' . $file['name'] . '</td><td>Other</td>';
							}
						?>
					
					<td><?= $file['size'] ?></td>
					<td><?= $file['modified'] ?></td>
				</tr>
<?php }
// <<<----------------------------------------------
?>
			</tbody>
		</table>
	</div>