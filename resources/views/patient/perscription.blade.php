@extends('patient.layouts.main')

@section('title', 'Prescriptions')

@section('breadcrum-title', 'Prescriptions')
@section('breadcrum-link-one', 'Home')
@section('breadcrum-link-two', 'Prescriptions')
@push('stylesheets')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
@endpush
@section('content')
    <x-page-header pageContentTitle="Prescriptions" :search="true" />

    <table class="my-datatable table-hover table-responsive">
        <thead>
            <tr>
                <th>Doctor / Clinic</th>
                <th>Appointment Date</th>
                <th>Patient</th>
                <th>Action</th>
            </tr>
        </thead>

        @foreach ($appointments as $appointment)
            <tr class="table-appointment-wrap">
                <td class="patinet-information">
                    @if (isset($appointment->doctor->profile_image))
                        <img src="{{ asset('storage/profile_images/' . $appointment->doctor->profile_image) }}" alt="User Image">
                    @else
                        <img src="{{ asset('storage/profile_images/default-profile-picture.webp') }}" alt="User Image">
                    @endif
                    <div class="patient-info">
                        <h6>{{ ucwords($appointment->doctor->name) }}</h6>
                        <p>{{ ucwords($appointment->clinic->name) }}</p>

                    </div>
                </td>
                <td class="mail-info-patient">
                    <ul>
                        <li><i class="fa-solid fa-calendar"></i>{{ date('d M Y', strtotime($appointment->appointment_date)) }}</li>
                        <li><i class="fa-solid fa-clock"></i>{{ date('h:i A', strtotime($appointment->timeSlot->slot_time)) }}</li>
                    </ul>
                </td>
                <td class="mail-info-patient">
                    <ul>
                        @if ($appointment->dependant_id)
                            <li>{{ optional($appointment->dependant)->name ?? 'N/A' }} <span class="badge  badge-green table-badge display-inline ms-2">Family</span>
                            <li><i class="fa-solid fa-phone"></i>{{ optional($appointment->patient)->phone ?? 'N/A' }}</li>
                        @else
                            <li>{{ optional($appointment->patient)->name ?? 'N/A' }} <span class="badge badge-info table-badge ms-2">Self</span></li>
                            <li><i class="fa-solid fa-phone"></i>{{ optional($appointment->patient)->phone ?? 'N/A' }} </li>
                        @endif
                    </ul>
                </td>
                <td class="appointment-start">
                    {{-- <a href="javascript:void(0);" class="start-link" data-bs-toggle="modal" data-bs-target="#view_prescription">View</a> --}}
                    <a href="javascript:void(0);" class="start-link viewPrescription" data-appointment-id="{{ $appointment->id }}">View</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

@section('modal')
    <div class="modal fade custom-modals" id="view_prescription">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">View Details</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <div class="prescribe-download">
                        <ul class="float-end">
                            <button type="button" id="downloadPdfBtn" class="btn btn-primary">Download as PDF</button>
                        </ul>
                    </div>
                    <span id="prescription">
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        var table = $('.my-datatable').DataTable({
            lengthChange: false,
            searching: true,
            dom: 'rt<"bottom"ip>',
            dom: 'rt<"bottom d-flex justify-content-end pt-4"p>'
        });

        $('.customSearch').on('keyup', function() {
            $('#clinic-table').DataTable().search($(this).val()).draw();
        });

        $('.customSearch').on('input', function() {
            if ($(this).val().trim() !== '') {
                $('.fa-magnifying-glass').addClass('hide');
                $('.fa-xmark').removeClass('hide');
                table.search(this.value).draw();
            } else {
                $('.fa-magnifying-glass').removeClass('hide');
                $('.fa-xmark').addClass('hide');
                table.search('').draw();
            }
        });

        $('.fa-xmark').on('click', function() {
            $('.customSearch').val('');
            table.search('').draw();
            $('.fa-magnifying-glass').removeClass('hide');
            $(this).addClass('hide');
        });

        $(".viewPrescription").on('click', function() {
            var appointment_id = $(this).attr('data-appointment-id');
            $.ajax({
                url: "{{ route('patient.prescription.generate') }}",
                method: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "appointment_id": appointment_id
                },
                success: function(response) {
                    console.log(response);
                    $('#prescription').html(response);
                    $('#view_prescription').modal('show');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        $(document).on('click', '#downloadPdfBtn', function() {
            // Get the invoice content div
            const element = document.getElementById('prescription');

            // Define options for the PDF
            const options = {
                // margin: 10,
                filename: 'prescription.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

            // Generate and download the PDF
            html2pdf().from(element).set(options).save();
        });
    </script>
@endpush
