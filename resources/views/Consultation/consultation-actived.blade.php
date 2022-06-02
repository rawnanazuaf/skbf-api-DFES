@extends('layouts.app2')

@section('content')
<div class="content-wrapper">   
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Actived Consultation</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>Consultation Id   </th>
                        <th>Customer Name     </th>
                        <th>Sales_id          </th>
                        <th>Vehicle Model     </th>
                        <th>Vehicle Year      </th>
                        <th>Vehicle Price     </th>
                        <th>Consultation Area </th>
                        <th>KTP               </th>
                        <th>Review State      </th>
                        <th>Review date       </th>
                        <th>Action            </th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($data_consultation as $consultation)
                  <tr>
                        <td>{{  $consultation->consultation_id }}     </td>
                        <td>{{  $consultation->customer_name }}      </td>
                        <td>{{  $consultation->sales_id }}            </td>
                        <td>{{  $consultation->vehicle_model }}       </td>
                        <td>{{  $consultation->vehicle_year }}        </td>
                        <td>{{  $consultation->vehicle_price }}       </td>
                        <td>{{  $consultation->consultation_area }}   </td>
                        <td>{{  $consultation->ktp }}                 </td>
                        <td>{{  $consultation->review_state  }}       </td>
                        <td>{{  $consultation->review_date }}         </td>
                        <td>         
                          <div class="btn-group">
                            <a href="#">
                              <button type="button" class="btn btn-danger">Details</button>
                            </a>
                          </div>
                        </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                        <th>Consultation Id   </th>
                        <th>Customer Name     </th>
                        <th>Sales_id          </th>
                        <th>Vehicle Model     </th>
                        <th>Vehicle Year      </th>
                        <th>Vehicle Price     </th>
                        <th>Consultation Area </th>
                        <th>KTP               </th>
                        <th>Review State      </th>
                        <th>Review date       </th>
                        <th>Action            </th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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

