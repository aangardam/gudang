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
use App\Models\Store;
use App\Models\ProductStore;
use Excel;
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
    public function gudang()
    {
        // return "Halaman PO";
        $products = $this->products->stokgudang();
        return view('admin.products.gudang')
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
        // return $request->all();
        $stok = 0;
        for ($i=0; $i < $request->input('quantity') ; $i++) { 
            // $qty = $i == 0 ? 0 : $request->input('qty')[$i-1];
            $stok = $stok + $request->input('qty')[$i];
        }
        

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
    public function store2(Request $request) //masuk ke gudang
    {
        // return $request->all();
        $stok = 0;
        for ($i=0; $i < $request->input('quantity') ; $i++) { 
            $stok = $stok + $request->input('qty')[$i];
        }
        // save to produk store
        for ($j=0; $j < $request->input('quantity') ; $j++) { 
            $data['store_id']   = $request->input('store_id');
            $data['product_id'] = $request->input('produk')[$j];
            $data['size']       = $request->input('size')[$j];
            $data['qty']        = $request->input('qty')[$j];
            $data['status']     = 'Pending';
            $data['nosurat']    = $request->input('nosurat');

            ProductStore::create($data);
        }
        
        // update produk and produk detail
        $produk = Products::select('total')
                                ->where('id',$request->input('produk'))
                                ->first();
        // return $produk->total;
        Products::where('id',$request->input('produk'))->update(array(
            'total' => $produk->total - $stok
        ));
        for ($x=0; $x < $request->input('quantity') ; $x++) { 
            // $qty = ProductsDetail::select('qty')
            //                             ->where('size',$request->input('size')[$x])
            //                             ->where('id_productsr',$request->input('produk'))
            //                             ->first();
            $qty = ProductsDetail::select('qty')
                                ->where([
                                    'size' => $request->input('size')[$x],
                                    'id_products'=>$request->input('produk')
                                ])
                                ->first();
            // return $qty;
            // ProductsDetail::where('id_products',$request->input('produk'))
            //              ->where('size',$request->input('size')[$x])
                        //  ->update(array(
                        //     'qty' => $qty->qty - $request->input('qty')[$x]
                        //  ));
            ProductsDetail::where([
                                'id_products'   => $request->input('produk'),
                                'size'          => $request->input('size')[$x]
                            ])
                            ->update(array(
                                'qty' => $qty->qty - $request->input('qty')[$x]
                             ));
        }
        Alert::success('Data berhasil ditambah', 'Selamat!');
        return redirect('/Produk/Send');

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
    public function show2($id)
    {
        // return $id;
        $products = $this->products->findOne($id);
        $detail = ProductsDetail::where('id_products',$id)->get();
        $store = Store::all();
        return view('admin.products.detail2')
                ->with([
                    'produk'    => $products,
                    'detail'    => $detail,
                    'store'     => $store
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
    public function getSize($id){
        $size = ProductsDetail::where('id_products',$id)->get();
        return $size;
    }
    public function getSum($id){
        $exp = explode('-', $id);
        $id = $exp[0];
        $size = $exp[1];

        $sum = ProductsDetail::where('id_products',$id)
                            ->where('size',$size)
                            ->get();
        return $sum;
    }

    public function approve(Request $request){
        // return $request->all();
        $param = $request->input('id_detail');
        foreach ($param as $key => $value) {
            $cek = ProductsDetail::where('id_products',$request->input('id_product'))
                                ->where('status','PO')
                                ->count();
            // return $cek;
            if ($cek <= 1) {
                Products::where('id',$request->input('id_product'))->update(array(
                    'status' => 'GUDANG'
                ));
            }
            ProductsDetail::where('id',$value)->update(array(
                'status' => 'GUDANG'
            ));
        }
        return redirect('Produk/PO/'.$request->input('id_product').'/view');
    }

    public function send(){
        $nosurat = ProductStore::all()->count();

        $nourut = $nosurat == 0 ? 1 : $nosurat+1;
        // return $nourut;
        $tgl = date('Ym');
        $nosurat = $tgl.sprintf("%04s", $nourut);
        // return $nosurat;
        $store = Store::where('status',1)->get();
        $produk = Products::where('status','GUDANG')
                        ->where('total','>=',1)
                        ->get();
        return view('admin.products.kirim')->with([
            'store'     => $store,
            'produk'    => $produk,
            'nosurat'   => $nosurat
        ]);
    }

    public function toko(){
        $data = ProductStore::select('nosurat','store_id','status')
                            ->groupBy('nosurat','store_id','status')
                            ->get();
        // $data = ProductStore::all();
        return view('admin.products.toko',compact('data'));
    }
    public function print($id){
        // return $id;
        $data = ProductStore::where('nosurat',$id)->get();
        Excel::create('Surat_Jalan', function ($excel) use ($data) {
            $excel
                ->sheet('Surat_Jalan', function ($sheet) use ($data) {
                    $sheet->setWidth(array(
                        'C' => 25
                    ));
                    $sheet->loadView(
                        'admin.products.print',
                        compact('data')
                    );
                })
                ->download('xlsx');
        });
    }
}