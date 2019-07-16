<?php

namespace App\Repositories\EventCalendar;



interface EventCalendarRepository
{
    
    public function addEvents(EventCalendarMapper $eventCalendarMapper, ResponseToEventCalendarCreation $listener);
}