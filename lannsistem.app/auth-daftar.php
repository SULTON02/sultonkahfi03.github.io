<?php if (!isset($db)) {
    print '<font color="red"><pre>h</pre></font>';
}

if (isset($_POST['register'])) {
    $post_name = $db->real_escape_string(e(@$_POST['name']));
    $post_email = $db->real_escape_string(e(@$_POST['email']));
    $post_phone = $db->real_escape_string(e(@$_POST['phone']));
    $post_user = $db->real_escape_string(e(@$_POST['user']));
    $post_pass = $db->real_escape_string(e(@$_POST['pass']));
    $post_pin = $db->real_escape_string(e(@$_POST['pin']));
    $post_reff = $db->real_escape_string(e(@$_POST['reff']));

    if (!$post_name || !$post_email || !$post_phone || !$post_user || !$post_pass || !$post_pin ||  !$post_reff) {
        $_SESSION['alert'] = ['danger', 'Failed!', 'Masih ada INFORMASI kosong.'];
    } elseif (filter_var($post_email, FILTER_VALIDATE_EMAIL) === false) {
        $_SESSION['alert'] = ['danger', 'Failed!', 'Email address tidak valid.'];
    
    } else {
        $check_email = $db->query("SELECT * FROM users WHERE email = '{$post_email}'");
        $check_phone = $db->query("SELECT * FROM users WHERE phone = '{$post_phone}'");
        $check_user = $db->query("SELECT * FROM users WHERE username = '{$post_user}'");

        $cek_refferal = $db->query("SELECT * FROM users WHERE refferal = '{$post_reff}'");
        $data_refferal = mysqli_fetch_assoc($cek_refferal);
        $cek_reff_rows = mysqli_num_rows($cek_refferal);
        $user_reff = $data_refferal['username'];

        if (mysqli_num_rows($check_email) >= 1) {
            $_SESSION['alert'] = ['danger', 'Failed!', 'Email sudah digunakan.'];
        } elseif (mysqli_num_rows($check_phone) >= 1) {
            $_SESSION['alert'] = ['danger', 'Failed!', 'Nomor Handphone sudah digunakan.'];
        } elseif (mysqli_num_rows($check_user) >= 1) {
            $_SESSION['alert'] = ['danger', 'Failed!', 'Username sudah digunakan.'];
        } else if ($cek_reff_rows == 1) { 
	    $_SESSION['alert'] = ['danger', 'Failed!', 'Harap Masukan Nama Store Dengan Benar. (RESELLER)'];
        } else {
            $password = password_hash($post_pass, PASSWORD_DEFAULT);
            $refferal = random(10);
            $uplink = !$post_reff ? 'website' : $post_reff;
            $api_key = random(30);
            $register_at = date("Y-m-d H:i:s");
            
            $insert_user = $db->query("INSERT INTO users VALUES('', '{$post_name}', '{$post_email}', '{$post_phone}', '{$post_user}', '{$password}', '0', '0', '0', '{$post_pin}', '', 'OFF', '{$refferal}', 'Member', 'active', 'YES', '{$uplink}', '{$api_key}', '', '', '0', '{$register_at}')");
            if ($insert_user === true) {                
                $_SESSION['alert'] = ['success', 'Berhasil Mendaftar!', 'Akun berhasil Didaftarkan, Silahkan Login.'];
                exit(header("Location: " . base_url('/auth/login')));
            } else {
                $_SESSION['alert'] = ['danger', 'Gagal!', 'Sistem Sedang Sibuk, Coba Kembali Dalam Waktu 5 Menit.'];
            }
        }
    }
}
