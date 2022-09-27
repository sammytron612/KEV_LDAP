<div class="w-100 mx-auto">
    @if(count($starters))

        @foreach($starters as $starter)

        <hr>

        <div x-data="{showSearch: false}">
                <table class="table table-sm table-bordered text-left">
                    <thead>
                        <tr>
                            <td class="text-left bg-warning">Starting {{\Carbon\Carbon::parse($starter[0]->start_date)->format('j F, Y')}}</td>
                            <th style="width:10px" class="text-center text-primary hov" x-on:click="showSearch = !showSearch">+</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($starter as $user)
                            @if($user->user_id == 0)
                                @continue;
                            @endif
                            <tr class="bg-white">
                                @if($user->user_id < 0)
                                    <td>{{$user->name}}</td>
                                @else
                                    <td>{{$user->User->name}}</td>
                                @endif

                                <td class="text-center hov1">
                                    <a wire:click="deleteMember({{$user->id}},'{{$user->start_date}}')" class="text-danger fas fa-trash"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div x-cloak x-transition.duration.750ms x-show="showSearch" @click.away="showSearch = false">
                    <livewire:teams.search-component  wire:key="{{$starter[0]->start_date}}" startDate="{{$starter[0]->start_date}}" showing="{{$showing}}"/>
                </div>

            </div>
        @endforeach

    @endif


</div>
