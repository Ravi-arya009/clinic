<div class="create-details-card">
    <div class="create-details-card-body">
        <div class="start-appointment-set mb-3">
            <div class="form-bg-title">
                <h5>Clinical Notes</h5>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="text-dark ms-2">
                        {{ $historicalAppointmentDetails->appointmentDetails->notes }}
                    </p>
                </div>
            </div>
        </div>
        <div class="start-appointment-set mb-3">
            <div class="form-bg-title">
                <h5>Medications</h5>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table-hover table-responsive table-dark w-100 mx-2">
                        <thead class="bg-dark">
                            <tr>
                                <th>Name</th>
                                <th>Dosage</th>
                                <th>Duration</th>
                                <th>Instructions</th>
                            </tr>
                        </thead>
                        <tbody class="text-dark">
                            @foreach ($historicalAppointmentDetails->medications as $medication)
                                <tr class="table-appointment-wrap">
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
        <div class="start-appointment-set mb-3">
            <div class="form-bg-title">
                <h5>Laboratory Tests</h5>
            </div>
            <div class="row meditation-row">
                @foreach ($historicalAppointmentDetails->labTests as $appointmentLabTest)
                    <div class="col-md-12" id="lab-test-row">
                        <div class="d-flex flex-wrap medication-wrap align-items-center">
                            <p class="ms-2">{{ $loop->index + 1 }}. {{ $appointmentLabTest->labTestMaster->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="start-appointment-set mb-3">
            <div class="form-bg-title">
                <h5>Advice</h5>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="text-dark ms-2">
                        {{ $historicalAppointmentDetails->appointmentDetails->advice }}
                    </p>
                </div>
            </div>
        </div>
        <x-Alert />
    </div>
</div>
