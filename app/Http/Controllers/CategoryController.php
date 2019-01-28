<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Repositories\Repository;
use App\Repositories\Category\CategoryRepository;
use Alert;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $category;
    public function __construct(Category $category){
        $this->middleware('auth');
        $this->category = new CategoryRepository($category);
    }
    public function index()
    {
        $category = $this->category->findAll();
        return view('admin.category.index')
                ->with('category',$category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
        $save = $this->category->create($data);
        if ($save) {
            Alert::success('Data berhasil ditambah', 'Selamat!');
        }else{
            Alert::error('Data berhasil ditambah', 'Maaf!');
        }
        return redirect('/Kategori/create');
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
        $category = $this->category->findOne($id);
        return view('admin.category.edit')
                ->with('category',$category);
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
        $update = $this->category->update($request->only($this->category->getModel()->fillable), $id);
        if ($update) {
            Alert::success('Data berhasil diubah', 'Selamat!');
        }else{
            Alert::error('Data berhasil diubah', 'Maaf!');
        }
        return redirect('/Kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->category->delete($id);
        Alert::success('Data berhasil dihapus', 'Selamat!');
        return redirect('/Kategori');
    }

    public function active(Request $request, $id)
    {
        Category::where('id',$id)->update(array(
            'status' => 'Aktif'
        ));
        Alert::success('Data berhasil diubah', 'Selamat!');
        return redirect('/Kategori');
    }
    public function inactive(Request $request, $id)
    {
        // TODO : pengecekan PO terlebih dahulu (Jika akan ada PO) 
        // TODO : Ketika tidak ada PO maka udah status
        // TODO : Jika ada PO yg belum selesai tidak bisa ubah status
        Category::where('id',$id)->update(array(
            'status' => 'Tidak Aktif'
        ));
        Alert::success('Data berhasil diubah', 'Selamat!');
        return redirect('/Kategori');
    }
}
