<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Middleware\RedirectIfAuthenticated;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            $data = Peminjaman::where('nomor_pinjam','LIKE','%' . $request->search . '%')->paginate(10);
                   
        }else{
            $data = Peminjaman::paginate(10);
        }

        

        return view('Home.backend.peminjaman.index',compact('data'));

        
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

       

        $pinjam = Peminjaman::latest()->first();
        $kode = "NPM";
      
        if($pinjam == null){
            $nomerUrut = "0001";
        }else{
            $nomerUrut = substr($pinjam->nomor_pinjam, 3, 4)+1;
            $nomerUrut = str_pad($nomerUrut, 4, "0", STR_PAD_LEFT);
        }

        $noPinjam = $kode . $nomerUrut;
     

       $data =$request->validate([
        'user_id' => 'required',
        'buku_id' =>'required'

       ],[
        'user_id.required' => 'Nama Peminjam Harus Diisi',
        'buku_id.required' => 'Judul Buku Harus Diisi'
       ]);

        $data['nomor_pinjam'] = $noPinjam;
        $data['tanggal_pinjam'] = Carbon::now()->toDateString();
        $data['tanggal_pengembalian'] = Carbon::now()->addDay(5)->toDateString();
        $data['status'] = 'prosess';
        
        $book = Book::findOrFail($request->buku_id)->only('status');

        if($book['status'] != 'Available') {
            
            return redirect()->back()->with(['Warning' => 'Buku Tidak Tersedia , Proses Peminjaman Gagal !!']);

        } else{
            $limit = Peminjaman::where('user_id' , $request->user_id)->where('actual_pengembalian' , null)->count();

            if($limit >= 3){
                return redirect()->back()->with(['Warning' => 'User Mencapai Batas Limit Peminjaman , Proses Peminjaman Gagal !!']);

            }



        

            // Database Transaction
         
            DB::beginTransaction();

            Peminjaman::create($data);

            $book =Book::findOrFail($request->buku_id);
            $book->status = 'Not Available';
            $book->save();
            DB::commit();
            
            return redirect()->back()->with(['success'=>'Data berhasil tersimpan, Peminjaman Buku Berhasil !!']);
            
        }
        
        



    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }
}
