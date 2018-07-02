<div class="container createAccount">
    <h2>Final Step</h2>
    <h2>Fill Employer Detail</h2>
    <div id="error">
        <?php
            if(isset($_SESSION['message'])){
            echo '<div class="alert alert-danger">'.$_SESSION['message'].'</div>';
        }
        ?>
    </div>
    <form role="form" action="<?php echo URL; ?>register_employer/register" method="POST">
        <div class="form-group">
            <label for="text">user Name:</label>
            <input type="text" class="form-control" name="UserName" required>
        </div>

        <div class="form-group">
            <label for="pwd">create Password:</label>
            <input type="password" class="form-control" name="Password" required>
        </div>

        <div class="form-group">
            <label for="pwd">confirm Password:</label>
            <input type="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="text">ENTER EMAIL</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="form-group">
            <label for="text">postal/Zip code:</label>
            <input type="text" class="form-control" name="Postal" required>
        </div>

        <div class="form-group">
            <label for="text">Country:</label>
            <input type="text" class="form-control" name="Country" required>
        </div>

        <div class="form-group">
            <label for="text">Region:</label>
            <input type="text" class="form-control" name="Region" required>
        </div>

        <div class="form-group">
            <label for="text">city:</label>
            <input type="text" class="form-control" name="City" required>
        </div>

        <div class="form-group">
            <label for="text">Adress:</label>
            <input type="text" class="form-control" name="Address" required>
        </div>

        <div class="form-group">
            <label for="text">Phone:</label>
            <input type="text" class="form-control" name="Phone" required>
        </div>
        <div>
            <input type="submit" value="REGISTER" class="btn btn-outline">
        </div>
    </form>
</div>