<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Profile;
use App\Imports\StaffImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Accounts\UserCreationRequest;
use App\Http\Requests\Accounts\AdminCreationRequest;
use App\Http\Requests\Accounts\StaffCreationRequest;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function staffCreate(Request $request)
    {
        $file = $request->file('csv_file');
        $name = $file->hashName();
        return $name;

        Excel::import(
            new StaffImport,
            request()->file('csv_file')
        );

        return $request->csv_file;
    }

    public function userCreate(Request $request)
    {
        return 2;
        $data = $request->all();

        $role = Role::where('name', $data['role'])
            ->first()
            ->id;

        $data['role_id'] = $role;
        $data['password'] = bcrypt('12345');

        User::create($data);
        return back();
    }
}
