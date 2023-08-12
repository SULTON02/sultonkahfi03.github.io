<?php
session_start();
require_once '../mainconfig.php';
load('middleware', 'user');

// Function Curl
function postCurlWaApi($url, $post, $header = null)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    if ($header !== null) curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $chresult = curl_exec($ch);
    curl_close($ch);
    return $chresult;
}

// Function Send Message
function sendMessage($api_key, $penerima, $title, $pesan)
{
    $api_postdata = [
        'api_key' => $api_key,
        'aksi' => 'kirim-pesan',
        'penerima' => $penerima,
        'title' => urlencode($title),
        'pesan' => urlencode($pesan)
    ];

    // Curl
    $chresult = postCurlWaApi("https://rent.hwg47.my.id/api/whatsapp", $api_postdata);
    $json_result = json_decode($chresult, true);
    return $json_result;
}

$seeDepo = $db->query("SELECT * FROM deposit WHERE username = '$session' AND status = 'Pending'");
$lann = $seeDepo->fetch_assoc();
$cId = base64_encode($lann['kode_deposit']);
$tUrl = base_url('/deposit/invoice?kode_deposit='.$cId);
$oUrl = 'https://tripay.co.id/checkout/'.$lann['tid'];

if($seeDepo->num_rows == 1 && $lann['tid'] == '') exit(header("Location: $tUrl"));
if($seeDepo->num_rows == 1 && $lann['tid'] !== '') exit(header("Location: $oUrl"));

