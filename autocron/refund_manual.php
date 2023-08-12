<?php
$cek_pesanan = $db->query("SELECT * FROM pembelian_manual WHERE status IN ('Error','Canceled') AND refund = 'no'");
if (mysqli_num_rows($cek_pesanan) == 0) {
} else {
	while($data_pesanan = mysqli_fetch_assoc($cek_pesanan)) {
	$harga = $data_pesanan['harga'];
	$oid = $data_pesanan['oid'];
	$layanan = $data_pesanan['layanan'];
	$tanggal = date('Y-m-d H:i:s');
	
        $update_order = $db->query("UPDATE users SET pemakaian = pemakaian-{$harga} WHERE username = '{$data_pesanan['user']}'");
	$update_order = $db->query("UPDATE users SET saldo = saldo+{$harga} WHERE username = '{$data_pesanan['user']}'");		
	$update_order = $db->query("UPDATE layanan_manual SET stok = stok+1 WHERE layanan = '{$layanan}'");	
	$update_order = $db->query("INSERT INTO history_saldo VALUES('', '{$data_pesanan['user']}', '+', '{$harga}', 'Refund error produk developer :: ({$oid})', '{$tanggal}')");		
	$update_order = $db->query("UPDATE pembelian_manual SET refund = 'ya' WHERE oid = '{$data_pesanan['oid']}'");	
    	if ($update_order == TRUE) {
    		} 
	}
}