@extends('Home.layouts.default')


@section('content')
    

<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">


    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> User</h4>

    @if(session('success'))
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
    </div>
    @endif

    <div class="card">
    <div class="card-header" style="display: flex; justify-content:space-between">
        <a href="" class="btn btn-primary"  data-bs-toggle="modal"
        data-bs-target="#basicModal">Create New</a>

        <div class="d-flex justify-content-between">
          <i class="bx bx-search fs-4 lh-0 mt-2 px-1"></i>
          <form action="{{ route('user') }}" method="get">
          
            <input type="search" name="search" id="nameBasic" class="form-control" placeholder="search.."  />

          </form>
        </div>
    </div>


    <div class="table-responsive text-nowrap">
      <table class="table table-dark">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Bagian</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">

            @php
             $i = 1;   
            @endphp

            @foreach ($user as $index => $row)
                
          <tr>
           
            
            <td>{{ ($user->currentpage()-1) * $user->perpage() + $index +1 }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->level }}</td>
              
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="" data-bs-toggle="modal"
                  data-bs-target="#editModal{{ $row->id }}"
                    ><i class="bx bx-edit-alt me-1"></i> Edit</a
                  >

                  <form action="{{ route('delete_user',$row->id) }}" method="POST">
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

      <div class="mt-5">
        {{ $user->render() }}
      </div>
        


    </div>
  </div>
  </div>



  <!-- Modal create -->
  <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Create User</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <form action="{{ route('store_user') }}" method="post">
            @csrf
            <div class="modal-body">
            <div class="row">
              <div class="row">
                <div class="col mb-3"> 
                  <label for="name" class="form-label">User Name</label>
                  <input type="text" name="name" id="nameBasic" class="form-control" placeholder="Enter Name" required />
                    @error ('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
              </div>

              <div class="row">
                <div class="col mb-3">
                  <label for="email" class="form-label">User email</label>
                  <input type="email" name="email" id="nameBasic" class="form-control" placeholder="Enter email" required />
                    @error ('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
              </div>

              <div class="row">
                <div class="col mb-3">
                  <label for="level" class="form-label">Level</label>
                  <select class="form-select" name="level" id="nameBasic" aria-label="Default select example">
                    <option selected>Select one</option>
                  
                    <option value="admin" >Admin</option>
                    <option value="staff" >Staff</option>
                    <option value="anggota" >Anggota</option>

                  </select>
                      @error ('level')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                  </div>
                </div>

                <div class="row">
                <div class="col mb-3">
                  <label for="password" class="form-label">User password</label>
                  <input type="password" name="password" id="nameBasic" class="form-control" placeholder="Enter password" required />
                      @error ('password')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                       
                 </div>
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
 
  {{-- End Modal --}}

   <!-- Modal edit -->

   @foreach ($user as $row)
       

   <div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Edit User</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <form action="{{ route('update_user',$row->id) }}" method="post">
            @csrf
            @method('PATCH')

            <div class="modal-body">
            <div class="row">
                <div class="col mb-3">
                <label for="name" class="form-label">User Name</label>
                <input type="text" name="name" class="form-control" value="{{ $row->name }}" required />
                    @error ('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
  
                <div class="row">
                    <div class="col mb-3">
                    <label for="email" class="form-label">User email</label>
                    <input type="email" name="email" class="form-control" value="{{ $row->email }}" required />
                        @error ('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="row">
                  <div class="col mb-3">
                    <label for="level" class="form-label">Level</label>
                    <select class="form-select" name="level" id="nameBasic" aria-label="Default select example">
                    
                      <option value="{{ $row->level }}" selected >{{ $row->level }}</option>
                      <option value="admin" >Admin</option>
                      <option value="staff" >Staff</option>
                      <option value="anggota" >Anggota</option>
                    </select>
                        @error ('level')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
              

                <div class="row">
                  <div class="col mb-3">
                    <label for="password" class="form-label">User password</label>
                        <input type="password" name="password" class="form-control" value="{{ $row->password }}" required />
                            @error ('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror    
                  </div>
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
  @endforeach
  
  {{-- End Modal --}}


@endsection

 

 