<?php

namespace App\Http\Controllers;

use PDF;
use App\Product;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductController extends Controller
{
    public $keyword = '';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = Product::latest()->with('category');

        if (!empty($request->keyword)) {
            $this->keyword = $request->keyword;
            
            $product = $product->where('name','like',"%".$this->keyword."%");

            $product = $product->orWhereHas('category', function ($query) {
                $query->where('category_name', 'like', "%".$this->keyword."%");
            });
            
        }
        
        return view('product.index')->with('product', $product->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        // dd(request()->session()->get('_previous')['url']);
        
        return view('product.create')->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $image = '';
        if($request->hasFile('image')){
            $image = $this->uploadGambar($request);
        }else{
            $image = "produk_default.jpg";
        }
        // $image = $request->cover->store('cover');

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'qty' => $request->qty,
            'buy_price' => $request->buy_price,
            'sell_price' => $request->sell_price,
            'description' => $request->description,
            'image' => $image
        ]);

        session()->flash('success', 'Data Produk Berhasil Ditambahkan');

        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $category = Category::all();
        // dd(request()->session()->get('_previous')['url']);
        
        return view('product.edit')
                ->with('product', $product)
                ->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->only([
            'name', 
            'category_id', 
            'buy_price', 
            'sell_price', 
            'qty', 
            'description',
        ]);

        if($request->hasFile('image')){
            $image = $this->uploadGambar($request);

            if($product->image !== "produk_default.jpg"){
                File::delete('img/gambar/'.$product->image);
            }

            $data['image'] = $image;
        }

        
        $product->update($data);

        session()->flash('success', "Data Produk : $product->name  Berhasil Di ubah");

        //redirect user
        return redirect(route('product.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->image !== "produk_default.jpg"){
            File::delete('img/gambar/'.$product->image);
        }
        
        $product->delete();

        session()->flash('success', "Data Produk : $product->name Berhasil Dihapus");

        return redirect(route('product.index'));
    }


    /**
     * Cetak data ke PDF.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PDF
     */
    public function reportPdf(Request $request)
    {
        
        $product = Product::all();
        
        $pdf = PDF::setOptions([
            'dpi' => 150, 
            'defaultFont' => 'sans-serif',  
            ])
            ->loadView('product.report.pdf', [
                'product' => $product,
            ]);

        return $pdf->stream();
        
    }


    /**
     * Export data ke Excel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return excel
     */
    public function export() 
    {
        return (new ProductExport())->download('laporan-produk.xlsx');
        // return Excel::download(new ProdukExport, 'produk.xlsx');
    }

    /**
     * Import data dari excel ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request) 
    {
        $this->validate($request, [
            'import_product' => 'required|nullable|mimes:xls,xlsx|max:10'
        ]);

        $file = request()->file('import_product');
                
        Excel::import(new ProductImport, request()->file('import_product'));
        
        session()->flash('success', "Data Produk Berhasil di import");

        //redirect user
        return redirect(route('product.index'));
    }

    /**
     * Upload gambar produk.
     *
     * @param  mixed  $request
     * @return string $gambar nama file produk
     */
    public function uploadGambar($request)
    {
        $namaFile = Str::slug($request->name);
        $ext = explode('/', $request->image->getClientMimeType())[1];
        $uniq = uniqid();
        $image = "$namaFile-$uniq.$ext";
        $request->image->move(public_path('img/gambar'), $image);

        return $image;
    }


}
