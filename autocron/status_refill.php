<?php

require_once '../mainconfig.php';
$refills = mysqli_query($db, "SELECT * FROM refill_sosmed WHERE status IN ('Pending','Processing') ORDER BY rand() LIMIT 50");
while ($refill = mysqli_fetch_assoc($refills)) {
    $provider = mysqli_query($db, "SELECT * FROM provider WHERE id = '2'");
    if (mysqli_num_rows($provider) == 0) {
        print("OID: " . $refill['order_id'] . ", Provider tidak ditemukan!<br />");
    } else {
        $provider = mysqli_fetch_assoc($provider);
        if ($provider['id'] == '2') {
            $post_api = [
                'api_id' => $provider['api_id'],
                'api_key' => $provider['api_key'],
                'secret_key' => $provider['secret_key'],
                'id' => $refill['reffil_id']
            ];
        
            $curl = post_curl($provider['link']."status_refill", $post_api);
            $result = json_decode($curl, true);
            if (isset($result['response']) and $result['response'] == true) {
                if ($result['status'] == 'Success') {
                    $status = 'Success';
                } elseif ($result['status'] == 'Processing') {
                    $status = 'Processing';
                } elseif ($result['status'] == 'Error') {
                    $status = 'Error';
                } else {
                    $status = 'Pending';
                }
                $update = mysqli_query($db, "UPDATE refill_sosmed SET status = '" . $status . "', tanggal_at = '" . date('Y-m-d H:i:s') . "' WHERE order_id = '" . $refill['order_id'] . "'");
                if ($update) {
                    print("RID: " . $refill['order_id'] . " | PRID: " . $refill['refill_id'] . " | STATUS: " . $status . " | P: " . $provider['code'] . "<br />");
                } else {
                    print("RID: " . $refill['order_id'] . ", Gagal update database!<br />");
                }
            } else {
                print("RID: " . $refill['order_id'] . ", Cek status gagal!<br />");
            }
        }
    }
}
