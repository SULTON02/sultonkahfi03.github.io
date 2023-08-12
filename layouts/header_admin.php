<?php defined("BASEPATH") or exit("No direct script access allowed."); ?>
<?php
$start_time = microtime(true);
if (isset($_SESSION['user'])) {
    $check_notifications = $db->query("SELECT * FROM user_notifications WHERE username = '{$_SESSION['user']['username']}' ORDER BY created_at DESC LIMIT 4");
}
$check_A = $db->query("SELECT * FROM setting_website WHERE id = '1'");
$web = $check_A->fetch_assoc();

$tiket = $db->query("SELECT * FROM tiket WHERE is_admin = '0'");

function level($s)
{
    if ($s === "Admin") {
        return 'Admin <i class="mdi mdi-checkbox-multiple-marked-circle text-success"></i> ';
    } elseif ($s === "Reseller") {
        return 'Reseller
<i class="mdi mdi-checkbox-multiple-marked-circle text-success"></i> ';
    } elseif ($s === "Member") {
        return 'Member';
    } else {
        return 'Lock <i class="mdi mdi-lock text-danger"></i>';
    }
}
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<?php include_once 'title_meta.php'; ?>
    <body class="vertical-layout vertical-menu-modern navbar-floating footer-static light-layout" data-open="click" data-menu="vertical-menu-modern" data-col="content-right-sidebar">
        <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
            <div class="navbar-container d-flex content">
                <div class="bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav d-xl-none">
                        <li class="nav-item">
                            <a class="nav-link menu-toggle" href="javascript:void(0);">
                                <i class="ficon" data-feather="menu"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <ul class="nav navbar-nav align-items-center ml-auto">
                    <?php if (isset($_SESSION['user'])) { ?>
                    <li class="nav-item dropdown dropdown-cart me-25">
                        <a class="nav-link" href="<?= base_url() ?>"><i class="ficon" data-feather="home"></i></a>
                    </li>                                                                                               
                    <li class="nav-item dropdown dropdown-notification mr-25">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">
                            <i class="ficon" data-feather="bell"></i><span class="badge badge-pill badge-danger badge-up"><?= mysqli_num_rows($check_notifications) ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header d-flex">
                                    <h4 class="notification-title mb-0 mr-auto">Notifikasi</h4>
                                    <div class="badge badge-pill badge-light-primary">
                                        <?= mysqli_num_rows($check_notifications) ?>
                                        Baru
                                    </div>
                                </div>
                            </li>
                            <li class="scrollable-container media-list">
                                <?php while ($data_notification = $check_notifications->fetch_assoc()) { ?>
                                <a class="d-flex" href="javascript:void(0)">
                                    <div class="media d-flex align-items-start">
                                        <div class="media-left">
                                            <div class="avatar bg-light-success">
                                                <div class="avatar-content"><i class="fas fa-bell"></i></div>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <p class="media-heading">
                                                <span class="font-weight-bolder"><?= $data_notification['title'] ?></span>
                                                <small class="float-right"><?= time_elapsed_string($data_notification['created_at']) ?></small>
                                            </p>
                                            <small class="notification-text"><?= $data_notification['message'] ?></small>
                                        </div>
                                    </div>
                                </a>
                                <?php } ?>
                            </li>
                            <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="<?= base_url('/account/aktifitas_login') ?>">Tampilkan Semua</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="user-nav d-sm-flex d-none">
                                <span class="user-name font-weight-bolder limited-text" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 8ch;"><?= $_SESSION['user']['username'] ?></span>
                                <span class="user-status"><?= level(e($_SESSION['user']['level'])) ?></span>
                            </div>
                            <span class="avatar">
                                <img class="round" src="<?= gravatar($_SESSION['user']['email']) ?>" alt="avatar" height="40" width="40" />
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                            <a class="dropdown-item" href="<?= base_url('/account/pengaturan_akun') ?>"> <i class="mr-50" data-feather="settings"></i> Pengaturan </a>
                            <a class="dropdown-item" href="<?= base_url('/account/aktifitas_login') ?>"> <i class="mr-50" data-feather="refresh-ccw"></i> Aktifitas Login </a>
                            <a class="dropdown-item" href="<?= base_url('/account/mutasi_saldo') ?>"> <i class="ti-wallet mr-50"></i> Mutasi Saldo </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('/account/logout') ?>"> <i class="mr-50" data-feather="power"></i> Logout </a>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>

        <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mr-auto">
                        <a class="navbar-brand" href="<?= base_url() ?>">
                            <span class="brand-logo"> </span>
                            <h2 class="brand-text text-primary"><?= $web['NamaWeb']; ?></h2>
                        </a>
                    </li>
                    <li class="nav-item nav-toggle">
                        <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                            <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                            <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc" data-ticon="disc"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="shadow-bottom"></div>

            <div class="main-menu-content">
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class="navigation-header">
                        <i data-feather="more-horizontal"></i>
                    </li>
                    <?php if (!isset($_SESSION['user'])) { ?>
                    <li class="nav-item <?= (uri() == '/auth/login') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/auth/login') ?>">
                            <i data-feather="log-in"></i>
                            <span class="menu-title text-truncate" data-i18n="SignIn">Login</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (uri() == '/auth/register') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/auth/register') ?>">
                            <i data-feather="user-plus"></i>
                            <span class="menu-title text-truncate" data-i18n="Register">Register</span>
                        </a>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item <?= (uri() == '/admin/') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url() ?>admin/">
                            <i data-feather="home"></i>
                            <span class="menu-title text-truncate" data-i18n="Home">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (uri() == 'users') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="users"></i>
                            <span class="menu-title text-truncate" data-i18n="Users">Users</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/admin/users/kelola_users') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>admin/users/kelola_users">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Kelola Users">Kelola Users</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/admin/users/aktifitas_login') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>admin/users/aktifitas_login">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Aktifitas Log">Aktifitas Log</span>
                                </a>
                            </li>

                            <li class="nav-item <?= (uri() == '/admin/users/balance_history') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>admin/users/balance_history">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Balance History">Balance History</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/admin/users/transfer_history') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>admin/users/transfer_history">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Transfer History">Transfer History</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?= (uri() == '/admin/ticket/list') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/admin/ticket/list') ?>">
                            <i data-feather="message-square"></i>
                            <span class="menu-title text-truncate" data-i18n="Ticket">Tiket Laporan</span>
                            <?php if (mysqli_num_rows($tiket) !== 0) { ?>
                            <span class="badge badge-warning badge-pill"><?php echo mysqli_num_rows($tiket); ?></span>
                            <?php } ?>
                        </a>
                    </li>
                    <li class="nav-item <?= (uri() == '/admin/provider/provider') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/admin/provider/provider') ?>">
                            <i data-feather="cpu"></i>
                            <span class="menu-title text-truncate" data-i18n="Provider">Cek Provider</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (uri() == '/admin/other/act') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/admin/other/act') ?>">
                            <i data-feather="inbox"></i>
                            <span class="menu-title text-truncate" data-i18n="Kelola Layanan">Get Layanan</span>
                        </a>
                    </li>

                    <li class="nav-item <?= (uri() == 'trxsosmed') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="cloud"></i>
                            <span class="menu-title text-truncate" data-i18n="Sosial Media">Satus Pembelian</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/admin/trxsosmed/transaksi') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>admin/trxsosmed/transaksi">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Status Transaksi">Lihat Status</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?= (uri() == '/admin/other/news_data') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/admin/other/news_data') ?>">
                            <i data-feather="inbox"></i>
                            <span class="menu-title text-truncate" data-i18n="News">Sett Notifikasi</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (uri() == 'deposit') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="credit-card"></i>
                            <span class="menu-title text-truncate" data-i18n="Deposit">Atur Deposit</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/admin/deposit/kelola') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>admin/deposit/kelola">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Kelola">Riwayat Deposit</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/admin/deposit/voucher_list') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>admin/deposit/voucher_list">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Voucher">Buat Voucher</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/admin/deposit/method_data') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>admin/deposit/method_data">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Method">Sett Deposit</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?= (uri() == 'other') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="list"></i>
                            <span class="menu-title text-truncate" data-i18n="Others">Lihat Lainnya</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/admin/other/setting_rate') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>admin/other/setting_rate">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Atur Rate">Sett Upgrade</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/admin/other/contact_person') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>admin/other/contact_person">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Contact">Info Kontak</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/admin/other/profit_data') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>admin/other/profit_data">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Profit">Sett Keuntungan</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/admin/other/config') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>admin/other/config">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Configuration">Sett Website</span>
                                </a>
                            </li>
                        </ul>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>

        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper">
                <div class="content-header row"></div>
                <div class="content-body">
                    <?php if (isset($_SESSION['alert']) && $alert = $_SESSION['alert']) { ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-<?= $alert[0] ?>" role="alert">
                                <h4 class="alert-heading"><?= $alert[1] ?></h4>
                                <div class="alert-body"><?= $alert[2] ?></div>
                            </div>
                        </div>
                    </div>
                    <?php unset($_SESSION['alert']); } ?>

                    