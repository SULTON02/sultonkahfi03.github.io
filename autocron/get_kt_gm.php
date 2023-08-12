<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<h3>
	<div style="text-align: center;">
		<a href="../admin/other/act"><b>Kembali</b></a><br/>
	</div>
</h3>

<?php
require_once '../mainconfig.php';

$cek_provider = $db->query("SELECT * FROM provider WHERE code = 'GM'");
$q = $cek_provider->fetch_assoc();

$input_curl = [
    'key' => $q['api_key'],
    'sign' => md5($q['api_id'].$q['api_key']),
    'type' => 'services',
];
$curl = post_curl($q['link'].'social-media', $input_curl);
$response = json_decode($curl, true);
//print_r($response);
// AUTO ADD KATEGORI

if ($response['result'] == true) {
    $no = 0;
    foreach ($response['data'] as $res) {
        $category = $res['category'];
        $check_kategori = mysqli_query($db, "SELECT * FROM kategori_layanan WHERE nama = '" . $category . "'");
        if (mysqli_num_rows($check_kategori) == 0) {
            $no = $no + 1;
            mysqli_query($db, "INSERT INTO kategori_layanan VALUES ('', '" . $category . "','" . $category . "','Sosial Media')");
        }
    }
    echo $no . " Kategori Berhasil Ditambahkan.";
}