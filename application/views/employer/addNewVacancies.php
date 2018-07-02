<div class="row">
    <form method="post" action="addvacancy.php">

        <div class="col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="contol-label">Job Name</label>
                <div class="input-group">
                    <input class="form-control" id="JobName" name="JobName" type="text" value="" required>
                </div>
            </div>
            <div class="form-group">
                <label class="contol-label">Skill Required</label>
                <div class="input-group">
                    <input class="form-control" id="SkillReq" name="SkillRequired" required type="text" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="contol-label">Minimum Rate/hour (Birr) (optional)</label>
                <div class="input-group">
                    <input class="form-control" id="MinRate" name="MinimumRate" type="text" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="contol-label">Minimum salary/month (Birr) (optional)</label>
                <div class="input-group">
                    <input class="form-control" id="MinSalary" name="MinimumSalary"  type="text" value="">
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="contol-label">Job Type (optional)</label>
                <br>
                <select class="form-group" name="length" id="Job_type_entered">
                    <option>Temporal</option>
                    <option>Permanent</option>
                    <option>Part-time</option>
                </select>
            </div>
            <div class="form-group">
                <label class="contol-label">Number of Employees</label>
                <div class="input-group">
                    <input class="form-control" id="NoEmp" name="NoEmployee" required     type="number" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="contol-label">Maximum Rate/hour (Birr) (optional)</label>
                <div class="input-group">
                    <input class="form-control" id="MaxRate" name="MaximumRate" type="text" value="">
                </div>
            </div>
            <div class="form-group">
                <label class="contol-label">Maximum salary/month (Birr) (optional)</label>
                <div class="input-group">
                    <input class="form-control" id="MaxSalary" name="MaximumSalary" type="text" value="">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label class="contol-label">Description</label>
                <div>
                    <textarea id="description" name="description" style="min-height:150px; min-width:800px;"></textarea>
                </div>
            </div>
        </div>
        <input class="btn btn-outline" id="addVacancies" style="margin-left:20px;" value="Add Vacancy">
    </form>
    <div id="AddVacanciesResult">
        <!--Ajax Data Here-->
    </div>
</div>

