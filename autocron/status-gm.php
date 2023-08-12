<?php

require_once '../mainconfig.php';

$tanggal = date('Y-m-d H:i:s');
$orders = mysqli_query($db, "SELECT * FROM pembelian_sosmed WHERE status IN ('Pending', 'Processing')");
while ($order = mysqli_fetch_array($orders)) {
    $provider = mysqli_query($db, "SELECT * FROM provider WHERE code = 'GM'");
    if (mysqli_num_rows($provider) == 0) {
        print "ID: " . $order['oid'] . ", Provider tidak ditemukan!<br />";
    } else {
        // CHECK USER PEMBELI
        $pembeli = $order['user'];
        $check_buyer = $db->query("SELECT * FROM users WHERE username = '{$pembeli}'");
        $data_buyer = $check_buyer->fetch_assoc();
        $refferal = $data_buyer['refferal'];

        // CHECK UPLINK REFF
        $check_reff = $db->query("SELECT * FROM users WHERE uplink = '{$refferal}'");
        $data_reff = mysqli_fetch_assoc($check_reff);
        $check_reff_rows = mysqli_num_rows($check_reff);
        $reff = $data_reff['username'];

        $provider = mysqli_fetch_assoc($provider);
        $post_api = [
            'key' => $provider['api_key'],
            'sign' => md5($provider['api_id'].$provider['api_key']),
            'type' => 'status',
            'trxid' => $order['provider_oid'],
        ];
        $curl = post_curl($provider['link'].'social-media', $post_api);
        $result = json_decode($curl, true);
        if (isset($result['result']) AND $result['result'] == true) {
           foreach ($result['data'] as $res) {
            if ($res['status'] == 'success') {
                $status = 'Success';
            } elseif ($res['status'] == 'error') {
                $status = 'Error';
            } elseif ($res['status'] == 'partial') {
                $status = 'Partial';
            } elseif ($res['status'] == 'processing') {
                $status = 'Processing';
            } else {
                $status = 'Pending';
            }
            $start_count = isset($res['count']) ? $res['count'] : 0;
            $remains = isset($res['remain']) ? $res['remain'] : 0;

            if ($status == 'Success') {
                $tanggal = date('Y-m-d H:i:s');
                $cek_profit = $db->query("SELECT * FROM keuntungan WHERE code = 'SOSIAL_MEDIA'");
                $data_profitQ = $cek_profit->fetch_assoc();
                $profitReff = $data_profitQ['rate_reff'];                
                $userUP = "UPDATE users SET poin = poin+{$profitReff} WHERE username = '{$reff}'";
                mysqli_query($db, $userUP);
            }

            // PERJUMLAHAN PROFIT
            $price_web = $order['harga'];
            $price_pusat = $order['price_pusat'];
            $jumlah_profit = $price_web - $price_pusat;

            $query_update = "UPDATE pembelian_sosmed SET status = '" . $status . "', start_count = '" . $start_count . "', remains = '" . $remains . "', tanggal_at = '" . $tanggal . "', profit = '" . $jumlah_profit . "' WHERE oid = '" . $order['oid'] . "'";
            mysqli_query($db, $query_update);
            print "ID: " . $order['oid'] . ", STATUS: $status, SC: $start_count, R: $remains | Response: " . $curl . "<br />";
           }
        } else {
            print "ID: " . $order['oid'] . ", Cek status gagal | Response: " . $curl . "!<br />";
        }
    }
}
