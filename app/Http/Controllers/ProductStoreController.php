<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductStore;
use App\Models\Store;
use Auth;
use App\User;
use Alert;
class ProductStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // pending
        $user = Auth::user()->id;
        $store = Store::where('user_id',$user)->first();
        $data = ProductStore::select('nosurat','store_id','status')
                            ->where('status','Pending')
                            ->where('store_id',$store->id)
                            ->groupBy('nosurat','store_id','status')
                            ->get();
        
        return view('toko.index',compact('data'));
    }
    public function index2()
    {
        // pending
        $user = Auth::user()->id;
        $store = Store::where('user_id',$user)->first();
        $data = ProductStore::select('nosurat','store_id','status')
                            ->where('status','Approve')
                            ->where('store_id',$store->id)
                            ->groupBy('nosurat','store_id','status')
                            ->get();
        
        return view('toko.index2',compact('data'));
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
        $data = ProductStore::where('nosurat',$id)->get();
        // return
        return view('toko.detail',compact('data'));
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
    public function update(Request $request)
    {
        // return $request->all();
        $id = $request->input('id');
        foreach($id as $key=>$value ){
            ProductStore::where('id',$value)->update(array(
                'status' => 'Approve'
            ));
        }
        Alert::success('Data sudah diterima', 'Selamat!');
        return redirect('/Produk/approve');
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
