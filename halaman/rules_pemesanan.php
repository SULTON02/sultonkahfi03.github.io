<?php
session_start();
require_once '../mainconfig.php';
include_once '../layouts/header.php';
?>
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
<p>8. Dengan melakukan orderan Anda dianggap sudah memahami dan setuju Syarat dan Ketentuan&nbsp;Indo SMM.</p>
<p><br></p>
<h4 class="text-center"><span style="text-align: CENTER"><u style="text-decoration: underline"><strong style="font-weight: bold">KETENTUAN </strong></u></span><span style="color: rgba(1, 227, 68, 1)"><span style="text-align: CENTER"><u style="text-decoration: underline"><strong style="font-weight: bold">SPEED UP</strong></u></span></span></h4>
<p><br></p>
<p>1. Definisi speedup adalah proses boost up layanan yang stuck orderannya&nbsp; / belum jalan sama sekali setelah lebih dari 24 jam. Speed up 24 jam tidak berlaku untuk layanan yang ada tulisan <strong style="font-weight: bold">SLOW</strong> pada nama layananya atau pada harga layanan kolom speed memang lambat prosesnya.</p>
<p>2. Apabila sudah melewati estimasi waktu speed layanan yang tertera pada halaman <a target="_self" href="https://indosmm.id/services"><strong style="font-weight: bold">Daftar Layanan</strong></a><a target="_self" href="https://indosmm.id/services"> </a>dan orderan masih pending / in progress / processing, silahkan request speedup dengan melaporkan order ID kepada CS.&nbsp;</p>
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

<?php include_once '../layouts/footer.php'; ?>