<?php
session_start();
require_once '../mainconfig.php';
include_once '../layouts/header.php';
?>
<div class="col-md-12 col-xl-12 tr_">
    <div class="card card-collapsed">
      <div class="card-header">
        <h3 class="card-title" data-toggle="card-collapse">
          <span class="bg-question"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
          Contoh Pengisian Link Target        </h3>
        <div class="card-options">
          <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
          <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
      </div>
      <div class="card-body">
        <p>Untuk melakukan pesanan anda harus memasukkan targer. Pastikan memasukkan target dengan teliti. kesalahan pengisian tanggung jawab pemesan dan tidak dapat diganti setelah anda klik pesan.</p>
<p>berikut ini contoh link target :</p>
<h3><b>Instagram</b></h3>
<ul xss="removed">
<li><span> Instagram Followers, Story, Live Video, Profile Visits : Username akun Instagram tanpa tanda @ // Contoh : andre_lestari1</span></li>
<li>Instagram Likes, Views, Comments, Impressions, Saves : Link postingan akun Instagram // Contoh : https://www.instagram.com/p/xxjiudjaradsou/</li>
<li>Instagram TV : Link postingan Instagram TV // Contoh : https://www.instagram.com/tv/DROfgerkdfdBsqP/</li>
<li>Instagram Reels : Link postingan Instagram Reels // Contoh : https://www.instagram.com/reel/MMrqMtmfddedDI/<br><br></li>
</ul>
<h3><b>Youtube</b></h3>
<ul>
<li>Youtube Likes, Views, Shares, Komentar : Link video youtube // Contoh : https://www.youtube.com/watch?v=NdgFndfdnFQqII</li>
<li>Youtube Live Steam : Link video live youtube // Contoh : https://www.youtube.com/watch?v=0AFdfdM8thZU_g</li>
<li>Youtube Subscribers : Link channel youtube // Contoh : https://www.youtube.com/channel/dDPr9Tbddasdfdf2zs9TC-esad (bukan pakai c)</li>
<li>Youtube Komentar like : link komentar yang didapat dengan cara klik tulisan waktu disamping nama akun anda yang buat komentar // contoh : https://www.youtube.com/watch?v=HvZjzIOd4y0&lc=UgxNAYDCGNBEq6i1on54AeABAg</li>
</ul>
<h3><b>Facebook</b></h3>
<ul>
<li>Facebook Page Likes, Page Followers : Link halaman atau fanspage facebook // Contoh : https://www.facebook.com/providermedsos/</li>
<li>Facebook Post Likes, Post Video : Link postingan facebook // Contoh : https://www.facebook.com/providermedsos/posts/1199897979</li>
<li>Facebook Followers, Friends : Link profile facebook // Contoh : https://www.facebook.com/andrexx</li>
<li>Facebook Group Members : Link group facebook // Contoh : https://www.facebook.com/groups/8709886789/<br><br></li>
</ul>
<h3><b>Twitter</b></h3>
<ul>
<li><span>Twitter Followers : Username akun twitter tanpa tanda @ // Contoh : providermedsos</span></li>
<li><span>Twitter Retweet, Favorite : Link tweet atau postingan twitter // Contoh : https://twitter.com/providermedsos/status/789098698769</span><br><br></li>
</ul>
<h3><b>Tik Tok</b></h3>
<ul>
<li>Tik Tok Followers : Link profile tik tok atau username tanpa tanda @ // Contoh : https://www.tiktok.com/@yt_andrelestari atau masukkan username : yt_andrelestari</li>
<li>Tik Tok Likes / Views/save/komentar/share : Link video tik tok // Contoh : https://vt.tiktok.com/xxxxx/ atau https://www.tiktok.com/@yt_andrelestari/video/7127708600415407387?is_from_webapp=1&sender_device=pc&web_id=7128236074933257730</li>
<li>Tiktok Live : https://www.tiktok.com/@yt_andrelestari/live</li>
</ul>
<h3><b>Shopee</b></h3>
<ul>
<li><span>Shopee Followers : Username akun shopee // Contoh : usernameanda</span></li>
<li><span>Shopee Product Likes : Link produk shopee // Contoh : https://shopee.co.id/Lenovo-Legion-Y25-25-Gaming-Monitor-24.5-FHD-IPS-AMD-FreeSync-Premium</span><br><br></li>
</ul>
<h3><b>Tokopedia</b></h3>
<ul>
<li>Tokopedia Followers : Username akun tokopedia atau link profile // Contoh : https://www.tokopedia.com/medsosup</li>
<li>Tokopedia Wishlist atau Favorite : Link produk tokopedia // Contoh : https://www.tokopedia.com/medsosup/like-instagram-murah-berkualitas<br><br><br></li>
</ul>
<h3><b>Website Traffic</b></h3>
<ul>
<li><span>Website Traffic : Link website // Contoh : <a href="https://rajapanell.com/new_order">https://rajapanell.com/new_order</a></span></li>
</ul>
<p><span></span></p>
<p><span>Untuk target link akun lainnya hampir sama , kalau untuk follower/subscriber pasti link profil atau username (tergantung deskripsi tiap layanan minta apa) untuk like/view/share/komentar pastinya link postingan/link video</span></p>      </div>
    </div>
  </div>


<?php include_once '../layouts/footer.php'; ?>