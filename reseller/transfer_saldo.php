<?php
session_start();
require_once '../mainconfig.php';
load('middleware', 'user');

if ($_SESSION['user']['level'] == "Member") {
    header('location:' . base_url());
}

if (isset($_POST['send'])) {
	$post_penerima = $db->real_escape_string(e(@$_POST['penerima']));
	$post_jumlah = $db->real_escape_string(e(@$_POST['jumlah']));
	
	$check_user = mysqli_query($db, "SELECT * FROM users WHERE username = '{$post_penerima}'");
	$data_penerima = mysqli_fetch_assoc($check_user);
	
	if (!$post_penerima || !$post_jumlah) {
		$_SESSION['alert'] = ['danger', 'Failed!', 'Masih ada form kosong.'];
	} else if ($_SESSION['user']['level'] == 'Lock') {
                        $_SESSION['alert'] = ['danger', 'Failed!', 'your account has been locked.'];
	} else if ($data_penerima == 0) { 
	        $_SESSION['alert'] = ['danger', 'Failed!', 'Username tidak ditemukan.'];
	} else if ($data_user['saldo'] < $post_jumlah) { 
	        $_SESSION['alert'] = ['danger', 'Failed!', 'Saldo anda tidak mencukupi.'];
	} else if ($post_jumlah < 500) { 
	        $_SESSION['alert'] = ['danger', 'Failed!', 'Minimal transfer saldo 500'];
	} else if ($data_user['level'] == 'Reseller') { 
	        $_SESSION['alert'] = ['danger', 'Failed!', 'Hanya bisa transfers ke level member.'];
	} else {
	$tanggal = date('Y-m-d H:i:s');
	$rid = random_number(6);
	
	$insert_db = $db->query("UPDATE users SET saldo = saldo-{$post_jumlah} WHERE username = '{$session}'");
	$insert_db = $db->query("UPDATE users SET saldo = saldo+{$post_jumlah} WHERE username = '{$post_penerima}'");
	$insert_db = $db->query("INSERT INTO history_transfer VALUES('', '{$rid}', '{$session}', '{$post_penerima}', '{$post_jumlah}', '{$tanggal}')");
	$insert_db = $db->query("INSERT INTO history_saldo VALUES('', '{$post_penerima}', 'Penambahan Saldo', '{$post_jumlah}', 'Menerima transfer saldo dari username ({$session})', '{$tanggal}')");
	$insert_db = $db->query("INSERT INTO history_saldo VALUES('', '{$session}', 'Pengurangan Saldo', '{$post_jumlah}', 'Berhasil melakukan transfer saldo tujuan ({$post_penerima})', '{$tanggal}')");
			if ($insert_db === true) {
				$_SESSION['alert'] = ['success', 'Success!', 'Transfer saldo berhasil.'];
			exit(header("Location: ".base_url('/reseller/transfer_saldo')));
			} else {
				$_SESSION['alert'] = ['danger', 'Failed!', 'System is busy, please try again later.'];
			}
		}
	}

include_once '../layouts/header.php';
?>
<section id="dashboard-ecommerce">
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card">
                 <div class="card-body">
                    <h4 class="m-t-0 text-uppercase header-title"><i class=""></i> TRANSFER SALDO</h4><hr>
                    <form method="POST">
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="penerima" required>
                                           </div>
                                      </div>
                                </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Jumlah</label>
                                    <input type="number" class="form-control" name="jumlah" onkeyup="this.value=this.value.replace(/[^\d]+/g,'')" data-validation-required-message="This phone field is required" required>
                                           </div>
                                      </div>
                                </div>
                        <div class="form-group"> 
                                    <div class="row">
                                <div class="col-md-12">
                                        <button type="submit" name="send" class="pull-right btn btn-block btn-md btn-primary waves-effect w-md waves-light"><i class=""></i> Submit</button> 
                                        </div>
                                </div>
                           </div>
                    </form>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="riwayat" data-toggle="tab" href="#riwayat" aria-controls="riwayat" role="tab" aria-selected="false">Riwayat</a>
                        </li>
                    </ul>
                        <div class="tab-pane active" id="riwayat" aria-labelledby="credit-tab" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered datatable" id="Myriwayat" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Penerima</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $check_history = $db->query("SELECT * FROM history_transfer WHERE username = '{$session}' ORDER BY id DESC");
                                    while($data_history = $check_history->fetch_assoc()) :
                                    ?>
                                     <tr>
                                        <td><?= $data_history['penerima'] ?><br>(#<?= $data_history['rid'] ?>)</td>
                                        <td><div class="badge badge-success">Rp <?= number_format($data_history['jumlah'],0,',','.') ?></div></td>
                                        <td><center><?= format_date('id',$data_history['tanggal']) ?></center></td>
                                      </tr>
                                      <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
 </div>
</section>    
<?php include_once '../layouts/footer.php'; ?>