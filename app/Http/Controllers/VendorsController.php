<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendors;
use App\Repositories\VendorsRepositoyInterface;
use App\Models\Category;
use App\Repositories\Repository;
use App\Repositories\Category\CategoryRepository;
use Alert;
use App\User;
use App\Models\Products;
use App\Models\ProductsDetail;
use Auth;
class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(VendorsRepositoyInterface $vendorRepo,Category $category){
        $this->vendorRepo = $vendorRepo;
        $this->category = new CategoryRepository($category);
    }
    public function index()
    {
        $vendor = $this->vendorRepo->all();
        // return $vendor;
        return view('admin.vendors.index')
                    ->with([
                        'vendors' => $vendor
                    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = $this->category->active();
        return view('admin.vendors.create')
                    ->with([
                        'category' => $category
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
        $data =  $request->all();
        $user = User::create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => bcrypt(1234),
            'role_id'   => 4
        ]);
        $user->attachRole(4);
        $data['iduser'] = $user->id;
        $this->vendorRepo->create($data);
        Alert::success('Data berhasil ditambah', 'Selamat!');
        return redirect('/Vendors/create');
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
        $vendor = $this->vendorRepo->findOne($id);
        $category = $this->category->active();
        return view('admin.vendors.edit')
                    ->with([
                        'category' => $category,
                        'vendors' => $vendor
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
        Vendors::where('id',$id)->update(array(
            'name'          => $request->input('name'),
            'category_id'   => $request->input('category_id'),
            'email'         => $request->input('email'),
            'notelp'        => $request->input('notelp'),
            'address'       => $request->input('address')
        ));
        Alert::success('Data berhasil diubah', 'Selamat!');
        return redirect('/Vendors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->vendorRepo->delete($id);
        Alert::success('Data berhasil dihapus', 'Selamat!');
        return redirect('/Vendors');
    }


    public function active(Request $request, $id)
    {
        Vendors::where('id',$id)->update(array(
            'active' => 1
        ));
        Alert::success('Data berhasil diubah', 'Selamat!');
        return redirect('/Vendors');
    }
    public function inactive(Request $request, $id)
    {
        Vendors::where('id',$id)->update(array(
            'active' => 0
        ));
        Alert::success('Data berhasil diubah', 'Selamat!');
        return redirect('/Vendors');
    }

    public function inprogres(){
        $user = Auth::user()->id;
        $vendor = Vendors::where('iduser',$user)->first();
        // return $vendor;
        $data = Products::where('status','PO')
                            ->where('vendor_id',$vendor->id)
                            ->get();
        return view('Vendors.index')
                ->with([
                    'products' => $data
                ]);
    }
    public function detail($id){
        // return $id;
        $produk = Products::find($id);
        $data = ProductsDetail::where('id_products',$id)->get();
        return view('Vendors.detail')
                ->with([
                    'detail' => $data,
                    'produk' => $produk
                ]);
    }

    public function finished(){
        $user = Auth::user()->id;
        $vendor = Vendors::where('iduser',$user)->first();
        // return $vendor;
        $data = Products::where('status','GUDANG')
                            ->where('vendor_id',$vendor->id)
                            ->get();
        return view('Vendors.index2')
                ->with([
                    'products' => $data
                ]);
    }
}
