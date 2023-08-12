<?php
session_start();
require_once '../mainconfig.php';
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	if (!isset($_POST['category'])) {
		exit("No direct script access allowed!");
	}
if (isset($_POST['category'])) {
	$post_kategori = $db->real_escape_string(e(@$_POST['category']));
	
	if($post_kategori=="All") {
	    $query = $db->query("SELECT * FROM kategori_layanan1 ORDER BY nama ASC");
	} else {
	    $query = $db->query("SELECT * FROM kategori_layanan1 WHERE nama LIKE '%$post_kategori%' ORDER BY nama ASC");
	}
		
	?>	
        <option value="0">Pilih Salah Satu...</option>
        <?php
	    while ($q = mysqli_fetch_assoc($query)) {
	?>
	<option value="<?= $q['kode']; ?>"><?= $q['nama']; ?></option>
	<?php
	}
} else {
?>
        <option value="0">Error.</option>
<?php
}
} else {
	exit("No direct script access allowed!");
}
