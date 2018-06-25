<html>
<head>
    <link href="/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            page-break-inside: auto
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto
        }

        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-footer-group
        }

        @media print {
            @page {
                margin: 0.5in;
                /*size: 7in 9.25in;*/
                size: auto;
            }
        }

        td {
            font-size: 80%;
        }
    </style>
</head>

<body>
<div class="text-center">
    <h3>Philippine Travel Exchange</h3>
    <hr>
    <h4>Schedule of Events</h4>
    <h4>{{date("F j, Y", strtotime($event->event_date))}}</h4>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-xs-12 text-center">
            <div class="table-responsive">
                <table border="1" class="table">

                    <thead>
                    <tr>
                        <th class="text-center"> #</th>
                        <th class="text-center">Time</th>
                        <th class="text-center">Buyer</th>
                        <th class="text-center">Table</th>
                        <th class="text-center">Signature</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $counter = 1;
                    @endphp

                    @foreach($final_schedules as $final_schedule)
                        <tr>
                            <td class="text-center">{{$counter}}</td>
                            <td class="text-center">{{date("H:i A", strtotime($final_schedule->eventParam()->first()->start_time)) . ' - ' . date("H:i A", strtotime  ($final_schedule->eventParam()->first()->end_time))}} </td>
                            <td>
                                <strong>
                                    {{strtoupper($final_schedule->buyer()->first()->event_rep1)}}
                                    {{strtoupper($final_schedule->buyer()->first()->event_rep2 ? ', ' . $final_schedule->buyer()->first()->event_rep2 : '')}}
                                </strong>
                                <br>
                                <i>{{$final_schedule->buyer()->first()->company_name}}
                                    - {{$final_schedule->buyer()->first()->country}}</i>
                            </td>
                            <td class="text-center"><strong>{{$final_schedule->table}}</strong></td>
                            <td></td>
                        </tr>

                        @php
                            $counter++;
                        @endphp
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{--<div class="col-xs-2"></div>--}}
    </div>
</div>
<script>
    window.onload = function () {
        window.print();
    }
</script>
</body>
</html>

