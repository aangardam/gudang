<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Alert;
use App\Models\Vendors;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    public function profil()
    {
        $user = Auth::user();
        // return $user;
        if ($user->role_id == 4) {
            $status = 'Vendors';
        }else{
            $status = 'Karyawan';
        }
        
        $vendors = Vendors::where('iduser',$user->id)->first();
        return view('admin.profil',compact('vendors','user','status'));
    }

    public function updateprofil(Request $request)
    {
        $id = $request->id;
        $status = $request->input('status');
        if ($status == 'Vendors') {
            $data = Vendors::where('iduser',$id)->update(array(
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'notelp' => $request->input('notelp')
            ));
        }
        // $user = User::where('id',$request->user_id)->update(array(
        //     'name'=>$request->name,
        //     'email'=>$request->email
        // ));
        if ($request->input('password') != '') {
            $update = User::where('id',$id)->update(array(
                 'name' => $request->input('name'),
                 'email' => $request->input('email'),
                 'password' => bcrypt($request->input('password'))
             ));
         }else{
             $update = User::where('id',$id)->update(array(
                 'name' => $request->input('name'),
                 'email' => $request->input('email')
             ));
         }
        Alert::success('Data Profil berhasil di ubah');
        return redirect('profil')->with('success', 'Data profil berhasil di ubah'); 
    } 

    
}
