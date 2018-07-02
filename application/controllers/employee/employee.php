<?php
/**
 * Created by PhpStorm.
 * User: eandualem
 * Date: 6/9/18
 * Time: 1:27 PM
 */

class employee extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->render_header();

            echo " <div class='container' > <aside>";

            $this->view->render_employee_page('asside', true);

            echo " </aside> <div class='tab-content'> <div id='employer' class='jobSearch tab-pane fade in active'> ";

            $this->view->render_employee_page('search_vacancies', true);

            echo " </div> <div id='menu1' class='jobSearch tab-pane fade'>";

            $this->view->render_employee_page('jobs_by_category', true);

            echo " </div> <div id='menu2' class='jobSearch tab-pane fade'>";

            $this->view->render_employee_page('jobs_by_location', true);

            echo " </div> <div id='menu3' class='jobSearch tab-pane fade'> ";

            $this->view->render_employee_page('accepted_application', true);

            echo " </div> <div id='menu4' class='jobSearch tab-pane fade'> ";

            $this->view->render_employee_page('former_employer', true);

            echo " </div> <div id='menu5' class='jobSearch tab-pane fade'> ";

            $this->view->render_employee_page('update_profile', true);

            echo " </div> </div> </div> ";

        $this->view->render_footer();

    }
}