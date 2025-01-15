<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Admin::class, 'admin');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('admin.view');
        $admins = Admin::paginate();
        return view('dashboard.admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         Gate::authorize('admin.create');
            return view('dashboard.admins.create',[
                'roles' => Role::all(),
                'admin' => new Admin(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         Gate::authorize('admin.create');
        $request->validate([
           'name' => 'required|string|max:255',
           'roles' => 'required|array',
        ]);
        $admin = Admin::create($request->all());
        $admin->roles()->attach($request->roles());

        return redirect()
                ->route('dashboard.admins.index')
                ->with('success','Admin cerated scssesfuly');
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
    public function edit(Admin $admin)
    {
         Gate::authorize('admin.update');
        $roles = Role::all();

        $admin_roles = $admin->roles()->pluck('id')->toArray();

        return view('dashboard.admins.edit',compact('admin','roles','admin_roles'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
         Gate::authorize('admin.update');
        $request->validate([
            'name' => 'required|string|max:255',
            'roles' => 'required|array',
        ]);

        $admin->update($request->all());
        $admin->roles()->sync($request->roles);

        return redirect()
            ->route('dashboard.admins.index')
            ->with('success', 'Admin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Gate::authorize('admin.delete');
       Admin::destroy($id);
       return redirect()
       ->route('dashboard.admins.index')
       ->with('success','Admin delete scssesfuly');
    }

}
