<?php

namespace App\Http\Controllers;

use App\Buyer;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function downloadPdf()
    {
        //$event_id, $user_id
        $view = 'reports.events.admin';
        // dd(Auth::user()->hasRole('superadmin'));

        if (Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')) {
            $view = 'reports.events.admin';
        } elseif (Auth::user()->hasRole('buyer')) {
            $view = 'reports.events.buyer';
        } elseif (Auth::user()->hasRole('seller')) {
            $view = 'reports.events.seller';
        } else{
            abort(404);
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView($view, ['buyer' => Buyer::all()->first()]);
        return $pdf->download('invoice.pdf');
    }
}
