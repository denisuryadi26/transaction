<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $category = Category::latest();

        if (!empty($request->keyword)) {
            $category = $category->where('category_name','like',"%".$request->keyword."%");
        }
        
        return view('category.index')->with('category', $category->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {           
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required|string|max:100'
        ]);

        $category = Category::create(['category_name' => $request->category_name]);

        session()->flash('success', "Data Berhasil Disimpan");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'category_name' => 'required|string|max:100'
        ]);

        $category->category_name = $request->category_name;

        $category->update();

        session()->flash('success', "Data Berhasil Diupdate");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->product->count() > 0){
            session()->flash('error', "Kategori : $category->category_name tidak bisa dihapus karena Total Produk Lebih Dari 0");
        }else{
            $category->delete();
            session()->flash('success', "Kategori : $category->category_name Berhasil Dihapus");
        }

        return redirect(route('category.index'));
    }
}
