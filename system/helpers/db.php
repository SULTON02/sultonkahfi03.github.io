<?php
$check_user = $db->query("SELECT * FROM users WHERE username = '{$session}'");
$data_user = $check_user->fetch_assoc();

// Data Website
$check_A = $db->query("SELECT * FROM setting_website WHERE id = '1'");
$web = $check_A->fetch_assoc();
// Harga Upgrade
$check_D = $db->query("SELECT * FROM keuntungan WHERE id = '1'");
$priceUP = $check_D->fetch_assoc();


// Halaman Pengguna
    $count_order = mysqli_num_rows($db->query("SELECT * FROM pembelian_sosmed WHERE user = '{$session}' AND status = 'Success'"));
    $Check_Order = $db->query("SELECT SUM(harga) AS total FROM pembelian_sosmed WHERE user = '{$session}' AND status = 'Success'");
    $order = $Check_Order->fetch_assoc();
    
    $count_deposit = mysqli_num_rows($db->query("SELECT * FROM deposit WHERE username = '{$session}' AND status = 'Success'"));
    $Check_Deposit = $db->query("SELECT SUM(get_saldo) AS total FROM deposit WHERE username = '{$session}' AND status = 'Success'");
    $deposit = $Check_Deposit->fetch_assoc();
//            

// Count Pesanan
$count_pesanan_sosmed = mysqli_num_rows($db->query("SELECT * FROM pembelian_sosmed"));

// Device AGENT
$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'unknown';
$device = isset($_SERVER['HTTP_USER_AGENT']) ? devices() : 'unknown';

// Total Profit Pembelian Sosmed Perbulan
$ThisProfitSosmed = $db->query("SELECT SUM(profit) AS total FROM pembelian_sosmed WHERE MONTH(pembelian_sosmed.tanggal) = '".date('m')."' AND YEAR(pembelian_sosmed.tanggal) = '".date('Y')."'");
$ProfitSosmed = $ThisProfitSosmed->fetch_assoc();
$ThisTotalSosmed = $db->query("SELECT SUM(harga) AS total FROM pembelian_sosmed WHERE MONTH(pembelian_sosmed.tanggal) = '".date('m')."' AND YEAR(pembelian_sosmed.tanggal) = '".date('Y')."'");
$AllSosmed = $ThisTotalSosmed->fetch_assoc();
$CountProfitSosmed = mysqli_num_rows($db->query("SELECT * FROM pembelian_sosmed WHERE MONTH(pembelian_sosmed.tanggal) = '".date('m')."' AND YEAR(pembelian_sosmed.tanggal) = '".date('Y')."'"));
?>