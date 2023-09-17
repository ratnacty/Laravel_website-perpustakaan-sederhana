@extends('Home.layouts.default')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />




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
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span>Entry Rent Book</h4>
        
        </div>

    <div class="col-md-10" >
        <div class="card mb-4" style="margin-left: 240px;" >
          <div class="card-body">

            @if(session('Warning'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('Warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
            </div>
            @endif

            <form action="{{ route('peminjaman.store') }}" method="post">
                @csrf
           
            <div class="mb-3">
                <label for="user_id" class="form-label">Nama Peminjam</label>
                <select class="form-control inputBox" name="user_id" id="user_id" >
                  <option value="">Select User</option>
                  @foreach ($users as $user)
                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                  @endforeach

                </select>
                
                @error ('user_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

             


            <div class="mb-3">
                <label for="buku_id" class="form-label ">Judul Buku</label>
                <select class="form-control inputBox" name="buku_id" id="buku_id" >
                  <option value="">Select Book</option>
                  @foreach ($books as $book)
                  <option value="{{ $book->id }}">{{ $book->judul_buku }}</option>
                  @endforeach

                </select>
                @error ('buku_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>
            
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



<script>
  // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.inputBox').select2();
});
</script>