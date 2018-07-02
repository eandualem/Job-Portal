<div class='container' >
    <div id='login'>
        <h2>
            Login Form
        </h2>
        <form class='form-horizontal' action="login/login" method='post'>
            <div id="error">
                <?php
                #session_start();
                if(isset($_SESSION['message'])){
                    echo '<div class="alert alert-danger">'.$_SESSION['message'].'</div>';
                }
                ?>
            </div>
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
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="Email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="Check" value="1"> <span>Remember me</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-outline" id="signbtn">Sign in</button>
                </div>
            </div>
        </form>
        <div id="forgot">
            <a href="forgot/forgot" class="btn btn-outline">Forget Your Password</a>
            <a href="register/register" class="btn btn-outline">Create an account</a>
        </div>
    </div>
</div>
