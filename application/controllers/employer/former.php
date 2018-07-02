<?php
/**
 * Created by PhpStorm.
 * User: eandualem
 * Date: 6/21/18
 * Time: 4:25 AM
 */

class former extends Controller
{
    public function former_employee()
    {
        $search_model = $this->loadModel('employer');
        $rest = $search_model->former();

        foreach( $rest as $value )
        {
            $this->render_result($value);
        }
    }

    private function render_result($rest){

        $result = json_decode($rest);

        $name = $result->name;
        $country = $result->country;
        $city = $result->city;
        $add = $result->add;
        $email = $result->email;
        $phone = $result->phone;

        $x = "<div class='small_container'>
                    <div class='img_div'>
                        <img src='../../assets/img/person.png' class='img-rounded'>
                        <h3>$name</h3>
                    </div>
                    <div class='cont_div'>
                        <h3>Location</h3>
                        <p>Country: $country</p>
                        <p>Cilty: $city</p>
                        <p>Address: $add</p>
                        <p>email: $email</p>
                        <p>Phone: $phone</p>
                        <form action='apply.view' method='post'>
                            <input name='inpvalue' value='".$empid."' class='fade'>
                            <button  class='btn btn-outline applybtn' onclick=''> Apply </button>
                        </form>
                    </div>
                </div>";
        echo $x;
    }

}