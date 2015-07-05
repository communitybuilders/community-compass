<?php
// TODO: route-model binding this resource to an Organisation instance.
// TODO: create middleware for access control.

namespace App\Http\Controllers;

use App\Address;
use App\AddressPoint;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Organisation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
}
