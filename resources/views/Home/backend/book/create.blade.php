@extends('Home.layouts.default')

@section('content')


<div class="content-wrapper">
    <!-- Content -->


    <div class="container-xxl flex-grow-1 container-p-y">

        
            @if(session('success'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
            </div>
            @endif

            
        <div style="display: flex; justify-content:space-between;">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span>Books</h4>
        <div class="mt-3">
            <a href="{{ route('book.index') }}" class="btn btn-warning">Back</a> 
        </div>
        </div>

    <div class="col-md-10" >
        <div class="card mb-4" style="margin-left: 240px;" >
          <h5 class="card-header">Create new Book</h5>
          <div class="card-body">


            <form action="{{ route('book.store') }}" method="post">
                @csrf

            {{-- <div class="mb-3">
              <label for="kode_buku" class="form-label">Kode Buku</label>
              <input
                type="text"
                class="form-control"
                name="kode_buku"
                placeholder="input name here.."
                required
              />
              @error ('kode')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div> --}}

            <div class="mb-3">
                <label for="judul_buku" class="form-label">Judul Buku</label>
                <input
                  type="text"
                  class="form-control"
                  name="judul_buku"
                  placeholder="Input here"
                  required
                />
                @error ('judul_buku')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" name="kategori" aria-label="Default select example">
                  <option selected>Select one</option>
  
                  @foreach ($kategori as $item)
                    @if (('kategori') == $item->kategori_name)
                        <option value="{{ $item->kategori->kategori_name}}" selected>{{ $item->kategori_name }}</option>
                    @else
                        <option value="{{ $item->kategori_name }}" > {{ $item->kategori_name }}</option> 
                    @endif
                  @endforeach

  
                </select>
                @error ('kategori')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
              </div>
  
              <div class="mb-3">
                <label for="pengarang" class="form-label">Pengarang</label>
                <input
                  type="text"
                  class="form-control"
                  name="pengarang"
                  placeholder="input name pengarang"
                  required
                />
                @error ('pengarang')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit</label>
                <input
                  type="text"
                  class="form-control"
                  name="penerbit"
                  placeholder="input name penerbit"
                  required
                />
                @error ('penerbit')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="tanggal_publikasi" class="form-label">Tanggal Publikasi</label>
                <input
                  type="date"
                  class="form-control"
                  name="tanggal_publikasi"
                  placeholder=""
                  required
                />
                @error ('tanggal_publikasi')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

              {{-- <div class="mb-3">
                <label for="stock" class="form-label">Stock Qty</label>
                <input
                  type="number"
                  class="form-control"
                  name="stock"
                  placeholder=""
                  required
                  min="1"
                />
                @error ('stock')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div> --}}
            
           
            
            <div class="mb-3 mt-5">
                <button class="btn btn-primary" type="submit"> Submit</button>
            </div>


        </form>

          </div>
        </div>
      </div>
    </div>
    
    <!-- / Content -->
    
@endsection