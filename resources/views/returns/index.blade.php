@extends('layouts.login')
@section('content')

<div class="container bg-white py-4">
    @if(session()->has('success'))
        <div class="alert alert-success">
            <h3>{{ session()->get('success') }}</h3>
        </div>
    @endif

    <form method="post" action="{{route('returnsRequest')}}">
        @csrf
        <div>
            <div class="row">
                <div class="col-12 col-md-2">
                    <img style="width:150px;height:150px" src="{{asset('images/eco.png')}}">
                </div>
                <div class="col-12 col-md-10">
                <p class="px-0 px-md-5"><b>*Required fields.</b></p>
                <p class="px-0 px-md-5">
Please leave at least 24 hours before your selected date/time to allow your request to be reviewed.
One you have successfully submitted your request; you will receive an email acknowledgment of the request.
Once the request has been reviewed you will receive a confirmation.
Do not return the equipment until you have received the confirmation that your request has been accepted.
                </p>

                </div>
            </div>

            <h2 class="mt-2">ECO Returns</h2>

            <h4 class="d-none d-md-block text-center py-2">Equipment Return Request Form</h4>
            <div class="w-100 w-md-50 form-group mx-auto">
                <label class="h4">Name*</label>
                <input class="form-control" value="{{ old('name') }}" type="text" name="name" required>
                <small>Please state your full name.</small>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="w-100 w-md-50 form-group mx-auto">
                <label class="h4">Campaign*</label>
                <select class="form-control" value="{{ old('campaign') }}" name="campaign" required>
                    <option value=""><---Choose---></option>
                    @foreach($campaigns as $campaign)
                        <option value="{{$campaign->title}}">{{$campaign->title}}</option>
                    @endforeach
                </select>
                <small>Please select your current campaign.</small>
                @error('campaign')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-100 w-md-50 form-group mx-auto">
                <label class="h4">Email*</label>
                <input class="form-control" value="{{ old('email') }}" type="email" name="email" required>
                <small>Please double check your email address is correct, you will receive confirmation of your booking via email.</small>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="w-100 w-md-50 form-group mx-auto">
                <label class="h4">Date & Time*</label>
                <input id="date_time" class="form-control" value="{{ old('date_time') }}"type="date" name="date_time" placeholder="Date & Time" required>
                @error('date_time')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="w-100 w-md-50 form-group mx-auto">
                <label class="h4">Notes</label>
                <textarea style="height:40px" value="{{ old('notes') }}" class="txt form-input w-100" type="date" name="notes"></textarea>
                <small>Please enter any additional information here.</small>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary w-100 w-md-50 text-center">Submit</button>
        </div>

    </form>
</div>
<script>
    flatpickr("#date_time", {
    enableTime: true,
    "disable": [
        function(date) {
            // return true to disable
            return (date.getDay() === 0 || date.getDay() === 6);

        }
    ],
    enableTime: true,
    noCalendar: false,
    minTime: "08:30",
    maxTime: "17:00",
    dateFormat: "d-m-Y H:i",
    time_24hr: true,
    minDate: "today",
    maxDate: new Date().fp_incr(14)});

document.addEventListener('DOMContentLoaded', function () {


$(function () {
    $(".txt").focus(function () {
        $('.txt').animate({
            height: '80px',
            },
           "slow"
        )
    });
});
});

</script>
@endsection
