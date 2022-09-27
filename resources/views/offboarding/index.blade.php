@extends('layouts.app', ['title' => 'Offboarding'])

@section('content')
<div class="container-fluid bg-white p-5">

    <h4 class="text-center text-md-left">A successful offboard will require a <i>'Computer login/Email/VPN'&nbsp</i> and <i>'workplace'</i> deactivation</h4>
    <h6 class='text-center text-md-left text-danger'>Note: some users may have multiple Login/Email accounts!</h6>
    <h6 class='text-center text-md-left text-danger'>If you are unable to locate someone, please contact IT!</h6>
    <br>
    <div class="row row-cols-1 row-cols-md-2 justify-content-center">
        <div class="col">
            <h4 class="pb-3 text-danger">Login/Email/VPN deactivate</h4>
            @livewire('offboarding.offboarding-component')
        </div>
        <div class="col">

            <h4 class="pb-3 text-danger">Workplace deactivate</h4>
            @livewire('it.disable-workplace')

        </div>
    </div>
</div>
@endsection
