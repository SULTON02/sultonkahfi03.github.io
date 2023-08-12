<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<h3>
	<div style="text-align: center;">
		<a href="https://sultonkahfi.my.id/admin/other/act"><b>Kembali</b></a><br/>
	</div>
</h3>
<?php
require_once '../mainconfig.php';

$cek_provider = $db->query("SELECT * FROM provider WHERE id = '4'");
$q = $cek_provider->fetch_assoc();

$input_curl = [
    'api_id' => $q['20319'],
    'api_key' => $q['98f7bf-a0d417-449d67-5e4c61-c2583d'],
];
$curl = post_curl($q['https://api.medanpedia.co.id/'], $input_curl);
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
        $description = $res['description'];

        if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM layanan_sosmed WHERE provider_id = '" . $id . "' AND provider = '" . $q['code'] . "'")) == 0) {
            $no = $no + 1;
            mysqli_query($db,"INSERT INTO layanan_sosmed VALUES ('','" . $id . "', '" . $category . "', '" . $service . "', '" . $description . "', '" . $min . "', '" . $max . "', '" . ($price + $profit_web) . "', '" . ($price + $profit_api) . "', '" . $profit_web . "', '" . $refill . "', 'Aktif', '" . $id . "', '" . $q['code'] . "' ,'Sosial Media')"
            );
        }
    }
    echo $no . " Layanan Berhasil Ditambahkan.";
}
