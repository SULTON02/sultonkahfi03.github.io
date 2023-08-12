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
$curl = post_curl($q['https://buzzerpanel.id/api/json.php'], $input_curl);
$response = json_decode($curl, true);
//print_r($response);
if ($response['status']) {
    $no = 0;
    foreach ($response['data'] as $res) {
        $id = $res['id'];
        $category = $res['category'];
        $service = $res['name'];
        $price = $res['price'];
        $refill = ($res['refill'] == 'true') ? 1 : 0;
        
$cek_keuntungan = $db->query("SELECT * FROM keuntungan WHERE code = 'SOSIAL_MEDIA'");
$qb = $cek_keuntungan->fetch_assoc();        
        
        $profit_web = ($price / 100) * $qb['web'];
        $profit_api = ($price / 100) * $qb['api'];
        $min = $res['min'];
        $max = $res['max'];
        $description = $res['note'];

        if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM layanan_sosmed2 WHERE provider_id = '" . $id . "' AND provider = '" . $q['code'] . "'")) == 0) {
            $no = $no + 1;
            mysqli_query($db,"INSERT INTO layanan_sosmed2 VALUES ('','" . $id . "', '" . $category . "', '" . $service . "', '" . $description . "', '" . $min . "', '" . $max . "', '" . ($price + $profit_web) . "', '" . ($price + $profit_api) . "', '" . $profit_web . "', '" . $refill . "', 'Aktif', '" . $id . "', '" . $q['code'] . "' ,'Sosial Media')"
            );
        }
    }
    echo $no . " Layanan Berhasil Ditambahkan.";
}
