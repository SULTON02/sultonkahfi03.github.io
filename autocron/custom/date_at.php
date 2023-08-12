<?php
$dualtime = date('Y-m-d H:i:s');
$q = $db->query("SELECT * FROM pembelian_pulsa WHERE tanggal_at = '0000-00-00 00:00:00'");
while($f = mysqli_fetch_assoc($q)) {
        $db->query("UPDATE pembelian_pulsa SET tanggal_at = '{$dualtime}' WHERE id = '{$f['id']}'");
        }