<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use DateObjectError;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       Gate::authorize('roles.view');
        $roles =  Role::paginate();
        return view('dashboard.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('roles.create');
        $role = new Role();
        return view('dashboard.roles.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('roles.create');
        $request->validate([
            'name'=>'required |string |max:255',
            'abilities'=>'required |array',
        ]);

        $role =Role::createWithAbilities($request);

        return redirect()
                ->route('dashboard.roles.index')
                ->with('success','Role Created Successfully');

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
    public function edit(Role  $role)
    {
        Gate::authorize('roles.update');
        $role_abilities =$role->abilities()->pluck('type','ability')->toArray();

        return view('dashboard.roles.edit',compact('role','role_abilities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , Role $role)
    {
        Gate::authorize('roles.update');
        $request->validate([
            'name'=>'required |string |max:255',
            'abilities'=>'required |array',
        ]);

        $role->updateWithAbilities($request);

        return redirect()
                ->route('dashboard.roles.index')
                ->with('success','Role Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('roles.delete');
        Role::destroy($id);
        return redirect()
        ->route('dashboard.roles.index')
        ->with('success','Role Daleted Successfully');
    }

}
