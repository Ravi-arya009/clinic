<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Time Slots</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Add Time Slots</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

         @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="" method="POST">
            @csrf
            <!-- Time Input -->
            <div class="mb-3">
                <label for="time" class="form-label">Time</label>
                <input type="time" id="time" name="time" class="form-control" required>
            </div>

            <!-- Recurring Days Checkboxes -->
            <div class="mb-3">
                <label class="form-label">Select Days (if recurring):</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="days[]" value="1" id="monday">
                    <label class="form-check-label" for="monday">Monday</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="days[]" value="2" id="tuesday">
                    <label class="form-check-label" for="tuesday">Tuesday</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="days[]" value="3" id="wednesday">
                    <label class="form-check-label" for="wednesday">Wednesday</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="days[]" value="4" id="thursday">
                    <label class="form-check-label" for="thursday">Thursday</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="days[]" value="5" id="friday">
                    <label class="form-check-label" for="friday">Friday</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="days[]" value="6" id="saturday">
                    <label class="form-check-label" for="saturday">Saturday</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="days[]" value="7" id="sunday">
                    <label class="form-check-label" for="sunday">Sunday</label>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Add Time Slot</button>
        </form>

        <!-- Added Time Slots -->
        {{-- @if (isset($timeSlots) && count($timeSlots) > 0)
        <div class="mt-5">
            <h3>Added Time Slots</h3>
            <ul class="list-group">
                @foreach ($timeSlots as $slot)
                    <li class="list-group-item">
                        <strong>Time:</strong> {{ $slot['time'] }} <br>
                        <strong>Days:</strong> {{ implode(', ', $slot['days']) }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    </div>
</body>

</html>
