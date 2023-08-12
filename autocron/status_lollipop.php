<?php

require_once '../mainconfig.php';

$tanggal = date('Y-m-d H:i:s');
$orders = mysqli_query($db, "SELECT * FROM pembelian_sosmed WHERE status IN ('Pending', 'Processing')");
while ($order = mysqli_fetch_array($orders)) {
    $provider = mysqli_query($db, "SELECT * FROM provider WHERE id = '10'");
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
            'api_id' => $provider['3770'],
            'api_key' => $provider['7be3ea-5ded21-fc764e-2380de-9dee31'],
            'id' => $order['provider_oid'],
        ];
        $curl = post_curl($provider['https://lollipop-smm.com/api/'], $post_api);
        $result = json_decode($curl, true);
        if (isset($result['status']) and $result['status'] == true) {
            if ($result['data']['status'] == 'Success') {
                $status = 'Success';
            } elseif ($result['data']['status'] == 'Error') {
                $status = 'Error';
            } elseif ($result['data']['status'] == 'Partial') {
                $status = 'Partial';
            } elseif ($result['data']['status'] == 'Processing') {
                $status = 'Processing';
            } else {
                $status = 'Pending';
            }
            $start_count = isset($result['data']['start_count']) ? $result['data']['start_count'] : 0;
            $remains = isset($result['data']['remains']) ? $result['data']['remains'] : 0;

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
        } else {
            print "ID: " . $order['oid'] . ", Cek status gagal | Response: " . $curl . "!<br />";
        }
    }
}
