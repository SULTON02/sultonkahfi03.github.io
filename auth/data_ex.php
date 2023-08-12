<?php
$dt_now = date('Y-m-d H:i:s');
$q = $db->query("SELECT * FROM dt_verif WHERE status = 'notvalid'");
while($f = mysqli_fetch_assoc($q)) {
    if ($dt_now >= $f['exp_code']) {
        $db->query("UPDATE dt_verif SET status = 'valid' WHERE id = '".$f['id']."'");
    }
}