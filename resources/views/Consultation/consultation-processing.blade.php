@extends('layouts.app2')

@section('content')
<div class="content-wrapper">   
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Processing Consultation</h1>
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
                        <th>Review Process    </th>
                        <th>Atlas Process     </th>
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
                        <td>{{  $consultation->current_process." - ".$consultation->process }}             </td>
                        <td>{{  $consultation->atlas_process }}       </td>
                        <td>        
                            <div class="btn-group">
                              <button type="button" class="btn btn-danger">{{  $consultation->review_state  }}</button>
                              <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <div class="dropdown-menu" role="menu">
                                <form action="/consultation-processing-update/{{$consultation->consultation_id}}" method="post">
                                {{ csrf_field() }}
                                  <input type="hidden" value="{{  $consultation->current_process }}" name="review_process">
                                  <input type="hidden" value="{{  $consultation->sales_id }}" name="sales_id">
                                  <button type="submit" class="dropdown-item" value="1" name="review_state">
                                    Approve
                                  </button>
                                  <button type="submit" class="dropdown-item" value="0" name="review_state">
                                    Reject
                                  </button>
                                </form>
                              </div>
                            </div>
                        </td>
                        <td>{{  $consultation->review_date }}         </td>
                        <td>         
                          <div class="btn-group">
                            <a href="/detail-consultation-processing/{{$consultation->consultation_id}}">
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
                        <th>Review Process    </th>
                        <th>Atlas Process     </th>
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

