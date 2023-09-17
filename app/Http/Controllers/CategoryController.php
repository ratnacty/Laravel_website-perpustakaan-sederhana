<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();

        return view('Home.backend.category.show',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(),[
            'kategori_name' => 'required|unique:category|min:3',
        ],[
            'kategori_name.required' => 'nama kategori belum terisi',
            'kategori_name.unique' => 'nama kategori sudah ada sebelumnya',
            'kategori_name.min'     => 'nama kategori minimal 3 huruf'

        ])->validate();
        Category::create([
            'kategori_name'=>$request->kategori_name,
            'slug'=> Str::slug($request->kategori_name)
        ]);

        return redirect()->route('category.index')->with(['success'=>'Data berhasil disimpan']);
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $category = Category::find($id);
        $category->delete();

        return redirect()->back()->with(['success'=>'Data berhasil di Hapus']);
    }
}
