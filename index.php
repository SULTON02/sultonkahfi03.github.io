
<?php
session_start();
require_once 'mainconfig.php';
require_once 'autocron/on_depo.php';

if (!isset($_SESSION['user'])) {    
header("Location: ".base_url('/home'));
} else { 

// MENAMPILKAN DOUGNUT
$data_success = mysqli_num_rows($db->query("SELECT * FROM pembelian_sosmed WHERE user = '{$session}' AND status = 'Success'"));
$data_pending = mysqli_num_rows($db->query("SELECT * FROM pembelian_sosmed WHERE user = '{$session}' AND status = 'Pending'"));
$data_error = mysqli_num_rows($db->query("SELECT * FROM pembelian_sosmed WHERE user = '{$session}' AND status = 'Error'"));
// END TO DATA

function berita($s) {
    if ($s === "info") {
        return '<div class="text-info">INFO</div>';
    } else if ($s === "news") {
        return '<div class="text-success">NEWS</div>';
    } else if ($s === "update") {
        return '<div class="text-warning">UPDATE</div>';
    } else {
        return '<div class="text-danger">MAINTENANCE</div>';
    }
}
}
$check_null = mysqli_query($db, "SELECT * FROM information");
$data_null = mysqli_fetch_assoc($check_null);
include_once 'layouts/header.php'; ?>
<!DOCTYPE html>
<html>
<head>
<style>
.floatwa {
position:fixed;
bottom:0px;
right: 0px;
background-color:#ffffff;
width:100%;
z-index:1000;
padding:2px;
margin:auto;
text-align:center;
float:none;
box-shadow: 0px -2px 10px #c0c0c0;
}
.tombolwa {
border: 1px #56aa71 solid;
background-color:#2f7e49;
width:90%;
padding:4px;
text-align:center;
margin:0;
border-radius: 5px;
margin:auto;
text-align:center;
float:none;
}
.floatwa a{
color:white;
}
</style>
<div class="floatwa">
<a href="" target="_blank"><div class="tombolwa"><?= $web['NamaWeb']; ?></div></a></div>

