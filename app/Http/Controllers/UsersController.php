<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    protected $user;
    
    protected $role;
    
    function __construct(User $user, Role $role) 
    {
        $this->middleware('auth');
        
        $this->user = $user;
        
        $this->role = $role;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $users = $this->user->all();
        
        return view('users.index', compact('users'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) 
    {
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
        $user = $this->user->findOrFail(auth()->user()->id);
        
        if ($user->can('edit users')) 
        {
            $user = $this->user->with('roles')->findOrFail($id);
            
            //user detils to edit
            
            $roles = $this->role->lists('name', 'name');
            
            return view('users.form', compact('user', 'roles'));
        } 
        else
        {
            abort('403', 'You dont have this permission');
        }
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
        $user = $this->user->findOrFail($id);
        
        $user->assignRole($request->input('roles'));
        
        $user->fill($request->all())->save();
        
        return redirect(route('users.index'));
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
}
