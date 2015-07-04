<?php
// TODO: route-model binding this resource to an Organisation instance.
// TODO: create middleware for access control.

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Organisation;
use Illuminate\Support\Facades\Auth;
use Input;


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
        $org_obj = new Organisation();
        return view('organisations.show', compact($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view('organisations.edit', compact($id));
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
}
