@extends('Home.layouts.default')


@section('content')
    

<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Employee List</h4>

      @if(session('success'))
      <div class="alert alert-primary alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>    
      </div>
      @endif


      <!-- Basic Bootstrap Table -->
      <div class="card">
       
         <div class="card-header d-flex justify-content-between">
          <a href="{{ url('create_employee') }}" class="btn btn-primary">Create New</a>
          
          <div class="d-flex justify-content-between">
            <i class="bx bx-search fs-4 lh-0 mt-2 px-1"></i>
            <form action="{{ route('employee') }}" method="get">
            
              <input type="search" name="search" id="nameBasic" class="form-control" placeholder="search.."  />
  
            </form>
          </div>

         </div>

          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr class="text-nowrap">
                  <th>#</th>
                  <th>NAME</th>
                  <th>NO HP</th>
                  <th>EMAIL</th>
                  <th>ADDRESS</th>
                  <th>Bagian</th>
                  <th>ACTION</th>
                </tr>
              </thead>
              <tbody>

                @php
                 $i = 1;   
                @endphp

                @foreach ($data as $index => $row)
                    
                <tr>
                  <th scope="row">{{ ($data->currentpage()-1) * $data->perpage() + $index +1 }}</th>
                  <td>{{ $row['name'] }}</td>
                  <td>{{ $row['no_hp'] }}</td>
                  <td>{{ $row['email'] }}</td>
                  <td>{{ $row['address'] }}</td>
                  <td>{{ $row['profesi_status'] }}</td>
             
          
                  <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{ url('edit_employee', $row->id )}}"
                            ><i class="bx bx-edit-alt me-2"></i> Edit</a
                          >
                          <form action="{{ url('delete_employee',$row->id) }}" method="post">
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
          {{ $data->links() }}
        </div>
  
</div>

@endsection