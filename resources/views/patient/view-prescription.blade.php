<style>
    .invoice-table {
        word-wrap: break-word;
        word-break: break-word;
        white-space: normal;
    }
</style>
<div class="view-prescribe-details">
    <div class="hospital-addr">
        <div class="invoice-logo">
            <img src={{ asset('img/logo.png') }} alt="logo">
        </div>
        <h5>{{ $appointment->clinic->address }}</h5>
        <p>Monday to Sunday - 09:30am to 12:00pm</p>
    </div>

    <!-- Invoice Item -->
    <div class="invoice-item">
        <div class="row">
            <div class="col-md-6">
                <div class="invoice-info">
                    <h6 class="customer-text">{{ $appointment->doctor->name }}</h6>
                    <p>{{ $appointment->doctor->doctorProfile->qualification->name }}, {{ $appointment->doctor->doctorProfile->speciality->name }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="invoice-info2">
                    <p><span>Date : </span>{{ date('d M Y', strtotime($appointment->appointment_date)) }}, {{ date('h:i A', strtotime($appointment->timeSlot->slot_time)) }}</p>

                    <p><span>Appointment Type : </span>Online</p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="patient-id">
                    <h6>Patient Details</h6>
                    @if ($appointment->dependant_id == null)
                        <div class="patient-det">
                            <h6>{{ $appointment->patient->name }}</h6>
                            <ul>
                                <li>{{ date('Y') - date('Y', strtotime($appointment->patient->dob)) }}Y / {{ $appointment->patient->gender == 1 ? 'Male' : 'Female' }}</li>
                                <li>{{ $appointment->patient->phone }}</li>
                                <li>{{ $appointment->patient->whatsapp }}</li>
                                <li>{{ $appointment->patient->email }}</li>
                            </ul>
                        </div>
                    @else
                        <div class="patient-det">
                            <h6>
                                <h6>{{ $appointment->dependant->name }}</h6>
                            </h6>
                            <ul>
                                <li>{{ date('Y') - date('Y', strtotime($appointment->dependant->dob)) }}Y / {{ $appointment->dependant->gender == 1 ? 'Male' : 'Female' }}</li>
                                <li>{{ $appointment->dependant->phone }}</li>
                                <li>{{ $appointment->dependant->whatsapp }}</li>
                                <li>{{ $appointment->dependant->email }}</li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /Invoice Item -->

    @if ($appointment->status == 1)
        <div class="appointment-notes">
            <h3>Prescription</h3>
        </div>


        <div class="appoint-wrap">
            <h5>Clinical Notes</h5>
            <p>{{ $appointment->appointmentDetails->notes }}</p>
        </div>
        <div class="appoint-wrap">
            <h5>Medications</h5>
            <div class="invoice-item invoice-table-wrap">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive inv-table">
                            <table class="invoice-table table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Medecine Name</th>
                                        <th>Dosage</th>
                                        <th>Duration</th>
                                        <th>Instruction</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointment->medications as $medication)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $medication->medicine->name }}</td>
                                            <td>{{ $medication->dosage }}</td>
                                            <td>{{ $medication->duration }}</td>
                                            <td>{{ $medication->instructions }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="appoint-wrap">
            <h5>Lab Tests</h5>
            @foreach ($appointment->labTests as $appointmentLabTest)
                <p class="mb-0">{{ $loop->index + 1 }}. {{ $appointmentLabTest->labTestMaster->name }}</p>
            @endforeach
        </div>
        <div class="appoint-wrap">
            <h5>Advice</h5>
            <p>{{ $appointment->appointmentDetails->advice }}</p>
        </div>
    @endif

    <!-- Invoice Item -->

    <!-- /Invoice Item -->

    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="scan-wrap">
                <h6>Scan to download report</h6>
                <img src={{ asset('img/scan.png') }} alt="scan">
            </div>
        </div>
        <div class="col-md-6">
            <div class="prescriber-info">
                <h6>{{ $appointment->doctor->name }}</h6>
                <p>Dept of Cardiology</p>
            </div>
        </div>
    </div>
</div>
