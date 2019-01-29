<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Repositories\StoreRepositoryInterface;

use App\User;
use Alert;
class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(StoreRepositoryInterface $store){
        $this->store = $store;
    }
    public function index()
    {
        $store = $this->store->all();
        return view('admin.store.index')
                ->with([
                    'store' => $store
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::where('role_id',2)->get();
        return view('admin.store.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->store->create($data);
        Alert::success('Data berhasil ditambah', 'Selamat!');
        return redirect('/Toko/create');
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
        $user = User::where('role_id',2)->get();
        $store = $this->store->findOne($id);
        return view('admin.store.edit')
                    ->with([
                        'user' => $user,
                        'store' => $store
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
        Store::where('id',$id)->update(array(
            'name'          => $request->input('name'),
            'user_id'   => $request->input('user_id'),
            'email'         => $request->input('email'),
            'telp'        => $request->input('telp'),
            'address'       => $request->input('address')
        ));
        Alert::success('Data berhasil diubah', 'Selamat!');
        return redirect('/Toko');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->store->delete($id);
        Alert::success('Data berhasil dihapus', 'Selamat!');
        return redirect('/Toko');
    }
    public function active(Request $request, $id)
    {
        Store::where('id',$id)->update(array(
            'status' => 1
        ));
        Alert::success('Data berhasil diubah', 'Selamat!');
        return redirect('/Toko');
    }
    public function inactive(Request $request, $id)
    {
        Store::where('id',$id)->update(array(
            'status' => 0
        ));
        Alert::success('Data berhasil diubah', 'Selamat!');
        return redirect('/Toko');
    }
}
