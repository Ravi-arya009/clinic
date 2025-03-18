<div class="view-prescribe invoice-content" id="invoice-content">
    <div class="invoice-item">
        <div class="row">
            <div class="col-md-6">
                <div class="invoice-logo">
                    <img src={{ asset('img/logo.png') }} alt="logo">
                </div>
            </div>
            <div class="col-md-6">
                <p class="invoice-details">
                    <strong>Invoice No : </strong> #INV005<br>
                    <strong>Issued:</strong>
                    {{ date('d M Y', strtotime($billingDetails->created_at)) }}
                </p>
            </div>
        </div>
    </div>

    <!-- Invoice Item -->
    <div class="invoice-item">
        <div class="row">
            <div class="col-md-4">
                <div class="invoice-info">
                    <h6 class="customer-text">Billing From</h6>
                    <p class="invoice-details invoice-details-two">
                        {{ $appointment->clinic->name }},<br>
                        {{ $appointment->clinic->address }}
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="invoice-info">
                    <h6 class="customer-text">Billing To</h6>
                    <p class="invoice-details invoice-details-two">
                        {{ $appointment->patient->name }},<br>
                        {{ $appointment->patient->address }},<br>
                        {{ $appointment->patient->phone }},<br>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="invoice-info invoice-info2">
                    <h6 class="customer-text">Payment Method</h6>
                    <p class="invoice-details">
                        @switch($appointment->payment_method)
                            @case(1)
                                Online
                            @break

                            @case(2)
                                Cash
                            @break

                            @default
                                Cash
                        @endswitch
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- /Invoice Item -->

    <!-- Invoice Item -->
    <div class="invoice-item invoice-table-wrap">
        <div class="row">
            <div class="col-md-12">
                <h6>Invoice Details</h6>
                <div class="table-responsive">
                    <table class="invoice-table table table-bordered">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Quatity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>General Consultation</td>
                                <td>1</td>
                                <td>{{ $billingDetails->amount_to_be_paid }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 ms-auto">
                <div class="table-responsive">
                    <table class="invoice-table-two table">
                        <tbody>
                            <tr>
                                <th>Subtotal:</th>
                                <td><span>{{ $billingDetails->amount_to_be_paid }}</span></td>
                            </tr>
                            <tr>
                                <th>Tax:</th>
                                <td><span>0.00</span></td>
                            </tr>
                            <tr>
                                <th>Total Amount:</th>
                                <td><span>{{ $billingDetails->amount_to_be_paid }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Invoice Item -->

    <!-- Invoice Information -->
    <div class="other-info mb-0">
        <h4>Other information</h4>
        <p class="text-muted mb-0">An account of the present illness, which includes the circumstances surrounding the onset of recent health changes and the chronology of subsequent events that have led the patient to seek medicine</p>
    </div>
    <!-- /Invoice Information -->

</div>
