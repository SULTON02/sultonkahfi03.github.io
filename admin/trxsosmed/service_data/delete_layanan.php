<?php
require_once '../../../mainconfig.php';

$id = $_GET['id'];
if(!isset($id))
    die('No direct script access allowed!');
$query = mysqli_query($db, "SELECT * FROM layanan_sosmed WHERE id = '$id'");
$q = mysqli_fetch_assoc($query); 
?>

<form method="POST">
<div class="row">
      <div class="col-12 mt-2">
            <blockquote class="blockquote pl-1 border-left-primary border-left-3">
                <p class="mb-0">Apakah anda yakin untuk menghapus layanan ini?</p>
                <hr>
   <div class="form-group">
        <label>ID</label>
        <input type="text" class="form-control" name="id" value="<?= $q['id']; ?>" Readonly>
    </div>
        <div class="form-group">
        <label>Layanan</label>
        <input type="text" class="form-control" value="<?= $q['layanan']; ?>" Readonly>
    </div>
    <div class="form-group">
        <label>Provider</label>
        <input type="text" class="form-control" value="<?= $q['provider']; ?>" Readonly>
    </div>
           </blockquote>    
        </div>

<div class="col-md-6 col-12 mt-2 text-center">
            <button type="button" class="btn btn-block btn-danger" data-dismiss="modal">BACK</button>
        </div><div class="col-md-6 col-12 mt-2 mb-2 text-center">
            <button type="submit" name="delete" class="btn btn-block btn-success">DELETE</button>
        </div></div>
        </form>
        
