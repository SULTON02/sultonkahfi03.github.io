<?php
session_start();
require_once '../mainconfig.php';
include_once '../layouts/header.php';
?>
<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <h4 class="m-t-0 header-title"><i class=""></i> Daftar Harga </h4><br>
                    <form class="form-horizontal" role="form" method="POST">
                        <div class="form-group">
                            <label class="col-md-12 control-label">Kategori</label>
                            <div class="col-md-12">
                                <select class="form-control" name="server" id="server">
                                    <option value="0">- Pilih Satu -</option>
                                    <option value="Sosial Media">Sosial Media</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12 control-label">Layanan</label>
                            <div class="col-md-12">
                                <select class="form-control" name="kategori" id="kategori">
                                    <option value="0">- Pilih Satu -</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="service"></div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Dashboard Ecommerce ends -->

<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#server").change(function () {
            var server = $("#server").val();
            $.ajax({
                url: "<?= base_url() ?>ajax/list/list-server.php",
                data: "server=" + server,
                type: "POST",
                dataType: "html",
                success: function (msg) {
                    $("#kategori").html(msg);
                },
            });
        });
        $("#kategori").change(function () {
            var server = $("#server").val();
            var kategori = $("#kategori").val();
            $.ajax({
                url: "<?= base_url() ?>ajax/list/list-kategori.php",
                data: "server=" + server + "&kategori=" + kategori,
                type: "POST",
                dataType: "html",
                success: function (msg) {
                    $("#service").html(msg);
                },
            });
        });
    });
</script>

<?php include_once '../layouts/footer.php'; ?>