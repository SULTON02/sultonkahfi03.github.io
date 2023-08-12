<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<h3>
	<div style="text-align: center;">
		<a href="../../../admin/other/act"><b>Kembali</b></a><br/>
	</div>
</h3>

<?php
require_once '../../../mainconfig.php';
$dbsDEL = mysqli_query($db, "DELETE FROM layanan_sosmed WHERE provider != 'MANUAL'");
if($dbsDEL == TRUE ) {
    mysqli_query($db, "ALTER TABLE layanan_sosmed AUTO_INCREMENT = 1");
    print ''.LannGreen('Delete Service SMM successfully').'';
} else {
    print ''.LannRed('404').'';
}