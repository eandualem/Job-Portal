<div class="form container createAccount">
    <h2>Step 1</h2>
    <h2>Select User Type</h2>
    <div id="error">
        <?php
            #session_start();
            if(isset($_SESSION['message'])){
                 echo '<div class="alert alert-danger">'.$_SESSION['message'].'</div>';
            }
        ?>
    </div>
    <form action="<?php echo URL; ?>register/register" method="POST">
        <div class="form-group">
            <label for="disabledSelect" class="col-sm-2 control-label">User</label>
            <div class="col-sm-10">
                <select id="disabledSelect" class="form-control" name="UserType">
                    <option>employee</option>
                    <option>employer</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-outline" id="signbtn">Continue</button>
            </div>
        </div>
    </form>
</div>
