@extends('admin.layouts.main')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
        <div class="home-tab">
          <div class="d-sm-flex align-items-center justify-content-between border-bottom">
            
          </div>
          <div class="tab-content tab-content-basic">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
              <div class="row">
                <div class="col-sm-12">
                  <div class="statistics-details d-flex align-items-center justify-content-between">

                    <div>
                      <p class="statistics-title">Total Patients </p>
                      <h3 class="rate-percentage">{{$patient}}</h3>
                      {{-- <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span></p> --}}
                    </div>
                    <div class="d-none d-md-block">
                      <p class="statistics-title">Total Bookings</p>
                      <h3 class="rate-percentage">{{$booking}}</h3>
                      {{-- <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p> --}}
                    </div>
                    <div class="d-none d-md-block">
                      <p class="statistics-title">Total Cancelled Booking</p>
                      <h3 class="rate-percentage">{{$cancelled_booking}}</h3>
                      {{-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p> --}}
                    </div>
                    <div class="d-none d-md-block">
                      <p class="statistics-title">Total Payments</p>
                      <h3 class="rate-percentage">₹ {{ number_format($total_payments,2)}}</h3>
                      {{-- <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p> --}}
                    </div>
                  </div>
                </div>
              </div>

                <hr>
              <div class="row">
                <div class="col-sm-12">
                  <div class="statistics-details d-flex align-items-center justify-content-between">

                    <div>
                      <p class="statistics-title">Today Patients </p>
                      <h3 class="rate-percentage">{{$today_patient}}</h3>
                      {{-- <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span></p> --}}
                    </div>
                    <div class="d-none d-md-block">
                      <p class="statistics-title">Today Bookings</p>
                      <h3 class="rate-percentage">{{$today_booking}}</h3>
                      {{-- <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p> --}}
                    </div>
                    <div class="d-none d-md-block">
                      <p class="statistics-title">Today Cancelled Booking</p>
                      <h3 class="rate-percentage">{{$today_cancelled_booking}}</h3>
                      {{-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p> --}}
                    </div>
                    <div class="d-none d-md-block">
                      <p class="statistics-title">Today Payments</p>
                      <h3 class="rate-percentage">₹ {{ number_format($today_total_payments,2)}}</h3>
                      {{-- <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p> --}}
                    </div>
                  </div>
                </div>
              </div>




              {{-- <div class="row">
                <div class="col-lg-8 d-flex flex-column">
                    
                  <div class="row flex-grow">
                    <div class="col-12 grid-margin stretch-card">
                      <div class="card card-rounded">
                        <div class="card-body">
                          <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                              <h4 class="card-title card-title-dash">Todays Patient</h4>
                              <p class="card-subtitle card-subtitle-dash">You have {{$today_patient}}+ new Patient</p>
                            </div>
                            <div>
                           </div>
                          </div>
                          <div class="table-responsive  mt-1">
                            <table class="table select-table">
                              <thead>
                                <tr>
                                  
                                  <th>Name</th>
                                  <th>DOB</th>
                                  <th>Sex</th>
                                  <th>Age</th>
                                  <th>Mobile</th>
                                  <th>Alternate mobile</th>
                                  <th>Address</th>
                                  <th>Date</th>
                                </tr>
                              </thead>
                              <tbody>

                                @foreach ($patient_list as $item)
                                <tr>
                                  
                                  <td>
                                    <div class="d-flex ">
                            
                                      <div>
                                        <h6>{{$item->name}}</h6>
                                 
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <h6>{{$item->dob}}</h6>
                                  </td>
                                  <td>
                                    <h6>{{$item->sex}}</h6>
                                  </td>
                                  <td>
                                    <h6>{{$item->age}}</h6>
                                  </td>
                                  <td>
                                    <h6>{{$item->mobile_no}}</h6>
                                  </td>
                                  <td>
                                    <h6>{{$item->alternate_mobile_no}}</h6>
                                  </td>
                                  <td>
                                    <h6>{{$item->address}}</h6>
                                  </td>
                                  <td>
                                    <div class="badge badge-opacity-warning">{{$item->created_at}}</div>
                                  </td>
                                </tr>
                                @endforeach

                                
                               
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 d-flex flex-column">
                  <div class="row flex-grow">

                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                      <div class="card card-rounded">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                                <div class="circle-progress-width">
                                  <div id="totalVisitors" class="progressbar-js-circle pr-2"></div>
                                </div>
                                <div>
                                  <p class="text-small mb-2">Today Booking</p>
                                  <h4 class="mb-0 fw-bold">{{$today_booking}}</h4>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="d-flex justify-content-between align-items-center">
                                <div class="circle-progress-width">
                                  <div id="visitperday" class="progressbar-js-circle pr-2"></div>
                                </div>
                                <div>
                                  <p class="text-small mb-2">Today Payments</p>
                                  <h4 class="mb-0 fw-bold">₹ {{ number_format($today_total_payments, 2) }}</h4>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="row flex-grow">
                    <div class="col-12 grid-margin stretch-card">
                      <div class="card card-rounded">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="card card-rounded">
                                <div class="card-body card-rounded">
                                  <h4 class="card-title  card-title-dash">Cancelled Bookings</h4>

                                  @foreach ($cancelled_booking_lists as $order)
                                  <div class="list align-items-center border-bottom py-2">
                                    <div class="wrapper w-100">
                                      <p class="mb-2 fw-medium"> {{ $order->patient_name }} </p>
                                      <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                          <i class="mdi mdi-calendar text-muted me-1"></i>
                                          <p class="mb-0 text-small text-muted">{{ \Carbon\Carbon::parse($order->booking_date)->format('d/m/Y') }} / {{ $order->from_time }} - {{ $order->to_time }}</p>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  @endforeach
                                  
           
                                  <div class="list align-items-center pt-3">
                                    <div class="wrapper w-100">
                                      <p class="mb-0">
                                        <a href="{{URL::To('admin/patient')}}" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                </div>
              </div>
              <div class="row">
                <div class="col-lg-8 d-flex flex-column">
                  
                  
                  <div class="row flex-grow">
                    <div class="col-12 grid-margin stretch-card">
                      <div class="card card-rounded">
                        <div class="card-body">
                          <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                              <h4 class="card-title card-title-dash">Todays Booking</h4>
                              <p class="card-subtitle card-subtitle-dash">You have {{$today_booking}}+ new Booking</p>
                            </div>
                            <div>
                            </div>
                          </div>
                          <div class="table-responsive  mt-1">

                            <table class="table select-table">

                           
                              <thead>
                                <tr>
                                    <th>Sl</th>
                                  
                                    <th>Patient</th>
                                    <th>Booking Date/Time</th>
                                    <th>Amount</th>
                                    <th>Transaction Id</th>
                                    <th>Payment Date</th>
                                </tr>
                            </thead>
                            <tbody >
                                @foreach($today_orders as $key => $order)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                          <div class="d-flex ">
                            
                                            <div>
                                              <h6>
                                          {{ $order->patient_name }}
                                        </h6>
                                 
                                      </div>
                                    </div>
                                        </td>
                                        <td><h6>{{ \Carbon\Carbon::parse($order->booking_date)->format('d/m/Y') }} / {{ $order->from_time }} - {{ $order->to_time }} </h6></td>
                                        <td><h6>₹ {{ number_format($order->total_amount, 2) }}</h6></td>
                                        <td><h6>#{{ $order->transaction_id }}</h6></td>
                                        <td><div class="badge badge-opacity-warning">{{ \Carbon\Carbon::parse($order->payment_date)->format('d/m/Y') }}</div></td>
                                   
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                 
                 
                </div>
                <div class="col-lg-4 d-flex flex-column">
                
                </div>
              </div> --}}


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->

</div>

@endsection
