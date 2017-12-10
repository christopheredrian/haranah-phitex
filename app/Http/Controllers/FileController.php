<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;


class FileController extends Controller
{
    public function importExcel(Request $request){
        $path = $request->file('file')->getRealPath();
        $data = Excel::load($path, function($reader) {})->get();

        if(!empty($data) && $data->count()){
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

                    $importedBuyers[] = $row['email'];
                }
            }
        }

        User::insert($dataImported);
        $buyerCount = count($dataImported);

        foreach ($importedBuyers as $importedBuyer){
            $buyer_user_id = User::where('email', '=', $importedBuyer)->first()->id;
            $buyer = new Buyer();
            $buyer->user_id = $buyer_user_id;
            $buyer->save();
        }

        Session::flash('flash_message', 'Import Complete! ' . $buyerCount . ($buyerCount > 1 ? ' buyers ' : ' buyer' . ' added!'));

        return redirect('admin/buyers');
    }
}
