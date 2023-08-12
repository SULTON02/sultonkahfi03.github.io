<?php
session_start();
require_once '../mainconfig.php';
load('middleware', 'user');

if (isset($_POST['kirim'])) {
    $post_tipe = $db->real_escape_string(e(@$_POST['tipe']));
    $post_pesan = $db->real_escape_string(e(@$_POST['pesan']));

    if (!$post_tipe || !$post_pesan) {
        $_SESSION['alert'] = ['danger', 'Failed!', 'Masih ada input kosong.'];
    } elseif (strlen($post_pesan) > 500) {
        $_SESSION['alert'] = ['danger', 'Failed!', 'Maksimal pesan 500 Karakter.'];
    } else {
        $date = date('Y-m-d H:i:s');
        
        $insert_tiket = $db->query("INSERT INTO tiket VALUES ('', '{$session}', '{$post_tipe}', '{$post_pesan}', '{$date}', '{$date}', '0', '1', 'Waiting')");
        if ($insert_tiket == true) {
            $_SESSION['alert'] = ['success', 'Success!', 'Ticket successfully send.'];
            exit(header("Location: ".base_url('/ticket/new')));
        } else {
            $_SESSION['alert'] = ['danger', 'Failed!', 'System is busy, please try again later.'];
            exit(header("Location: ".base_url('/ticket/new')));
        }
    }
}

include_once '../layouts/header.php'; ?>
<section id="basic-vertical-layouts">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body border-bottom">
                    <h4 class="card-title"><i class="far fa-comments me-1"></i> Tiket Baru</h4>
                    <form method="POST">
                        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>" />
                        <div class="mb-1">
                            <label class="form-control-label">Tipe <span class="text-danger">*</span></label>
                            <select class="form-control" name="tipe">
                                <option value="Pesanan">Pesanan</option>
                                <option value="Deposit">Deposit</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label class="form-control-label">Pesan <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="pesan" rows="5"></textarea>
                        </div>
                        <div class="mb-0 text-right">
                            <button type="submit" name="kirim" class="btn btn-relief-primary float-end"><i class="far fa-comments me-1"></i> Kirim</button>                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><i class="fas fa-info-circle me-1"></i> Informasi</h4>
                    <strong>Cara Membuat Tiket Baru :</strong>
                    <ul>
                        <li>Pilih <em>Tipe Tiket</em> (Pesanan, Deposit, Lainnya).</li>
                        <li>Kami akan segera merespon tiket Anda.</li>
                    </ul>
                    <strong>Penting !</strong>
                    <ul>
                        <li>Kami berhak menghapus atau memblokir akun Anda apabila terbukti melakukan tindakan pelanggaran pada Tiket.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once '../layouts/footer.php'; ?>