@extends('Home.layouts.default')


@section('content')
    

<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Log Peminjaman </h4>

      <div class="mt-2 d-flex justify-content-between">
        <i class="bx bx-search fs-4 lh-0 mt-2 px-1"></i>
        <form action="{{ route('peminjaman.index') }}" method="get">
      
          <input type="search" name="search" id="nameBasic" class="form-control" placeholder=' search..'   />
          
        </form>
      </div>
    </div>
      @if(session('success'))
      <div class="alert alert-primary alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
      </div>
      @endif


      <!-- Basic Bootstrap Table -->
      <div class="card">
       
         {{-- <div class="card-header">
          <a href="{{ url('create_employee') }}" class="btn btn-primary">Create New</a>
          
         </div> --}}

          <div class="table-responsive text-nowrap">
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
                    
                <tr class="{{ $row->actual_pengembalian == null ? '' : ($row->tanggal_pengembalian < $row->actual_pengembalian ? 'text-white bg-danger' : 'text-white bg-success') }}">
                  <td >{{ ($data->currentpage()-1) * $data->perpage() + $index +1 }}</td>
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

                      @if($row['status'] == 'completed')

                        <td> <span class="badge bg-label-success">{{ $row->status }} </span></td>

                      
                            
                        @else
                        <td> <span class="badge bg-label-danger">{{ $row->status }} </span></td>

                        @endif

                  @endif

                
          
                  
                 
                </tr>
                @endforeach
              </tbody>
            </table>

          </div>

        </div>
  
        <div class="mt-5 mb-5">
          {{ $data->render() }}
        </div>

        <div>
          <h6>Keterangan:</h6>
          <p> <span class="badge bg-label-danger">*Merah</span> = Denda</p>
          <p><span class="badge bg-label-success">*Hijau</span> = Tanpa Denda</p>
          <p><span class="badge bg-white text-primary outline-primary">*Putih</span> = Proses Peminjaman Berlangsung</p>
        </div>

          

</div>

@endsection