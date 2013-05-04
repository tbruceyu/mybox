
<div class="title_dir_frame">
	<a><?=$path?></a>
</div>
<table border="1" class="file_table">
<?foreach ($files as $file_row):?>
<tr class="file_frame">
	<td width="30">
		<input type="hidden" name="file_id" value="<?=$file_row->id?>">
		<?if ($file_row->type == 2):?>
		<img src="<?=base_url('source/images/folder_icon.jpg')?>"></img>
		<?else:?>
		<img src="<?=base_url('source/images/file_icon.jpg')?>">
		<?endif?>
	</td>
	<td>
		<a class="filename_style"><?=$file_row->name?></a>
	</td>
	<td>
		<a class="filename_style"><?=$file_row->createtime?></a>
	</td>
</tr>
<?endforeach?>

</table>