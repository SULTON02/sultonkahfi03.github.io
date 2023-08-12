<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<h3>
	<div style="text-align: center;">
		<a href="../../../admin/other/act"><b>Kembali</b></a><br/>
	</div>
</h3>
<?php
require_once '../../../mainconfig.php';
$dCategory = mysqli_query($db, "TRUNCATE TABLE kategori_layanan");
if($dCategory == TRUE ) {
    print ''.LannGreen('Delete category successfully').'';
} else {
    print ''.LannRed('404').'';
}
?>