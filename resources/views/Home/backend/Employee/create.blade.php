
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Employee</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

       @include('Home.includes.layout-menu')
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">

          <!-- Navbar -->

        @include('Home.includes.navbar')

          <!-- / Navbar -->

          <!-- Content wrapper -->
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
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span>Employee</h4>
                <div class="mt-3">
                    <a href="{{ url('employee') }}" class="btn btn-warning">Back</a> 
                </div>
                </div>

            <div class="col-md-10" >
                <div class="card mb-4" style="margin-left: 240px;" >
                  <h5 class="card-header">Create new Employee</h5>
                  <div class="card-body">


                    <form action="{{ url('store_employee') }}" method="post">
                        @csrf
    
                    <div class="mb-3">
                      <label for="name" class="form-label">Name</label>
                      <input
                        type="text"
                        class="form-control"
                        name="name"
                        placeholder="input name here.."
                        required
                      />
                      @error ('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input
                          type="email"
                          class="form-control"
                          name="email"
                          placeholder="name@example.com"
                          required
                        />
                        @error ('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="no_hp" class="form-label">No Handpohone</label>
                        <input
                          type="number"
                          class="form-control"
                          name="no_hp"
                          placeholder="0894762893"
                          required
                        />
                        @error ('no_hp')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Address</label>
                        <input
                          type="text"
                          class="form-control"
                          name="address"
                          placeholder="name@example.com"
                          required
                        />
                        @error ('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                      </div>
                    
                   
                    <div class="mb-3">
                      <label for="profesi_status" class="form-label">Departement</label>
                      <select class="form-select" name="profesi_status" aria-label="Default select example">
                        <option selected>Select one</option>
                        <option value="Office">Office</option>
                        <option value="Staff Admin">Staff Admin</option>
                        <option value="GM">GM</option>
                        <option value="Office Boy/Girl">Office Boy</option>
                      </select>
                      @error ('profesi_status')
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

            <!-- Footer -->
            @include('Home.includes.footer')
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

   

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    @include('Home.includes.script')
  </body>
</html>
