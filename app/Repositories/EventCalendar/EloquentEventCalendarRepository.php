<?php

namespace App\Repositories\EventCalendar;
use App\EventCalendar;

class EloquentEventCalendarRepository implements EventCalendarRepository
{   
    private $eventCalendar;

    public function __construct(EventCalendar $eventCalendar) {
        $this->eventCalendar = $eventCalendar;
    }

    public function addEvents(EventCalendarMapper $eventCalendarMapper, ResponseToEventCalendarCreation $listener) {
        $this->eventCalendar->fill($eventCalendarMapper->getFieldsInAssociativeArray());
        if ($this->eventCalendar->save()) {
            return $listener->eventCalendarSuccessfullyAdded(new EventCalendarEntity($this->eventCalendar->toArray()));
        } else {
            return $listener->eventCalendarUnsuccessfullyAdded();
        }
    }
}