<?php
session_start();
require_once '../mainconfig.php';
load('middleware', 'user');

function status($s) {
    if ($s === "Success") {
        return '<div class="badge badge-glow badge-success">Success</div>';
    } else if ($s === "Completed") {
        return '<div class="badge badge-glow badge-success">Completed</div>';
    } else if ($s === "Pending") {
        return '<div class="badge badge-glow badge-warning"><i class="mdi mdi-autorenew mdi-spin"></i> Pending</div>';
    } else if ($s === "Processing") {
        return '<div class="badge badge-glow badge-info"><i class="mdi mdi-cube-send"></i> Processing</div>';
    } else if ($s === "In progress") {
        return '<div class="badge badge-glow badge-info"><i class="mdi mdi-cube-send"></i> In progress</div>';
    } else if ($s === "Partial") {
        return '<div class="badge badge-secondary"><i class="far fa-times-circle"></i> Partial</div>';
    } else if ($s === "Canceled") {
        return '<div class="badge badge-glow badge-danger">Canceled</div>';
    } else {
        return '<div class="badge badge-glow badge-danger">Error</div>';
    }
}

include_once '../layouts/header.php'; 
?>

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Social Media</h4>
                    Kami hanya menampilkan data transaksi 100 terbaru
                </div>
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped zero-configuration" id="datatable">
                            <thead>
                                <tr>
                                    <th>Layanan</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Mulai</th>
                                    <th>Proses</th>
                                    <th>Selesai</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php
                    $check_data = $db->query("SELECT * FROM pembelian_sosmed ORDER BY id DESC LIMIT 100");
                    while($data_moni = $check_data->fetch_assoc()) :
                    $start  = date_create($data_moni['tanggal']);
                    $update = date_create($data_moni['tanggal_at']); // waktu sekarang
                    $diff  = date_diff( $start, $update );
                    ?>
                            <tr>
                                <td><?= $data_moni['layanan']; ?></td>
                                <td><?= $data_moni['jumlah']; ?></td>
                                <td><?= $data_moni['harga']; ?></td>
                                <td><center><?= format_date('id',$data_moni['tanggal']); ?></center></td>
                                <td><center><?php if ($data_moni['status'] == 'Success') { ?> <?php if ($diff->d == "0") { ?> <?php } else { ?> <?php echo $diff->d . ' Hari,'; ?> <?php } ?> <?php echo $diff->h . ' Jam, '; ?> <?php echo $diff->i . ' Menit, '; ?> <?php echo $diff->s . ' Detik.'; ?><?php } else { ?> - <?php } ?></center></td>
                                <td><center><?php if($data_moni['status'] == 'Success'){;
      }else if($data_moni['status'] == 'Completed'){; ?><?= format_date('id',$data_moni['tanggal_at']); ?><?php } else { ?> - <?php } ?> </center></td>
                                <td><?= status($data_moni['status']); ?></td>
                            </tr>
                            <?php endwhile; ?>
						</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once '../layouts/footer.php'; ?>