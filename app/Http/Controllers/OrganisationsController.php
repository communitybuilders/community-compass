<?php
// TODO: route-model binding this resource to an Organisation instance.
// TODO: create middleware for access control.

namespace App\Http\Controllers;

use App\Address;
use App\Http\Requests;
use App\Token;
use App\Http\Controllers\Controller;
use App\Organisation;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Input;
use MyProject\Proxies\__CG__\stdClass;
use Request;


class OrganisationsController extends Controller
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
        $lat = -33.8132992;
        $lng = 151.0094947;
        $organisation_arr = Organisation::closest($lat, $lng, 0)
            ->withImage()
            ->withWebsite()
            ->get();

        return view('organisations.index', compact('logged_in', 'organisation_arr'));
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

    /**
     * Return a list of nearby organisations, for AJAX requests.
     *
     */
    public function closest()
    {
        if (!Request::ajax()) {
            return response('Unauthorized.', 401);
        }

        // Get address points.
        $request = Request::all();


        $organisations = Organisation::closest(
            $request['lat'], 
            $request['lng'], 
            $request['skip'],
            $request['take']
        )
            ->withImage()
            ->withWebsite()
            ->get();

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
        $token_url = URL::to("/token/process/{$token_obj->token}");
        $email_body = "Hi {$user_obj->first_name}, <br/><br/>Click <a href='{$token_url}'>here</a> to claim your organisation.";
        mail($user_obj->email, "Claim an organisation", $email_body, $mail_header, '-fsupport@communitybuilders.com.au');

        return Redirect::route("organisations.index", ["message" => "An email has been sent to {$user_obj->email} with instructions on how to claim this organisation."]);
    }
}
