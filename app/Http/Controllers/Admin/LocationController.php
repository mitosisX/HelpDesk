<?php

namespace App\Http\Controllers\Admin;

use App\Models\Locations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Locationss = Locations::all();
        return view('admin.Locationss.index', compact('Locationss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.Locationss.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Locations::create($request->validated())->id;

        // Locations::find($id)
        //     ->update(['name' => $request->name]);

        return response()
            ->json(['id' => $id]);

        // return redirect()
        //     ->route('manager.Locationss.index')
        //     ->with('Locations_status', 'create succefully!');
    }

    public function storeJSON(Request $request)
    {
        $id = Locations::create($request->validated())->id;

        // Locations::find($id)
        //     ->update(['name' => $request->name]);

        return response()
            ->json(['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Locations $Locations)
    {
        return view('manager.Locationss.edit', compact('Locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Locations)
    {
        Locations::find($Locations->id)
            ->update($request->validated());

        return redirect()
            ->route('manager.Locationss.index')
            ->with('Locations_status', 'Updated succefully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Locations)
    {
        return "sdsds";
    }

    public function delete(Locations $Locations)
    {
        $Locations->delete();
        return redirect()
            ->route('manager.Locationss.index');
    }

    public function updateLocationsJson(Request $request, $id)
    {
        Locations::find($id)
            ->update(['name' => $request->name]);

        return response()
            ->json(['success' => true]);
    }

    public function deleteLocationsJson(Locations $Locations)
    {
        $Locations->delete();

        return response()
            ->json(['success' => true]);
    }
}
