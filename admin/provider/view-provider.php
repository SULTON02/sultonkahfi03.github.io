<?php
require_once '../../mainconfig.php';

$id = $_GET['id'];
if(!isset($id))
    die('No direct script access allowed!');
$query = mysqli_query($db, "SELECT * FROM provider WHERE id = '$id'");
$q = mysqli_fetch_assoc($query); 
?>

<?php if ($q['id'] == '1') { ?>
<table style="font-size:0.8rem;border-collapse:separate;border-spacing:1px;">
        <tbody>
            <tr>
                <td>No Data From Provider</td>
            </tr>
        </tbody>
    </table>
    <hr>
    <div class="row">
        <div class="form-group col-12">
            <button type="button" class="btn btn-danger btn-block" data-dismiss="modal"> BACK </button>
        </div>
    </div>
</form>
<?php } ?>

<?php if ($q['code'] == 'MP') { ?>
<table style="font-size:0.8rem;border-collapse:separate;border-spacing:1px;">
        <?php 
        
        $data = lannProv('MP');
        $api_postdata = [
             'api_id' => $data['api_id'],
             'api_key' => $data['api_key']
        ];
        
        $curl = post_curl($data['link'].'profile',$api_postdata);
        $json_result = json_decode($curl, true);
	                
        ?>
        <tbody>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><?= $json_result['data']['username']; ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>: Connected</td>
            </tr>
        </tbody>
    </table>
    <hr>
    <div class="row">
        <div class="form-group col-12">
            <button type="button" class="btn btn-relief-danger btn-block" data-dismiss="modal"> BACK </button>
        </div>
    </div>
</form>
<?php } ?>

<?php if ($q['code'] == 'LP') { ?>
<table style="font-size:0.8rem;border-collapse:separate;border-spacing:1px;">
        <?php 
        
        $data = lannProv('LP');
        $api_postdata = [
             'api_id' => $data['api_id'],
             'api_key' => $data['api_key']
        ];
        
        $curl = post_curl($data['link'].'profile',$api_postdata);
        $json_result = json_decode($curl, true);
	                
        ?>
        <tbody>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><?= $json_result['data']['username']; ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>: Connected</td>
            </tr>
        </tbody>
    </table>
    <hr>
    <div class="row">
        <div class="form-group col-12">
            <button type="button" class="btn btn-relief-danger btn-block" data-dismiss="modal"> BACK </button>
        </div>
    </div>
</form>
<?php } ?>

<?php if ($q['code'] == 'BZ') { ?>
<table style="font-size:0.8rem;border-collapse:separate;border-spacing:1px;">
        <?php 
        
        $data = lannProv('BZ');
        $api_postdata = [
             'api_key' => $data['api_key'],
             'secret_key' => $data['secret_key']
        ];
        
        $curl = post_curl($data['link'].'profile',$api_postdata);
        $json_result = json_decode($curl, true);
	                
        ?>
        <tbody>
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><?= $json_result['data']['username']; ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>: Connected</td>
            </tr>
        </tbody>
    </table>
    <hr>
    <div class="row">
        <div class="form-group col-12">
            <button type="button" class="btn btn-relief-danger btn-block" data-dismiss="modal"> BACK </button>
        </div>
    </div>
</form>
<?php } ?>