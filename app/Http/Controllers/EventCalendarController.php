<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventCalendar;
use App\Repositories\EventCalendar\EventCalendarEntity;
use App\Repositories\EventCalendar\EventCalendarRepository;
use App\Repositories\EventCalendar\ResponseToEventCalendarCreation;
use Response;
use App\Repositories\EventCalendar\EventCalendarMapper;

class EventCalendarController extends Controller implements ResponseToEventCalendarCreation
{
    private $eventCalendarDb;
    public function __construct(EventCalendarRepository $eventCalendarDb) {
        $this->eventCalendarDb = $eventCalendarDb;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('event_calendar.index');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        return $this->eventCalendarDb->addEvents(new EventCalendarEntity($data), $this);
    }
    
    public function eventCalendarSuccessfullyAdded(EventCalendarMapper $responseData) {
        return Response::json(array('message' => 'successfully added', 'data' => $responseData->getFieldsInAssociativeArray()));
    }

    public function eventCalendarUnsuccessfullyAdded() {
        return Response::json(array('message' => 'unsuccessfully added'));
    }

}
