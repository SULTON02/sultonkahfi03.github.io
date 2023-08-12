<?php

require_once '../mainconfig.php';

use GojekPay\GojekPay;

$tanggal = date('Y-m-d H:i:s');
$deposits = mysqli_query($db, "SELECT * FROM deposit WHERE status = 'Pending' AND provider = 'GOPAY'");
$gopay = mysqli_query($db, "SELECT * FROM gopay WHERE id = '1'");
$token = $gopay->fetch_assoc()['token'];

$init = new GojekPay($token);
$gojek_transaksi = json_decode($init->getTransactionHistory(),true);
    
while($deposit = mysqli_fetch_array($deposits)){
    foreach($gojek_transaksi['data']['success'] as $mut){
        $idDeposit = $deposit['id'];
        $username = $deposit['username'];
        
        $tanggal_transaksi = date("Y-m-d H:i:s", strtotime("+7 hours", strtotime($mut['transacted_at'])));
        $invoice_transaksi = $mut['transaction_ref'];
        $jumlah_masuk = $mut['amount']['value'];
        $tipe_transaksi = $mut['type'];
        
        if($deposit['tanggal'] > $tanggal_transaksi) continue;
        
        $cari_trxid = mysqli_query($db, "SELECT * FROM deposit WHERE trxid = '$invoice_transaksi'");
    
        if($cari_trxid->num_rows > 0) continue;
        
        if($tipe_transaksi == "credit" && $jumlah_masuk == $deposit['jumlah_transfer']){
            
            $update_status_deposit = mysqli_query($db, "UPDATE deposit SET status = 'Success', trxid='$invoice_transaksi' WHERE id='$idDeposit'");
            $update_user = mysqli_query($db, "UPDATE users SET saldo = saldo+{$deposit[get_saldo]} WHERE username = '$username'");
            $input_history = mysqli_query($db, "INSERT INTO history_saldo VALUES('', '{$deposit[username]}', 'Penambahan Saldo', '{$deposit[get_saldo]}', 'Deposit Saldo :: ({$deposit[kode_deposit]})', '{$tanggal}')");
            
            if($update_status_deposit && $update_user && $input_history){
                echo "sukses";
            }
        }
        
    }
}