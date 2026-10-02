@extends('admin.layouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h6 class="py-3 mb-4"><span class="text-muted fw-light">Admin/</span>
            {{ Request::segment(2) . '/' . Request::segment(3) }}
        </h6>
        
        <div class="mb-2">
            <div class="row">
                <div class="col-md-10">
                    <h5 class="mb-0">{{$title}}</h5>
                </div>
                <div class="col-md-2">
                    {{-- <a href="{{URL::To('admin/payments/add')}}">
                        <button class="btn btn-primary btn-sm text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>Add Payment</button>
                    </a>  --}}
                </div>
            </div>
        </div>
        
        <div class="card p-4">
            <div class="table-responsive text-nowrap">
                <table class="table" id="zero_config">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Actions</th>
                            <th>Payment Date</th>
                            <th>Amount</th>
                            <th>Payment Mode</th>
                            <th>Transaction ID</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">

                        @foreach ($orders as $key=>  $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    <a href="">
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailsModal" onclick="viewDetails(1)">View</button>
                                    </a>
                                    
                                </td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->total_amount}}</td>
                                <td>{{$item->transaction_mode}}</td>
                                <td>{{$item->transaction_id}}</td>
                            </tr>
                        @endforeach

                       
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Payment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    function viewDetails(id) {
        const details = {
            1: { payment_date: '2024-02-16', amount: '5000', payment_mode: 'Cash', transaction_id: 'N/A', manual_entry_details: 'Cash Amount: 5000, Date: 2024-02-16' },
            2: { payment_date: '2024-02-15', amount: '10000', payment_mode: 'UPI', transaction_id: 'UPI123456', manual_entry_details: 'Amount: 10000, Date: 2024-02-15, UPI ID: upi@bank' },
            3: { payment_date: '2024-02-14', amount: '15000', payment_mode: 'Online Transfer', transaction_id: 'TXN789123', manual_entry_details: 'Amount: 15000, Date: 2024-02-14, Bank Name: ABC Bank' },
            4: { payment_date: '2024-02-13', amount: '20000', payment_mode: 'Cheque', transaction_id: 'CHK456789', manual_entry_details: 'Amount: 20000, Cheque Date: 2024-02-13, Cheque Number: 987654, Bank Name: XYZ Bank' }
        };
        
        let payment = details[id];
        document.getElementById('modalBody').innerHTML =
            '<p><strong>Payment Date:</strong> ' + payment.payment_date + '</p>' +
            '<p><strong>Amount:</strong> ' + payment.amount + '</p>' +
            '<p><strong>Payment Mode:</strong> ' + payment.payment_mode + '</p>' +
            '<p><strong>Transaction ID:</strong> ' + payment.transaction_id + '</p>' +
            '<p><strong>Manual Entry Details:</strong> ' + payment.manual_entry_details + '</p>';
    }
</script>
@endsection
