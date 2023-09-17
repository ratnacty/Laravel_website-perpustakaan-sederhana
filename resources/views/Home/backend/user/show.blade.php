
@extends('Home.layouts.default')


@section('content')
    

<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">


    <h1> My Profile </h1>

    <div class="card">
        
        {{-- <div class="table-responsive text-nowrap mb-5 ">
          <table class="table table-dark ">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Level</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                    
              <tr>
                
                <td> {{ Auth::user()->name }}</td>
                <td> {{ Auth::user()->email }}</td>
                <td> {{ Auth::user()->level }}</td>
                  
               
              </tr>
             
            </tbody>
          </table>


        
      </div> --}}

      <div class="row mt-4 ">
        <p><b class="px-4">Name  :</b>  {{ Auth::user()->name }} </p> 
        <p><b class="px-4">Email :</b>  {{ Auth::user()->email }} </p> 
        <p><b class="px-4">Level :</b>  {{ Auth::user()->level }} </p> 
      </div>

     
      <div class="table-responsive text-nowrap mt-5">
        <h5 class="px-4">List and History Peminjaman</h5>
        <table class="table">
          <thead>
            <tr class="text-nowrap">
              <th>No</th>
              <th>No Pinjam</th>
              <th>Nama Peminjam</th>
              <th>Judul Buku</th>
              <th>Kode Buku</th>
              <th>Tanggal Pinjam</th>
              <th>Tanggal Kembali</th>
              <th>Actual Pengembalian</th>
              <th>Status</th>
             
            </tr>
          </thead>
          <tbody>

            @php
             $i = 1;   
            @endphp

            @foreach ($data as $index => $row)
                
            <tr>
              <th scope="row">{{ $i++ }}</th>
              <td>{{ $row->nomor_pinjam }}</td>
              <td>{{ $row->user->name }}</td>
              <td>{{ $row->book->judul_buku }}</td>
              <td>{{ $row->book->kode_buku }}</td>
              <td>{{ date('d-m-Y',strtotime($row['tanggal_pinjam'])) }}</td>
              <td>{{ date('d-m-Y',strtotime($row['tanggal_pengembalian'])) }}</td>
              <td>{{ $row['actual_pengembalian'] }}</td>

              @if ($row['status'] == 'prosess')
               <td> <span class="badge bg-label-info">{{ $row->status }} </span></td>
            
                  
              @else
              <td> <span class="badge bg-label-success">{{ $row->status }} </span></td>
              @endif
             
      
              
             
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
    </div>
 
   
    


</div>
</div>


    @endsection
