<?php

$this->breadcrumbs=array(
	'Settings'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List Setting', 'url'=>array('index')),
	array('label'=>'Create Setting', 'url'=>array('create')),
	array('label'=>'Update Setting', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete Setting', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Setting', 'url'=>array('admin')),
);
?>

<h1>View Setting #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'path_pending',
		'Id_customer',
		'sabnzb_api_key',
		'sabnzb_api_url',
		'host_name',
		'path_ready',
		'path_subtitle',
		'path_images',
		'path_shared',
	),
));
return; ?>


<div id="screenHome" class="container">
<?php
error_reporting(0);
require_once 'File/Fstab.php';

// $fstab =& new File_Fstab();
// $floppy =& new File_Fstab_Entry();
// $floppy->fsType = 'vfat';
// $floppy->device = '/dev/fd0';
// $floppy->mountPoint = '/floppy';
// $fstab->addEntry($floppy);
// return;

$fstab =& new File_Fstab();
//igetEntryForPath

//$pelicano =& new File_Fstab_Entry();
$pelicano =& $fstab->getEntryForPath('/media/pelicano/ripped');
if (PEAR::isError($pelicano)) {
	$pelicano =& new File_Fstab_Entry();
}
$pelicano->device = '//192.168.0.105/storage';
$pelicano->label = 'PelicanoRipped';
$pelicano->fsType = 'cifs';
$pelicano->mountPoint = '/media/pelicano/ripped';
$pelicano->mountOptions = array(
		'credentials' => "/etc/cifs/dhcppc2",
		"uid"=>"arnold",
		"gid"=>"www-data",
		"file_mode"=>"0777",
		"dir_mode"=>"0777"
);
$pelicano->dump = 0;
$pelicano->fsckPassNo = 0;
$fstab->addEntry($pelicano);
$res = $fstab->save('/tmp/fstab.new');
if (PEAR::isError($res)) {
	die($res->getMessage());
};


// $dev =& $fstab->getEntryForUUID('f598101c-ffbd-4935-ac58-6682186d9a73');
// if (PEAR::isError($dev)) {
//     die($dev->getMessage());
// }
// var_dump($dev);
return;
?>
</div>