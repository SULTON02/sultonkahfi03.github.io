<?php
session_start();
require_once '../mainconfig.php';

include_once '../layouts/header.php'; ?>
<div class="row match-height justify-content-around">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Error page-->
                <div class="misc-wrapper">
                    <div class="misc-inner p-2 p-sm-3">
                        <div class="w-100 text-center">
                        <img class="img-fluid" src="/assets/images/logo/app-store-google-play-apple-apple.png" alt="app-store-google-play-apple-apple.png" width="150px" height="50px">
                            <h4 class="mb-1 text-primary">Download Aplikasi <?= $web['NamaWeb']; ?></h4>
                            <p class="mb-2">Nikmati kemudahan bertransaksi hanya dari Smartphonemu</p><a class="btn btn-primary mb-2 btn-sm-block" href=""><i class="fas fa-download"></i> Download Sekarang</a>
<div class="divider divider-primary">
  <div class="divider-text">Atau</div>
</div>                            
                            <a class="btn btn-primary mb-2 btn-sm-block" href="https://asepah.my.id/halaman/MediaSMM.apk"><i class="fab fa-google-play"></i> Download Via Playstore</a>
                          <!---  <a class="btn btn-primary mb-2 btn-sm-block" href="https://asepah.my.id/halaman/MediaSMM.apk"><i class="fa fa-download"></i> Download Sekarang</a> ---!>
                          <!--- <img class="img-fluid" src="/assets/images/logo/app-store-google-play-apple-apple.png" alt="app-store-google-play-apple-apple.png" /> ---!>
                        </div>
                    </div>
                </div>
                <!-- / Error page-->
            </div>
        </div>
    </div>
    <!-- END: Content-->
	
</div>
<?php include_once '../layouts/footer.php'; ?>
