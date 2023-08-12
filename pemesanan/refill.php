<?php
session_start();
require_once '../mainconfig.php';
load('middleware', 'user');

if(isset($_GET['oid'])){
    $order_id = $db->real_escape_string(trim(filter($_GET['oid'])));
    
    $cek_pembelian = $db->query("SELECT * FROM pembelian_sosmed WHERE id = '{$order_id}' AND user = '{$session}' LIMIT 1");
    $data_pembelian = mysqli_fetch_assoc($cek_pembelian);

    if(mysqli_num_rows($cek_pembelian) == 0){
        $_SESSION['alert'] = ['danger', 'Failed!', 'Orderan tidak ditemukan.'];
        exit(header("Location: " . base_url()));
    } else if(!$data_pembelian['refill']){
        $_SESSION['alert'] = ['danger', 'Failed!', 'Orderan tidak dapat direfill.'];
        exit(header("Location: " . base_url()));
    } else {
        $oid = $data_pembelian['oid'];
        $tanggal = date('Y-m-d H:i:s');
    
        $cek_prov = $db->query("SELECT * FROM provider WHERE id = '2'");
        $data_prov = mysqli_fetch_assoc($cek_prov);
        
        $post_api = [
            'api_id' => $data_prov['api_id'],
            'api_key' => $data_prov['api_key'],
            'secret_key' => $data_prov['secret_key'],
            'id' => $data_pembelian['provider_oid']
        ];
        
        $curl = post_curl($data_prov['link']."refill", $post_api);
        $result = json_decode($curl, true);
        
        if (isset($result['response']) and $result['response'] == true) {
            $provider_oid = $result['data']['refill_id'];
            $result_api = true;
        }
        
        if(!$result_api && !isset($provider_oid)){
            $_SESSION['alert'] = ['danger', 'Failed!', 'Gagal melakukan refill. Msg : '.$result['data']['msg']];
            exit(header("Location: " . base_url()));
        } else {
            $input_refill_sosmed = $db->query("INSERT INTO refill_sosmed VALUES ('', '{$session}', '{$oid}', '{$provider_oid}', 'Pending', '{$tanggal}', '{$tanggal}')");
            if($input_refill_sosmed){
                $_SESSION['alert'] = ['success', 'Success!', 'Refill sedang diproses.'];
                exit(header("Location: " . base_url()));
            }
        }
    }
}