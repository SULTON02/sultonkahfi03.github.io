<?php
session_start();
require_once '../mainconfig.php';
load('middleware', 'user');
include_once '../layouts/header.php';
?>
<section id="dashboard-analytics">
    <div class="card">
        <div class="card-header">
            <h4 id="order" class="card-title">Order</h4>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li>
                        <a data-action="expand"><i data-feather="maximize"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-content collapse show" aria-expanded="true">
            <div class="card-body">
                <div class="card-text">
                    <p>
                        [<code>POST</code>]
                        <?= config ('web','url') ?>/api/social_media
                    </p>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless mb-0">
                        <thead>
                            <tr>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Req.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>CEK API KEY</td>
                                <td>DI PENGATURAN AKUN</td>
                                <td>LIHAT DI PENGATURAN</td></td>
                            </tr>
                            <tr>
                                <td>api_key</td>
                                <td>berisi api key anda.</td>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <td>action</td>
                                <td>pemesanan</td>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <td>layanan</td>
                                <td>berisi kode layanan, <a href="<?= config('web','url') ?>/halaman/price_list" target="blank">cek disini</a>.</td>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <td>target</td>
                                <td>berisi data tujuan</td>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <td>jumlah</td>
                                <td>jumlah pesanan</td>
                                <td>Yes</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h4 class="mt-3">Respon Sukses</h4>
                <hr />
                <pre>
                        <code class="language-json">
{
  "data": {
          "id": "1119",
          "start_count": "200"
          }
}                        </code>
                    </pre>
                <h4 class="mt-3">Respon Gagal</h4>
                <hr />
                <pre>
                        <code class="language-json">
{
    "status": false,
    "data": {
        "pesan": "Permintaan tidak sesuai"
    }
}                        </code>
                    </pre>
            </div>
        </div>
    </div>
    <!--/ Melakukan Pemesanan Structure -->
    <!-- Melakukan Cek Status Pesanan Structure -->
    <div class="card">
        <div class="card-header">
            <h4 id="status" class="card-title">Cek Status</h4>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li>
                        <a data-action="expand"><i data-feather="maximize"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-content collapse show" aria-expanded="true">
            <div class="card-body">
                <div class="card-text">
                    <p>
                        [<code>POST</code>]
                        <?= config ('web','url') ?>/api/social_media
                    </p>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless mb-0">
                        <thead>
                            <tr>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Req.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>api_key</td>
                                <td>berisi api key anda.</td>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <td>action</td>
                                <td>status</td>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <td>id</td>
                                <td>ID pesanan</td>
                                <td>Yes</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h4 class="mt-3">Respon Sukses</h4>
                <hr />
                <pre>
                        <code class="language-json">
{
  "data": {
          "id":"23",
          "start_count":"123",
          "status":"Success",
          "remains":"0"
          }
}                        </code>
                    </pre>
                <h4 class="mt-3">Respon Gagal</h4>
                <hr />
                <pre>
                        <code class="language-json">
{
    "status": false,
    "data": {
        "pesan": "Permintaan tidak sesuai"
    }
}                        </code>
                    </pre>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 id="services" class="card-title">Get Service</h4>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li>
                        <a data-action="expand"><i data-feather="maximize"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-content collapse show" aria-expanded="true">
            <div class="card-body">
                <div class="card-text">
                    <p>
                        [<code>POST</code>]
                        <?= config ('web','url') ?>/api/social_media
                    </p>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless mb-0">
                        <thead>
                            <tr>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Req.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>api_key</td>
                                <td>berisi api key anda.</td>
                                <td>Yes</td>
                            </tr>
                            <tr>
                                <td>action</td>
                                <td>layanan</td>
                                <td>Yes</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h4 class="mt-3">Respon Sukses</h4>
                <hr />
                <pre>
                        <code class="language-json">
{
  "data": {
          "id": "1"
          "category": " Instagram Followers Indonesia"
          "service": "Instagram Followers Indonesia Server 17 max 5KтЪбя╕П Real ЁЯТп"
          "min": "10"
          "max": "5.000"
          "price": "10.200"
          "note": "Proses fast Real indo per akun max 5k followers"
          }
}                        </code>
                    </pre>
                <h4 class="mt-3">Respon Gagal</h4>
                <hr />
                <pre>
                        <code class="language-json">
{
    "status": false,
    "data": {
        "pesan": "Permintaan tidak sesuai"
    }
}                        </code>
                    </pre>
            </div>
        </div>
    </div>
</section>

<?php include_once '../layouts/footer.php'; ?>