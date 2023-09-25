<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $books = Book::all();

        return view('Home.backend.pengembalian.index',compact('users','books'));
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
        $return = Peminjaman::where('user_id', $request->user_id)->where('buku_id' , $request->buku_id)->where('actual_pengembalian' , null);

        $returnData = $return->first();
        $countData = $return->count();

            

        if($countData == 1){
            $returnData->actual_pengembalian = Carbon::now()->toDateString();
            $returnData->status = 'completed';
            $returnData->save();

           

            

            DB::beginTransaction();

           
            $book =Book::findOrFail($request->buku_id);
            $book->status = 'Available';
            $book->save();

            DB::commit();

            
            
            return redirect()->back()->with(['success' => 'Process Return Successfully']);

        

        }else{
            return redirect()->back()->with(['Warning' => 'Process Errors, Please Make Sure Book or User is right ']);

        }

     
                
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
