<?php
session_start();
require_once '../mainconfig.php';
load('middleware', 'user');

if (isset($_POST['redeem'])) {
                $post_voucher = $db->real_escape_string(e(@$_POST['voucher']));
                
		$cek_voucher = $db->query("SELECT * FROM voucher_deposit WHERE voucher = '$post_voucher'");
		$data_voucher = $cek_voucher->fetch_assoc();
		$cek_voucher_rows = mysqli_num_rows($cek_voucher);
		
                $post_balance = $data_voucher['saldo'];
                $post_voc = $data_voucher['voucher'];
		
		if (!$post_voucher) {
			$_SESSION['alert'] = ['danger', 'Failed!', 'Masih ada form kosong.'];
		} else if ($_SESSION['user']['level'] == 'Lock') {
                        $_SESSION['alert'] = ['danger', 'Failed!', 'your account has been locked.'];
		} else if ($cek_voucher_rows == 0) {		
			$_SESSION['alert'] = ['danger', 'Failed!', 'Voucher tidak tersedia.'];
		} else if ($data_voucher['status'] == "sudah diredeem") { 
			$_SESSION['alert'] = ['danger', 'Failed!', 'Voucher sudah digunakan.'];	
		} else {
		
	                $tanggal = date('Y-m-d H:i:s');
		        $insert_depo = $db->query("UPDATE voucher_deposit set status = 'sudah diredeem', tanggal = '{$tanggal}', penerima = '{$session}' WHERE voucher = '$post_voucher'");
			$insert_depo = $db->query("UPDATE users SET saldo = saldo+$post_balance WHERE username = '{$session}'");
			$insert_depo = $db->query("INSERT INTO history_saldo VALUES('', '{$session}', 'Penambahan Saldo', '{$post_balance}', 'Redeem, voucher :: ({$post_voucher})', '{$tanggal}')");
			
			if ($insert_depo == TRUE) {
			$_SESSION['alert'] = ['success', 'Success!', 'Redeem berhasil Rp '.number_format($post_balance,0,',','.').''];	
			} else {
				$_SESSION['hasil'] = array('alert' => 'danger bg-danger text-white', 'judul' => 'Failed!', 'pesan' => 'Invalid Code #505');
			}
		}
	}
	
include_once '../layouts/header.php';
?>

<section id="basic-vertical-layouts">
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card">
                 <div class="card-body">
                    <h4 class="m-t-0 header-title"><i class=""></i> Redeem Voucher</h4>
                    <form method="POST" class="form form-vertical">
                        <input type="hidden" id="csrf_token" name="csrf_token" value="<?= csrf_token() ?>">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Kode Voucher</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="gift"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="voucher">
                                    </div>
                                </div>
                            <div class="row">  
                            <div class="col-12 text-right">
                                <button type="reset" class="btn btn-relief-danger"><i class="fas fa-sync"></i> Ulangi</button>
                                <button type="submit" name="redeem" class="btn btn-relief-primary mr-1"><i class="fas fa-gift"></i> Redeem</button>
                            </div>
                        </div>
                   </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once '../layouts/footer.php'; ?>