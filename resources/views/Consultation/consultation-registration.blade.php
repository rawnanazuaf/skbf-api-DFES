@extends('layouts.app2')

@section('content')
<div class="content-wrapper">   
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Consultation Registration</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Make sure the data entered is correct!</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="/consultation-registration/store" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="card-body">
                    <div class="form-group">
                        <label>Customer Name</label>
                        <input type="text" class="form-control" name="customer_name">
                    </div>
                    <div class="form-group">
                        <label>Spouse Name</label>
                        <input type="text" class="form-control" name="spouse_name">
                    </div>
                    <div class="form-group">
                        <label>Director Name</label>
                        <input type="text" class="form-control" name="director_name">
                    </div>
                    <div class="form-group">
                        <label>Shareholders</label>
                        <input type="text" class="form-control" name="shareholders">
                    </div>
                    <div class="form-group">
                        <label>Dealer Name</label>
                        <input type="text" class="form-control" name="dealer_name">
                    </div>
                    <div class="form-group">
                        <label>Produk</label>
                        <input type="text" class="form-control" name="produk">
                    </div>
                    <div class="form-group">
                        <label>Brand</label>
                        <input type="text" class="form-control" name="brand">
                    </div>
                    <div class="form-group">
                        <label>Vehicle Model</label>
                        <input type="text" class="form-control" name="vehicle_model">
                    </div>
                    <div class="form-group">
                        <label>Vehicle Year</label>
                        <input type="text" class="form-control" name="vehicle_year">
                    </div>
                    <div class="form-group">
                        <label>Vehicle Price</label>
                        <input type="text" class="form-control" name="vehicle_price">
                    </div>
                    <div class="form-group">
                        <label>Loan Amount</label>
                        <input type="text" class="form-control" name="loanAmt">
                    </div>
                    <div class="form-group">
                        <label>Units Amount</label>
                        <input type="text" class="form-control" name="unitsAmt">
                    </div>
                    <div class="form-group">
                        <label>Insurance</label>
                        <input type="text" class="form-control" name="insurance">
                    </div>
                    <div class="form-group">
                        <label>Dp Percent</label>
                        <input type="text" class="form-control" name="dpPercent">
                    </div>
                    <div class="form-group">
                        <label>Tenure</label>
                        <input type="text" class="form-control" name="tenure">
                    </div>
                    <div class="form-group">
                        <label>ADDM / ADDB</label>
                        <input type="text" class="form-control" name="addm_addb">
                    </div>
                    <div class="form-group">
                        <label>effectiveRate</label>
                        <input type="text" class="form-control" name="effectiveRate">
                    </div>
                    <div class="form-group">
                        <label>telno</label>
                        <input type="text" class="form-control" name="telno">
                    </div>
                    <div class="form-group">
                        <label>Consultation Area</label>
                        <input type="text" class="form-control" name="consultation_area">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">KTP</label>
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="ktp" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Kk</label>
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="kk" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">NPWP</label>
                        <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="npwp" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                        <label class="form-check-label" for="exampleCheck1">I HAVE CHECKED THE CONSULTATION DATA AND IT IS CORRECT.</label>
                    </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>            
            </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection