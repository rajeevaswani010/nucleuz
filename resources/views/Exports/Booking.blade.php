<table>
    <thead>
        <tr>
            <th>Booking ID</th>
            <th>Name</th>
            <th>Nationality</th>
            <th>Mobile</th>
            <th>Email</th>
            <th>Car Type</th>
            <th>Make</th>
            <th>Model</th>
            <th>Reg. No.</th>
            <th>Tarrif</th>
            <th>Tarrif Day/Week/Month</th>
            <th>Tarrif Amount</th>
            <th>Pickup Date Time</th>
            <th>Drop Off Date Time</th>
            <th>Sub Total</th>
            <th>Tax</th>
            <th>Additional Amount</th>
            <th>Discount</th>
            <th>Grand Total</th>
            <th>Final Paid Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($Data as $DT)
        <tr>
            <td>{{ $DT->id }}</td>
            <td>{{ $DT->customer->title }} {{ $DT->customer->first_name }} {{ $DT->customer->last_name }}</td>
            <td>{{ $DT->customer->nationality }}</td>
            <td>{{ $DT->customer->mobile }}</td>
            <td>{{ $DT->customer->email }}</td>
            <td>{{ $DT->car_type }}</td>
            <td>{{ $DT->vehicle->make }}</td>
            <td>{{ $DT->vehicle->model }}</td>
            <td>{{ $DT->vehicle->reg_no }}</td>
            <td>{{ $DT->tarrif_type }}</td>
            <td>{{ $DT->tarrif_detail }}</td>
            <td>{{ $DT->tarrif_amount }}</td>
            <td>{{ date("d/m/Y H:i A", strtotime($DT->pickup_date_time)) }}</td>
            <td>{{ date("d/m/Y H:i A", strtotime($DT->dropoff_date)) }}</td>
            <td>{{ $DT->sub_total }}</td>
            <td>{{ ($DT->sub_total * $DT->tax_percentage) / 100 }}</td>
            <td>{{ $DT->additional_charges }}</td>
            <td>{{ $DT->discount_amount }}</td>
            <td>{{ $DT->grand_total }}</td>
            <td>{{ $DT->final_amount_paid }}</td>
        </tr>
        @endforeach
    </tbody>
</table>