<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            $buku = Book::where('judul_buku','LIKE','%' . $request->search . '%')
                    ->orWhere('kode_buku','LIKE','%' . $request->search . '%')
                    ->orWhere('kategori','LIKE','%' . $request->search . '%')
                    ->orWhere('pengarang','LIKE','%' . $request->search . '%')->paginate(10);
        }else{
            $buku = Book::paginate(10);
        }

        $kategori = Category::all();

        return view('Home.backend.book.index',compact('buku','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $kategori = Category::all();
        return view('Home.backend.book.create',compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $book = Book::latest()->first();
        $kode = "CBK";
        $kodeTahun = date("Y");
        if($book == null){
            $nomerUrut = "0001";
        }else{
            $nomerUrut = substr($book->kode_buku, 7, 4)+1;
            $nomerUrut = str_pad($nomerUrut, 4, "0", STR_PAD_LEFT);
        }

        $kodeBuku = $kode . $kodeTahun . $nomerUrut;
     

        $requestData = $request->validate([
            'judul_buku'=> 'required|min:3',
            'kategori'=>'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tanggal_publikasi' => 'required',
           
        ]);
        $requestData['status'] = 'Available';
        $requestData['kode_buku'] = $kodeBuku;
        Book::create($requestData);

        return redirect()->route('book.index')->with(['success'=>'Data Buku Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $buku = Book::find($id);
        $kategori = Category::all();

        return view('Home.backend.book.edit',compact('buku','kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
     
        Validator::make($request->all(),[
            'judul_buku'=> 'required|min:3',
            'pengarang'=> 'required',
            'penerbit'=> 'required',
            'tanggal_publikasi'=> 'required',
        ])->validate();

        $data = Book::find($id);
        $data->judul_buku = $request->judul_buku;
        $data->kategori =$request->kategori;
        $data->pengarang = $request->pengarang;
        $data->penerbit = $request->penerbit;
        $data->tanggal_publikasi = $request->tanggal_publikasi;

        $data->save();

        return redirect()->route('book.index',compact('data'))->with(['success'=>'Data Berhasil DiUpdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect()->back()->with(['success'=>'Data Buku Berhasil DiHapus']);
    }
}
