{{-- table-template.blade.php --}}

<table class="my-datatable table-hover">
    <thead>
        <tr>
            @foreach ($columns as $column)
                <th>{{ $column }}</th>
            @endforeach
        </tr>
    </thead>
    @foreach ($data as $row)
    {{dump($row)}}
        <tr class="table-appointment-wrap">
            @foreach ($columns as $column)
                {{-- @if ($loop->first) --}}
                    {{-- First Column --}}
                    <td class="patinet-information">
                        <img src="{{ asset('img/bg/ring-2.png') }}" alt="User Image">
                        <div class="patient-info">
                            {{-- <h6>{{ $column->name }}</h6> --}}
                            {{-- {{dump($column)}} --}}
                        </div>
                    </td>
                    {{-- /First Column --}}
                {{-- @elseif ($loop->last) --}}
                    {{-- Last Column --}}
                    {{-- <td class="mail-info-patient">
                        <ul>
                            <li>{{ isset($clinic) ? ucfirst($clinic->area) : '-' }}</li>
                            <li>{{ isset($clinic) ? ucfirst($clinic->city->name) : '-' }}</li>
                        </ul>
                    </td> --}}
                    {{-- /Last Column --}}
                {{-- @else
                    <td class="appointment-start">
                        <a href="#" class="start-link">Start Now</a>
                    </td>
                @endif --}}
            @endforeach
        </tr>
    @endforeach
</table>
