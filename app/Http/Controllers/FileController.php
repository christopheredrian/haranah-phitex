<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Event;
use App\EventBuyer;
use App\EventSeller;
use App\Seller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;


class FileController extends Controller
{
    public function importBuyersOrSellers(Request $request){
        $path = $request->file('file')->getRealPath();
        $data = Excel::load($path, function($reader) {})->get();
        $event_id = $request->event_id;
        $event_name = Event::find($event_id)->first()->event_name;
        $user_type = $request->user_type;

        // Import to USERS table
        if(!empty($data) && $data->count()){

            // NOTE: Because of unclear requirements, the need to filter out
            //       this process is still unsure
            //
            //Example : What does the excel file contain? Is it only the email?

            foreach ($data->toArray() as $row) {
                if (!empty($row)) {
                    $dataImported[] =
                        [
                            'last_name' => $row['last_name'],
                            'first_name' => $row['first_name'],
                            'email' => $row['email'],
                            'role' => 'buyer',
                            'activated' => 0,
                        ];

                    $importedUsers[] = $row['email'];
                }
            }
        }

        User::insert($dataImported);
        $buyerCount = count($dataImported);

        // Import to BUYERS or SELLERS table
        if($user_type == 'buyer'){
            foreach ($importedUsers as $importedBuyer){
                $buyer_user_id = User::where('email', '=', $importedBuyer)->first()->id;
                $buyer = new Buyer();
                $buyer->user_id = $buyer_user_id;
                $buyer->save();

                $event_buyer = new EventBuyer();
                $event_buyer->event_id = $event_id;
                $event_buyer->buyer_id = $buyer->id;
                $event_buyer->save();
            }

            Session::flash('flash_message',
                'Import Complete! ' . $buyerCount . ($buyerCount > 1 ? ' buyers ' : ' buyer') . ' added ' . 'to ' . $event_name. '!');
        } elseif ($user_type == 'seller'){
            foreach ($importedUsers as $importedSeller){
                $seller_user_id = User::where('email', '=', $importedSeller)->first()->id;
                $seller = new Seller();
                $seller->user_id = $seller_user_id;
                $seller->save();

                $event_buyer = new EventSeller();
                $event_buyer->event_id = $event_id;
                $event_buyer->seller_id = $seller->id;
                $event_buyer->save();
            }

            Session::flash('flash_message',
                'Import Complete! ' . $buyerCount . ($buyerCount > 1 ? ' sellers ' : ' seller') . ' added ' . 'to ' . $event_name. '!');
        }

        return redirect('admin/events/'.$event_id);
    }
}
