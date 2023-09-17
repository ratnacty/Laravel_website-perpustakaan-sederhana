@extends('Home.layouts.default')

@section('content')
    
<div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y">
               
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Buku</h4>

    @if(session('success'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
    </div>
    @endif

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <a href="{{ route('book.create') }}" class="btn btn-primary">Create new</a>
        <div class="d-flex justify-content-between">
          <i class="bx bx-search fs-4 lh-0 mt-2 px-1"></i>
          <form action="{{ route('book.index') }}" method="get">
        
            <input type="search" name="search" id="nameBasic" class="form-control" placeholder=' search..'   />
            
          </form>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-ligh">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Judul</th>
            <th>Category</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Tanggal Publikasi</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">

            @php
             $i = 1;   
            @endphp

            @foreach ($buku as $index => $row)
                
          <tr>
            
            <td>{{ ($buku->currentpage()-1) * $buku->perpage() + $index +1 }}</td>
            <td>{{ $row->kode_buku }}</td>
            <td>{{ $row->judul_buku }}</td>
            <td>{{ $row->kategori}}</td>
            <td>{{ $row->pengarang }}</td>
            <td>{{ $row->penerbit }}</td>
            <td>{{ date('d-m-Y',strtotime($row['tanggal_publikasi'])) }}</td>
            <td>{{ $row->status }}</td>
              
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('book.edit',$row->id) }}"
                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                  >

                  <form action="{{ route('book.destroy',$row->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="dropdown-item" onclick="return confirm('Are You Sure want to Delete This ?')">
                        <i class="bx bx-trash me-1"></i>Delete
                    </button>
                </form>

                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="mt-5">
    {{ $buku->render() }}
  </div>
    


{{-- modal --}}
{{-- <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <form action="{{ route('category.store') }}" method="post">
            @csrf
            <div class="modal-body">
            <div class="row">
                <div class="col mb-3">
                <label for="kategori_name" class="form-label">Category Name</label>
                <input type="text" name="kategori_name" class="form-control" placeholder="Enter Name" required />
                    @error ('kategori_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
            </button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
         </form>
      </div>
    </div>
  </div>
</div> --}}
</div>

@endsection