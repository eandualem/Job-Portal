<div class="form container createAccount">
    <h2>Reset Your Password</h2>
    <div id="error">
        <?php
            #session_start();
            if(isset($_SESSION['message'])){
                 echo '<div class="alert alert-danger">'.$_SESSION['message'].'</div>';
            }
        ?>
    </div>

    <form action="forgot/forgot" method="POST">
        <div class="field-wrap">
            <label class="SearchLabel">
                Email Address
            </label>
            <input type="email" class="form-control" required autocomplete="off" name="email"/>
        </div>
        <button class="btn btn-outline" style="margin-top: 24px">Reset</button>
    </form>
</div>
