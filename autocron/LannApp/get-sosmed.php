<?php
require_once '../mainconfig.php';

$prov = $db->query("SELECT * FROM provider WHERE code = 'MP'");

if($prov->num_rows == 1) {
    $prov = $prov->fetch_assoc();
    $api_postdata = [
        'api_id' => $prov['api_id'],
        'api_key' => $prov['api_key']
    ];
    
    $curl = post_curl($prov['link'].'services',$api_postdata);
    $try = json_decode($curl, true);
    
    if(isset($try['status'])) {
        if($try['status'] == true) {
            if(count($try['data']) > 0) {
                for($i = 0; $i <= count($try['data'])-1; $i++) {
                    $data = $try['data'][$i];
                    $pid = $data['id'];
                    $min = $data['min'];
                    $max = $data['max'];
                    $name = $data['name'];
                    $note = $data['description'];
                    $price = explode('.',$data['price'])[0];
                    $refill = ($data['refill'] == 'true') ? 1 : 0;
                    $category = $data['category'];
                    $category2 = str_replace(['&','*'],'',$data['category']);

                    /* Profit */
                    $seeProfit = $db->query("SELECT * FROM keuntungan WHERE code = 'SOSIAL_MEDIA'")->fetch_assoc();                                           
                    $profit_web = ($price / 100) * $seeProfit['web'];
                    $profit_api = ($price / 100) * $seeProfit['api'];
                                       
                    $check_category = $db->query("SELECT * FROM kategori_layanan WHERE nama = '$category2' AND tipe = 'Sosial Media'");
                    $check_service = $db->query("SELECT * FROM layanan_sosmed WHERE provider_id = '$pid' AND provider = 'MP'");

                    if($check_category->num_rows == 0)
                        $db->query("INSERT INTO kategori_layanan VALUES ('', '$category2','$category2','Sosial Media')");                                   
                    if($check_service->num_rows == 0) {
                        $db->query("INSERT INTO layanan_sosmed VALUES ('', '$pid', '$category2', '$name', '$note', '$min', '$max', '".($price + $profit_web)."', '".($price + $profit_api)."', '$profit_web', '$refill', 'Aktif', '$pid', 'MP' ,'Sosial Media')");                        
                        print '<font color="green"><pre>';
                        print "[+] $name {Berhasil ditambahkan}<br>";
                        print "Min: $min<br>";
                        print "Max: $max<br>";
                        print "Status: $status<br>";
                        print "Harga Pusat: $price<br>";
                        print "Harga Member: ".($price+$profit_web)."<br>";
                        print "Harga H2H/Special: ".($price+$profit_api)."<br>";
                        print '</pre></font><hr>';
                    } else {
                        $data_service = $check_service->fetch_assoc();
                        if($data_service['harga'] <> ($price + $profit_web) || $reset == true || $data_service['min'] <> $min || $data_service['max'] <> $max) {
                            $db->query("UPDATE layanan_sosmed SET catatan = '$note', harga = '".($price+$profit_web)."', harga_api = '".($price+$profit_api)."', profit = '$profit_web', min = '$min', max = '$max' WHERE provider_id = '$pid' AND provider = 'MP'");
                            print '<font color="green"><pre>';
                            print "[+] $name {Berhasil diupdate}<br>";
                            print "Min: ".$data_service['min']." -> $min<br>";
                            print "Max: ".$data_service['max']." -> $max<br>";
                            print "Status: ".$data_service['status']." -> $status<br>";
                            print "Harga Pusat: ".$data_service['price']." -> $price<br>";
                            print '</pre></font><hr>';
                        } else {
                            print '<font color="red"><pre>[!] '.$name.' {Data masih sama}</pre></font><hr>';
                        }
                    }
                }
            } else {
                print '<font color="red"><pre>[!] No Service</pre></font>';
            }
        } else {
            print '<font color="red"><pre>[!] '.$try['data'].'</pre></font>';
        }
    } else {
        print '<font color="red"><pre>[!] Connection Failed</pre></font>';
    }
} else {
    print '<font color="red"><pre>[!] Provider not found</pre></font>';
}
