<?php defined("BASEPATH") or exit("No direct script access allowed."); ?>
<?php
$start_time = microtime(true);
if (isset($_SESSION['user'])) {
    $check_notifications = $db->query("SELECT * FROM user_notifications WHERE username = '{$_SESSION['user']['username']}' ORDER BY created_at DESC LIMIT 4");
}

$check_A = $db->query("SELECT * FROM setting_website WHERE id = '1'");
$web = $check_A->fetch_assoc();

$tiket = $db->query("SELECT * FROM tiket WHERE is_user = '0' AND user = '{$_SESSION['user']['username']}'");

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
                    </li>
                    <?php if (isset($_SESSION['user'])) { ?>
                                                                                               
                    
            
                
                    <div>
                    
                        <h2 class="font-weight-bolder mb-0">Rp. <?= number_format($data_user['saldo'],0,',','.'); ?></h2>
                        <p class="card-text">
                        <?php echo $count_order; ?>
                        Pesanan Selesai
                        </p>
                    </div>
                        
 
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

                            </a>
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
                    <?php if (!isset($_SESSION['user'])) { ?>
                    <li class="navigation-header">
                        <span>DASHBOARD</span>
                        <i data-feather="more-horizontal"></i>
                    </li>
                    <li class="nav-item <?= (uri() == '/dashboard') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/home') ?>">
                            <i data-feather="home"></i>
                            <span class="menu-title text-truncate" data-i18n="Home">Home</span>
                        </a>
                    </li>
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
                    <li class="nav-item <?= (uri() == '/halaman/price_list') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/halaman/price_list') ?>">
                            <i data-feather="tag"></i>
                            <span class="menu-title text-truncate" data-i18n="Price List">Price List</span>
                        </a>
                    </li>
                    <?php } else { ?>                    													                                        
                    <?php if ($_SESSION['user']['level'] == 'Reseller' || $_SESSION['user']['level'] == 'Reseller') : ?>
                    <li class="navigation-header">
                        <i data-feather="more-horizontal"></i>
                    </li>
                    <li class="nav-item <?= (uri() == '/reseller') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="feather"></i>
                            <span class="menu-title text-truncate" data-i18n="Premium">Premium</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/reseller/transfer_saldo') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>reseller/transfer_saldo">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Transfer Saldo">Transfer Saldo</span>
                                </a>
                            </li>
                           
                            </ul>
                    <?php endif; ?>
                    
                    <?php if ($_SESSION['user']['level'] == 'Admin' || $_SESSION['user']['level'] == 'Admin') : ?>
                    <li class="nav-item <?= (uri() == '/admin') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/admin') ?>">
                            <i data-feather="grid"></i>
                            <span class="menu-title text-truncate" data-i18n="Admin Panel">Admin Panel</span>
                            </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php if ($_SESSION['user']['level'] == 'Admin' || $_SESSION['user']['level'] == 'Admin') : ?>
                    <li class="nav-item <?= (uri() == '/reseller') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="feather"></i>
                            <span class="menu-title text-truncate" data-i18n="Premium">Premium</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/reseller/transfer_saldo') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>reseller/transfer_saldo">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Transfer Saldo">Transfer Saldo</span>
                                </a>
                            </li>
                           
                    <?php endif; ?>
                    
                    <?php if ($_SESSION['user']['level'] == 'Admin' || $_SESSION['user']['level'] == 'Admin') : ?>
                    <li class="nav-item <?= (uri() == '/admin/other/sales') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/admin/other/sales') ?>">
                            <i data-feather="archive"></i>
                            <span class="menu-title text-truncate" data-i18n="Cek Keuntungan">Cek Keuntungan</span>
                            </a>
                    </li>
                    <?php endif; ?>
                    
                    <li class="nav-item <?= (uri() == '/') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url() ?>">
                            <i data-feather="home"></i>
                            <span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span>
                        </a>
                    </li>
                   
                    
                    
                    <li class="nav-item <?= (uri() == 'pemesanan/new') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="shopping-bag"></i>
                            <span class="menu-title text-truncate" data-i18n="Pemesanan">Order Baru</span>
                        </a>
                        <ul class="menu-content">
                           
                            <li class="nav-item <?= (uri() == '/pemesanan/new') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>pemesanan/new">
                                    <i data-feather="layout"></i>
                                    <span class="menu-title" data-i18n="">💎Pesanan Baru</span>
                                </a>
                            </li>
                            
                            
                            
                            <li class="nav-item <?= (uri() == '/pemesanan/riwayat') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>pemesanan/riwayat">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Riwayat Pesanan">Riwayat Pesanan</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/pemesanan/riwayat-refill') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>pemesanan/riwayat-refill">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Riwayat Refill">Riwayat Refill</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    

                    <li class="nav-item <?= (uri() == 'deposit') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="credit-card"></i>
                            <span class="menu-title text-truncate" data-i18n="Deposit">Menu Deposit</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/deposit/new') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>deposit/new">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Kelola">Deposit Baru</span>
                                </a>
                            </li>
                            
                            <li class="nav-item <?= (uri() == '/deposit/riwayat') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>deposit/riwayat">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Riwayat Deposit">Riwayat Deposit</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item <?= (uri() == 'halaman') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="tag"></i>
                            <span class="menu-title text-truncate" data-i18n="Layanan">Layanan</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/halaman/price_list') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>halaman/price_list">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Daftar Layanan">Daftar Layanan</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/halaman/monitoring') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>halaman/monitoring">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Monitoring">Monitoring</span>
                                </a>
                            </li>
                        </ul>                        
                    </li>
                    
                    <li class="nav-item <?= (uri() == 'ticket') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="message-square"></i>
                            <span class="menu-title text-truncate" data-i18n="Tiket">Tiket</span>
                            <?php if (mysqli_num_rows($tiket) !== 0) { ?>
                            <span class="badge badge-pill badge-success"><?php echo mysqli_num_rows($tiket); ?></span>
                            <?php } ?>                                   
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/ticket/list') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>ticket/list">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Data Ticket">Data Tiket</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/ticket/new') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>ticket/new">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Buat Ticket">Buat Tiket</span>
                                </a>
                            </li>                            
                        </ul>
                    </li>
                    
                    <li class="nav-item <?= (uri() == 'dokumentasi') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="trello"></i>
                            <span class="menu-title text-truncate" data-i18n="API">Documentasi API</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/dokumentasi/api_sosialmedia') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>dokumentasi/api_sosialmedia">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Sosial Media">Sosial Media</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/dokumentasi/api_profile') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>dokumentasi/api_profile">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="Profile">Profile</span>
                                </a>
                            </li>
                        </ul>                        
                    </li>
                    
                    
                                                            
                    <?php } ?>
                    
                    <li class="nav-item <?= (uri() == '/halaman/download_app') ? 'active':'' ?>">
                        <a class="d-flex align-items-center" href="<?= base_url('/halaman/download_app') ?>">
                            <i data-feather="download"></i>
                            <span class="menu-title text-truncate" data-i18n="APK">Download APK</span>
                        </a>
                    </li>
                                        
                    <li class="nav-item <?= (uri() == 'dokumentasi') ? 'sidebar-group-active':'' ?>">
                        <a class="d-flex align-items-center" href="javascript:;">
                            <i data-feather="circle"></i>
                            <span class="menu-title text-truncate" data-i18n="Informasi">Informasi</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?= (uri() == '/halaman/kontak-kami') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>halaman/kontak-kami">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="terms">Kontak Admin</span>
                                </a>
                            </li>
                            <li class="nav-item <?= (uri() == '/halaman/ketentuan_layanan') ? 'active':'' ?>">
                                <a class="d-flex align-items-center" href="<?= base_url() ?>halaman/ketentuan_layanan">
                                    <i data-feather="circle"></i>
                                    <span class="menu-title" data-i18n="terms">Ketentuan</span>
                                </a>
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

                    