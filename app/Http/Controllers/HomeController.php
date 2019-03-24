<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Alert;
use App\Models\Vendors;
use App\Models\Rainkarp;
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

    public function test(){

        // return "halaman test";
        return view('test.rabinkarp');
    }

    public function cek(Request $request){
       $data = $request->input('isi');
       // $jumlah = strlen($request->input('nama'));
       // return $data;
       $cek = Rainkarp::where('isi', 'like', '%' . $data . '%')->count();
       // return $cek;
       if ($cek == 0) {
           $save = Rainkarp::create([
                            'nama' => $request->input('nama'),
                            'isi' => $data
                        ]);
           return redirect('test');
       }else{
            $cek2 = Rainkarp::where('isi', 'like', '%' . $data . '%')->get();
            $jumlah1 = strlen($data);
            $jum = 0;
            $content = [];
            for ($i=0; $i < $cek ; $i++) { 
                $jumlah2 = strlen($cek2[$i]->isi);
                if ($jumlah1 >= $jumlah2 ) {
                    $jum = $jumlah2;
                }else{
                    $jum = $jumlah1;
                }
                $rabinkarp = new Rainkarp();
                $hasil = $rabinkarp->rabinkarp( "'" . $data . "'" ,"'" . $cek2[$i]->isi . "'" , $jum);   
            }

       }

       // for ($i=0; $i < 4 ; $i++) { 
       //    echo $rabinkarp->rabinkarp( "'" . $data . "'" ,"testing", $jumlah)."<br>";
       // }
        
    }
}
