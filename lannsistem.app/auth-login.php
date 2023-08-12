<?php if (!isset($db)) {print '<font color="red"><pre>sistem custom</pre></font>';}

function CurL($url){
    $session = curl_init();
    curl_setopt($session, CURLOPT_URL, $url);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);
    $hasil = curl_exec($session);
    curl_close($session);
    //print_r($hasil);
    $res = json_decode($hasil, true);
    return $res;
}
$ip = $_SERVER['REMOTE_ADDR'];
$sumber = CurL('http://www.geoplugin.net/json.gp?ip=' . $_SERVER['REMOTE_ADDR']);

if (isset($_COOKIE['cookie_token'])) {
    $data = $db->query("SELECT * FROM users WHERE cookie_token = '{$_COOKIE['cookie_token']}'");
    if (mysqli_num_rows($data) > 0) {
        $hasil = mysqli_fetch_assoc($data);
        $_SESSION['user'] = $hasil;
        redirect(0, base_url());
    }
}
if (isset($_POST['login'])) {
    $post_user = $db->real_escape_string(e(@$_POST['user']));
    $post_pass = $db->real_escape_string(e(@$_POST['pass']));

    $check_use = $db->query("SELECT * FROM users WHERE username = '{$post_user}'");
        $data_use = $check_use->fetch_assoc();
        $vr_us = $data_use['verif'];

    if (!$post_user || !$post_pass) {
        $_SESSION['alert'] = ['danger', 'Failed!', 'Masih ada form kosong.'];
    } elseif ($vr_us == 'NO') {
        $_SESSION['alert'] = ['danger', 'Failed!', 'Akun anda belum diverifikasi.'];
    } else {
        $check_user = $db->query("SELECT * FROM users WHERE username = '{$post_user}'");
        if (mysqli_num_rows($check_user) == 0) {
            $_SESSION['alert'] = ['danger', 'Failed!', 'Account not registered.'];
        } else {
            $data_user = $check_user->fetch_assoc();
            if (password_verify($post_pass, $data_user['password']) === false) {
                $_SESSION['alert'] = ['danger', 'Failed!', 'Invalid Password.'];
            } else {
                $create_token = md5(uniqid(random(50), true));
                $remember = isset($_POST['remember']) ? true : false;
                if ($remember == true) {
                    $cookie_token = md5(uniqid(random(50), true));
                    $db->query("UPDATE users SET cookie_token = '{$cookie_token}' WHERE username = '{$post_user}'");
                    setcookie('cookie_token', $cookie_token, time() + 60 * 60 * 60 * 60 * 60, '/');
                }
                if ($remember == false) {
                    $cookie_token = md5(uniqid(rand(), true));
                    $db->query("UPDATE users SET cookie_token = '0' WHERE username = '{$post_user}'");
                    setcookie('cookie_token', $cookie_token, time() + 60, '/');
                }
                $address = $_SERVER['REMOTE_ADDR'];
                $login_at = date('Y-m-d H:i:s');

                $db->query(
                    "INSERT INTO user_notifications VALUES('','{$data_user['username']}', 'Welcome back','{$address}','{$_SERVER['HTTP_USER_AGENT']}', '" .
                        $sumber['geoplugin_city'] .
                        " " .
                        $sumber['geoplugin_countryCode'] .
                        "', '', '','{$login_at}')"
                );
                $db->query("INSERT INTO agent VALUES('', '{$device}','" . get_client_browser() . "')");
                $db->query("UPDATE users SET token = '{$create_token}' WHERE username = '{$post_user}'");
                $_SESSION['user'] = $data_user;
                $_SESSION['alert'] = ['success', 'Success!', 'Welcome, ' . e($data_user['username']) . '.'];
                redirect(1, base_url());
            }
        }
    }
}
