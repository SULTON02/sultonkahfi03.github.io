<?php
$cek_pesanan = $db->query("SELECT * FROM pembelian_sosmed WHERE status IN ('Error','Canceled','Partial') AND refund = '0'");
if (mysqli_num_rows($cek_pesanan) == 0) {
} else {
	while($data_pesanan = mysqli_fetch_assoc($cek_pesanan)) {
		
		    $harga = $data_pesanan['harga'] / $data_pesanan['jumlah'];
		    $profit = $data_pesanan['profit'] / $data_pesanan['jumlah'];
		    $refund_satu = $harga * $data_pesanan['remains'];
		    $refund_dua = $profit * $data_pesanan['remains'];
		    $oid = $data_pesanan['oid'];
		    $tanggal = date('Y-m-d H:i:s');
		    
		    if($data_pesanan['remains'] == 0) {
		        $refund_satu = $data_pesanan['harga'];
		        $refund_dua = $data_pesanan['profit'];
		    }
		    
			$update_user = $db->query("UPDATE users SET pemakaian = pemakaian-{$refund_satu} WHERE username = '{$data_pesanan['user']}'");
			$update_user = $db->query("UPDATE users SET saldo = saldo+{$refund_satu} WHERE username = '{$data_pesanan['user']}'");
			$update_order = $db->query("INSERT INTO history_saldo VALUES('', '{$data_pesanan['user']}', 'Penambahan Saldo', '{$refund_satu}', 'Refund Error :: ({$oid})', '{$tanggal}')");
    		$update_order = $db->query("UPDATE pembelian_sosmed SET refund = '1' , profit = profit-{$refund_dua}  WHERE oid = '{$data_pesanan['oid']}'");
    		if ($update_order == TRUE) {
    		
    		} 
	}
}