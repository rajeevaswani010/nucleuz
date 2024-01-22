
<style>
#invoice  {
  background-image: url("/home/rajeev/Documents/CANARY_RENT_A_CAR_CONTRACT.pdf");
  background-color: #cccccc;
}
</style>
<div id="invoice" class="container">

<div class="header">

</div>

<div class="body">
    <div style="float: left; width: 45%;">
        <div style="border: 1px solid rgba(0,0,0,.125); border-radius: 0.25rem; height: 400px;">
            <div style="flex: 1 1 auto; padding: 1rem 1rem;">
                <h2>{{ $booking->customer->title }} {{ $booking->customer->first_name }}</h2>
                <div class="mt-4"><b>{{ __("Gender") }}</b> {{ $booking->customer->gender }}</div>
                <div class="mt-2"><b>{{ __("DOB") }}</b> {{ date("d/m/Y", strtotime($booking->customer->dob)) }}</div>
                <div class="mt-2"><b>{{ __("Nationality") }}</b> {{ $booking->customer->nationality }}</div>
                <div class="mt-2"><b>{{ __("Email") }}</b> {{ $booking->customer->email }}</div>
                <div class="mt-2"><b>{{ __("Mobile") }}</b> {{ $booking->customer->mobile }}</div>
                <div class="mt-2"><b>{{ __("Insurance Details") }}</b> {{ $booking->customer->insurance }}</div>
                <div class="mt-2"><b>{{ __("Permanent Address") }}</b> {{ $booking->customer->permanent_address }}</div>
                <div class="mt-2"><b>{{ __("Temp Address") }}</b> {{ $booking->customer->temp_address }}</div>
            </div>
        </div>
    </div>

</div>

</div>
