<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductStore;
use App\Models\Store;
use Auth;
use App\User;
use Alert;
use App\Models\product_return;
use App\Models\Products;
use App\Models\ProductsDetail;

class ProductReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "halaman return barang";
        $user = Auth::user()->id;
        $store = Store::where('user_id',$user)->first();
      
        return view('admin.produk_return.index');
    }

    public function index2(){
        $data = product_return::select('store_id','status','nosurat')
                            ->where('status', 'Pending')
                            ->groupBy('store_id','status','nosurat')
                            ->get();
        return view('admin.produk_return.index2',compact('data'));
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
        // return $id;
        $data = product_return::where('nosurat',$id)->get();
        // return
        return view('admin.produk_return.show',compact('data'));
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
            // ubah status produk return
            product_return::where('id',$value)->update(array(
                'status' => 'Approve'
            ));

            // ubah jumlah produk
            $produk = Products::select('total')
                ->where('id',$request->input('produk')[$key])
                ->first();
            Products::where('id',$request->input('produk')[$key])->update(array(
                'total' => $produk->total + $request->input('qty')[$key],
            ));

            // ubah detail
            $jum = ProductsDetail::select('qty')
                ->where([
                    'size' => $request->input('size')[$key],
                    'id_products' => $request->input('produk')[$key],
                ])
                ->first();
            ProductsDetail::where([
                'id_products' => $request->input('produk')[$key],
                'size' => $request->input('size')[$key],
            ])
                ->update(array(
                    'qty' => $jum->qty + $request->input('qty')[$key],
                ));
            }
        Alert::success('Data berhasil ditambah', 'Selamat!');
        return redirect('/Produk/kembali');
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