<!-- Stats Horizontal Card -->
  <marquee behavior="scroll" direction="left">
    <img src="/assets/images/logo/logojalan2.png" width="120" height="80" alt="Natural" />
  
    <img src="https://i.postimg.cc/K4XJVLpw/20220605-033625.png" width="120" height="80" alt="Natural" />
    <img src="https://i.postimg.cc/JnNNngp6/20220605-034542.png" width="120" height="80" alt="Natural" />
    <img src="https://i.postimg.cc/KcQTHtwM/20220605-034523.png" width="120" height="80" alt="Natural" />
    <img src="https://i.postimg.cc/W4Rqk8FQ/20220605-034506.png" width="120" height="80" alt="Natural" />
    <img src="https://i.postimg.cc/2yXV87N9/20220605-034446.png" width="120" height="80" alt="Natural" />
    <img src="https://i.postimg.cc/rFKDZ35B/20220605-034430.png" width="120" height="80" alt="Natural" />
    <img src="https://i.postimg.cc/zX6Vs7jV/20220605-034413.png" width="120" height="80" alt="Natural" />
  </marquee><br></br>

  
    <div class="row">
        <div class="col-12">
            <div class="card card-congratulation-medal">
                <div class="card-body row">
                    <div class="col-9">
                        <h3 class="text-primary mb-0">
                            <b><?= $data_user['level']; ?></b>
                        </h3>
                        <p class="card-text font-small-2 mb-2"><b>CURRENT LEVEL</b></p>
                        <?php if ($data_user['level'] == 'Member') { ?>
                        <button onclick="location.href='<?= base_url('/account/upgrade_akun') ?>'" type="button" class="btn btn-primary benefit_account"><b>Upgrade Akun</b></button>
                        <?php } ?>
                        <?php if ($data_user['level'] !== 'Member') { ?>
                        <button class="btn btn-primary benefit_account"><b>Akun Premium</b></button>
                        <?php } ?>
                    </div>
                    <div class="col-3">
                        <img src="<?= asset('/images/icons/bronze.svg') ?>" class="congratulation-medal" alt="BRONZE" />
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-6 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="font-weight-bolder mb-0">Rp. <?= number_format($deposit['total'],0,',','.'); ?></h2>
                        <p class="card-text">
                            <?php echo $count_deposit; ?>
                            Deposit Selesai
                        </p>
                    </div>
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="credit-card" class="font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card shadow border-0 mb-3" style="max-height: 400px; overflow: auto;">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <?php
                    $check_data = mysqli_query($db, "SELECT * FROM information ORDER BY id DESC LIMIT 5");
                    while($data_berita = mysqli_fetch_assoc($check_data)) : ?>
                            <h6 class="font-weight-small">
                                <u style="font-weight: 800;" class=""><?= berita($data_berita['tipe']); ?></u>
                            </h6>
                            <div class="col-auto pl-0">
                                <p class="small text-mute text-trucated mb-1"><?= format_date('id',$data_berita['tanggal']); ?></p>
                            </div>
                            <p class="small"><?= html_entity_decode($data_berita['content']); ?></p>
                            <hr />
                            <?php endwhile; ?>
                            <?php if (mysqli_num_rows($check_null) == 0) : ?>
                            <h6 class="font-weight-small"><u style="font-weight: 800;" class="text-danger">SYSTEM</u></h6>
                            <div class="col-auto pl-0">
                                <p class="small text-mute text-trucated mb-1"><?= format_date('id',date('Y-m-d H:i:s')); ?></p>
                            </div>
                            <p class="small">Tidak Ada Informasi.</p>
                            <hr />
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if ($data_user['read_news'] == '0') { ?>
<div class="modal fade text-left" id="info_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-bullhorn me-1"></i>Informasi Terbaru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow: auto;">
                <div class="row">
                    <?php
                    $check_data = mysqli_query($db, "SELECT * FROM information ORDER BY id DESC");
                    while($data_berita = mysqli_fetch_assoc($check_data)) : ?>
                    <div class="col-md-12">
                        <div class="alert alert-info" role="alert">
                            <div class="alert-body">
                                <h5 class="text-info mb-1">
                                    <strong>
                                        <i class="fas fa-info-circle"></i>
                                        <?= $data_berita['tipe']; ?>
                                    </strong>
                                    <span class="text-secondary mb-1 float-end">
                                        <small><?= format_date('id',$data_berita['tanggal']); ?></small>
                                    </span>
                                </h5>
                                <p class="text-secondary mb-1">
                                    <strong>
                                        <em><?= html_entity_decode($data_berita['content']); ?></em>
                                    </strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php if (mysqli_num_rows($check_null) == 0) : ?>
                    <div class="col-md-12">
                        <div class="alert alert-info" role="alert">
                            <div class="alert-body">
                                <h5 class="text-danger mb-1">
                                    <strong> SYSTEM</strong>
                                    <span class="text-secondary mb-1 float-end">
                                        <small><?= format_date('id',date('Y-m-d H:i:s')); ?></small>
                                    </span>
                                </h5>
                                <p class="text-secondary mb-1">
                                    <strong><em>Information not available. </em></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary waves-effect waves-float waves-light float-right" data-bs-dismiss="modal" onclick="read_popup();"><i class="fas fa-thumbs-up me-1"></i>Sudah membaca</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!DOCTYPE html>
<html>
<head>
<a href="https://api.whatsapp.com/send?phone=+6282231484231">
<img src="https://hantamo.com/free/whatsapp.svg" class="wabutton" alt="Whatsapp-Button" />
</a>
<style>
.wabutton{
width:60px;
height:60px;
position:fixed;
bottom:80px;
right:20px;
z-index:100;
}
</style>
<?php include_once 'layouts/footer.php'; ?>