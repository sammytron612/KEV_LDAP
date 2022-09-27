@extends('layouts.app', ['title' => 'Team planning'])
@section('content')
<div style="padding-bottom:25%" class="container-fluid bg-white pt-5">
    <input id="active" type="hidden" value="{{$showing}}">
            <div class="row">
                <nav class="col flex-wrap text-center">
                    <div id="button-container">
                        @livewire('teams.button-component', ['showing' => $showing])
                    </div>
                    @livewire('teams.manager-component', ['showing' => $showing])
                </nav>
            </div>
            <hr>
            <div class="row">
                <div class="d-none d-md-block col-4 text-center border-right">
                    @livewire('teams.stats-component', ['showing' => $showing])
                </div>

                <div class="col-12 col-md-6 col-lg-4 text-center border-right">
                    @livewire('teams.teams-component', ['showing' => $showing])
                    @livewire('teams.schedule-component', ['showing' => $showing])
                </div>

                <div class="col-12 col-md-4 text-center">

                    @livewire('teams.intake-component', ['showing' => $showing])
                </div>
            </div>
            <div class="row h-5">
            </div>

</div>

        </body>
    <script>
        function change_team(id)
        {
            let wasActive = $('#active').val()
            $('#active').val(id)
            $('#'+id).removeClass('shadow').removeClass('btn-outline-eco-red').addClass('btn-eco-red')
            $('#'+wasActive).removeClass('btn-eco-red').addClass('shadow').addClass('btn-outline-eco-red')

            Livewire.emitTo('teams.teams-component', 'changeTeam', id)

            Livewire.emitTo('teams.schedule-component', 'changeTeam', id)

            Livewire.emitTo('teams.intake-component', 'changeTeam', id)

            Livewire.emitTo('teams.stats-component', 'changeTeam', id)

            //Livewire.emitTo('teams.button-component', 'changeTeam', id)

        }

    </script>
@endsection
