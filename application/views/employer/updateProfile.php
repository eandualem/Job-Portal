<div class="small_container">
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <img src="../../assets/img/person.png" alt="..." class="img-rounded">
            </div>
            <label class="control-label">
                <span style="font-weight: normal;"><?php if(isset($_SESSION['name'])){
                                                                       $s = $_SESSION['name'];
                                                                       echo $s; }?>
                </span>
            </label>
            <div class="input-group">
                <input accept="image/*" class="input-large" id="StudentPhoto" name="StudentPhoto" onchange="loadFile(event)" type="file" value>
            </div>
        </div>
        <div class="row">
            <form method="post">
                <h2>change basic info</h2>
                <div class="col-sm-4 ">
                    <div class="form-group">
                        <label for="text">user Name</label><br>
                        <input type="text" class="form-control" required >
                    </div>
                    <div class="form-group">
                        <label for="text">Phone</label>
                        <input type="text" class="form-control" required >
                    </div>
                    <div class="form-group">
                        <label for="text">city</label>
                        <input type="text" class="form-control" required >
                    </div>
                </div>
                <div class="form-group">
                    <label for="text">Country</label>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="input-group">
                <button type="submit" id="savePersonalDetails" class="btn btn-success margin-btn-sm"><i class="glyphicon glyphicon-ok-sign"></i>Update profile</button>
            </div>
        </div>
    </div>
</div>
</div>
