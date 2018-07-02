<?php

class View
{

    public function render_header()
    {
        require TEMPLATE_VIEWS_PATH . 'header.php';
    }

    public function render_footer()
    {
        require TEMPLATE_VIEWS_PATH . 'footer.php';
    }

    public function render_login_page($filename, $render_without_header_and_footer = false)
    {
        if ($render_without_header_and_footer == true) {
            require LOGIN_VIEWS_PATH . $filename . '.php';
        } else {
            require TEMPLATE_VIEWS_PATH . 'header.php';
            require LOGIN_VIEWS_PATH . $filename . '.php';
            require TEMPLATE_VIEWS_PATH . 'footer.php';
        }
    }
    public function render_employee_page($filename, $render_without_header_and_footer = false)
    {
        if ($render_without_header_and_footer == true) {
            require EMPLOYEE_VIEWS_PATH . $filename . '.php';
        } else {
            require TEMPLATE_VIEWS_PATH . 'header.php';
            require EMPLOYEE_VIEWS_PATH . $filename . '.php';
            require TEMPLATE_VIEWS_PATH . 'footer.php';
        }
    }
    public function render_employer_page($filename, $render_without_header_and_footer = false)
    {
        if ($render_without_header_and_footer == true) {
            require EMPLOYER_VIEWS_PATH . $filename . '.php';
        } else {
            require TEMPLATE_VIEWS_PATH . 'header.php';
            require EMPLOYER_VIEWS_PATH . $filename . '.php';
            require TEMPLATE_VIEWS_PATH . 'footer.php';
        }
    }

    public function renderFeedbackMessages()
    {
        require TEMPLATE_VIEWS_PATH . 'feedback.php';

        Session::set('feedback_positive', null);
        Session::set('feedback_negative', null);
    }


    private function checkForActiveController($filename, $navigation_controller)
    {
        $split_filename = explode("/", $filename);
        $active_controller = $split_filename[0];

        if ($active_controller == $navigation_controller) {
            return true;
        }
        // default return
        return false;
    }

    private function checkForActiveAction($filename, $navigation_action)
    {
        $split_filename = explode("/", $filename);
        $active_action = $split_filename[1];

        if ($active_action == $navigation_action) {
            return true;
        }
        // default return of not true
        return false;
    }


    private function checkForActiveControllerAndAction($filename, $navigation_controller_and_action)
    {
        $split_filename = explode("/", $filename);
        $active_controller = $split_filename[0];
        $active_action = $split_filename[1];

        $split_filename = explode("/", $navigation_controller_and_action);
        $navigation_controller = $split_filename[0];
        $navigation_action = $split_filename[1];

        if ($active_controller == $navigation_controller AND $active_action == $navigation_action) {
            return true;
        }
        // default return of not true
        return false;
    }
}
