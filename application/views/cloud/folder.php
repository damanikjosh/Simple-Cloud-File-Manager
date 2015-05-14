<div class="container-fluid">
	<ol class="breadcrumb">
		<li>
			<a href="<?= site_url('cloud/folder') ?>" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"></span></a>
		</li>
		<?php $i=0;$len = count($breadcrumbs);foreach($breadcrumbs as $breadcrumb) {
		if ($i == $len - 2) { ?>
		<li class="breadcrumb-middle">
			<a class="hidden-xs" href="<?= $breadcrumb['url'] ?>"><?= $breadcrumb['title'] ?></a>
			<a class="visible-xs-inline" href="<?= $breadcrumb['url'] ?>">...</a>
		</li>
		<?php } else if($i == $len - 1) { ?>
		<li class="breadcrumb-middle">
			<a href="<?= $breadcrumb['url'] ?>"><?= $breadcrumb['title'] ?></a>
		</li>
		<?php } else { ?>
		<li class="breadcrumb-middle hidden-xs">
			<a href="<?= $breadcrumb['url'] ?>"><?= $breadcrumb['title'] ?></a>
		</li>
		<?php } $i++;} ?>

		<div class="pull-right">
			<?php echo form_open('cloud/new_folder' . $path, array('class'=>'form-inline')); ?>
				<div id="add-folder-form" class="form-group">
					<input id="add-folder-input" type="text" name="foldername" class="form-control input-sm" placeholder="New Folder Name">
					<button class="btn btn-sm btn-primary" type="submit"><span class="glyphicon glyphicon-ok"></span></button>
					<a id="add-folder-cancel" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
				</div>
				<a href="#" id="add-folder-btn" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
			<a href="<?= site_url('cloud/upload' . $path) ?>" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span></a>
			</form>
			
		</div>
	</ol>
	<table id="table-contents" class="table table-hover">
		<thead>
			<tr class="folder-header">
				<th class="column-icon"></th>
				<th class="column-name">
					<a href="<?='?sort=name'.($sort=='name'?($asc==1 ?'&asc=0':'&asc=1'):'')?>">Name</a>
					<?php if($sort=='name'): ?>
					<span class="glyphicon glyphicon-chevron-<?=$asc==1 ?'up':'down'?>"></span>
					<?php endif ?>
				</th>
				<th class="column-size">
					<a href="<?='?sort=size'.($sort=='size'?($asc==1 ?'&asc=0':'&asc=1'):'')?>">Size</a>
					<?php if($sort=='size'): ?>
					<span class="glyphicon glyphicon-chevron-<?=$asc==1 ?'up':'down'?>"></span>
					<?php endif ?>
				</th>
				<th class="column-date hidden-xs">
					<a href="<?='?sort=date'.($sort=='date'?($asc==1 ?'&asc=0':'&asc=1'):'')?>">Modified</a>
					<?php if($sort=='date'): ?>
					<span class="glyphicon glyphicon-chevron-<?=$asc==1 ?'up':'down'?>"></span>
					<?php endif ?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($folders)) foreach($folders as $folder){ ?>
			<tr class="folder-content">
				<td class="content-icon"><span class="glyphicon glyphicon-folder-open"></span></td>
				<td nowrap class="content-name"><a href="<?= $folder['url'] ?>"><?= $folder['name'] ?></a></td>
				<td class="content-size"><?= $folder['size'] ?></td>
				<td class="content-date hidden-xs"><?= $folder['date'] ?></td>
			</tr>
			<?php }if(!empty($files)) foreach($files as $file){ ?>
			<tr class="folder-content">	
				<td class="content-icon">
					<span class="glyphicon glyphicon-<?php
						switch ($file['type']) {
							case 'Image': echo 'picture';break;
							case 'Video': echo 'film';break;
							case 'Text': echo 'font';break;
							case 'Audio': echo 'music';break;
							case 'Application': echo 'tasks';break;
							case 'Compressed': echo 'compressed';break;
							case 'Document': echo 'file';break;
							default: echo 'briefcase';
						} ?>">
					</span>
				</td>
				<td nowrap class="content-name"><?= $file['name'] ?></td>
				<td class="content-size"><?= $file['size'] ?></td>
				<td class="content-date hidden-xs"><?= $file['date'] ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#add-folder-btn').click(function(){
			if ($(window).width() >= 768){
				$(this).hide();
				$('#add-folder-form').css('display', 'inline-block');
				$('#add-folder-input').focus();
			}
		});
		$('#add-folder-cancel').click(function(){
			if ($(window).width() >= 768){
				$('#add-folder-form').css('display', 'none');
				$('#add-folder-btn').css('display', 'inline-block');
			}
		});
	});
</script>