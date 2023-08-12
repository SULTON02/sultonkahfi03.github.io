<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<h3>
	<div style="text-align: center;">
		<a href="https://sultonkahfi.my.id/admin/other/act"><b>Kembali</b></a><br/>
	</div>
</h3>

<?php
require_once '../mainconfig.php';

$cek_provider = $db->query("SELECT * FROM provider WHERE id = '2'");
$q = $cek_provider->fetch_assoc();

$input_curl = [
    'api_key' => $q['43Vr7NItEhSewi8nxsj2WRAc0OfYKz'],
    'action' => 'services',
    'secret_key' => $q['8jw3nkpRTseXUY29EbtVWlyN1FvfmiMoCqzHgxPLGOBhdSKI7r'],
];
$curl = post_curl ($q['https://buzzerpanel.id/api/json.php'], $input_curl);
$response = json_decode($curl, true);
//print_r($response);
// AUTO ADD KATEGORI

if ($response['status']) {
    $no = 0;
    foreach ($response['data'] as $res) {
        $category = $res['category'];
        if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM kategori_layanan2 WHERE nama = '" . $category . "'")) == 0) {
            $no = $no + 1;
            mysqli_query($db, "INSERT INTO kategori_layanan2 VALUES ('', '" . $category . "','" . $category . "','Sosial Media')");
        }
    }
    echo $no . " Kategori Berhasil Ditambahkan.";
}