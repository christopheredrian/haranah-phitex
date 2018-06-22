<?php

namespace App\Http\Controllers\Seller;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Seller;
use App\User;
use App\FinalSchedule;
use App\EventParam;
use App\Event;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Illuminate\Database\Eloquent\Builder;
use Session;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    private $seller_validation = [
        'company_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'email' => 'unique:users,email|email',
        'phone' => 'nullable',
        'country' => 'required',
        'company_name' => 'required',
        'company_address' => 'required',
        'event_rep1' => 'required',
        'event_rep2' => 'required',
        'designation' => 'required',
        'website' => 'required',
        'products' => 'required',
    ];

    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('seller.create')
            ->with('isCreate', true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Shows all event for this particular logged in seller
     * @return
     */

    public function show(Request $request)
    {
        $id = Auth::user()->id;

        $seller = Seller::where("sellers.user_id", "=", "$id")->first();

        $sellerID = Seller::where('user_id', Auth::user()->id)
            ->pluck('id');

        //gets all schedule
        $schedule = DB::table('final_schedules')
            ->join('event_params', 'final_schedules.event_param_id', '=', 'event_params.id')
            ->where('final_schedules.seller_id', '=', $sellerID)
            ->get();

        // gets event information
//        $eventOfSeller = Event::whereIn('id', EventSeller::where('seller_id','=',$sellerID)
//            ->pluck('event_id'))
//            ->get();

        $eventOfSeller = $seller->event;

        $info = DB::table('final_schedules')
            ->join('sellers', 'final_schedules.seller_id', '=', 'sellers.id')
            ->select('buyer_id', 'event_param_id')
            ->where('sellers.id', '=', $sellerID)
            ->get();

        // gets Name (first and last) of buyer in the final schedule
        $buyer = DB::table('users')
            ->join('buyers', 'users.id', '=', 'buyers.user_id')
            ->get();

        $count = \App\SellerPreference::where('seller_preferences.seller_id', '=', $sellerID)
            ->count();

        if ($count > 0) {
            $has_preference = true;
        } else {
            $has_preference = false;
        }

        $countries = array("AF" => "Afghanistan",
            "AX" => "Åland Islands",
            "AL" => "Albania",
            "DZ" => "Algeria",
            "AS" => "American Samoa",
            "AD" => "Andorra",
            "AO" => "Angola",
            "AI" => "Anguilla",
            "AQ" => "Antarctica",
            "AG" => "Antigua and Barbuda",
            "AR" => "Argentina",
            "AM" => "Armenia",
            "AW" => "Aruba",
            "AU" => "Australia",
            "AT" => "Austria",
            "AZ" => "Azerbaijan",
            "BS" => "Bahamas",
            "BH" => "Bahrain",
            "BD" => "Bangladesh",
            "BB" => "Barbados",
            "BY" => "Belarus",
            "BE" => "Belgium",
            "BZ" => "Belize",
            "BJ" => "Benin",
            "BM" => "Bermuda",
            "BT" => "Bhutan",
            "BO" => "Bolivia",
            "BA" => "Bosnia and Herzegovina",
            "BW" => "Botswana",
            "BV" => "Bouvet Island",
            "BR" => "Brazil",
            "IO" => "British Indian Ocean Territory",
            "BN" => "Brunei Darussalam",
            "BG" => "Bulgaria",
            "BF" => "Burkina Faso",
            "BI" => "Burundi",
            "KH" => "Cambodia",
            "CM" => "Cameroon",
            "CA" => "Canada",
            "CV" => "Cape Verde",
            "KY" => "Cayman Islands",
            "CF" => "Central African Republic",
            "TD" => "Chad",
            "CL" => "Chile",
            "CN" => "China",
            "CX" => "Christmas Island",
            "CC" => "Cocos (Keeling) Islands",
            "CO" => "Colombia",
            "KM" => "Comoros",
            "CG" => "Congo",
            "CD" => "Congo, The Democratic Republic of The",
            "CK" => "Cook Islands",
            "CR" => "Costa Rica",
            "CI" => "Cote D'ivoire",
            "HR" => "Croatia",
            "CU" => "Cuba",
            "CY" => "Cyprus",
            "CZ" => "Czech Republic",
            "DK" => "Denmark",
            "DJ" => "Djibouti",
            "DM" => "Dominica",
            "DO" => "Dominican Republic",
            "EC" => "Ecuador",
            "EG" => "Egypt",
            "SV" => "El Salvador",
            "GQ" => "Equatorial Guinea",
            "ER" => "Eritrea",
            "EE" => "Estonia",
            "ET" => "Ethiopia",
            "FK" => "Falkland Islands (Malvinas)",
            "FO" => "Faroe Islands",
            "FJ" => "Fiji",
            "FI" => "Finland",
            "FR" => "France",
            "GF" => "French Guiana",
            "PF" => "French Polynesia",
            "TF" => "French Southern Territories",
            "GA" => "Gabon",
            "GM" => "Gambia",
            "GE" => "Georgia",
            "DE" => "Germany",
            "GH" => "Ghana",
            "GI" => "Gibraltar",
            "GR" => "Greece",
            "GL" => "Greenland",
            "GD" => "Grenada",
            "GP" => "Guadeloupe",
            "GU" => "Guam",
            "GT" => "Guatemala",
            "GG" => "Guernsey",
            "GN" => "Guinea",
            "GW" => "Guinea-bissau",
            "GY" => "Guyana",
            "HT" => "Haiti",
            "HM" => "Heard Island and Mcdonald Islands",
            "VA" => "Holy See (Vatican City State)",
            "HN" => "Honduras",
            "HK" => "Hong Kong",
            "HU" => "Hungary",
            "IS" => "Iceland",
            "IN" => "India",
            "ID" => "Indonesia",
            "IR" => "Iran, Islamic Republic of",
            "IQ" => "Iraq",
            "IE" => "Ireland",
            "IM" => "Isle of Man",
            "IL" => "Israel",
            "IT" => "Italy",
            "JM" => "Jamaica",
            "JP" => "Japan",
            "JE" => "Jersey",
            "JO" => "Jordan",
            "KZ" => "Kazakhstan",
            "KE" => "Kenya",
            "KI" => "Kiribati",
            "KP" => "Korea, Democratic People's Republic of",
            "KR" => "Korea, Republic of",
            "KW" => "Kuwait",
            "KG" => "Kyrgyzstan",
            "LA" => "Lao People's Democratic Republic",
            "LV" => "Latvia",
            "LB" => "Lebanon",
            "LS" => "Lesotho",
            "LR" => "Liberia",
            "LY" => "Libyan Arab Jamahiriya",
            "LI" => "Liechtenstein",
            "LT" => "Lithuania",
            "LU" => "Luxembourg",
            "MO" => "Macao",
            "MK" => "Macedonia, The Former Yugoslav Republic of",
            "MG" => "Madagascar",
            "MW" => "Malawi",
            "MY" => "Malaysia",
            "MV" => "Maldives",
            "ML" => "Mali",
            "MT" => "Malta",
            "MH" => "Marshall Islands",
            "MQ" => "Martinique",
            "MR" => "Mauritania",
            "MU" => "Mauritius",
            "YT" => "Mayotte",
            "MX" => "Mexico",
            "FM" => "Micronesia, Federated States of",
            "MD" => "Moldova, Republic of",
            "MC" => "Monaco",
            "MN" => "Mongolia",
            "ME" => "Montenegro",
            "MS" => "Montserrat",
            "MA" => "Morocco",
            "MZ" => "Mozambique",
            "MM" => "Myanmar",
            "NA" => "Namibia",
            "NR" => "Nauru",
            "NP" => "Nepal",
            "NL" => "Netherlands",
            "AN" => "Netherlands Antilles",
            "NC" => "New Caledonia",
            "NZ" => "New Zealand",
            "NI" => "Nicaragua",
            "NE" => "Niger",
            "NG" => "Nigeria",
            "NU" => "Niue",
            "NF" => "Norfolk Island",
            "MP" => "Northern Mariana Islands",
            "NO" => "Norway",
            "OM" => "Oman",
            "PK" => "Pakistan",
            "PW" => "Palau",
            "PS" => "Palestinian Territory, Occupied",
            "PA" => "Panama",
            "PG" => "Papua New Guinea",
            "PY" => "Paraguay",
            "PE" => "Peru",
            "PH" => "Philippines",
            "PN" => "Pitcairn",
            "PL" => "Poland",
            "PT" => "Portugal",
            "PR" => "Puerto Rico",
            "QA" => "Qatar",
            "RE" => "Reunion",
            "RO" => "Romania",
            "RU" => "Russian Federation",
            "RW" => "Rwanda",
            "SH" => "Saint Helena",
            "KN" => "Saint Kitts and Nevis",
            "LC" => "Saint Lucia",
            "PM" => "Saint Pierre and Miquelon",
            "VC" => "Saint Vincent and The Grenadines",
            "WS" => "Samoa",
            "SM" => "San Marino",
            "ST" => "Sao Tome and Principe",
            "SA" => "Saudi Arabia",
            "SN" => "Senegal",
            "RS" => "Serbia",
            "SC" => "Seychelles",
            "SL" => "Sierra Leone",
            "SG" => "Singapore",
            "SK" => "Slovakia",
            "SI" => "Slovenia",
            "SB" => "Solomon Islands",
            "SO" => "Somalia",
            "ZA" => "South Africa",
            "GS" => "South Georgia and The South Sandwich Islands",
            "ES" => "Spain",
            "LK" => "Sri Lanka",
            "SD" => "Sudan",
            "SR" => "Suriname",
            "SJ" => "Svalbard and Jan Mayen",
            "SZ" => "Swaziland",
            "SE" => "Sweden",
            "CH" => "Switzerland",
            "SY" => "Syrian Arab Republic",
            "TW" => "Taiwan, Province of China",
            "TJ" => "Tajikistan",
            "TZ" => "Tanzania, United Republic of",
            "TH" => "Thailand",
            "TL" => "Timor-leste",
            "TG" => "Togo",
            "TK" => "Tokelau",
            "TO" => "Tonga",
            "TT" => "Trinidad and Tobago",
            "TN" => "Tunisia",
            "TR" => "Turkey",
            "TM" => "Turkmenistan",
            "TC" => "Turks and Caicos Islands",
            "TV" => "Tuvalu",
            "UG" => "Uganda",
            "UA" => "Ukraine",
            "AE" => "United Arab Emirates",
            "GB" => "United Kingdom",
            "US" => "United States",
            "UM" => "United States Minor Outlying Islands",
            "UY" => "Uruguay",
            "UZ" => "Uzbekistan",
            "VU" => "Vanuatu",
            "VE" => "Venezuela",
            "VN" => "Viet Nam",
            "VG" => "Virgin Islands, British",
            "VI" => "Virgin Islands, U.S.",
            "WF" => "Wallis and Futuna",
            "EH" => "Western Sahara",
            "YE" => "Yemen",
            "ZM" => "Zambia",
            "ZW" => "Zimbabwe");

        return view('seller.index', compact('seller'), ['role' => 'Seller'])
            ->with('sellers', $seller)
            ->with('schedule', $schedule)
            ->with('sellerEvent', $eventOfSeller)
            ->with('info', $info)
            ->with('buyer', $buyer)
            ->with('preference', $has_preference)
            ->with('event_id', $seller->event_id)
            ->with('countries', $countries);
    }


    public function showEvents()
    {
        // TODO: Another refactor later
        $seller = Seller::where('user_id', Auth::user()->id)
            ->first();

        $sellerID = Seller::where('user_id', Auth::user()->id)
            ->pluck('id');
        // note: to be refactored

        //table column where  id
        $schedule = DB::table('final_schedules')
            ->join('event_params', 'final_schedules.event_param_id', '=', 'event_params.id')
            ->where('final_schedules.seller_id', '=', $sellerID)
            ->get();

        // gets the buyer_id and event_param_id
        $info = DB::table('final_schedules')
            ->join('sellers', 'final_schedules.seller_id', '=', 'sellers.id')
            ->select('buyer_id', 'event_param_id')
            ->where('sellers.id', '=', $sellerID)
            ->get();

        // gets Name (first and last) of buyer in the final schedule
        $buyer = DB::table('users')
            ->join('buyers', 'users.id', '=', 'buyers.user_id')
            ->get();

        return view('seller.event')
            ->with('events', $seller->events)
            ->with('schedule', $schedule)
            ->with('info', $info)
            ->with('buyer', $buyer);
    }

    /**
     * Shows the seller preference form
     * @param $id
     * @return
     */
    public function sellerPreference()
    {
        //$buyers = User::whereIn('id', Buyer::whereIn('id',EventBuyer::where('event_id','=',1)
        //->pluck('buyer_id'))
        //->pluck('user_id'))
        //->get();
        //$buyers = DB::table('buyers')->join('users', 'buyers.user_id', '=', 'users.id')->select('users.*', 'buyers.country')->get();
        // return view('seller.list');
        $id = Auth::user()->id;
        $seller = Seller::where('user_id', Auth::user()->id)
            ->first();
        $event = Event::find($seller->event_id);
        return view('seller.list')
            ->with('buyers', $event->buyers)
            ->with('event', $event);
    }

    /**
     * Submit user preferences
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function submitPreferences(Request $request)
    {
        // Get values from request
        if (!empty($request->values)) {
            foreach ($request->values as $item) {
                $seller_preference = \App\SellerPreference::create();
                $seller_preference->event_id = Auth::user()->seller->event->id;
                $seller_preference->seller_id = Auth::user()->seller->id;
                $pieces = explode("-", $item);
                $seller_preference->buyer_id = $pieces[0];
                $seller_preference->rank = $pieces[1];
                $seller_preference->save();
            }
            return redirect('seller/home');
        } else {
            return redirect('seller/pick')->with('status', 'No Buyers selected!');
        }

    }

    public function showBuyerProfile($user_id)
    {
        $buyer = \App\Buyer::find($user_id);
        return view('seller.cbuyer')
            ->with('buyer', $buyer);
    }

    public function update(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate($this->seller_validation);
        $requestData = $request->all();

        $seller = Seller::where("sellers.user_id", "=", "$id")->first();
        $seller->update($requestData);

        $user = User::findOrFail($seller->user->id);
        $user->update($requestData);

        if ($request->file('company_logo') != null) {
            $logo = 'seller-' . $seller->id . '.jpg';

            $request->file('company_logo')->move(
                base_path() . '/public/uploads/', $logo
            );
        }

        return redirect('seller/home')->with('flash_message', 'Profile updated!');
    }
}
