<?php

class search extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function search()
    {
        $num = $_POST["num_result"];
        $table = $_POST["search_table"];
        $jt = $_POST["JobType"];
        $lc = $_POST["Location"];
        $sr = $_POST["SkillRequired"];
        $ed = $_POST["EdQl"];

        $search_model = $this->loadModel('employee');
        $rest = $search_model->search($this->prepare_sql($num, $table, $jt, $lc, $sr, $ed));

        foreach( $rest as $value )
        {
            $this->render_result($value);
        }
    }

    public function apply()
    {
        $search_model = $this->loadModel('employee');
        $res = $search_model->apply();

        if($res)
        {
            echo "Application sent successfully";
        }
        else {
            echo "FAiled";
        }
    }

    public function accepted()
    {
        $search_model = $this->loadModel('employee');
        $rest = $search_model->accepted();
        echo count($rest);

        foreach( $rest as $value )
        {
            $this->render_result($value);
        }

    }

    public function former()
    {
        $search_model = $this->loadModel('employee');
        $rest = $search_model->former();
        echo count($rest);

        foreach( $rest as $value )
        {
            $this->render_result($value);
        }
    }


    public function prepare_sql($num, $table, $jt, $lc, $sr, $ed)
    {
        $sql = "SELECT * FROM $table ";
        if ($jt != "Any") {

            $sql .= "WHERE JobType LIKE '" . $jt . "'";

            if ($lc != "Any" OR $sr != "Any" OR $ed != "Any") {
                $sql .= " AND ";
            }
        }
        if ($lc != "Any") {
            if ($jt == "Any") {
                $sql .= "WHERE ";
            }

            $sql .= "Joblocation LIKE '" . $lc . "' ";

            if ($sr != "Any" OR $ed != "Any") {
                $sql .= " AND ";
            }
        }
        if ($sr != "Any") {
            if ($jt == "Any" AND $lc == "Any") {
                $sql .= "WHERE ";
            }

            $sql .= "SkillRequired LIKE '" . $sr . "' ";

            if ($ed != "Any") {
                $sql .= " AND ";
            }
        }
        if ($ed != "Any") {
            if ($jt == "Any" AND $lc == "Any" AND $sr == "Any") {
                $sql .= "WHERE ";
            }

            $sql .= "Educationalqualificationrequired LIKE '" . $ed . "'";
        }
        $sql .= " LIMIT " . $num;

        return $sql;

    }

    private function render_result($rest){

        $result = json_decode($rest);

        $type = $result->type;
        $cdate = $result->cdate;
        $desc = $result->desc;
        $loc = $result->loc;
        $skill = $result->skill;
        $educ = $result->educ;
        $jobid = $result->jobid;
        $name = $result->name;
        $country = $result->country;
        $city = $result->city;
        $add = $result->add;
        $email = $result->email;
        $phone = $result->phone;

        $x = "<div class='small_container'>
                    <div class='img_div'>
                        <img src='../../assets/img/person.png' class='img-rounded'>
                        <h3>".$name."</h3>
                    </div>
                    <div class='cont_div'>
                        <h3>Job Description</h3>
                        <p>Job type: $type</p>
                        <p>Posted Date: $cdate</p>
                        <p>Description: $desc</p>
                        <p>Required skill set: $skill </p>
                        <p>Educational Qualification: $educ</p>
                    </div>
                    <div class='cont_div'>
                        <h3>Location</h3>
                        <p>Country: $country</p>
                        <p>Cilty: $city</p>
                        <p>Location: $loc</p>
                        <p>Address: $add</p>
                        <p>email: $email</p>
                        <p>Phone: $phone</p>
                        <div>
                            <input name='inpvalue' value=$jobid class='fade' id='scrt'>
                            <button  class='btn btn-outline applybtn' id='apply_for_job'> Apply </button>
                        </div>
                            <div id=\"applicationResult\">
                                <!--Ajax Data Here-->
                            </div>
                    </div>
                </div>";
        echo $x;
    }
    
}

