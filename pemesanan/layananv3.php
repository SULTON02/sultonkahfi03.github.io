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
    $chresult = postCurlWaApi("", $api_postdata);
    $json_result = json_decode($chresult, true);
    return $json_result;
}


if (isset($_POST['pesan'])) {

            $post_kategori = $conn->real_escape_string(trim(filter($_POST['kategori'])));
		    $post_layanan = $conn->real_escape_string(trim(filter($_POST['layanan'])));
		    $post_target = $conn->real_escape_string(trim(filter($_POST['target'])));
		    $post_jumlah = $conn->real_escape_string(trim(filter($_POST['jumlah'])));
		    $post_pin = $conn->real_escape_string(trim(filter($_POST['pin'])));
		    $post_comments = $_POST['comments'];
		    $post_link = $conn->real_escape_string(trim(filter($_POST['cuslink'])));

		    $cek_rate = $conn->query("SELECT * FROM setting_rate WHERE tipe = 'Sosial Media'");
		    $data_rate = mysqli_fetch_assoc($cek_rate);

		    $cek_layanan = $conn->query("SELECT * FROM layanan_sosmed WHERE service_id = '$post_layanan' AND status = 'Aktif'");
		    $data_layanan = mysqli_fetch_assoc($cek_layanan);

	    	    $cek_pesanan = $conn->query("SELECT * FROM pembelian_sosmed WHERE target = '$post_target' AND status = 'Pending'");
		    $data_pesanan = mysqli_fetch_assoc($cek_pesanan);

	            $cek_rate_koin = $conn->query("SELECT * FROM setting_koin_didapat WHERE status = 'Aktif'");
		    $data_rate_koin = mysqli_fetch_assoc($cek_rate_koin);

		    $kategori = $data_layanan['kategori'];
		    $layanan = $data_layanan['layanan'];
		    $cek_harga = $data_layanan['harga'] / 1000;
		    $cek_profit = $data_rate['rate'] / 1000;
		    $hitung = count(explode(PHP_EOL, $post_comments));
	            $replace = str_replace("\r\n",'\r\n', $post_comments);
	            if (!empty($post_comments)) {
			    $post_jumlah = $hitung;
		    } else {
		    	    $post_jumlah = $post_jumlah;
		    }
		    if (!empty($post_comments)) {
		    	    $harga = $cek_harga*$hitung;
			    $profit = $cek_profit*$hitung;
		    } else {
			    $harga = $cek_harga*$post_jumlah;
			    $profit = $cek_profit*$post_jumlah;
		    }
		    $order_id = acak_nomor(3).acak_nomor(4);
		    $provider = $data_layanan['provider'];
		    $koin = $harga * $data_rate_koin['rate'];

		    $cek_provider = $conn->query("SELECT * FROM provider WHERE code = '$provider'");
		    $data_provider = mysqli_fetch_assoc($cek_provider);
		    
		    $url = $data_provider['https://lollipop-smm.com/api/services'];


    //Get Start Count
   if ($data_layanan['kategori'] == "Instagram Likes" and "Instagram Likes Indonesia" and "Instagram Likes [Targeted Negara]" and "Instagram Likes/Followers Per Minute") {
        $start_count = likes_count($post_target);
    } elseif ($data_layanan['kategori'] == "Instagram Followers No Refill/Not Guaranteed" and "Instagram Followers Indonesia" and "Instagram Followers [Negara]" and "Instagram Followers [Refill] [Guaranteed] [NonDrop]") {
        $start_count = followers_count($post_target);
    } elseif ($data_layanan['kategori'] == "Instagram Views") {
        $start_count = views_count($post_target);
    } else {
        $start_count = 0;
    }

    $cek_pin = $db->query("SELECT * FROM users WHERE pin = '{$post_pin}' AND username = '{$session}'");
    $data_pin = mysqli_fetch_assoc($cek_pin);

    if (!$post_target || !$post_layanan || !$post_kategori || !$post_pin) {
        $_SESSION['alert'] = ['danger', 'Failed!', 'There is still a blank form.'];
    } elseif ($_SESSION['user']['level'] == 'Lock') {
        $_SESSION['alert'] = ['danger', 'Failed!', 'your account has been locked.'];
    } elseif (mysqli_num_rows($cek_pin) == 0) {
        $_SESSION['alert'] = ['danger', 'Failed!', 'PIN transaksi anda salah.'];
    } elseif (mysqli_num_rows($cek_layanan) == 0) {
        $_SESSION['alert'] = ['danger', 'Failed!', 'Layanan tidak tersedia.'];
    } elseif (mysqli_num_rows($cek_provider) == 0) {
        $_SESSION['alert'] = ['danger', 'Failed!', 'Server sedang maintenance.'];
    } elseif ($post_jumlah < $data_layanan['min']) {
        $_SESSION['alert'] = ['danger', 'Failed!', 'Min ' . $data_layanan['min'] . '.'];
    } elseif ($post_jumlah > $data_layanan['max']) {
        $_SESSION['alert'] = ['danger', 'Failed!', 'Max ' . $data_layanan['max'] . '.'];
    } elseif ($data_user['saldo'] < $harga) {
        $_SESSION['alert'] = ['danger', 'Failed!', 'Saldo anda tidak mencukupi.'];
    } elseif (mysqli_num_rows($cek_pesanan) == 5) {
        $_SESSION['alert'] = ['danger', 'Failed!', 'Pesanan masih ada yang berstatus pending.'];
    } else {
        if ($provider == "MANUAL") {
            $random_number = random_number(6);
            if ($db->query("INSERT INTO pembelian_sosmed VALUES ('','{$order_id}', '{$random_number}', '{$session}', '{$data_layanan['layanan']}', '{$exTarget}', '-', '{$post_jumlah}', '0', '{$start_count}', '{$harga}', '0', '{$pp1k}', 'Pending', '{$tanggal}', '-', '{$provider}', 'Website', 'no')") == true) {
                $db->query("UPDATE users SET saldo = saldo-{$harga}, pemakaian = pemakaian+{$harga} WHERE username = '{$session}'");
                $db->query("INSERT INTO history_saldo VALUES('', '{$session}', '-', '{$harga}', 'Order social media :: ({$order_id})', '{$tanggal}')");
            }
            $provider_oid = $random_number;
            $result_api = true;
        } elseif ($provider == $q['code']) {
            // PROVIDER 2
            $exService = $data_layanan['provider_id'];
            $exData = $post_target;
            $exQuantity = $post_jumlah;
            $exCC = '';
            $post_api = [
                'api_id' => $q['3770'],
                'api_key' => $q['7be3ea-5ded21-fc764e-2380de-9dee31'],
                'service' => $exService,
                'target' => $exData,
                'quantity' => $exQuantity,
            ];
            if (!empty($post_comments)) {
                $exCC = $post_comments;
                $post_api['custom_comments'] = $exCC;
            }
            $curl = post_curl($q['https://lollipop-smm.com/api/services'], $post_api);
            $result = json_decode($curl, true);
            if (isset($result['status']) and $result['status'] == true) {
                $provider_oid = $result['data']['id'];
                $result_api = true;
            }
        } else {
            $_SESSION['alert'] = ['danger', 'Failed!', '' . $result['data'] . ''];
        }
        //print_r($result);
        if (!$result_api && empty($provider_oid)) {
            $_SESSION['alert'] = ['danger', 'Failed!', 'Layanan sedang tidak tersedia. ' . $result['data']['msg'] . ''];
        } else {
            if ($db->query("INSERT INTO pembelian_sosmed VALUES ('','{$order_id}', '{$provider_oid}', '{$session}', '{$data_layanan['layanan']}', '{$exTarget}', '{$exCC}', '{$post_jumlah}', '{$post_jumlah}', '{$start_count}', '{$harga}', '0', '{$pp1k}', '{$status_refill}', 'Pending', '{$tanggal}', '{$tanggal}', '{$provider}', 'Website', '0')") == true) {

                $db->query("UPDATE users SET saldo = saldo-{$harga}, pemakaian = pemakaian+{$harga} WHERE username = '{$session}'");

                $db->query("INSERT INTO history_saldo VALUES('', '{$session}', 'Pengurangan Saldo', '{$harga}', 'Order :: ({$order_id})', '{$tanggal}')");
                $_SESSION['alert'] = ['success', 'RESPOND : ORDER BERHASIL ✓', 'ORDER ID : ' . $order_id . ' | HARGA : ' . $harga . ' | JUMLAH : ' . $post_jumlah . ' | DATE : ' . $tanggal . ''];
                // Wa Message Api
                $api_key = "";
                $tujuan = $data_pin['phone'];
                $isititle = "RAJAPANELL SMM PANEL";
                $isipesan = "♥️INFORMASI ORDER♥️\n\n👉ID PEMESANAN : $order_id\n👉HARGA : $harga\n👉JUMLAH : $post_jumlah\n👉Target : $post_target\n👉ORDER DATE : $tanggal\n\n♥️CEK STATUS ORDERAN 👇\nhttps://rajapanell.com/pemesanan/riwayat\n\nTERIMA KASIH\nSalam Hormat: RAJAPANELL.COM";
                $isifooter = "Footer";
                sendMessage($api_key, $tujuan, $isititle, $isipesan);
            } else {
                $_SESSION['alert'] = ['danger', 'Failed!', '404.'];
            }
        }

        //$id = $_GET['id'];
        //$query = mysqli_query($db, "SELECT * FROM users WHERE id = '$id'");
        //$q = mysqli_fetch_assoc($query); 
        //$nohp = $q['phone'];
    }
}