if (isset($_POST['request'])) {
		$post_tipe = $db->real_escape_string(e(@$_POST['tipe']));
		$post_provider = $db->real_escape_string(e(@$_POST['provider']));
		$post_jumlah = $db->real_escape_string(e(@$_POST['jumlah']));
		$post_pengirim = $db->real_escape_string(e(@$_POST['pengirim']));        
        
		$cek_metod = $db->query("SELECT * FROM metode_depo WHERE id = '{$post_provider}'");
		$data_metod = $cek_metod->fetch_assoc();
		$cek_metod_rows = mysqli_num_rows($cek_metod);
		
		$cek_depo = $db->query("SELECT * FROM deposit WHERE username = '{$session}' AND status = 'Pending'");
		$data_depo = $cek_depo->fetch_assoc();
		$count_depo = mysqli_num_rows($cek_depo);
		
		$kode_deposit = base64_encode(random_number(6));		
		$tanggal = date('Y-m-d H:i:s');
		$tanggal_at = date('Y-m-d H:i:s', strtotime('+3 hours', strtotime($tanggal)));
		
		if (!$post_tipe || !$post_provider || !$post_jumlah) {
			$_SESSION['alert'] = ['danger', 'Failed!', 'Masih ada form kosong.'];
		
	        } else if ($_SESSION['user']['level'] == 'Lock') {
                        $_SESSION['alert'] = ['danger', 'Failed!', 'Akun anda di kunci #HUBADMIN.'];
            
	        } else if ($_SESSION['user']['level'] == 'Lock') {
                        $_SESSION['alert'] = ['danger', 'Failed!', 'your account has been locked.'];
	       	
	        } else if ($cek_metod_rows == 0) {
			$_SESSION['alert'] = ['danger', 'Failed!', 'Metode tidak tersedia.'];
			
	        } else if ($count_depo >= 1) {
			$_SESSION['alert'] = ['danger', 'Failed!', 'Masih ada deposit yang pending.'];
			
	        } else if ($post_jumlah < $data_metod['min']) {
			$_SESSION['alert'] = ['danger', 'Failed!', 'Minimal deposit Rp '.number_format($data_metod['min'],0,',','.').',-'];
			
		} else if ($post_jumlah > $data_metod['max']) {
			$_SESSION['alert'] = ['danger', 'Failed!', 'Maxsimal deposit Rp '.number_format($data_metod['max'],0,',','.').',-'];		
			
	        } else {
	    
	        $metodnya = $data_metod['nama'];
	        
	        /* RATE DISINI */
	        $acakin = random_number(3);
	        $get_saldo = ($acakin+$post_jumlah) * $data_metod['rate'];
	        $trxid = "";
	        
	        $pengirim = (!$post_pengirim) ? '-' : $post_pengirim;
	       
	        if($post_tipe != 'PULSA') {
                    $amount = $get_saldo;
	            $reg = $post_jumlah;
                } else {
                    $amount = $get_saldo;
	            $reg = $post_jumlah;
                }
                
	        $insert = $db->query("INSERT INTO deposit VALUES ('', '{$kode_deposit}', '{$session}', '{$post_tipe}', '{$data_metod['provider']}', '{$data_metod['nama']}', '{$pengirim}', '{$trxid}', '".$data_metod['tujuan']."', '{$data_metod['an']}', '{$reg}', '$get_saldo', 'Pending', '$acakin','','{$tanggal}', '{$tanggal_at}')");
	        if($insert == TRUE) {
	              // Wa Message Api
            $api_key = "HumGA9s8eoyFMZjaioDQ1d";
$tujuan = $_SESSION['user']['phone'];
$isititle = "#NOTICE DEPOSIT";
$isipesan = "♥️INFORMASI DEPOSIT $metodnya\n\n💎Nominal Deposit: $post_jumlah\n💎Kode Unik : $acakin\n💎Jumlah : Nominal ➕ Kode Unik\n💎Nomor Invoice : $kode_deposit\n\nSEGERA SELSAIKAN DEPOSIT ANDA\nTERIMA KASIH\n\nSalam Hormat : RAJAPANELL.COM";
$isifooter = "Footer";
            sendMessage($api_key, $tujuan, $isititle, $isipesan);
            
            $api_key = "HumGA9s8eoyFMZjaioDQ1d";
$tujuan = "6285559702423";
$isititle = "RAJAPANELL DEPOSIT $metodnya";
$isipesan = "♥️NOTICE : INFORMASI DEPOSIT\n💎UserName : $session\n💎Nominal : $post_jumlah\n💎Kode Unik : $acakin\n💎Pengirim : $post_pengirim\n💎Nomor Invoice : $kode_deposit\n\nSalam Hormat : RAJAPANELL.COM";
$isifooter = "Footer";
            sendMessage($api_key, $tujuan, $isititle, $isipesan);
            
           
            
	            $last_id = $db->insert_id;                             
                    $apiKey = 'bTr7166E8G6ab18MWdtQIRJy1Uytj4VL2a7uxWxM';
                    $privateKey = 'puHG1-MULWt-19ZkW-5erTZ-35f5z';
                    $merchantCode = 'T23102';
                    $merchantRef = $last_id;
                    
                    $seeuser = $db->query("SELECT * FROM users WHERE username = '$session'")->fetch_assoc();
        
                    $data = [
                       'method'            => strtoupper($data_metod['provider']),
                       'payment_name'      => $data_metod['nama'],
                       'merchant_ref'      => $merchantRef,
                       'amount'            => $post_jumlah,
                       'customer_name'     => $seeuser['name'],
                       'customer_email'    => $seeuser['email'],
                       'customer_phone'    => $seeuser['phone'],
                       'order_items'       => [
                           [
                               'sku'       => $last_id,
                               'name'      => 'RajaPanell - Deposit #'.date('H.i'),
                               'price'     => $post_jumlah,
                               'quantity'  => 1
                           ]
                       ],
                      'return_url'        => base_url('/deposit/riwayat'),
                      'expired_time'      => (time()+(24*60*60)), // 24 jam
                      'signature'         => hash_hmac('sha256', $merchantCode.$merchantRef.$post_jumlah, $privateKey)
                    ];
                    
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL               => "https://tripay.co.id/api/transaction/create",
                        CURLOPT_RETURNTRANSFER    => 1,
                        CURLOPT_HEADER            => false,
                        CURLOPT_HTTPHEADER        => array("Authorization: Bearer ".$apiKey),
                        CURLOPT_POST              => 1,
                        CURLOPT_POSTFIELDS        => http_build_query($data)                        
                    ));
                    curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
                  
                    $response = curl_exec($curl);
                    $return = json_decode($response, true);
                    
                                        
                    if($return['success'] == true) {                                                         
                        $reference = $return['data']['reference'];
                        $feePay = $return['data']['total_fee'];
                        $amountAll = $return['data']['amount_received'];
                        $checkUrl = $return['data']['checkout_url'];
                        
                        $db->query("UPDATE deposit SET tid = '$reference', acakin = '$feePay', get_saldo = '$amountAll' WHERE id = '$last_id'");
                        
                       # $_SESSION['alert'] = ['success', 'Success!', 'Deposit berhasil dibuat.'];
                        
                        exit(header("Location: $checkUrl"));
                    } else {
                        exit(header("Location: ".base_url('/deposit/invoice?kode_deposit='.base64_encode($kode_deposit))));                       
                    }	                               	            
	        } else {
			$_SESSION['hasil'] = array('alert' => 'danger bg-danger text-white', 'judul' => 'Failed!', 'pesan' => 'Eror sistem #404.');
	        }
	    }
	}

