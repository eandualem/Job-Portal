<?php
/**
 * Created by PhpStorm.
 * User: eandualem
 * Date: 6/20/18
 * Time: 5:37 AM
 */

class accept extends Controller
{
    function __construct()
    {
        parent::__construct();
    }


    public function accept()
    {

        $search_model = $this->loadModel('Employer');
        $rest = $search_model->accept();
        try {
            foreach( $rest as $value )
            {
                $this->render_result($value);
            }
        } catch (Exception $e) {
            throw new Exception("Error rendering result");
        }
    }

    private function render_result($rest){

        $result = json_decode($rest);

        $cetificate     = $result->cetificate;
        $major          = $result->major;
        $institute      = $result->institute;
        $stdate         = $result->stdate;
        $codate         = $result->codate;
        $gpa            = $result->gpa;
        $jobid          = $result->jobid;
        $name           = $result->name;
        $country        = $result->country;
        $city           = $result->city;
        $add            = $result->add;
        $email          = $result->email;
        $phone          = $result->phone;

        $x = "<div class='small_container'>
                    <div class='img_div'>
                        <img src='../../assets/img/person.png' class='img-rounded'>
                        <h3>$name</h3>
                    </div>
                    <div class='cont_div'>
                        <h3>Employee Education</h3>
                        <p>Certificate: $cetificate</p>
                        <p>Majore: $major</p>
                        <p>Institute: $institute</p>
                        <p>Started: $stdate </p>
                        <p>End: $codate</p>
                        <p>GPA: $gpa</p>
                    </div>
                    <div class='cont_div'>
                        <h3>Location</h3>
                        <p>Country: $country</p>
                        <p>Cilty: $city</p>
                        <p>Address: $add</p>
                        <p>email: $email</p>
                        <p>Phone: $phone</p>
                        <form action='apply.view' method='post'>
                            <input name='inpvalue' value=$jobid class='fade'>
                            <button  class='btn btn-outline acceptbtn' onclick=''> Accept </button>
                        </form>
                    </div>
                </div>";
        echo $x;
    }

}