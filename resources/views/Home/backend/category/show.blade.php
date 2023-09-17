@extends('Home.layouts.default')

@section('content')
    
<div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y">
               
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Category</h4>

    @if(session('success'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
    </div>
    @endif

<div class="card">
    <div class="card-header">
        <a href="" class="btn btn-primary"  data-bs-toggle="modal"
        data-bs-target="#basicModal">Create New</a>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-dark">
        <thead>
          <tr>
            <th>No</th>
            <th>Category Name</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">

            @php
             $i = 1;   
            @endphp

            @foreach ($category as $row)
                
          <tr>
            
            <td>{{ $i++ }}</td>
            <td>{{ $row->kategori_name }}</td>
              
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"
                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                  >

                  <form action="{{ route('category.destroy',$row->id) }}" method="POST">
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



<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
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
</div>
</div>

@endsection