include_once '../layouts/header.php';
?>
<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-analytics">
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-body">
                    <h4 class="m-t-0 header-title"><i class="fas fa-credit-card"></i> Deposit Baru</h4>
                    <br>
                    <form class="form-horizontal" role="form" method="POST">
                        <input type="hidden" id="csrf_token" name="csrf_token" value="<?= csrf_token() ?>" />

                        <div class="form-group">
                        <label class="col-md-12 control-label"><b>Pilih Tipe Pembayaran</b></label>
                            <div class="col-12">
                                <span class="custom-control custom-radio">
                                    <input type="radio" id="BANK" value="BANK" name="tipe" class="custom-control-input" />
                                    <label class="custom-control-label" for="BANK">Bank</label>
                                </span>
                                <span class="custom-control custom-radio">
                                    <input type="radio" id="E-MONEY" value="E-MONEY" name="tipe" class="custom-control-input" />
                                    <label class="custom-control-label" for="E-MONEY">E-Wallet</label>
                                    </span>
                                <span class="custom-control custom-radio">
                                    <input type="radio" id="VA-BANK" value="VA-BANK" name="tipe" class="custom-control-input" />
                                    <label class="custom-control-label" for="VA-BANK">VA ACCOUNT</label>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12 control-label"><b>Pilih Metode Pembayaran</b></label>
                            <div class="col-md-12">
                                <select class="form-control" name="provider" id="provider">
                                    <option value="0">Pilih...</option>
                                </select>
                            </div>
                        </div>

                        <small><div id="element-note"></div></small>

                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-12 text-right">
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#primary">
                                                Qris
                                            </button>
                                <button type="submit" class="btn btn-relief-primary float-end" name="request"><i class="fas fa-credit-card"></i> Deposit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
                                        
                                            <!-- Button trigger modal -->
                                            
                                            <!-- Modal -->
                                            <div class="modal fade text-left modal-primary" id="primary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel160"><b>Qris Code</b></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img class="img-fluid" src="/assets/images/logo/contohqris.png" alt="Qris" />
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
        
        
        <div class="col-12 col-md-5">
        <div class="card">
            <div class="card-body border-bottom">
                <h4 class="card-title"><i class="fas fa-info-circle me-1"></i> Informasi</h4>
                <strong>Cara Melakukan Deposit Baru :</strong>
                <ul>
                    <li>Pilih <em>Jenis Pembayaran</em>.</li>
                    <li>Pilih <em>Metode Pembayaran</em>.</li>
                    <li>Input <em>Jumlah Deposit</em> yang Anda inginkan.</li>
                    <li>Transfer Pembayaran sesuai dengan nominal yang tertera.</li>
                </ul>
                <strong>Penting !</strong>
                <ul>
                    <li>Kami berhak menghapus atau memblokir akun Anda apabila terbukti melakukan kecurangan pada Deposit.</li>
                    <li>Jika sudah melakukan transfer harap konfirmasi ke Admin agar Permintaan Deposit segera diterima.</li>
                </ul>           
            </div>
        </div>
    </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
            $('input[type=radio][name=tipe]').change(function() {
                var tipe = this.value;
                $.ajax({
			url: '<?= base_url() ?>ajax/provider_deposit.php',
			data: 'tipe=' + tipe,
			type: 'POST',
			dataType: 'html',
			success: function(msg) {
				$("#provider").html(msg);
			}
		});
	});
            $("#provider").change(function() {
                var provider = $("#provider").val();
                $.ajax({
                    url: '<?= base_url() ?>ajax/catatan_deposit.php',
                    data: 'provider=' + provider,
                    type: 'POST',
                    dataType: 'html',
                    success: function(msg) {
                        $("#element-note").html(msg);
                    }
                });
            });
            
            $("#jumlah").change(function(){
                var pembayaran = $("#pembayaran").val();
                var jumlah = $("#jumlah").val();
                $.ajax({
                    url : '<?= base_url() ?>ajax/rate_deposit.php',
                    type  : 'POST',
                    dataType: 'html',
                    data  : 'pembayaran='+pembayaran+'&jumlah='+jumlah,
                    success : function(result){
                        $("#rate").val(result);
                    }
                });
            });
        });
</script>					

          </div>
</section>
<!-- Dashboard Ecommerce ends -->
<?php include_once '../layouts/footer.php'; ?>