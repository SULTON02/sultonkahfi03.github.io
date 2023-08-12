<?php
$dt_now = date('Y-m-d H:i:s');
$q = $db->query("SELECT * FROM deposit WHERE status = 'Pending'");
while($f = mysqli_fetch_assoc($q)) {
    if ($dt_now >= $f['tanggal_at']) {
        $db->query("UPDATE deposit SET status = 'Cancelled' WHERE id = '".$f['id']."'");
    }
}