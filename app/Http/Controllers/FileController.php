<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\BuyerEvent;
use App\Event;
use App\EventBuyer;
use App\EventSeller;
use App\Seller;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;


class FileController extends Controller
{
    public function importBuyersOrSellers(){
        try{
            $event_id = session('importEventID');
            $event_name = Event::find($event_id)->first()->event_name;
            $user_type = session('importUserType');
            $imported_users = [];
            $new_imported_users = [];
            $users = session('importData');

            // Import to USERS table
            if(!empty($users) && count($users)){
                foreach($users as $user)
                {
                    try {
                        if(isset($user['name']) && isset($user['email']) && isset($user['position']) && isset($user['company'])){
                            array_push($imported_users, $user);

                            // check if account exists using email
                            if(User::where('email', $user['email'])->count() == false){
                                $new_user = new User();
                                $new_user->name = $user['name'];
                                $new_user->email = $user['email'];
                                $new_user->password = bcrypt('password');
                                $new_user->role = $user_type;
                                $new_user->activated = 1;
                                $new_user->save();

                                array_push($new_imported_users, $user);
                            }
                        }
                    } catch(Exception $e) {
                        Session::flash('flash_message','The following columns are required in the Excel file: Name, Position, Company, Email.');
                        Session::flash('alert-class','alert-danger');

                        return redirect('admin/events/'.$event_id);
                    }

                }
            }

            $user_count = count($imported_users);

            // Import to BUYERS or SELLERS table
            if($user_type == 'buyer'){
                if(count($new_imported_users) > 0){
                    foreach ($new_imported_users as $new_imported_buyer){
                        $buyer_user_id = User::where('email', '=', $new_imported_buyer['email'])->first()->id;

                        $buyer = new Buyer();
                        $buyer->company_name = $new_imported_buyer['company'];
                        $buyer->position = $new_imported_buyer['position'];
                        $buyer->user_id = $buyer_user_id;
                        $buyer->save();
                    }
                }

                if(count($imported_users) > 0){
                    foreach ($imported_users as $imported_buyer) {
                        if(!isset($imported_buyer['isVerifiedBuyer']) || $imported_buyer['isVerifiedBuyer']){
                            $imported_buyer_id = User::where('email', $imported_buyer['email'])->first()->buyer->id;

                            if (!BuyerEvent::where('event_id', $event_id)->where('buyer_id', $imported_buyer_id)->exists()) {
                                $event_buyer = new BuyerEvent();
                                $event_buyer->event_id = $event_id;
                                $event_buyer->buyer_id = $imported_buyer_id;
                                $event_buyer->save();
                            }
                        } else {
                            $user_count--;
                        }
                    }
                }

                Session::flash('flash_message', 'Import Complete! ' . $user_count . ($user_count > 1 ? ' buyers ' : ' buyer') . ' added ' . 'to ' . $event_name. '!');
            } elseif ($user_type == 'seller'){
                if(count($new_imported_users) > 0){
                    foreach ($new_imported_users as $new_imported_seller){
                        $seller_user_id = User::where('email', '=', $new_imported_seller['email'])->first()->id;

                        $seller = new Seller();
                        $seller->company_name = $new_imported_seller['company'];
                        $seller->position = $new_imported_seller['position'];
                        $seller->user_id = $seller_user_id;
                        $seller->save();

                    }
                }

                if(count($imported_users) > 0){
                    foreach ($imported_users as $imported_seller) {
                        if(!isset($imported_seller['isVerifiedSeller']) || $imported_seller['isVerifiedSeller']){
                            $imported_seller_id = User::where('email', $imported_seller['email'])->first()->seller->id;

                            if (!EventSeller::where('event_id', $event_id)->where('seller_id', $imported_seller_id)->exists()) {
                                $event_seller = new EventSeller();
                                $event_seller->event_id = $event_id;
                                $event_seller->seller_id =  $imported_seller_id;
                                $event_seller->save();
                            }
                        }  else {
                            $user_count--;
                        }
                    }
                }
                Session::flash('flash_message', 'Import Complete! ' . $user_count . ($user_count > 1 ? ' sellers ' : ' seller') . ' added ' . 'to ' . $event_name. '!');
            }

            // clear import data from session
            session()->forget('importEventID');
            session()->forget('importUserType');
            session()->forget('importData');

            return redirect('admin/events/' . $event_id);

        } catch(Exception $e) {
            Session::flash('flash_message','An error occurred. There might be invalid columns in the  import file or some emails are already taken.');
            Session::flash('alert-class','alert-danger');

            return redirect('admin/events/'.$event_id);
        }
    }
}
