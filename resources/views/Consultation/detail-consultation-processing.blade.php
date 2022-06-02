@extends('layouts.app2')

@section('content')
<div class="content-wrapper">   
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Processing Consultation</h1>
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
                <form action="" method="" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="card-body">
                        @foreach($data_consultation as $consultation)
                        <div class="form-group">
                            <label>Sales ID</label>
                            <input type="text" class="form-control" name="customer_name" value="{{  $consultation->sales_id }}">
                        </div>
                        <div class="form-group">
                            <label>Sales Name</label>
                            <input type="text" class="form-control" name="customer_name" value="{{  $consultation->sales_name }}">
                        </div>
                        <div class="form-group">
                            <label>Consultation ID</label>
                            <input type="text" class="form-control" name="customer_name" value="{{  $consultation->consultation_id }}">
                        </div>
                        <div class="form-group">
                            <label>Customer Name</label>
                            <input type="text" class="form-control" name="customer_name" value="{{  $consultation->customer_name }}">
                        </div>
                        <div class="form-group">
                            <label>Spouse Name</label>
                            <input type="text" class="form-control" name="spouse_name" value="{{  $consultation->spouse_name }}">
                        </div>
                        <div class="form-group">
                            <label>Director Name</label>
                            <input type="text" class="form-control" name="director_name" value="{{  $consultation->director_name }}">
                        </div>
                        <div class="form-group">
                            <label>Shareholders</label>
                            <input type="text" class="form-control" name="shareholders" value="{{  $consultation->shareholders }}">
                        </div>
                        <div class="form-group">
                            <label>Dealer Name</label>
                            <input type="text" class="form-control" name="dealer_name" value="{{  $consultation->dealer_name }}">
                        </div>
                        <div class="form-group">
                            <label>Produk</label>
                            <input type="text" class="form-control" name="produk" value="{{  $consultation->produk }}">
                        </div>
                        <div class="form-group">
                            <label>Brand</label>
                            <input type="text" class="form-control" name="brand" value="{{  $consultation->brand }}">
                        </div>
                        <div class="form-group">
                            <label>Vehicle Model</label>
                            <input type="text" class="form-control" name="vehicle_model" value="{{  $consultation->vehicle_model }}">
                        </div>
                        <div class="form-group">
                            <label>Vehicle Year</label>
                            <input type="text" class="form-control" name="vehicle_year" value="{{  $consultation->vehicle_year }}">
                        </div>
                        <div class="form-group">
                            <label>Vehicle Price</label>
                            <input type="text" class="form-control" name="vehicle_price" value="{{  $consultation->vehicle_price }}">
                        </div>
                        <div class="form-group">
                            <label>Loan Amount</label>
                            <input type="text" class="form-control" name="loanAmt" value="{{  $consultation->loanAmt }}">
                        </div>
                        <div class="form-group">
                            <label>Units Amount</label>
                            <input type="text" class="form-control" name="unitsAmt" value="{{  $consultation->unitsAmt }}">
                        </div>
                        <div class="form-group">
                            <label>Insurance</label>
                            <input type="text" class="form-control" name="insurance" value="{{  $consultation->insurance }}">
                        </div>
                        <div class="form-group">
                            <label>Dp Percent</label>
                            <input type="text" class="form-control" name="dpPercent" value="{{  $consultation->dpPercent }}">
                        </div>
                        <div class="form-group">
                            <label>Tenure</label>
                            <input type="text" class="form-control" name="tenure" value="{{  $consultation->tenure }}">
                        </div>
                        <div class="form-group">
                            <label>ADDM / ADDB</label>
                            <input type="text" class="form-control" name="addm_addb" value="{{  $consultation->addm_addb }}">
                        </div>
                        <div class="form-group">
                            <label>effectiveRate</label>
                            <input type="text" class="form-control" name="effectiveRate" value="{{  $consultation->effectiveRate }}">
                        </div>
                        <div class="form-group">
                            <label>telno</label>
                            <input type="text" class="form-control" name="telno" value="{{  $consultation->telno }}">
                        </div>
                        <div class="form-group">
                            <label>Consultation Area</label>
                            <input type="text" class="form-control" name="consultation_area" value="{{  $consultation->consultation_area }}">
                        </div>
                        <div class="form-group">
                            <label>Review Process</label>
                            <input type="text" class="form-control" name="consultation_area" value="{{  $consultation->current_process.' - '.$consultation->process }}">
                        </div>
                        <div class="form-group">
                            <label>Atlas Proses</label>
                            <input type="text" class="form-control" name="consultation_area" value="{{  $consultation->atlas_process }}">
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputFile">KTP</label>
                            <input type="text" class="form-control" name="ktp" id="exampleInputFile" value="{{  $consultation->ktp }}">
                            <input type="image" src="{{ asset('/storage/files/'.$consultation->sales_id.'/'.$consultation->ktp) }}" alt="image">
                            <img src="{{ asset('/storage/files/'.$consultation->sales_id.'/'.$consultation->ktp) }}" alt="image">
                        </div> -->
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h4 class="card-title">KTP</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <a href="{{ asset('/storage/files/'.$consultation->sales_id.'/'.$consultation->ktp) }}" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                                        <img src="{{ asset('/storage/files/'.$consultation->sales_id.'/'.$consultation->ktp) }}" class="img-fluid mb-2" alt="white sample"/>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h4 class="card-title">KK</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <a href="{{ asset('/storage/files/'.$consultation->sales_id.'/'.$consultation->kk) }}" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                                        <img src="{{ asset('/storage/files/'.$consultation->sales_id.'/'.$consultation->kk) }}" class="img-fluid mb-2" alt="white sample"/>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h4 class="card-title">NPWP</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <a href="{{ asset('/storage/files/'.$consultation->sales_id.'/'.$consultation->npwp) }}" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                                        <img src="{{ asset('/storage/files/'.$consultation->sales_id.'/'.$consultation->npwp) }}" class="img-fluid mb-2" alt="white sample"/>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputFile">Kk</label>
                            <input type="text" class="form-control" name="kk" id="exampleInputFile" value="{{  $consultation->kk }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">NPWP</label>
                            <input type="text" class="form-control" name="npwp" id="exampleInputFile" value="{{  $consultation->npwp }}">
                        </div> -->
                        @endforeach    
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