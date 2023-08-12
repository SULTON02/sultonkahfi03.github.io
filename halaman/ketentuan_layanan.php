<?php
session_start();
require_once '../mainconfig.php';
include_once '../layouts/header.php';
?>
<section id="dashboard-ecommerce">
    <div class="row match-height">
        <div class="col-md-10 offset-md-1 col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="m-t-0 text-uppercase header-title"><i class=""></i> KETENTUAN LAYANAN</h4>
                    <hr />
                    <br />
                    <ul class="timeline">
                        <li class="timeline-item">
                            <span class="timeline-point timeline-point-indicator"></span>
                            <div class="timeline-event">
                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                    <h6>1. Umum</h6>
                                </div>
                                <p>
                                    Dengan mendaftar dan menggunakan layanan
                                    <?= config('web','title') ?>, Anda secara otomatis menyetujui semua ketentuan layanan kami. Kami berhak mengubah ketentuan layanan ini tanpa pemberitahuan terlebih dahulu. Anda diharapkan membaca semua
                                    ketentuan layanan kami sebelum membuat pesanan.
                                </p>
                                <ul>
                                    <li>
                                        <b>Penolakan: </b>
                                        <?= config('web','title') ?>
                                        tidak akan bertanggung jawab jika Anda mengalami kerugian dalam bisnis Anda.
                                    </li>
                                    <li>
                                        <b>Kewajiban: </b>
                                        <?= config('web','title') ?>
                                        tidak bertanggung jawab jika Anda mengalami suspensi akun atau penghapusan kiriman yang dilakukan oleh Instagram, Twitter, Facebook, Youtube, dan lain-lain.
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="timeline-item">
                            <span class="timeline-point timeline-point-indicator"></span>
                            <div class="timeline-event">
                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                    <h6>2. Layanan</h6>
                                </div>
                                <ul>
                                    <li>
                                        <?= config('web','title') ?>
                                        hanya digunakan untuk media promosi sosial media dan membantu meningkatkan penampilan akun Anda saja.
                                    </li>
                                    <li>
                                        <?= config('web','title') ?>
                                        tidak menjamin pengikut baru Anda berinteraksi dengan Anda, kami hanya menjamin bahwa Anda mendapat pengikut yang Anda beli.
                                    </li>
                                    <li>
                                        <?= config('web','title') ?>
                                        tidak menerima permintaan pembatalan / pengembalian dana setelah pesanan masuk ke sistem kami. Kami memberikan pengembalian dana yang sesuai jika pesanan tidak dapat diselesaikan.
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="timeline-item">
                            <span class="timeline-point timeline-point-indicator"></span>
                            <div class="timeline-event">
                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                    <h6>3. Akun</h6>
                                </div>
                                <p>
                                    <?= config('web','title') ?>
                                    berhak mensuspend atau menghapus akun anda tanpa pemberian refund dari pihak kami apabila melakukan hal dibawah ini:
                                </p>
                                <ul>
                                    <li>
                                        Memperjual Belikan akun
                                        <?= config('web','title') ?>
                                    </li>
                                    <li>
                                        Melakukan kecurangan dalam bertransaksi di
                                        <?= config('web','title') ?>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="timeline-item">
                            <span class="timeline-point timeline-point-indicator"></span>
                            <div class="timeline-event">
                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                    <h6>4. Transaksi</h6>
                                </div>
                                <p>Apabila terdapat pengguna melakukan transaksi secara tidak resmi / kecurangan :</p>
                                <ul>
                                    <li>
                                        <?= config('web','title') ?>
                                        berhak membawa kejalur hukum.
                                    </li>
                                    <li>Pengguna wajib mempertanggungjawabkan kesalahannya.</li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Dashboard Ecommerce ends -->
    </div>
</section>

<?php include_once '../layouts/footer.php'; ?>