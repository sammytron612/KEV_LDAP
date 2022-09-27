<div>
    <div class="container-fluid bg-white py-5">
        @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
        @endif
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        @can('it')
        <button wire:click="bulkInvite" class="btn btn-primary float-right">Bulk Invite</button>
        @endcan
        <label class="text-danger text-mute mb-3">Inviting a user twice, will reset their progression for that module!</label>
        @error('selectedUsers')<div class="blinking text-danger">A user is needed</div>@enderror
        <div class="row">
            <div class="position-relative text-center form-inline col-12 col-md-6">
                <label style="font-weight: 700" class="h5 mr-1 text-eco-blue" for="search">Search a name:</label>
                <input wire:model.debounce.500ms="searchTerm" type="search" class="w-100 w-md-50 form-control" id="search">
                <div class="d-none d-md-block input-group-append">
                    <span class="input-group-text"><i class="py-1 fa fa-search"></i></span>
                </div>
                <div class="row col-12 mt-2">
                    <div wire:loading.remove>
                        <button wire:click="finish" class="w-100 btn btn-primary">Invite</button>
                    </div>
                    <div wire:loading>
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div id="myData" x-cloak x-data="{ visible : @entangle('isVisible').defer }">
                    <div @click.away="visible = false" id="dropdown" x-show="visible" style="z-index:99; left:-25px; top:60px; min-width:430px;max-height:250px;overflow: scroll;" class="bg-white w-100 border border-secondry p-2 position-absolute w-100">
                        @if(count($users) > 0)
                            <div class="font-italic text-left font-weight-bold text-teak">Users</div>
                            <hr>
                            <ul class="list-unstyled text-left list-group list-group-flush">
                                @foreach($users as $user)
                                <li class="mb-2">{{$user->name}} - {{$user->username}} - <span class="text-capitalize font-weight-bold">{{$user->domain}}</span><button wire:click='addUser({{$user->id}})' class="float-right btn btn-primary btn-sm py-0">Add</button>
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-5 mt-md-0 col-12 col-md-6">
                @if(count($selectedUsers) > 0)
                    <div class="form-inline w-100">
                        <label style="font-weight: 700" class="text-eco-blue h5">Users:</label>
                        <div style="max-height: 150px; height:auto" class="border p-2 ml-1 overflow-auto border w-100 w-md-50">
                            @foreach($selectedUsers as $user)
                                <div>
                                    {{$user['name']}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <br>
        <hr>
        <h3 class="mt-5 mb-5 text-center underline text-eco-blue">Training categories</h3>
        @error('checkedModules')<span class="text-danger blinking">At least 1 Module  is needed</span>@enderror
        <div class="row row-cols-1 row-cols-md-2">
            @foreach($categories as $category)
            @if(count($category->modules))
                <div class="col px-3 py-1">
                    <div class="">
                        <h4 class="py-2 text-center text-dark">{{$category->title}}</h4>
                    </div>
                    <div class="p-2 text-center">
                        <img style="height:150px" class="w-100 w-md-50 img-thumbnail" src="{{asset('storage/images/' .$category->image)}}">
                        <h5 class="py-2 text-center">No of modules {{count($category->modules)}}</h5>

                        <ul class="list-unstyled">
                            <div id="accordion">
                                <div class="card mt-2 text-left">
                                    <a href class="stretched-link text-decoration-none" data-toggle="collapse" data-target="#collapse-{{$category->id}}" aria-expanded="true" aria-controls="collapse-{{$category->id}}">
                                    <div class="card-header eco-blue-gradient" id="heading-{{$category->id}}">
                                        <h5 class="mb-0 text-white">
                                            <input type="button" class="btn btn-link bg-gradient text-white mr-2"/>
                                            {{$category->title}}<i class="text-white float-right fas fa-chevron-down"></i>
                                        </h5>
                                    </div>
                                    </a>
                                    <div id="collapse-{{$category->id}}" class="collapse" aria-labelledby="heading-{{$category->id}}" data-parent="#accordion">
                                        <div class="card-body">
                                            @foreach($category->modules as $module)
                                                <div>
                                                    <h5>{{$module->title}}<input type="checkbox" wire:model.defer="checkedModules" value="{{ $module->id }}" class="float-right"></h5>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            @endif
            @endforeach
        </div>
    </div>
</div>

