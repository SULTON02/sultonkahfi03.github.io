<?php

require '../mainconfig.php';

$tanggal = date('Y-m-d H:i:s');
$deposits = mysqli_query($db, "SELECT * FROM deposit WHERE provider = 'GOPAY' AND status = 'Pending' AND DATE(tanggal) = '" . date('Y-m-d') . "'");
while ($deposit = mysqli_fetch_assoc($deposits)) {
    $start_date = new DateTime(date('Y-m-d', strtotime($deposit['tanggal'])));
    $since_start = $start_date->diff(new DateTime(date('Y-m-d')));
    if ($since_start->days < 1) {
        $mutation = mysqli_query($db, "SELECT * FROM gopay_mutations WHERE amount = '" . $deposit['post_amount'] . "' AND DATE(created_at) = '" . date('Y-m-d', strtotime($deposit['created_at'])) . "' AND status = 'UNREAD'");
        if (mysqli_num_rows($mutation) == 1) {
           
            mysqli_query($db, "UPDATE deposit SET status = 'Success', trxid = '". $mut['transaction_ref'] ."' WHERE id = '" . $deposit['id'] . "'");
            mysqli_query($db, "UPDATE gopay_mutations SET status = 'READ' WHERE id = '" . $mutation['id'] . "'");
            mysqli_query($db, "UPDATE users SET saldo = saldo+{$deposit[get_saldo]} WHERE username = '". $deposit['username'] ."'");
            mysqli_query($db, "INSERT INTO history_saldo VALUES('', '". $deposit['username'] ."', 'Penambahan Saldo', '". $deposit['get_saldo'] ."', 'Deposit Saldo :: (". $deposit['kode_deposit'] .")', '". $tanggal ."')");
                        
        }
    }
}
