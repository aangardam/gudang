<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Rainkarp;
use App\Models\Vendors;
use App\User;
use Auth;
use Illuminate\Http\Request;

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
        } else {
            $status = 'Karyawan';
        }

        $vendors = Vendors::where('iduser', $user->id)->first();
        return view('admin.profil', compact('vendors', 'user', 'status'));
    }

    public function updateprofil(Request $request)
    {
        $id = $request->id;
        $status = $request->input('status');
        if ($status == 'Vendors') {
            $data = Vendors::where('iduser', $id)->update(array(
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'notelp' => $request->input('notelp'),
            ));
        }
        // $user = User::where('id',$request->user_id)->update(array(
        //     'name'=>$request->name,
        //     'email'=>$request->email
        // ));
        if ($request->input('password') != '') {
            $update = User::where('id', $id)->update(array(
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ));
        } else {
            $update = User::where('id', $id)->update(array(
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ));
        }
        Alert::success('Data Profil berhasil di ubah');
        return redirect('profil')->with('success', 'Data profil berhasil di ubah');
    }

    public function test()
    {

        // return "halaman test";
        return view('test.rabinkarp');
    }

    public function cek(Request $request)
    {
        $cek = Rainkarp::count();
        $data = $request->input('isi');

        if ($cek == 0) {
            $save = Rainkarp::create([
                'nama' => $request->input('nama'),
                'isi' => $data,
            ]);
            Alert::success('Data berhasil di di tambah');
            return redirect('test');
        } else {
            $items = array();
            for ($i = 0; $i < $cek; $i++) {
                $data1 = Rainkarp::select('isi')->get();
                similar_text($data, $data1[$i]->isi, $persen);
                $pembanding = $persen;
                if ($pembanding > 25) {
                    if (strlen($data) > strlen($data1[$i]->isi)) {
                        $jum = strlen($data1[$i]->isi);
                    } else {
                        $jum = strlen($data);
                    }
                    $rabinkarp = new Rainkarp();
                    $items[] = $rabinkarp->rabinkarp("'" . $data1[$i]->isi . "'", "'" . $data . "'", $jum - 1);
                }
            }
            if ($items == []) {
                $save = Rainkarp::create([
                    'nama' => $request->input('nama'),
                    'isi' => $data,
                ]);
                Alert::success('Data berhasil di di tambah');
                return redirect('test');
            } else {
                $nilai = max($items);
                // return $nilai;
                if ($nilai < 50) {
                    $save = Rainkarp::create([
                        'nama' => $request->input('nama'),
                        'isi' => $data,
                    ]);
                    Alert::success('Data Profil berhasil di ubah');
                    return redirect('test');
                } else {
                    Alert::error('Data telah ada');
                    return redirect('test');
                }
            }
        }
    }
}
