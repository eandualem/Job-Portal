// search
$(document).ready(function(){
    let num_result = 0;

    $("#searchbtn").click( function(){
        num_result += 3;
        let JobType = document.getElementById("JobType");
        let Location = document.getElementById("Location");
        let SkillRequired = document.getElementById("SkillRequired");
        let EdQl = document.getElementById("EdQl");

        $(this).text("MORE");
        $("#SearchResult").load("http://localhost:8888/jobportal/search/search", {
            num_result : num_result,
            search_table: "job",
            JobType: JobType.options[JobType.selectedIndex].value,
            Location: Location.options[Location.selectedIndex].value,
            SkillRequired: SkillRequired.options[SkillRequired.selectedIndex].value,
            EdQl: EdQl.options[EdQl.selectedIndex].value
        });
    });
});
//by Category
$(document).ready(function(){
    let num_result = 0;

    $("#searchbycategotybtn").click( function(){
        let JobType = document.getElementById("JobType2");
        num_result += 4;
        $("#SearchResult2").load("http://localhost:8888/jobportal/search/search", {
            num_result : num_result,
            search_table: "job",
            JobType: JobType.options[JobType.selectedIndex].value,
            Location: "Any",
            SkillRequired: "Any",
            EdQl: "Any"
        });
    });
});
//by Location
$(document).ready(function(){
    let num_result = 0;

    $("#searchbylocationbtn").click( function(){
        num_result += 4;
        let Location = document.getElementById("Location2");
        //alert(lc);
        $("#SearchResult3").load("http://localhost:8888/jobportal/search/search", {
            num_result : num_result,
            search_table: "job",
            JobType: "Any",
            Location: Location.options[Location.selectedIndex].value,
            SkillRequired: "Any",
            EdQl: "Any"
        });
    });
});

$(document).ready(function(){
    $("#apply_for_job").click( function(){
        let job_id = document.getElementById("scrt");
        alert(job_id.value);
        $("#applicationResult").load("http://localhost:8888/jobportal/search/apply", {
            JOBID: job_id.value
        });
    });
});


$(document).ready(function(){
    $("#acceptedbtn").click(function () {
        $("#acceptedContainer").load("http://localhost:8888/jobportal/search/accepted");
            //alert("status");
        });

});
//Former Employer
$(document).ready(function(){
    $("#formerbtn").click(function () {
        $("#formerContainer").load("http://localhost:8888/jobportal/search/former");
        //alert("status");
    });
});

// Add Vacancies
$(document).ready(function(){
    $("#addVacancies").click(function () {
        let JobName = document.getElementById("JobName");
        let SkillReq = document.getElementById("SkillReq");
        let MinRate = document.getElementById("MinRate");
        let MinSalary = document.getElementById("MinSalary");
        let Job_type_entered = document.getElementById("Job_type_entered");
        let NoEmp = document.getElementById("NoEmp");
        let MaxRate = document.getElementById("MaxRate");
        let MaxSalary = document.getElementById("MaxSalary");
        let Description = document.getElementById("description");


        $("#AddVacanciesResult").load("http://localhost:8888/jobportal/addVacancies/former", {
            JobName: JobName.value,
            SkillReq: SkillReq.value,
            MinRate: MinRate.value,
            MinSalary: MinSalary.value,
            Job_type_entered: Job_type_entered.options[Job_type_entered.selectedIndex].value,
            NoEmp: NoEmp.value,
            MaxRate: MaxRate.value,
            MaxSalary: MaxSalary.value,
            Description: Description.value
        });
    });
});

$(document).ready(function(){
    $("#applicationsbtn").click(function () {
        $("#applicationsContainer").load("http://localhost:8888/jobportal/accept/accept");
        //alert("status");
    });
});
//Former Employee
$(document).ready(function(){
    $("#formerempbtn").click(function () {
        $("#formerempContainer2").load("http://localhost:8888/jobportal/former/former_employee");
        //alert("status");
    });
});