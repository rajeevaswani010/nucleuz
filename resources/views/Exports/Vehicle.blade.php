<table>
    <thead>
        <tr>
            <th>Car Type</th>
            <th>Make</th>
            <th>Model</th>
            <th>Variant</th>
            <th>KM Reading</th>
            <th>Fuel Level Reading</th>
            <th>Current Conditions</th>
            <th>AC</th>
            <th>Audio</th>
            <th>GPS</th>
            <th>Mulkiya Details</th>
            <th>Insurance Details</th>
            <th>Chasis Number</th>
            <th>Engine Number</th>
            <th>Registration Number</th>
        </tr>
    </thead>
    <tbody>
        @foreach($Data as $DT)
        <tr>
            <td>{{ $DT->car_type }}</td>
            <td>{{ $DT->make }}</td>
            <td>{{ $DT->model }}</td>
            <td>{{ $DT->variant }}</td>
            <td>{{ $DT->km_reading }}</td>
            <td>{{ $DT->fuel_level_reading }}</td>
            <td>{{ $DT->current_condition }}</td>
            <td>{{ $DT->ac }}</td>
            <td>{{ $DT->Audio }}</td>
            <td>{{ $DT->gps }}</td>
            <td>{{ $DT->mulkiya_details }}</td>
            <td>{{ $DT->insurance_detail }}</td>
            <td>{{ $DT->chasis_no }}</td>
            <td>{{ $DT->engine_no }}</td>
            <td>{{ $DT->reg_no }}</td>
        </tr>
        @endforeach
    </tbody>
</table>