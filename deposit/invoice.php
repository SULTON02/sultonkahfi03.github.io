<?php
session_start();
require_once '../mainconfig.php';
load('middleware', 'user');

$kode_deposit = $db->real_escape_string(e(base64_decode($_GET['kode_deposit'])));
$check_bill = $db->query("SELECT * FROM deposit WHERE kode_deposit = '{$kode_deposit}' AND username = '{$session}'");
$bill = $check_bill->fetch_assoc();
$bill_metod = $db->query("SELECT * FROM metode_depo WHERE provider = '".$bill['provider']."'")->fetch_assoc();

if (!isset($_GET['kode_deposit'])) {
    exit(header("Location: " . base_url('/deposit/new')));
} else {
        $jumlah = $bill['jumlah_transfer'];
        $saldo = $bill['get_saldo'];
        $tanggal = date('Y-m-d H:i:s');
        $tanggal_mutasi = $bill['tanggal_mutasi'];
    if (mysqli_num_rows($check_bill) == 0) {
        $_SESSION['alert'] = ['danger', 'Failed!', 'Invoice not found.'];
        exit(header("Location: " . base_url('/deposit/riwayat')));
    } else if ($bill['status'] != 'Pending') {
        $_SESSION['alert'] = ['danger', 'Failed!', 'Deposit has been successful or Canceled cant be visited.'];
        exit(header("Location: " . base_url('/deposit/riwayat')));
    } else {                
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['cancel'])) {
                $post_pin = $db->real_escape_string(trim(filter($_POST['pin'])));
                $cek_pin = $db->query("SELECT * FROM users WHERE pin = '{$post_pin}' AND username = '{$session}'");
                $data_pin = mysqli_fetch_assoc($cek_pin);
                if (!$post_pin) {
                    $_SESSION['alert'] = ['danger', 'Failed!', 'Mohon untuk di isi konfirmasi PIN.'];
                } else if (mysqli_num_rows($cek_pin) == 0) {
                    $_SESSION['alert'] = ['danger', 'Failed!', 'PIN anda salah.'];
                } else {
                    $cancel_bill = $db->query("UPDATE deposit SET status = 'Cancelled' WHERE kode_deposit = '{$kode_deposit}' AND username = '{$session}'");
                    if ($cancel_bill === true) {
                        $_SESSION['alert'] = ['success', 'Success!', 'Invoice berhasil dibatalkan.'];
                        exit(header("Location: " . base_url()));
                    } else {
                        $_SESSION['alert'] = ['danger', 'Failed!', 'System is busy, please try again later.'];
                    }
                }
            } else if (isset($_POST['confirm'])) {
                if ($bill['provider'] == 'BCA') {
                    include '../mutasi/bca-class.php';
                    $cek = check_bca($jumlah);
                    if ($cek == "sukses") {
                        $check = true;
                    } else {
                        $check = false;
                    }
                }
                if ($check == false) {
                    $_SESSION['alert'] = ['danger', 'Failed!', 'Dana belum kami terima.'];
                } else {
                    if ($bill['status'] == 'Success') {
                        $_SESSION['alert'] = ['danger', 'Failed!', 'Deposit kamu sudah sukses!.'];
                    }
                    $update_depooo = $db->query("UPDATE users SET saldo = saldo+{$saldo} WHERE username = '{$session}'");
                    $update_depooo = $db->query("UPDATE deposit SET status = 'Success' WHERE kode_deposit = '{$kode_deposit}'");
                    $update_depooo = $db->query("INSERT INTO history_saldo VALUES('', '{$session}', '+', '{$saldo}', 'Deposit Saldo :: ({$kode_deposit})', '{$tanggal}')");
                    if ($update_depooo === true) {
                        $_SESSION['alert'] = ['success', 'Success!', 'Deposit sukses silahkan cek saldo anda.'];
                        exit(header("Location: " . base_url()));
                    } else {
                        $_SESSION['alert'] = ['danger', 'Failed!', 'System is busy, please try again later.'];
                    }
                }
            } else if (isset($_POST['confirm-bni'])) {
                if ($bill['provider'] == 'BNI') {
                    $check_bni = $db->query("SELECT * FROM bank_mutasi WHERE kredit = '$jumlah'");
                    $data_bni = $check_bni->fetch_assoc();
                    $cek = $data_bni['status'];
                }
                if (mysqli_num_rows($check_bni) == 0) {
                    $_SESSION['alert'] = ['danger', 'Failed!', ' Dana belum kami terima.'];
                } else {
                    if ($cek == 'sukses') {
                        $update_depooo = $db->query("UPDATE users SET saldo = saldo+{$saldo} WHERE username = '{$session}'");
                        $update_depooo = $db->query("UPDATE deposit SET status = 'Success' WHERE kode_deposit = '{$kode_deposit}'");
                        $update_depooo = $db->query("INSERT INTO history_saldo VALUES('', '{$session}', '+', '{$saldo}', 'Deposit Saldo :: ({$kode_deposit})', '{$tanggal}')");
                        if ($update_depooo === true) {
                            $_SESSION['alert'] = ['success', 'Success!', 'Deposit sukses silahkan cek saldo anda.'];
                            exit(header("Location: " . base_url()));
                        } else {
                            $_SESSION['alert'] = ['danger', 'Failed!', 'System is busy, please try again later.'];
                        }
                    }
                }
            }
        }
        if ($bill['status'] == 'Pending') {
            $text_color = 'warning';
        } else if ($bill['status'] == 'Success') {
            $text_color = 'success';
        } else {
            $text_color = 'danger';
        }
        include_once '../layouts/header.php'; ?>
        <?php
        $cek_depo = $db->query("SELECT * FROM deposit WHERE username = '{$session}' AND status = 'Pending' AND provider NOT IN ('QRIS') ORDER BY id DESC");
        while ($bill = $cek_depo->fetch_assoc()) {
?>
<section class="invoice-preview-wrapper">
    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-9 col-md-8 col-12">
            <div class="card invoice-preview-card">
                <div class="card-body invoice-padding pb-0">
                    <!-- Header starts -->
                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                        <div>
                            <div class="logo-wrapper">
                                                <svg viewBox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                                    <defs>
                                                        <linearGradient id="invoice-linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                                            <stop stop-color="#000000" offset="0%"></stop>
                                                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                                                        </linearGradient>
                                                        <linearGradient id="invoice-linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                                            <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                                                        </linearGradient>
                                                    </defs>
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <g transform="translate(-400.000000, -178.000000)">
                                                            <g transform="translate(400.000000, 178.000000)">
                                                                <path class="text-primary" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill: currentColor"></path>
                                                                <path d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#invoice-linearGradient-1)" opacity="0.2"></path>
                                                                <polygon fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                                                <polygon fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                                                <polygon fill="url(#invoice-linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                                <h3 class="text-primary invoice-logo"><?= $web['NamaWeb']; ?></h3>
                                                          </div>
                            <p class="card-text mb-25">KANTOR PUSAT</p>
                            <p class="card-text mb-25"><?= $web['Alamat'] ?></p>
                            <p class="card-text mb-0"><?= $web['Nomor'] ?></p>
                        </div>
                        
                        <div class="mt-md-0 mt-2">
                            <h4 class="invoice-title">
                                Faktur
                                <span class="invoice-number">#<?= $bill['kode_deposit'] ?></span>
                            </h4>
                            <div class="invoice-date-wrapper">
                                <p class="invoice-date-title">Tanggal:</p>
                                <p class="invoice-date"> <?= format_date('id',$bill['tanggal']) ?></p>
                            </div>
                            <div class="invoice-date-wrapper">
                                <p class="invoice-date-title">Status:</p>
                                <p class="invoice-date"> <b class=""><?= e($bill['status']) ?></b></p>
                            </div>
                        </div>
                    </div>
                    <!-- Header ends -->
                </div>
                
                <hr class="invoice-spacing">
                
                <!-- Address and Contact starts -->
                <div class="card-body invoice-padding pt-0">
                    <div class="row invoice-spacing">
                        <div class="col-xl-8 p-0">
                            <h6 class="mb-2">Ditagih ke:</h6>
                            <h6 class="mb-25"><?= e($_SESSION['user']['name']) ?></h6>
                            <p class="card-text mb-25"><?= e($_SESSION['user']['username']) ?></p>
                            <p class="card-text mb-25"><?= e($_SESSION['user']['phone']) ?></p>
                            <p class="card-text mb-0"><?= e($_SESSION['user']['email']) ?></p>
                        </div>
                        
                        <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                            <h6 class="mb-2">Payment Details:</h6>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="pr-1">Payment:</td>
                                        <td><?= e($bill['payment']) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="pr-1">Jumlah Transfer:</td>
                                        <td><span class="font-weight-bold">Rp <?= number_format($bill['jumlah_transfer']+$bill['acakin'],0,',','.') ?>,-</span></td>
                                    </tr>                                    
                                    <tr>
                                        <td class="pr-1">Tujuan Transfer:</td>
                                        <td><?= $bill['tujuan'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="pr-1">Nama Penerima:</td>
                                        <td><?= e($bill['an']) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
               
                
                <!-- Address and Contact ends -->
                
                <!-- Invoice Description starts -->
                <div class="table-responsive">
                    <table class="table" width="100%">
                        <thead>
                            <tr>
                                <th class="py-1">Metode Pembayaran</th>
                                <th class="py-1">Nomor Pengirim</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-1">
                                    <p class="card-text font-weight-bold mb-25"><?= e($bill['']) ?></p>
                                    <p class="card-text text-nowrap"><?= e($bill['payment']) ?></p>
                                </td>
                                <td class="py-1">
                                    <span class="font-weight-bold"><?= e($bill['nomor_pengirim']) ?></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="card-body invoice-padding pb-0">
                    <div class="row invoice-sales-total-wrapper">
                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                            <p class="card-text mb-0">
                                <span class="font-weight-bold">Sales:</span> <span class="ml-75"><?= config('web', 'title') ?> System</span>
                            </p>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                            <div class="invoice-total-wrapper">
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Nominal:</p>
                                    <p class="invoice-total-amount"><?= number_format($bill['jumlah_transfer'],0,',','.') ?></p>
                                </div>
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Tax:</p>
                                    <p class="invoice-total-amount"><?= number_format($bill['acakin'],0,',','.') ?></p>
                                </div>
                                <hr class="my-50">
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Total:</p>
                                    <p class="invoice-total-amount text-success"><?= number_format($bill['jumlah_transfer']+$bill['acakin'],0,',','.') ?></p>
                                </div>                               
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr class="invoice-spacing">
                
                <div class="card-body invoice-padding pt-0">
                    <div class="row">
                        <div class="col-12">
                            <span class="font-weight-bold">Note:</span>
                            <span>
                                Permintaan deposit harus dibayar pada hari yang sama dengan penerimaan faktur. Dibayar dengan bank, emoney, atau pulsa. Jika setoran tidak dibayarkan pada hari yang sama, permintaan akan dibatalkan secara otomatis oleh sistem.
                            </span>     
                        </div>
                    </div>
                </div>
                <!-- Invoice Description ends -->
            </div>
        </div>
       
        <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
            <div class="card">
                <div class="card-body">
                    <?php if ($bill['status'] == 'Pending') { ?>                    
                    <button class="btn btn-danger btn-block mb-75" onclick="modal('Cancel #<?= e(base64_decode($kode_deposit)) ?>','<?= base_url() ?>deposit/cancel','md')">Cancel</button>                                                            
                    <?php } ?>
                    <? if($bill['tid'] !== '') { ?>
                    <a href="https://tripay.co.id/checkout/<?= $bill['tid'] ?>" class="btn btn-primary text-white btn-block mb-75">Alihkan</a>
                    <? } ?>
                    <a class="btn btn-outline-warning btn-block mb-75" href="javascript:window.print()">
                        <i data-feather="printer"></i> Print</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php } ?>

<?php
	$cek_depo = $db->query("SELECT * FROM deposit WHERE username = '{$session}' AND status = 'Pending' AND provider IN ('QRIS') ORDER BY id DESC");
	while ($bill = $cek_depo->fetch_assoc()) {
					?>

<section class="invoice-preview-wrapper">
    <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-9 col-md-8 col-12">
            <div class="card invoice-preview-card">
                <div class="card-body invoice-padding pb-0">
                    <!-- Header starts -->
                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                        <div>
                            <div class="logo-wrapper">
                                <img src="<?= asset('/images/logo/favicon.ico') ?>" width="50px">
                                <p class="invoice-logo text-primary"></p>
                                                          </div>
                            <p class="card-text mb-25"><?= $web['Alamat'] ?></p>
                            <p class="card-text mb-0"><?= $web['Nomor'] ?></p>
                        </div>
                        
                        <div class="mt-md-0 mt-2">
                            <h4 class="invoice-title">
                                Faktur
                                <span class="invoice-number">#<?= $bill['kode_deposit'] ?></span>
                            </h4>
                            <div class="invoice-date-wrapper">
                                <p class="invoice-date-title">Tanggal:</p>
                                <p class="invoice-date"> <?= format_date('id',$bill['tanggal']) ?></p>
                            </div>
                            <div class="invoice-date-wrapper">
                                <p class="invoice-date-title">Status:</p>
                                <p class="invoice-date"> <b class="text-<?= $text_color ?>"><?= e($bill['status']) ?></b></p>
                            </div>
                        </div>
                    </div>
                    <!-- Header ends -->
                </div>
                
                <hr class="invoice-spacing">
                
                <!-- Address and Contact starts -->
                <div class="card-body invoice-padding pt-0">
                    <div class="row invoice-spacing">
                        <div class="col-xl-8 p-0">
                            <h6 class="mb-2">Ditagih ke:</h6>
                            <h6 class="mb-25"><?= e($_SESSION['user']['name']) ?></h6>
                            <p class="card-text mb-25"><?= e($_SESSION['user']['username']) ?></p>
                            <p class="card-text mb-25"><?= e($_SESSION['user']['phone']) ?></p>
                            <p class="card-text mb-0"><?= e($_SESSION['user']['email']) ?></p>
                        </div>
                        
                        <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                            <h6 class="mb-2">Payment Details:</h6>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="pr-1">Payment:</td>
                                        <td><?= e($bill['payment']) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="pr-1">Jumlah Transfer:</td>
                                        <td><span class="font-weight-bold">Rp <?= number_format($bill['jumlah_transfer'],0,',','.') ?>,-</span></td>
                                    </tr>
                                    <tr>
                                        <td class="pr-1">Acc. No Rek:</td>
                                        <td><?= e($bill['tujuan']) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="pr-1">Acc. A/N:</td>
                                        <td><?= e($bill['an']) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Address and Contact ends -->
                
                <!-- Invoice Description starts -->
                <div class="table-responsive">
                    <table class="table" width="100%">
                        <thead>
                            <tr>
                                <th class="py-1">Payment</th>
                                <th class="py-1">Pengirim</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-1">
                                    <p class="card-text font-weight-bold mb-25"><?= e($bill['']) ?></p>
                                    <p class="card-text text-nowrap"><?= e($bill['payment']) ?></p>
                                </td>
                                <td class="py-1">
                                    <span class="font-weight-bold"><?= e($bill['nomor_pengirim']) ?></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="card-body invoice-padding pb-0">
                    <div class="row invoice-sales-total-wrapper">
                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                            <p class="card-text mb-0">
                                <span class="font-weight-bold">Sales:</span> <span class="ml-75"><?= config('web', 'title') ?> System</span>
                            </p>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                            <div class="invoice-total-wrapper">
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Tax:</p>
                                    <p class="invoice-total-amount"><?= number_format($bill['acakin'],0,',','.') ?></p>
                                </div>
                                <hr class="my-50">
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Get:</p>
                                    <p class="invoice-total-amount"><?= number_format($bill['get_saldo']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr class="invoice-spacing">
                
                <div class="card-body invoice-padding pt-0">
                    <div class="row">
                        <div class="col-12">
                            <span class="font-weight-bold">Note:</span>
                            <span>
                                Permintaan deposit harus dibayar pada hari yang sama dengan penerimaan faktur. Dibayar dengan bank, emoney, atau pulsa. Jika setoran tidak dibayarkan pada hari yang sama, permintaan akan dibatalkan secara otomatis oleh sistem.
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Invoice Description ends -->
            </div>
        </div>
       
        <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
            <div class="card">
                <div class="card-body">
                    <?php if ($bill['status'] == 'Pending') { ?>
                    <button class="btn btn-danger btn-block mb-75" onclick="modal('Cancel #<?= e(base64_decode($kode_deposit)) ?>','<?= base_url() ?>deposit/cancel','md')">Cancel</button><button class="btn btn-outline-secondary btn-block mb-75" onclick="modal('QRIS #<?= e($kode_deposit) ?>','<?= base_url() ?>deposit/qris','md')">
                        Show QR
                    </button><?php } ?>
                    <a class="btn btn-outline-warning btn-block mb-75" href="javascript:window.print()">
                        <i data-feather="printer"></i> Print</a>
                                        </div>
            </div>
        </div>
    </div>
</section>

<?php } ?>

<div class="modal fade text-left" id="SModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" id="SModal-size" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="SModal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="SModal-body"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function modal(name, link, size) {
        var sizes = '';
        if (size == 'smaller' || size == 'xs') sizes = 'SModal-xs';
        if (size == 'small' || size == 'sm') sizes = 'SModal-sm';
        if (size == 'large' || size == 'lg') sizes = 'SModal-lg';
        if (size == 'larger' || size == 'xl') sizes = 'SModal-xl';

        $.ajax({
            type: "GET",
            url: link,
            beforeSend: function() {
                $('#SModal-body').html('Loading...');
            },
            success: function(result) {
                $('#SModal-body').html(result);
            },
            error: function() {
                $('#SModal-body').html('Failed to get contents...');
            }
        });

        $('#SModal-title').html(name);
        $('#SModal-size').removeClass('SModal-xs');
        $('#SModal-size').removeClass('SModal-sm');
        $('#SModal-size').removeClass('SModal-lg');
        $('#SModal-size').removeClass('SModal-xl');
        $('#SModal-size').addClass(sizes);
        $('#SModal').modal();
    }
</script>
<?php include_once '../layouts/footer.php';
    }
} ?>
