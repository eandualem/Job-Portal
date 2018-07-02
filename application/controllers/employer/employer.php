<?php
/**
 * Created by PhpStorm.
 * User: eandualem
 * Date: 6/9/18
 * Time: 1:27 PM
 */

class employer extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->render_header();

        echo " <div class='container' > <aside>";

        $this->view->render_employer_page('asside', true);

        echo " </aside> <div class='tab-content'> <div id='employer' class='jobSearch tab-pane fade in active'> ";

        $this->view->render_employer_page('addNewVacancies', true);

        echo " </div> <div id='menu1' class='jobSearch tab-pane fade'>";

        $this->view->render_employer_page('updateVacancies', true);

        echo " </div> <div id='menu2' class='jobSearch tab-pane fade'> ";

        $this->view->render_employer_page('acceptAppliedEmployee', true);

        echo " </div> <div id='menu3' class='jobSearch tab-pane fade'> ";

        $this->view->render_employer_page('formerEmployees', true);

        echo " </div> <div id='menu4' class='jobSearch tab-pane fade'> ";

        $this->view->render_employer_page('updateProfile', true);

        echo " </div> </div> </div> ";

        $this->view->render_footer();

    }
}