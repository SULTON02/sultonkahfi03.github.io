<?php
$time = date('H:i:s');
$q = $db->query("SELECT * FROM metode_depo WHERE status = 'off'");
while($f = mysqli_fetch_assoc($q)) {
    if ($time >= $f['on_at']) {
        $db->query("UPDATE metode_depo SET status = 'on' WHERE id = '{$f['id']}'");
   }
}