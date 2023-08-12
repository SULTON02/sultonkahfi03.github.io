<?php
session_start();
require_once '../mainconfig.php';
load('middleware', 'user');

$id = $db->real_escape_string(e($_GET['id']));
if(!isset($_GET['id'])) exit(header("Location: " . base_url('/deposit/riwayat')));

/* CANCEL */
$up = $db->query("UPDATE deposit SET status = 'Cancelled' WHERE id = '$id' AND username = '$session'");

if($up == true) { 
    redirect(0,base_url('/deposit/riwayat'));
    $_SESSION['alert'] = ['success', 'Success!', 'Deposit berhasil dicancelled.'];
} else {
    redirect(0,base_url('/deposit/riwayat'));
    $_SESSION['alert'] = ['danger', 'Failed!', 'Ror Error.'];
}