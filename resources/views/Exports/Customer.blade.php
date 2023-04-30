<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Permanent Address</th>
            <th>Temp Address</th>
            <th>Nationality</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Insurance Details</th>
        </tr>
    </thead>
    <tbody>
        @foreach($Data as $DT)
        <tr>
            <td>{{ $DT->title }} {{ $DT->first_name }} {{ $DT->middle_name }} {{ $DT->last_name }}</td>
            <td>{{ $DT->permanent_address }}</td>
            <td>{{ $DT->temp_address }}</td>
            <td>{{ $DT->nationality }}</td>
            <td>{{ $DT->gender }}</td>
            <td>{{ $DT->dob }}</td>
            <td>{{ $DT->email }}</td>
            <td>{{ $DT->mobile }}</td>
            <td>{{ $DT->insurance }}</td>
        </tr>
        @endforeach
    </tbody>
</table>