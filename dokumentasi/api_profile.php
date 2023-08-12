<?php
session_start();
require_once '../mainconfig.php';
load('middleware', 'user');
include_once '../layouts/header.php';
?>
<section id="dashboard-analytics">
    <div class="card">
        <div class="card-header">
            <h4 id="profile" class="card-title">Profile</h4>
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
                        <?= config ('web','url') ?>/api/profile
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
                                <td>profile</td>
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
          "username": "<?= $data_user['username']; ?>",
          "balance": "<?= $data_user['saldo']; ?>",
          "point": "<?= $data_user['poin']; ?>",
          "spent": "<?= $data_user['pemakaian']; ?>"
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

    <!--/ profile Structure -->
</section>

<?php include_once '../layouts/footer.php'; ?>