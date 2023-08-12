<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<h3>
	<div style="text-align: center;">
		<a href="../admin/other/act"><b>KEMBALI</b></a><br/>
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
if ($response['result'] == true) {
    $no = 0;
    foreach ($response['data'] as $res) {
        $id = $res['id'];
        $category = $res['category'];
        $service = $res['name'];
        $price = $res['price'];
        $status = ($res['status'] == 'available') ? 'Aktif' : 'Tidak Aktif';
        $refill = ($res['refill'] == 'true') ? 1 : 0;
        
$cek_keuntungan = $db->query("SELECT * FROM keuntungan WHERE code = 'SOSIAL_MEDIA'");
$qb = $cek_keuntungan->fetch_assoc();        
        
        $profit_web = ($price / 100) * $qb['web'];
        $profit_api = ($price / 100) * $qb['api'];
        $web = 2000;
        $api = 2000;
        $min = $res['min'];
        $max = $res['max'];
        $description = $res['note'];

        if (mysqli_num_rows(mysqli_query($db, "SELECT * FROM layanan_sosmed WHERE provider_id = '" . $id . "' AND provider = '" . $q['code'] . "'")) == 0) {
            $no = $no + 1;
            mysqli_query($db,"INSERT INTO layanan_sosmed VALUES ('','" . $id . "', '" . $category . "', '" . $service . "', '" . $description . "', '" . $min . "', '" . $max . "', '" . ($price + $profit_web) . "', '" . ($price + $profit_api) . "', '" . $web . "', '" . $refill . "', '" . $status . "', '" . $id . "', '" . $q['code'] . "' ,'Sosial Media')"
            );
        }
    }
    echo $no . " Layanan Berhasil Ditambahkan.";
}
