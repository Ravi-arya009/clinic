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
        <h3>Medicine List</h3>
        <ul class="header-list-btns">
            <li>
                <a href="#add_medicine" class="btn btn-primary prime-btn btn-sm float-start me-3" data-bs-toggle="modal"><i class="fa-solid fa-plus me-2"></i>Add</a>
                <div class="input-block dash-search-input float-start">
                    <input type="text" class="form-control customSearch" placeholder="Search">
                    <span class="search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <i class="fa-solid fa-xmark hide" style="cursor: pointer;"></i>
                    </span>
                </div>
            </li>
        </ul>
    </div>

    <table class="my-datatable table-hover" id="medicine-master-table">
        <thead class="my-table-hover">
            <tr>
                <th>Sno.</th>
                <th>Name</th>
                <th>Status</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        @foreach ($medicines as $medicine)
            <tr class="table-appointment-wrap" id="medicine-row-{{ $medicine->id }}">
                <td class="mail-info-patient">
                    <ul>
                        <li>#{{ $loop->iteration }}</li>
                    </ul>
                </td>

                <td class="mail-info-patient" id="medicine-name-{{ $medicine->id }}">
                    <ul>
                        <li>{{ isset($medicine->name) ? ucfirst($medicine->name) : 'N/A' }}</li>
                    </ul>
                </td>

                <td class="mail-info-patient">
                    <ul>
                        <li>
                            <span class="badge badge-green status-badge">Available</span>
                        </li>
                    </ul>
                </td>

                <td class="appointment-start">
                    <a href="#" class="edit-medicine-button start-link" data-bs-toggle="modal" title="Edit Medicine" data-medicine-id="{{ $medicine->id }}" data-medicine-name="{{ $medicine->name }}">
                        Delete
                    </a>
                </td>

                <td class="appointment-start">
                    <a href="#edit_medicine" class="edit-medicine-button start-link" data-bs-toggle="modal" title="Edit Medicine" data-medicine-id="{{ $medicine->id }}" data-medicine-name="{{ $medicine->name }}">
                        Edit
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <hr>
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
                        <button class="btn btn-primary" id="update-medicine-button">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Medicine Moodal -->

    {{-- success modal --}}
    <div class="modal fade custom-modal custom-modal-two modal-lg" id="success-modal">
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
                        <h4>Medicine Name : <span id="success-medicine-name"></span></h4>
                    </div>

                    <div id="success-modal-alert" class="alert alert-success d-block ">
                        <ul>
                            <li>Medicine Added Succesfully</li>
                        </ul>
                    </div>

                    <div class="form-set-button">
                        <button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- success modal --}}
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script>
        var medicineStoreRoute = '{{ route('admin.medicine.store') }}';
        var medicineUpdateRoute = "{{ route('admin.medicine.update', ':medicine') }}";
        var table = $('.my-datatable').DataTable({
            lengthChange: false,
            searching: true,
            dom: 'rt<"bottom"ip>',
            dom: 'rt<"bottom d-flex justify-content-end pt-4"p>',
            ordering: false

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

        $("#medicineName").keyup(function(event) {
            if (event.key === "Enter") {
                $("#add-medicine-button").click();
            }
        });

        $("#add_medicine").on("shown.bs.modal", function() {
            $("#medicineName").val("");
            $("#medicineName").focus();
        });
        $("#add-medicine-button").on("click", function() {
            var medicineName = $('.modal-body input[type="text"]').val();
            var errorDiv = $(".modal-body .alert");

            if (medicineName.trim() === "") {
                errorDiv.removeClass("d-none");
                errorDiv.find("li").html("Error: Medicine name is required.");
            } else {
                errorDiv.addClass("d-none");
                console.log("Medicine name:", medicineName);

                $.ajax({
                    type: "POST",
                    url: medicineStoreRoute,
                    data: {
                        medicineName: medicineName
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function(response) {
                        var table = $("#medicine-master-table").DataTable();
                        if (table) {
                            // Get the last row's ID number
                            var lastId = 0;
                            if (table.rows().count() > 0) {
                                var lastRowData = table
                                    .row(table.rows().count() - 1)
                                    .data();
                                lastId =
                                    parseInt(
                                        $(lastRowData[0])
                                        .find("li")
                                        .text()
                                        .replace("#", "")
                                    ) || 0;
                            }

                            var newId = lastId + 1;
                            var newRow = [
                                '<td class="mail-info-patient"><ul><li>#' +
                                newId +
                                "</li></ul></td>",
                                '<td class="mail-info-patient"><ul><li>' +
                                (response.name ?
                                    response.name.charAt(0).toUpperCase() +
                                    response.name.slice(1) :
                                    "N/A") +
                                "</li></ul></td>",
                                '<td class="mail-info-patient"><ul><li><span class="badge badge-green status-badge">Available</span></li></ul></td>',
                                '<td class="appointment-start"><a href="#" class="edit-medicine-button start-link" data-bs-toggle="modal" title="Edit Medicine" data-medicine-id="' +
                                response.id +
                                '" data-medicine-name="' +
                                response.name +
                                '">Delete</a></td>',
                                '<td class="appointment-start"><a href="#edit_medicine" class="edit-medicine-button start-link" data-bs-toggle="modal" title="Edit Medicine" data-medicine-id="' +
                                response.id +
                                '" data-medicine-name="' +
                                response.name +
                                '">Edit</a></td>',
                            ];

                            var row = table.row.add(newRow).draw().node();
                            $("#add_medicine").modal("hide");
                            $(row).find("td").addClass("highlight");
                            $("#success-modal-alert").removeClass("d-none");
                            $("#success-medicine-name").text(medicineName);
                            $("#success-modal").modal("show");

                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status == 422) {
                            errorDiv.removeClass("d-none");
                            errorDiv.find("li").html("Medicine already exists.");
                        }
                        console.log("Error adding medicine:", error);
                    },
                });
            }
        });

        $(".edit-medicine-button").on("click", function() {
            var medicineId = $(this).data("medicine-id");
            var medicineName = $(this).data("medicine-name");
            $("#edit-medicine-name").val(medicineName).focus();
            $("#update-medicine-button").data("medicine-id", medicineId);
            $("#update-medicine-button").data("medicine-name", medicineName);
        });

        $("#update-medicine-button").on("click", function() {
            var medicineId = $(this).data("medicine-id");
            var medicineName = $("#edit-medicine-name").val();
            var errorDiv = $(".modal-body .alert");

            if (medicineName.trim() === "") {
                errorDiv.removeClass("d-none");
                errorDiv.find("li").html("Error: Medicine name is required.");
            } else {
                errorDiv.addClass("d-none");
                console.log("Medicine name:", medicineName);
                $.ajax({
                    type: "PUT",
                    url: medicineUpdateRoute.replace(":medicine", medicineId),
                    data: {
                        name: medicineName,
                        method: "PUT",
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function(response) {
                        console.log(response);
                        $("#medicine-name-" + medicineId).text(medicineName);
                        $("#medicine-row-" + medicineId)
                            .children("td")
                            .addClass("highlight");
                        console.log($(this));
                        $("#edit_medicine").modal("hide");
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status == 422) {
                            errorDiv.removeClass("d-none");
                            errorDiv.find("li").html("Medicine already exists.");
                        }
                        console.log("Error adding medicine:", error);
                    },
                });
            }
        });
        // $(function(){
        //     $("#success-modal").modal("show");
        // });
    </script>
@endpush
