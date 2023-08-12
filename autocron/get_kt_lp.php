<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<h3>
	<div style="text-align: center;">
		<a href="https://sultonkahfi.my.id/admin/other/act"><b>Kembali</b></a><br/>
	</div>
</h3>

<?php
require_once '../mainconfig.php';

$cek_provider = $db->query("SELECT * FROM provider WHERE id = '8'");
$q = $cek_provider->fetch_assoc();

$input_curl = [
    'api_id' => $q['3770'],
    'api_key' => $q['7be3ea-5ded21-fc764e-2380de-9dee31'],
];
$curl = post_curl($q['https://lollipop-smm.com/api/'], $input_curl);
$response = json_decode($curl, true);
//print_r($response);
// AUTO ADD KATEGORI

if ($response['status']) {
    $no = 0;
    foreach ($response['data'] as $res) {
        $category = $res['category'];
        if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM kategori_layanan3 WHERE nama = '" . $category . "'")) == 0) {
            $no = $no + 1;
            mysqli_query($db, "INSERT INTO kategori_layanan3 VALUES ('', '" . $category . "','" . $category . "','Sosial Media')");
        }
    }
    echo $no . " Kategori Berhasil Ditambahkan.";
}