<?php
require("../mainconfig.php");
$cek_pesanan = $db->query("SELECT * FROM pembelian_sosmed WHERE status IN ('','Pending','Processing','In progress') AND provider = 'INDOSMM'");

if (mysqli_num_rows($cek_pesanan) == 0) {
  die("Order Pending Tidak Ditemukan.");
} else {
  while($data_pesanan = $cek_pesanan->fetch_assoc()) {
    $poid =  $data_pesanan['provider_oid'];
    $oid =  $data_pesanan['oid'];
    $id =  $data_pesanan['id'];
    $o_provider =  $data_pesanan['provider'];

    if ($o_provider == "MANUAL") {
      echo "Order manual<br />";
    } else {

      $cek_provider = $db->query("SELECT * FROM provider WHERE code = 'INDOSMM'");
      $data_provider = $cek_provider->fetch_assoc();

      if ($o_provider !== "MANUAL") {
        $api_postdata = "key=".$data_provider['api_key']."&action=status&order=$poid";
      } else {
        die("System error");
      }
      
      $url = 'https://indosmm.id/api/v2';
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $api_postdata);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $chresult = curl_exec($ch);
      //echo $chresult;
      curl_close($ch);
      $json_result = json_decode($chresult, true);
      print_r($json_result);

      if ($o_provider !== "MANUAL") {
       $u_status = $json_result['status'];
        $u_start = $json_result['start_count'];
        $u_remains = $json_result['remains'];
      }

      if($u_status == 'Pending'){
        $status = 'Pending';
      }else if($u_status == 'Processing'){
        $status = 'Processing';
      }else if($u_status == 'In progress'){
        $status = 'In progress';
      }else if($u_status == 'Canceled'){
        $status = 'Canceled';
      }else if($u_status == 'Partial'){
        $status = 'Partial';
      }else if($u_status == 'Success'){
        $status = 'Success';
      }else if($u_status == 'Completed'){
        $status = 'Completed';
      }else if($u_status == ''){
        $status = $u_status;
      }else{
        $status = $u_status;
      }

      $update_pesanan = $db->query("UPDATE pembelian_sosmed SET status = '$u_status', start_count = '$u_start', remains = '$u_remains' WHERE id = '$id' AND provider = 'INDOSMM'");
      if ($update_pesanan == TRUE) {
        echo "<b>Status Order Diupdate</b> <br/>
        Order ID: $poid <br/>
        Status: $u_status <br/>
        Start: $u_start <br/>
        Remains: $u_remains <br/><br/>";
      } else {
        echo "Error database";
      }
    }
  }
}

?>