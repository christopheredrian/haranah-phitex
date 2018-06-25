<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Event;
use App\EventParam;
use App\FinalSchedule;
use App\Seller;
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
        $event = Event::find($event_id);
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

    public function downloadPdf($event_id)
    {
        //$event_id, $user_id
        $view = 'reports.events.admin';

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
        $event_name = Event::find($event_id)->event_name;

        // filter data that is being passed to view
        if (Auth::user()->hasRole('superadmin') || Auth::user()->hasRole('admin')) {
            return view($view, [
                'event' => Event::find($event_id),
                'event_params' => EventParam::where('event_id', '=' , $event_id)->get(),
                'final_schedules' => FinalSchedule::where('event_id', '=' , $event_id)->get(),
            ]);
        } elseif (Auth::user()->hasRole('buyer')) {
            $auth_buyer = Buyer::where('user_id', '=', Auth::user()->id)->first();

            return view($view, [
                'event' => Event::find($event_id),
                'final_schedules' => FinalSchedule::where('buyer_id', '=' , $auth_buyer->id)
                    ->where('event_id', '=', $event_id)->get(),
            ]);
        } elseif (Auth::user()->hasRole('seller')) {
            $auth_seller = Seller::where('user_id', '=', Auth::user()->id)->first();

            return view($view, [
                'event' => Event::find($event_id),
                'event_params' => EventParam::where('event_id', '=' , $event_id)->get(),
                'final_schedules' => FinalSchedule::where('seller_id', '=' , $auth_seller->id)
                    ->where('event_id', '=', $event_id)->get()
            ]);
        }
    }
}