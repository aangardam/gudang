<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Alert;
use App\Repositories\Repository;
use App\Repositories\User\UserRepository;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $users;
    public function __construct(User $users){
        $this->middleware('auth');
        $this->users = new UserRepository($users);
    }
    public function index()
    {
        $users = $this->users->findAll();
        return view('admin.user.index')
                ->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();
        return view('admin.user.create')
                ->with('role',$role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $users = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role_id' => $request->input('role_id')
        ]);
        $users->attachRole($request->input('role_id'));
        Alert::success('Data berhasil ditambah', 'Selamat!');
        return redirect('/User/create')->with('success', 'Data berhasil ditambah');
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
        $role = Role::all();
        $users = $this->users->findOne($id);
        return view('admin.user.edit')
                ->with([
                    'role' => $role,
                    'users' => $users
                ]);
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
        if ($request->input('password') != '') {
           $update = User::where('id',$id)->update(array(
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'role_id' => $request->input('role_id')
            ));
        }else{
            $update = User::where('id',$id)->update(array(
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role_id' => $request->input('role_id')
            ));
        }
        
        if ($update) {
            DB::table('role_user')
                ->where('user_id',$id)
                ->update(['role_id'=>$request->input('role_id') ]);
        }
        Alert::success('Data berhasil diubah', 'Selamat!');
        return redirect('/User')->with('success', 'Data berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->users->delete($id);
        Alert::success('Data berhasil dihapus', 'Selamat!');
        return redirect('/User')->with('success', 'Data berhasil dihapus');
    }
}