include_once '../layouts/header.php';
?>

<!--library select2-->

<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<!---->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body border-bottom" style="padding-bottom: 0.5rem;">
                <div class="row">
                    <div class="col-6 col-lg-4 col-xl-3 d-grid">
                        <button type="button" class="btn btn-outline-primary btn-sm d-block text-nowrap mb-1 waves-effect" onclick="filterCategory('All');">
                            <span class="d-flex align-items-center"><i class="fas fa-adjust fs-4"></i><span style="margin-left: 8px; margin-top: 1px;">Semua</span></span>
                        </button>
                    </div>
                    <div class="col-6 col-lg-4 col-xl-3 d-grid">
                        <button type="button" class="btn btn-outline-primary btn-sm d-block text-nowrap mb-1 waves-effect" onclick="filterCategory('Instagram');">
                            <span class="d-flex align-items-center"><i class="fab fa-instagram fs-4"></i><span style="margin-left: 8px; margin-top: 1px;">Instagram</span></span>
                        </button>
                    </div>
                    <div class="col-6 col-lg-4 col-xl-3 d-grid">
                        <button type="button" class="btn btn-outline-primary btn-sm d-block text-nowrap mb-1 waves-effect" onclick="filterCategory('Facebook');">
                            <span class="d-flex align-items-center"><i class="fab fa-facebook fs-4"></i><span style="margin-left: 8px; margin-top: 1px;">Facebook</span></span>
                        </button>
                    </div>
                    <div class="col-6 col-lg-4 col-xl-3 d-grid">
                        <button type="button" class="btn btn-outline-primary btn-sm d-block text-nowrap mb-1 waves-effect" onclick="filterCategory('Twitter');">
                            <span class="d-flex align-items-center"><i class="fab fa-twitter fs-4"></i><span style="margin-left: 8px; margin-top: 1px;">Twitter</span></span>
                        </button>
                    </div>
                    <div class="col-6 col-lg-4 col-xl-3 d-grid">
                        <button type="button" class="btn btn-outline-primary btn-sm d-block text-nowrap mb-1 waves-effect" onclick="filterCategory('TikTok');">
                            <span class="d-flex align-items-center"><i class="fas fa-music fs-4"></i><span style="margin-left: 8px; margin-top: 1px;">Tiktok</span></span>
                        </button>
                    </div>
                    <div class="col-6 col-lg-4 col-xl-3 d-grid">
                        <button type="button" class="btn btn-outline-primary btn-sm d-block text-nowrap mb-1 waves-effect" onclick="filterCategory('Spotify');">
                            <span class="d-flex align-items-center"><i class="fab fa-spotify fs-4"></i><span style="margin-left: 8px; margin-top: 1px;">Spotify</span></span>
                        </button>
                    </div>
                    <div class="col-6 col-lg-4 col-xl-3 d-grid">
                        <button type="button" class="btn btn-outline-primary btn-sm d-block text-nowrap mb-1 waves-effect" onclick="filterCategory('Google');">
                            <span class="d-flex align-items-center"><i class="fab fa-google fs-4"></i><span style="margin-left: 8px; margin-top: 1px;">Google</span></span>
                        </button>
                    </div>
                    <div class="col-6 col-lg-4 col-xl-3 d-grid">
                        <button type="button" class="btn btn-outline-primary btn-sm d-block text-nowrap mb-1 waves-effect" onclick="filterCategory('Telegram');">
                            <span class="d-flex align-items-center"><i class="fab fa-telegram fs-4"></i><span style="margin-left: 8px; margin-top: 1px;">Telegram</span></span>
                        </button>
                    </div>
                    <div class="col-6 col-lg-4 col-xl-3 d-grid">
                        <button type="button" class="btn btn-outline-primary btn-sm d-block text-nowrap mb-1 waves-effect" onclick="filterCategory('Discord');">
                            <span class="d-flex align-items-center"><i class="fab fa-discord fs-4"></i><span style="margin-left: 8px; margin-top: 1px;">Discord</span></span>
                        </button>
                    </div>
                    <div class="col-6 col-lg-4 col-xl-3 d-grid">
                        <button type="button" class="btn btn-outline-primary btn-sm d-block text-nowrap mb-1 waves-effect" onclick="filterCategory('Twitch');">
                            <span class="d-flex align-items-center"><i class="fab fa-twitch fs-4"></i><span style="margin-left: 8px; margin-top: 1px;">Twitch</span></span>
                        </button>
                    </div>
                    <div class="col-6 col-lg-4 col-xl-3 d-grid">
                        <button type="button" class="btn btn-outline-primary btn-sm d-block text-nowrap mb-1 waves-effect" onclick="filterCategory('Website Traffic');">
                            <span class="d-flex align-items-center"><i class="fas fa-globe fs-4"></i><span style="margin-left: 8px; margin-top: 1px;">Web Traffic</span></span>
                        </button>
                    </div>
                    <div class="col-6 col-lg-4 col-xl-3 d-grid">
                        <button type="button" class="btn btn-outline-primary btn-sm d-block text-nowrap mb-1 waves-effect" onclick="filterCategory('Youtube');">
                            <span class="d-flex align-items-center"><i class="fab fa-youtube fs-4"></i><span style="margin-left: 8px; margin-top: 1px;">Youtube</span></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="m-t-0 text-center header-title"><i class="fas fa-cart-plus"></i><b> Pesanan Baru</b></h4>
                <form class="form-horizontal" method="POST">
                    <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>" />

                    <div class="form-group">
                        <label class="col-md-12 control-label">Kategori</label>
                        <div class="col-md-12">
                            <select class="form-control" id="kategori" name="kategori">
                                <option value="">Pilih Kategori...</option>
                                <?php
                                $cek_kategori = $db->query("SELECT * FROM kategori_layanan3 ORDER BY nama ASC");
                                while ($data_kategori = $cek_kategori->fetch_assoc()) { ?>
                                    <option value="<?php echo $data_kategori['kode']; ?>"><?php echo $data_kategori['nama']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>layanan *  <a href="../halaman/web_panel">Apakah Anda Ingin Memiliki Website Panel Sendiri ?</a></label>
                        <div class="col-md-12">
                            <select class="form-control" name="layanan" id="layanan" onchange="tampilkan_field()">
                                <option value="0">Pilih Layanan...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div id="catatan"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Target * Penjelasan Target <a href="../halaman/contoh_target">Klik Disini</a></label>
                        <div class="col-md-12">
                            <input type="text" name="target" class="form-control" placeholder="" required />
                        </div>
                    </div>
                    <div id="show1" style="display: none;">
                        <div class="form-group">
                            <label class="col-md-12 control-label">Jumlah Pesanan</label>
                            <div class="col-md-12">
                                <input type="number" name="jumlah" class="form-control" placeholder="" required onkeyup="get_total(this.value).value;" />
                            </div>
                        </div>
                        <input type="hidden" id="rate" value="0" />
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="form-label">Total Harga</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control" id="total" disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="show2" style="display: none;">
                        <div class="form-group">
                            <label class="col-md-12 control-label">Comment</label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="comments" id="comments" placeholder="Pisahkan Tiap Baris komentar dengan enter"></textarea>
                            </div>
                        </div>
                        <input type="hidden" id="rate" value="0" />
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="form-label">Total Harga</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control" id="totalxx" disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="form-label">PIN Transaksi</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather="key"></i></span>
                                </div>
                                <input type="password" class="form-control" name="pin" onkeyup="this.value=this.value.replace(/[^\d]+/g,'')" placeholder="" minlength="1" maxlength="2" data-validation-required-message="This pin field is required" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <button type="reset" class="btn btn-relief-danger"><i class="fas fa-sync-alt"></i> Ulangi</button>
                        <button type="submit" class="btn btn-relief-primary" name="pesan"><i class="fas fa-cart-plus"></i> <b>Pesan</b></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
          <div class="component_content_card component_content_button">
            <div class="card">
                                            <div class="new-order__content-title">
                  <div class="position-relative">
                                          <h4 class="text-center"><span style="color: rgba(231, 22, 22, 1)"><span style="text-align: CENTER"><u style="text-decoration: underline"><strong style="font-weight: bold">RULES&nbsp; - WAJIB BACA !!!</strong></u></span></span></h4>
                                      </div>
                </div>
                            <div class="new-order__content-text">
                                  <p>1. Pastikan Anda menginput link yang benar sesuai format yang ada di&nbsp;<strong style="font-weight: bold">keterangan</strong>, karena kami tidak bisa <strong style="font-weight: bold">membatalkan pesanan</strong>.</p>
<p>2.<strong style="font-weight: bold"> Jangan&nbsp;</strong>menggunakan <strong style="font-weight: bold">lebih dari satu layanan sekaligus</strong> untuk username/link yang sama. Harap tunggu status&nbsp;completed&nbsp;pada orderan sebelumnya baru melakukan orderan kepada username/ link yang sama. Hal ini&nbsp;<strong style="font-weight: bold">tidak akan membantu mempercepat orderan&nbsp;</strong>Anda karena kedua orderan bisa jadi berstatus completed tetapi hanya tercapai target dari salah satu orderan dan&nbsp;<strong style="font-weight: bold">tidak ada pengembalian dana</strong>.</p>
<p>3. Setelah order dimasukan, jika username/link yang diinput tidak ditemukan (<span style="color: rgba(231, 22, 22, 1)"><strong style="font-weight: bold">diganti/diprivate/dihapus</strong></span>), orderan akan otomatis menjadi <span style="color: rgba(10, 230, 55, 1)"><strong style="font-weight: bold">completed </strong></span>dan <strong style="font-weight: bold">tidak ada pengembalian dana</strong>.</p>
<p>4. Kesalahan pembeli, bukan tanggung jawab admin, karena panel ini serba otomatis, jadi hati-hati dan perhatikan link sebelum order dan&nbsp;<strong style="font-weight: bold">tidak ada pengembalian dana</strong>!</p>
<p>5. Jika Orderan statusnya&nbsp;<span style="color: rgba(231, 22, 22, 1)"><strong style="font-weight: bold">partial&nbsp;&amp;&nbsp;canceled</strong></span>, <strong style="font-weight: bold">saldo otomatis di refund</strong> dan bisa order ulang!</p>
<p>6. Jumlah maks&nbsp;menunjukkan kapasitas layanan tersebut untuk satu target (akun/link) bukan menunjukkan kapasitas maks sekali order. Apabila Anda telah menggunakan semua kapasitas maks layanan,<strong style="font-weight: bold">&nbsp;Anda tidak bisa menggunakan layanan itu lagi</strong>&nbsp;dan harus menggunakan layanan yang lain. Oleh karenannya kami menyediakan banyak layanan dengan kapasitas maks yang lebih besar.</p>
<p>7. <strong style="font-weight: bold">Informasi</strong> yang terdapat pada <strong style="font-weight: bold">kolom keterangan</strong> (speed, drop rate) <strong style="font-weight: bold">bersifat estimasi</strong>&nbsp;untuk membedakan layanan yang satu dan lainnya. Informasi bisa jadi tidak akurat tergantung dari performa server dan jumlah orderan yang masuk pada server tersebut. Anda dapat <strong style="font-weight: bold">report setelah 24 jam orderan dikirim</strong>.</p>
<p>8. Dengan melakukan orderan Anda dianggap sudah memahami dan setuju Syarat dan Ketentuan&nbsp;RajaPanell.</p>
<p><br></p>
<h4 class="text-center"><span style="text-align: CENTER"><u style="text-decoration: underline"><strong style="font-weight: bold">KETENTUAN </strong></u></span><span style="color: rgba(1, 227, 68, 1)"><span style="text-align: CENTER"><u style="text-decoration: underline"><strong style="font-weight: bold">SPEED UP</strong></u></span></span></h4>
<p><br></p>
<p>1. Definisi speedup adalah proses boost up layanan yang stuck orderannya&nbsp; / belum jalan sama sekali setelah lebih dari 24 jam. Speed up 24 jam tidak berlaku untuk layanan yang ada tulisan <strong style="font-weight: bold">SLOW</strong> pada nama layananya atau pada harga layanan kolom speed memang lambat prosesnya.</p>
<p>2. Apabila sudah melewati estimasi waktu speed layanan yang tertera pada halaman <a target="_self" href="https://rajapanell.com/halaman/price_list"><strong style="font-weight: bold">Daftar Layanan</strong></a><a target="_self" href="https://rajapanell.com/halaman/price_list"> </a>dan orderan masih pending / in progress / processing, silahkan request speedup dengan melaporkan order ID kepada CS.&nbsp;</p>
<p>3. Request speed up nantinya akan di proses dalam waktu 1x24 jam.</p>
<p>Batas maksimal request speed up adalah 1x dalam 1 hari untuk satu order id yang sama.</p>
<p>4. Jika dalam 1x24 jam status orderan masih belum completed, silahkan lakukan request speed up untuk yang kedua kalinya. Kemudian tunggu hingga 1x24 jam.</p>
<p><br></p>
<p><strong style="font-weight: bold">NOTE :</strong></p>
<p>Kami hanya menerima request, bukan memantau status orderan belum completed secara berkala.</p>
<p><br></p>
<h4 class="text-center"><span style="text-align: CENTER"><u style="text-decoration: underline"><strong style="font-weight: bold">KETENTUAN </strong></u></span><span style="color: rgba(23, 110, 253, 1)"><span style="text-align: CENTER"><u style="text-decoration: underline"><strong style="font-weight: bold">REFILL</strong></u></span></span></h4>
<p><br></p>
<p>1. Definisi refill adalah proses pengisian ulang layanan (followers / view /lainnya) yang mengalami drop parah (lebih dari 30%) <strong style="font-weight: bold">sejak orderan statusnya completed</strong>. Status partial, tidak dapat di refill.</p>
<p>2. <strong style="font-weight: bold">Refill</strong> hanya berlaku untuk layanan yang memberikan garansi refill. Setiap layanan memberikan masa garansi berbeda-beda (<strong style="font-weight: bold">silahkan lihat dibagian keterangan layanan</strong>).</p>
<p>3. <strong style="font-weight: bold">Refill tidak berlaku</strong> apabila jumlah followers / views / subscribers dll saat ini berada dibawah start count.</p>
<p>4. <strong style="font-weight: bold">Refill tidak berlaku</strong> apabila status orderan Anda partial.</p>
<p>5. Untuk klaim garansi refill ada 2 cara, yaitu pertama, ada yang langsung menggunakan <strong style="font-weight: bold">tombol refill di riwayat order</strong>, kedua, <strong style="font-weight: bold">refill manual</strong> silahkan laporkan order id kepada CS melalui Tiket atau WhatsApp.</p>
<p>6. Pastikan akun tidak di private, jika private refill tidak dapat diproses.</p>
<p>7. Proses refill bisa memakan waktu 1x24 jam atau lebih tergantung jenis layanan.</p>
<p>8. Jika refill belum masuk, silahkan follow up kembali ke CS. Batas maksimal request refill adalah 1x dalam 1 hari untuk satu order id yang sama.</p>
<p>9. Jika tidak ada follow up dari member setelah 1x24 jam sejak request refill kepada CS, maka kami menganggap bahwa request refill sudah masuk.</p>
<p>10. Selama proses refill belum selesai, tidak diperbolehkan untuk order ulang ke link yang sama atau<strong style="font-weight: bold"> garansi hangus</strong>.</p>
<p><br></p>
<p><strong style="font-weight: bold">NOTE :</strong></p>
<p>Akun private = tidak bisa refill</p>
<p>Akun diubah usernamenya = tidak bisa refill</p>
<p>Request Refill tidak dapat dilakukan jika waktu masa garansi telah habis. Sehingga komplain refill setelah expired tidak diterima. Kami hanya menerima request, bukan memantau jumlah refill sudah terpenuhi atau belum secara berkala.</p>
                              </div>
                          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#kategori").change(function() {
            var kategori = $("#kategori").val();
            $.ajax({
                url: '<?= base_url() ?>/ajax/layanan_sosmed3.php',
                data: 'kategori=' + kategori,
                type: 'POST',
                dataType: 'html',
                success: function(msg) {
                    $("#layanan").html(msg);
                }
            });
        });
        $("#layanan").change(function() {
            var layanan = $("#layanan").val();
            $.ajax({
                url: '<?= base_url() ?>/ajax/catatan_sosmed3.php',
                data: 'layanan=' + layanan,
                type: 'POST',
                dataType: 'html',
                success: function(msg) {
                    $("#catatan").html(msg);
                }
            });
            $.ajax({
                url: '<?= base_url() ?>/ajax/rate_sosmed3.php',
                data: 'layanan=' + layanan,
                type: 'POST',
                dataType: 'html',
                success: function(msg) {
                    $("#rate").val(msg);
                }
            });
        });
    });

    function tampilkan_field() {
        var selectedCountry = $("#layanan option:selected").text();
        if (selectedCountry.indexOf('Custom') !== -1 || selectedCountry.indexOf('CUSTOM') !== -1) {
            document.getElementById("show2").style.display = "block";
            document.getElementById("show1").style.display = "none";
        } else {
            document.getElementById("show2").style.display = "none";
            document.getElementById("show1").style.display = "block";
        }
    }
    $(document).ready(function() {
        $("#comments").on("keypress", function(a) {
            if (a.which == 13) {
                var baris = $("#comments").val().split(/\r|\r\n|\n/).length;
                var rates = $("#rate").val();
                var calc = eval(baris) * rates;
                console.log(calc)
                $('#totalxx').val(calc);
            }
        });

    });

    function get_total(quantity) {
        var rate = $("#rate").val();
        var result = eval(quantity) * rate;
        $('#total').val(result);
    }

    function filterCategory(category) {
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>/ajax/kategori_sosmed3.php",
            data: "category=" + category,
            dataType: "html",
            success: function(msg) {
                $('#kategori').html(msg);
                $('#layanan').html('<option value="0">Pilih Kategori Terlebih Dahulu</option>');
            },
            error: function() {
                $('#ajax-result').html('<font color="red">Terjadi kesalahan! Silahkan refresh halaman.</font>');
            }
        });
    }
</script>

<!--codingan untuk select2-->
<script>
    $(document).ready(function() {
        $('#kategori').select2();
    });

    $(document).ready(function() {
        $('#layanan').select2();
    });
</script>
<!---->

<?php
include_once '../layouts/footer.php';
?>