<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ap\Models\Vendors;
use App\Repositories\VendorsRepositoyInterface;
use App\Models\Category;
use App\Repositories\Repository;
use App\Repositories\Category\CategoryRepository;
use Alert;
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
        $category = $this->category->findAll();
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
        $this->vendorRepo->create($request);
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
        $vendor->vendorRepo->findOne($id);
        $category = $this->category->findAll();
        return view('admin.vendors.create')
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor->vendorRepo->delete($id);
        Alert::success('Data berhasil dihapus', 'Selamat!');
        return redirect('/Vendors');
    }
}
