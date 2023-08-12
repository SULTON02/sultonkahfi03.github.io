<?php
session_start();
require_once '../mainconfig.php';
load('middleware', 'user');

if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') { ?>
<div class="row">
    <div class="col-12">
        <form method="POST" autocomplete="off">
            <div class="form-group">
                <blockquote class="blockquote pl-1 border-left-primary border-left-3">
          <p class="mb-0">Apakah Anda yakin untuk membatalkan invoice ini? Silakan masukan PIN dibawah ini.</p>
          <hr>
          <div class="form-group">
        <label>PIN</label>
        <input type="text" class="form-control" name="pin" onkeyup="this.value=this.value.replace(/[^\d]+/g,'')" placeholder="" minlength="6" maxlength="6" data-validation-required-message="This phone field is required" required>
    </div>
        </blockquote>
            </div>
            <div class="row">
                <div class="form-group col-6">
                    <button type="button" name="reset" class="btn btn-relief-danger btn-block" data-dismiss="modal"> Batal </button>
                </div>
                <div class="form-group col-6">
                    <button type="submit" name="cancel" class="btn btn-relief-primary btn-block"> Ya </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php } ?>
