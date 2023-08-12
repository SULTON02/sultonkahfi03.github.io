<?php
$time = date('H:i:s');
$q = $db->query("SELECT * FROM metode_depo WHERE status = 'on'");
while($f = mysqli_fetch_assoc($q)) {
    if ($time >= $f['off_at']) {
        $db->query("UPDATE metode_depo SET status = 'off' WHERE id = '{$f['id']}'");
    }
}