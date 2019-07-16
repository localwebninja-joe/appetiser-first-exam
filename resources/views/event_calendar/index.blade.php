
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Event Calendar</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
           
   
            .header-form {
                height: 30px;
                margin: 10px;
                border: 1px solid;
                padding: 10px;
                border-radius: 4px;
                padding-top: 15px !important;
                padding-bottom: 41px !important;
            }
            .form-content {
                width: 25%;
                float: left;
                margin-top: 60px;
                margin-left: 20px;
            }

            .form-content label {
                padding: 5px;
            }
            #calendar {
                width: 70%;
                float: right;
            }
            .btn-save {
                margin: 5px;
            }
            #ui-datepicker-div {
                border: 0px;
            }
        </style>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />
        
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>
     
        <h3 class="header-form jumbotron">Calendar</h3>
        
        <form class="form-content">
            Event:
            <input id="event-name" type="text" required  />
            <br />  <br />
            From:
            <input id="event-date-from" type="text" class="date" required />
        
            To:
            <input id="event-date-to" type="text" class="date" required  />
            <br /> <br />

            <label><input class="event-days-of-week" type="checkbox" value="sun">Sun</label>
            <label><input class="event-days-of-week" type="checkbox" value="mon">Mon</label>
            <label><input class="event-days-of-week" type="checkbox" value="tue">Tue</label>
            <label><input class="event-days-of-week" type="checkbox" value="wed">Wed</label>
            <label><input class="event-days-of-week" type="checkbox" value="thu">Thu</label>
            <label><input class="event-days-of-week" type="checkbox" value="fri">Fri</label>
            <label><input class="event-days-of-week" type="checkbox" value="sat">Sat</label>
            
            <br /> 
            <input id="event-save-btn" class="btn btn-save btn-primary" type="submit" value="Save" />
        </form>


        <div id='calendar'></div>

        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
        
        
        <script>
            
            $(document).ready(function() {
                $('.date').datepicker({
                    autoclose: true,
                    dateFormat: "yy-mm-dd"
                });
                
                var  calendar = $('#calendar');
                var initEvents = function (start, end, dow, title) {
                    calendar.fullCalendar({
                        eventRender: function(event, element, view) {

                            var theDate = event.start
                            var endDate = event.dowend;
                            var startDate = event.dowstart;

                            if (theDate > endDate) {
                                    return false;
                            }

                            if (theDate < startDate) {
                                return false;
                            }

                        },
                        events: [{                        
                            dow: [],
                            title : '',
                            dowstart: new Date(),
                            dowend: new Date()
                        }]
                    });
                };
                initEvents();
                var loadEvents = function (start, end, dow, title) {
                    calendar.fullCalendar('removeEvents');
                    calendar.fullCalendar('addEventSource', [
                        {                        
                            dow: dow,
                            title : title,
                            dowstart: start,
                            dowend: end
                        }
                    ]);  
                    calendar.fullCalendar('refetchEvents');
                };
                

                $('#event-save-btn').click(function (event) {
                    if ($('#event-name').val() !== '' && 
                        $('#event-date-from').val() !== '' && 
                        $('#event-date-to').val() !== '') {
                        event.preventDefault();
                    }
                    var dow = [];
                    $('.event-days-of-week').each(function( index ) {
                        if ($(this)[0].checked) {
                            dow.push(index);
                        }
                    });
                    
                    var data = {
                        "_token": "{{ csrf_token() }}",
                        name: $('#event-name').val(),
                        date_from: $('#event-date-from').val(),
                        date_to: $('#event-date-to').val(),
                        dow: JSON.stringify(dow)
                    };
                    
                    $.ajax({
                        url: "/event-calendar",
                        method: "POST",
                        data: data,
                        dataType: "json"
                    }).then(function (res) {
                        if (res.message === 'successfully added') {
                            var start = new Date(res.data.date_from);
                            var end = new Date(res.data.date_to);
                            var dow = res.data.dow;
                            var title = res.data.name;
                            loadEvents(start, end, dow, title);
                        }
                    });

                });


            });
        </script>

    </body>
</html>

