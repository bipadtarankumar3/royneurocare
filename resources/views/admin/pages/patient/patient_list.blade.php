@extends('admin.layouts.main')

@section('content')

    <!-- Custom CSS -->
<style>
    .custom-nav-tabs {
        display: flex;
        justify-content: center;
        padding: 10px;
    }

    .custom-nav-tabs .nav-link {
        font-size: 16px; /* Slightly bigger text */
        color: black; /* Default text color */
        transition: all 0.3s ease-in-out;
    }

    .custom-nav-tabs .nav-link.active {
        color: white !important; /* Active text color */
        background-color: #007bff !important; /* Blue background */
        font-size: 18px; /* Bigger text when active */
        font-weight: bold;
        border-radius: 5px;
    }

    .custom-nav-tabs .nav-link:hover {
        color: #007bff; /* Hover effect */
    }
</style>


    <div class="container-xxl flex-grow-1 container-p-y">
        <h6 class="py-3 mb-4"><span class="text-muted fw-light">Admin /</span> patient</h6>

        <div class="card p-4">

            <ul class="nav nav-tabs text-center custom-nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Today</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Tomorrow</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Yesterday</button>
                </li>
            </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="table-responsive text-nowrap">
                        <table class="table"  id="todayTable">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>DOB</th>
                                    <th>Sex</th>
                                    <th>Age</th>
                                    <th>Mobile No</th>
                                    <th>Alt Mobile</th>
                                    <th>Address</th>
                                    <th>Problem</th>
                                   
                                    <th>Amount</th>
                                    <th>Transaction Id</th>
                                    <th>Payment Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($today_orders as $key => $order)
                                @php
                                        // Convert from_time to hour for color logic
                                        $hour = date('H', strtotime($order->from_time));
                                        if ($hour < 12) {
                                            $timeClass = 'bg-warning'; // Morning
                                        } elseif ($hour < 17) {
                                            $timeClass = 'bg-success'; // Afternoon
                                        } else {
                                            $timeClass = 'bg-primary'; // Evening
                                        }
                                    @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->booking_date)->format('d/m/Y') }} </td>
                                    <td><span class="badge {{ $timeClass }}">{{ $order->from_time }} - {{ $order->to_time }}</span></td>
                                    <td>{{ $order->first_name }}</td>
                                    <td>{{ $order->last_name }}</td>
                                    <td>{{ $order->dob }}</td>
                                    <td>{{ $order->sex }}</td>
                                    <td>{{ $order->age }}</td>
                                    <td>{{ $order->mobile_no }}</td>
                                    <td>{{ $order->alternate_mobile_no }}</td>
                                    <td>{{ $order->address }}</td>
                                    <td>{{ $order->patient_problem }}</td>
                                    
                                    <td>{{ $order->total_amount }}</td>
                                    <td>#{{ $order->transaction_id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->payment_date)->format('d/m/Y') }}</td>
                                    <td>
                                        @php
                                            $statusClass = match(strtolower($order->status)) {
                                                'pending' => 'badge bg-warning text-dark',
                                                'completed' => 'badge bg-success',
                                                'cancelled', 'canceled' => 'badge bg-danger',
                                                'processing' => 'badge bg-info text-dark',
                                                default => 'badge bg-secondary'
                                            };
                                        @endphp
                                        <span class="{{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                                    </td>
                                    
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    &#x22EE;
                                                </button>
                                                <ul class="dropdown-menu">
                                                    
                                                    <li>
                                                        <a class="dropdown-item" href="{{ url('admin/patient-history/status-change/'.$order->id) }}">Status Change</a>
                                                    </li>
                                                    <li><a class="dropdown-item text-danger" href="javascript:void(0);" onclick="deleteConfirmation(event, {{ $order->id }});">Delete</a></li>
                                                
                                                </ul>
                                            </div>
                                        </td> 
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive text-nowrap">
                        <table class="table"  id="tomorrowTable">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>DOB</th>
                                    <th>Sex</th>
                                    <th>Age</th>
                                    <th>Mobile No</th>
                                    <th>Alt Mobile</th>
                                    <th>Address</th>
                                    <th>Problem</th>
                                    <th>Amount</th>
                                    <th>Transaction Id</th>
                                    <th>Payment Date</th>
                                    <th>Status</th>
                                     <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($tomorrow_orders as $key => $order)

                                    @php
                                        // Convert from_time to hour for color logic
                                        $hour = date('H', strtotime($order->from_time));
                                        if ($hour < 12) {
                                            $timeClass = 'bg-warning'; // Morning
                                        } elseif ($hour < 17) {
                                            $timeClass = 'bg-success'; // Afternoon
                                        } else {
                                            $timeClass = 'bg-primary'; // Evening
                                        }
                                    @endphp


                                    <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->booking_date)->format('d/m/Y') }}</td>
                                            <td>
                                                <span class="badge {{ $timeClass }}">{{ $order->from_time }} - {{ $order->to_time }}</span>
                                            </td>
                                            
                                            <td>{{ $order->first_name }}</td>
                                            <td>{{ $order->last_name }}</td>
                                            <td>{{ $order->dob }}</td>
                                            <td>{{ $order->sex }}</td>
                                            <td>{{ $order->age }}</td>
                                            <td>{{ $order->mobile_no }}</td>
                                            <td>{{ $order->alternate_mobile_no }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>{{ $order->patient_problem }}</td>
                                           
                                            
                                            <td>{{ $order->total_amount }}</td>
                                            <td>#{{ $order->transaction_id }}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->payment_date)->format('d/m/Y') }}</td>
                                            <td>
                                                @php
                                                    $statusClass = match(strtolower($order->status)) {
                                                        'pending' => 'badge bg-warning text-dark',
                                                        'completed' => 'badge bg-success',
                                                        'cancelled', 'canceled' => 'badge bg-danger',
                                                        'processing' => 'badge bg-info text-dark',
                                                        default => 'badge bg-secondary'
                                                    };
                                                @endphp
                                                <span class="{{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                                            </td>
                                            
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    &#x22EE;
                                                </button>
                                                <ul class="dropdown-menu">
                                                    
                                                     <li>
                <a class="dropdown-item" href="{{ url('admin/patient-history/status-change/'.$order->id) }}">Status Change</a>
            </li>
                                                    <li><a class="dropdown-item text-danger" href="javascript:void(0);" onclick="deleteConfirmation(event, {{ $order->id }});">Delete</a></li>
                                                </ul>
                                            </div>
                                        </td> 
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="table-responsive text-nowrap">
                        <table class="table"  id="yesterdayTable">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>DOB</th>
                                    <th>Sex</th>
                                    <th>Age</th>
                                    <th>Mobile No</th>
                                    <th>Alt Mobile</th>
                                    <th>Address</th>
                                    <th>Problem</th>
                                   
                                    <th>Amount</th>
                                    <th>Transaction Id</th>
                                    <th>Payment Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach($yesterday_orders as $key => $order)
                                @php
                                        // Convert from_time to hour for color logic
                                        $hour = date('H', strtotime($order->from_time));
                                        if ($hour < 12) {
                                            $timeClass = 'bg-warning'; // Morning
                                        } elseif ($hour < 17) {
                                            $timeClass = 'bg-success'; // Afternoon
                                        } else {
                                            $timeClass = 'bg-primary'; // Evening
                                        }
                                    @endphp

                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->booking_date)->format('d/m/Y') }}</td>
                                        <td><span class="badge {{ $timeClass }}">{{ $order->from_time }} - {{ $order->to_time }}</span>
                                        
                                            <td>{{ $order->first_name }}</td>
                                            <td>{{ $order->last_name }}</td>
                                            <td>{{ $order->dob }}</td>
                                            <td>{{ $order->sex }}</td>
                                            <td>{{ $order->age }}</td>
                                            <td>{{ $order->mobile_no }}</td>
                                            <td>{{ $order->alternate_mobile_no }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>{{ $order->patient_problem }}</td>
                                           
                                            <td>{{ $order->total_amount }}</td>
                                            <td>#{{ $order->transaction_id }}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->payment_date)->format('d/m/Y') }}</td>
                                            <td>
                                                @php
                                                    $statusClass = match(strtolower($order->status)) {
                                                        'pending' => 'badge bg-warning text-dark',
                                                        'completed' => 'badge bg-success',
                                                        'cancelled', 'canceled' => 'badge bg-danger',
                                                        'processing' => 'badge bg-info text-dark',
                                                        default => 'badge bg-secondary'
                                                    };
                                                @endphp
                                                <span class="{{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                                            </td>
                                            
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    &#x22EE;
                                                </button>
                                                <ul class="dropdown-menu">
                                                    
                                                     <li>
                <a class="dropdown-item" href="{{ url('admin/patient-history/status-change/'.$order->id) }}">Status Change</a>
            </li>
                                                    <li><a class="dropdown-item text-danger" href="javascript:void(0);" onclick="deleteConfirmation(event, {{ $order->id }});">Delete</a></li>
                                                </ul>
                                            </div>
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
@endsection

@section('js')


<script>
    $(document).ready(function () {
    $('#todayTable, #tomorrowTable, #yesterdayTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'csvHtml5',
                text: 'Export CSV',
                className: 'btn btn-sm btn-primary',
                title: 'Appointment Data',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ]
    });
});


</script>
<script>
    function deleteConfirmation(event, id) {
    event.preventDefault();
    if (confirm('Are you sure you want to delete this record?')) {
        window.location.href = '{{ url('admin/patient_history/delete') }}/' + id;
    }
}

</script>
@endsection
