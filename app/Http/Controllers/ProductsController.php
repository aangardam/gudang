<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductsDetail;
use App\Repositories\Category\CategoryRepository;
use App\Models\Category;
use App\Repositories\ProductsRepositoryInterfece;
use App\Repositories\VendorsRepositoyInterface;
use Alert;
use App\Models\Vendors;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(ProductsRepositoryInterfece $products,Category $category,VendorsRepositoyInterface $vendorRepo){
        $this->products = $products;
        $this->category = new CategoryRepository($category);
        $this->vendorRepo = $vendorRepo;
    }
    public function index()
    {
        // return "Halaman PO";
        $products = $this->products->getPO();
        return view('admin.products.index')
                ->with([
                    'products' => $products
                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendor = $this->vendorRepo->active();
        $category = $this->category->active();
        return view('admin.products.create')
                ->with([
                    'category' => $category,
                    'vendor' => $vendor
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
        for ($i=0; $i < $request->input('quantity') ; $i++) { 
            $qty = $i == 0 ? 0 : $request->input('qty')[$i-1];
            $stok = $qty + $request->input('qty')[$i];
        }
        // return $request->all();

        $data = $request->all();
        if($request->file('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $products = "products_".date("YmdHis").strtolower('.'.$extension);
            $destination  = 'images/products/';
            $request->file('image')->move($destination,$products);
            $data['image'] = $destination.$products;
        }
        // save product
        $data['price'] =  preg_replace('/[^A-Za-z0-9\ ]/', '', $request->input('price'));
        $data['total'] = $stok;
        $produk = Products::create($data);
        $jum =  $request->input('quantity');
        for ($i=0; $i < $jum; $i++) { 
            // return $save->id;
            $detail['id_products'] = $produk->id;
            $detail['size']     = $request->input('size')[$i];
            $detail['qty']      = $request->input('qty')[$i];
            $detail['status']   = 'Order';
            $save = ProductsDetail::create($detail);
        }

        Alert::success('Data berhasil ditambah', 'Selamat!');
        return redirect('/Produk/PO/create');

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
        $products = $this->products->findOne($id);
        $detail = ProductsDetail::where('id_products',$id)->get();
        return view('admin.products.detail')
                ->with([
                    'produk'    => $products,
                    'detail'    => $detail
                ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = $this->products->findOne($id);
        $detail = ProductsDetail::where('id_products',$id)->get();
        return view('admin.products.edit')
                ->with([
                    'produk'    => $products,
                    'detail'    => $detail
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
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $products = "products_".date("YmdHis").strtolower('.'.$extension);
            $destination  = 'images/products/';
            $request->file('image')->move($destination,$products);
            $name_img=$destination.$products;
            Vendors::where('id',$id)->update(array(
                'name'          => $request->input('name'),
                'category_id'   => $request->input('category_id'),
                'vendor_id'     => $request->input('vendor_id'),
                'image'         => $name_img,
                'total'         => $request->input('total'),
                'finishing'     => $request->input('finishing'),
                'price'         => $request->input('price')
            ));
        }else{
            Vendors::where('id',$id)->update(array(
                'name'          => $request->input('name'),
                'category_id'   => $request->input('category_id'),
                'vendor_id'     => $request->input('vendor_id'),
                'total'         => $request->input('total'),
                'finishing'     => $request->input('finishing'),
                'price'         => $request->input('price')
            ));
        }
        Alert::success('Data berhasil diubah', 'Selamat!');
        return redirect('/Produk/PO');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //pengecekan ke detail product
        $this->products->delete($id);
        Alert::success('Data berhasil dihapus', 'Selamat!');
        return redirect('/Produk/PO');
    }

    public function getVendor($id){
        $vendor = Vendors::where('category_id',$id)->get();
        return $vendor;
    }

    public function approve(Request $request){
        // return $request->all();
        $param = $request->input('id_detail');
        foreach ($param as $key => $value) {
            $cek = ProductsDetail::where('id_products',$request->input('id_product'))
                                ->where('status','Order')
                                ->count();
            if ($cek == 1) {
                Products::where('id',$request->input('id_product'))->update(array(
                    'status' => 'OK'
                ));
            }
            ProductsDetail::where('id',$value)->update(array(
                'status' => 'OK'
            ));
        }
        return redirect('Produk/PO/'.$request->input('id_product').'/view');
    }
}
