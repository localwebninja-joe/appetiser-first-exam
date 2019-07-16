<?php

namespace App\Repositories\EventCalendar;

class EventCalendarEntity implements EventCalendarMapper
{   
    private $name;
    private $date_from;
    private $date_to;
    private $dow;
    
    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->date_from = $data['date_from'];
        $this->date_to = $data['date_to'];
        $this->dow = $data['dow'];
    }

    public function getFieldsInAssociativeArray() : array 
    {
        return get_object_vars($this);
    }
}