@extends('admin.layouts.main')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('title', 'Medicines')

@section('breadcrum-title', 'Medicines')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Medicines')

@push('stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
@endpush

@section('content')
    <div class="dashboard-header">
        <div class="header-back">
            <h3>Medicine List</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <a href="#add_medicine" class="btn btn-primary prime-btn float-end mb-3" data-bs-toggle="modal"><i class="fa-solid fa-plus me-2"></i>Add</a>
        </div>
        <div class="col-sm-12">
            <div class="account-detail-table">
                <div class="custom-new-table">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0" id="medicine-master-table">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($medicines as $medicine)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>{{ $medicine->name }}</td>
                                        <td>
                                            <span class="badge badge-success-bg">Completed</span>
                                        </td>
                                        <td>
                                            <a href="#edit_medicine" class="edit-medicine-button account-action" data-bs-toggle="modal" title="Edit Medicine" data-medicine-id="{{$medicine->id}}" data-medicine-name="{{$medicine->name}}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
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

@section('modal')
    <!-- Add Medicine Moodal -->
    <div class="modal fade custom-modal custom-modal-two modal-lg" id="add_medicine">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Medicine</h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span><i class="fa-solid fa-x"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-block input-block-new">
                        <label class="form-label">Medicine Name</label>
                        <input type="text" class="form-control" id="medicineName">
                    </div>

                    <div class="alert alert-danger d-none">
                        <ul>
                            <li id="add-medicine-error"></li>
                        </ul>
                    </div>

                    <div class="form-set-button">
                        <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" id="add-medicine-button">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Medicine Moodal -->


    <!-- Edit Medicine Moodal -->
    <div class="modal fade custom-modal custom-modal-two modal-lg" id="edit_medicine">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Medicine</h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span><i class="fa-solid fa-x"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-block input-block-new">
                        <label class="form-label">Medicine Name</label>
                        <input type="text" class="form-control" id="edit-medicine-name">
                    </div>

                    <div class="alert alert-danger d-none">
                        <ul>
                            <li id="edit-medicine-error"></li>
                        </ul>
                    </div>

                    <div class="form-set-button">
                        <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" id="edit-medicine-button">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /Edit Medicine Moodal -->

    <!-- Account Details Modal-->
    <div class="modal fade custom-modal custom-modal-two modal-lg" id="account_details">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Account Details</h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span><i class="fa-solid fa-x"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="accounts.htm;">
                        <div class="input-block input-block-new">
                            <label class="form-label">Bank Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="input-block input-block-new">
                            <label class="form-label">Branch Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="input-block input-block-new">
                            <label class="form-label">Account Number</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="input-block input-block-new">
                            <label class="form-label">Account Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-set-button">
                            <button class="btn btn-light" type="button">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- /Account Details Modal-->

    <!-- Other Accounts Modal-->
    <div class="modal fade custom-modal custom-modal-two modal-lg" id="other_accounts">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Other Accounts</h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span><i class="fa-solid fa-x"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="other-accounts-info">
                        <ul>
                            <li>
                                <ul class="other-bank-info">
                                    <li>
                                        <h6>Name</h6>
                                        <span>Citi Bank Inc</span>
                                    </li>
                                    <li>
                                        <h6>Account No</h6>
                                        <span>5396 5250 1908 XXXX</span>
                                    </li>
                                    <li>
                                        <h6>Branch</h6>
                                        <span>London</span>
                                    </li>
                                    <li>
                                        <h6>Name on Bank Account</h6>
                                        <span>Edalin Hendry</span>
                                    </li>
                                    <li>
                                        <a href="#">Current</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <ul class="other-bank-info">
                                    <li>
                                        <h6>Name</h6>
                                        <span>HDFC Bank Inc</span>
                                    </li>
                                    <li>
                                        <h6>Account No</h6>
                                        <span>7382 4924 4924 XXXX</span>
                                    </li>
                                    <li>
                                        <h6>Branch</h6>
                                        <span>New York</span>
                                    </li>
                                    <li>
                                        <h6>Name on Bank Account</h6>
                                        <span>Edalin Hendry</span>
                                    </li>
                                    <li>
                                        <a href="#">Change to default</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <ul class="other-bank-info">
                                    <li>
                                        <h6>Name</h6>
                                        <span>Union Bank Inc</span>
                                    </li>
                                    <li>
                                        <h6>Account No</h6>
                                        <span>8934 4902 9024 XXXX</span>
                                    </li>
                                    <li>
                                        <h6>Branch</h6>
                                        <span>Chicago</span>
                                    </li>
                                    <li>
                                        <h6>Name on Bank Account</h6>
                                        <span>Edalin Hendry</span>
                                    </li>
                                    <li>
                                        <a href="#">Change to default</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <ul class="other-bank-info">
                                    <li>
                                        <h6>Name</h6>
                                        <span>KVB Bank Inc</span>
                                    </li>
                                    <li>
                                        <h6>Account No</h6>
                                        <span>5892 4920 4829 XXXX</span>
                                    </li>
                                    <li>
                                        <h6>Branch</h6>
                                        <span>Austin</span>
                                    </li>
                                    <li>
                                        <h6>Name on Bank Account</h6>
                                        <span>Edalin Hendry</span>
                                    </li>
                                    <li>
                                        <a href="#">Change to default</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <a href="#" class="btn btn-primary prime-btn w-100 mt-2" data-bs-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Other Accounts Modal-->

    <!-- Request Completed Modal-->
    <div class="modal fade custom-modal custom-modal-two" id="request_details_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Request Details <span class="badge badge-success-bg">Completed</span></h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span><i class="fa-solid fa-x"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="completed-request">
                        <ul>
                            <li>
                                <h6>ID</h6>
                                <span>#AC-1234</span>
                            </li>
                            <li>
                                <h6>Requested on</h6>
                                <span>24 Mar 2024</span>
                            </li>
                            <li>
                                <h6>Credited Date</h6>
                                <span>24 Mar 2024</span>
                            </li>
                            <li>
                                <h6>Amount</h6>
                                <span class="text-blue">$300</span>
                            </li>
                        </ul>
                        <div class="bank-detail">
                            <h4>Bank Details</h4>
                            <div class="accont-information">
                                <h6>Name</h6>
                                <span>Citi Bank Inc</span>
                            </div>
                            <div class="accont-information">
                                <h6>Account No</h6>
                                <span>5396 5250 1908 XXXX</span>
                            </div>
                            <div class="accont-information">
                                <h6>Branch</h6>
                                <span>London</span>
                            </div>
                        </div>
                        <div class="request-des">
                            <h4>Reqeust Description</h4>
                            <p>I recently completed a series of dental treatments with Dr.Edalin Hendry,
                                and I couldn't be more pleased with the results. From my very first appointment.
                            </p>
                        </div>
                        <a href="#" class="btn btn-primary prime-btn w-100" data-bs-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Request Completed Modal-->

    <!-- Request Cancel Modal-->
    <div class="modal fade custom-modal custom-modal-two" id="request_cancel_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Request Details <span class="badge badge-danger-bg">Cancelled</span></h5>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span><i class="fa-solid fa-x"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="cancelled-request">
                        <div class="canceled-user-info d-flex align-items-center">
                            <div class="patinet-information">
                                <a href="doctor-upcoming-appointment.html">
                                    <img src={{ asset('img/doctors-dashboard/profile-01.jpg') }} alt="User Image">
                                </a>
                                <div class="patient-info">
                                    <p>#Apt0001</p>
                                    <h6><a href="doctor-upcoming-appointment.html">Adrian</a></h6>
                                </div>
                            </div>
                            <div class="email-info">
                                <ul>
                                    <li><i class="fa-solid fa-envelope"></i>adran@example.com</li>
                                    <li><i class="fa-solid fa-phone"></i>+1 504 368 6874</li>
                                </ul>
                            </div>
                        </div>
                        <div class="cancellation-fees">
                            <h6>Consultation Fees : $200</h6>
                            <div class="cancellation-info">
                                <div class="appointment-type">
                                    <p class="md-text">Type of Appointment</p>
                                    <p><i class="fa-solid fa-building text-green"></i>Direct Visit</p>
                                </div>
                                <div class="appointment-type">
                                    <p class="md-text">Clinic Location</p>
                                    <p>Adrian’s Dentistry</p>
                                </div>
                            </div>
                        </div>
                        <div class="cancel-reason">
                            <h5>Reason</h5>
                            <p>I have an urgent surgery, while our Appointment so i am rejecting appointment </p>
                            <span class="text-danger">Cancelled By You on 23 Mar 2024</span>
                        </div>
                        <span class="text-blue refund">Status : Refund Accepted</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Request Cancel Modal-->
@endsection

@push('scripts')
    <script>
        var medicineStoreRoute = '{{ route('admin.medicine.store') }}';
    </script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/editor/2.2.1/js/dataTables.editor.min.js"></script>
@endpush
