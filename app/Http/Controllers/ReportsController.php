<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    // Must be authenticated for all of these routes


    /**
     * Download the file for the schedule at a particular event
     * @param $event_id
     */
    public function downloadSchedule($event_id, $file_type = 'xls')
    {
        Excel::create('EventName-Schedule', function ($excel) use ($event_id) {

            // Set the title
            $excel->setTitle('Event Name');

            // Chain the setters
            $excel->setCreator('Haranah')
                ->setCompany('Haranah');


            $excel->sheet('Final Schedule', function ($sheet) use ($event_id) {
                $sheet->setOrientation('landscape');
                $sheet->fromArray(array(
                    array('data1', 'data2'),
                    array('data3', 'data4')
                ));

            });

        })->download('xls');;
    }
}
