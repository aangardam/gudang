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
        // create user
        $users = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt('12341234'),
            'role_id' => '4'
        ]);
        $users->attachRole($request->input('role_id'));
        // end
        $data['user_id'] = $users->id;
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
}
