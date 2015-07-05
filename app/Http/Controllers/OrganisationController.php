<?php
// TODO: route-model binding this resource to an Organisation instance.
// TODO: create middleware for access control.

namespace App\Http\Controllers;

use App\Address;
use App\Token;
use App\Http\Controllers\Controller;
use App\Organisation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Input;
use Request;


class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $logged_in = Auth::user();

        $organisation = new Organisation();
        $organisation_arr = $organisation->fillorganisation();

        return view('organisations.index', compact('organisation_arr', 'logged_in'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('organisations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        die("xxx");
        // TODO: make an OrganisationRequest, then Organisation::create()
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $org = Organisation::find($id);
        return view('organisations.show', compact('org'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
          $org = Organisation::find($id);
        return view('organisations.edit', compact('org'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        // TODO: make:request OrganisationRequest, then Organisation::find($id)->update()
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // Intentially left blank.
    }

    public function ajaxloadorganisations(){
        $data = Input::all();

        $current_row = $data['current_row'];
        $next_row = $current_row + 1;

        $organisation = New Organisation();
        $organisation_arr = $organisation->fillorganisationbyid($next_row);

        echo json_encode($organisation_arr);
        die();
    }

    /**
     * Return a list of nearby organisations, for AJAX requests.
     *
     */
    public function nearby()
    {
        if (!Request::ajax()) {
            return response('Unauthorized.', 401);
        }

        $request = Request::all();

        // Get address ids.
        $query = DB::raw("
            SELECT address_id,
            ST_DISTANCE(
                geopoint,
                POINT(?, ?)
            ) AS distance
            FROM address_points
            WHERE geopoint IS NOT NULL
            ORDER BY distance
            LIMIT 0, 10
        ");
        $points = DB::select($query, [$request['lat'], $request['lng']]);
        $addressIds = [];
        foreach ($points as $point) {
            $addressIds[] = $point->address_id;
        }


        // Get full Organisation details for all addresses.
        $addresses = Address::whereIn('id', $addressIds)->get();
        $organisations = [];
        foreach($addresses as $address) {
            $organisation = $address->getOrganisation();
            $organisation->address = $address;
            $organisation->website = $organisation->getWebsite();
            $organisations[] = $organisation;
        }

        return $organisations;
    }

    public function claim() {
        $user_obj = Auth::user();
        $today = new \DateTime();

        $input = Input::all();

        $existing_user = TRUE;
        if( is_null($user_obj) ) {
            // No logged in user.
            // We need to create a new user.
            $input['created_at'] = $today->format("Y-m-d H:i:s");
            $input['updated_at'] = $today->format("Y-m-d H:i:s");
            $input['role_id'] = 2; // Client

            $user_obj = User::create($input);

            $existing_user = FALSE;
        }

        $org_obj = Organisation::find($input['organisation_id']);

        // Create a token
        $token_params = [
            "type" => "organisation_claim",
            "email" => $user_obj->email,
            "organisation_id" => $org_obj->id,
            "user_id" => $user_obj->id
        ];
        $token_obj = Token::create($token_params);

        $mail_header = "From: "."Community Builders Support" ." <"."support@communitybuilders.com.au." .">\n";
        $mail_header .= "Reply-To: "."support@communitybuilders.com.au"."\n";
        $mail_header .= "MIME-Version: 1.0\n";

        // Send the email
        mail($user_obj->email, "Claim an organisation", "Hi {$user_obj->first_name}, <br/><br/>Click <a href='google.com'>here</a> to claim your organisation", $mail_header, '-fsupport@communitybuilders.com.au');

        return Redirect::route("organisations.index", ["message" => "An email has been sent to {$user_obj->email} with instructions on how to claim this organisation."]);
    }
}
