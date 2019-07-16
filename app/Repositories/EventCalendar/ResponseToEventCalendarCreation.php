<?php

namespace App\Repositories\EventCalendar;



interface ResponseToEventCalendarCreation
{
    
    public function eventCalendarSuccessfullyAdded(EventCalendarMapper $responseData);

    public function eventCalendarUnsuccessfullyAdded();
    
}