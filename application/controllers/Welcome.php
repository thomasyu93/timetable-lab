<?php

/**
 * Our homepage. Show the most recently added quote.
 * 
 * controllers/Welcome.php
 *
 * ------------------------------------------------------------------------
 */
class Welcome extends Application {

    function __construct() {
        parent::__construct();
        $this->load->model('TimeSchedule');
        //$this->load->model('order');
    }

    //-------------------------------------------------------------
    //  Homepage: show a list of the orders on file
    //-------------------------------------------------------------

    function index() {
        // Build a list of orders

        $this->data["daysofweek"] = $this->TimeSchedule->getDays();
//        $temp=$this->TimeSchedule->getDays();
//        var_dump($temp);

        $this->data['timeslots'] = $this->TimeSchedule->getTimeslots();

        $this->data['courses'] = $this->TimeSchedule->getCourses();

        $this->data['pagebody'] = 'homepage';
        $this->render();
    }

    function search(){
        $timeslotSelected = $this->input->post('timeslots');
        $daySelected = $this->input->post('days');

        $timeslotArray = $this->TimeSchedule->getTimeslotForDropdown();
        $timeslotSelected = $timeslotArray[$timeslotSelected];

        $dayArray = $this->TimeSchedule->getDayForDropdown();
        $daySelected = $dayArray[$daySelected];

        $dayResults = $this->TimeSchedule->searchDays($timeslotSelected, $daySelected);
        $timeslotResults = $this->TimeSchedule->searchTimeslots($timeslotSelected, $daySelected);
        $courseResults = $this->TimeSchedule->searchCourses($timeslotSelected, $daySelected);

        var_dump($dayResults);
        var_dump($timeslotResults);
        var_dump($courseResults);

        //check that the search returned only one booking for each facet
        if(count($dayResults) == 1 && count($timeslotResults) == 1 && count($courseResults) == 1){

        }
    }
}
