<div>
    @if(isset($intakes))
    <h5 class="text-center"><i class="fas fa-2x fa-headset"></i> : <span class="h2 @php if($totalHeadsets > 0) { echo "text-danger";} @endphp">{{$totalHeadsets}}</span>
    <i class="ml-5 fas fa-2x fa-camera"></i> : <span class="h2 @php if($totalWebcams > 0) { echo "text-danger";} @endphp">{{$totalWebcams}}</span>
    <i class="ml-5 fas fa-2x fa-laptop"></i> : <span class="h2 @php if($totalHeads > 0) { echo "text-danger h3";} @endphp">{{$totalHeads}}</span></h5>
    <hr>
    <div>
        <div class="ml-4">
            <label><h5>Filter</h5></label>
            <select style="font-size:20px" class="form-control w-100 w-sm-50 w-md-25" type="search" wire:model="filter">
                <option value="boldon">Boldon</option>
                <option value="sheffield">Sheffield</option>
                <option value="doxford">Doxford</h5></option>
            </select>
        </div>
        <hr>
        @if(count($intakes))
            <div style="max-height:300px" class="table-responsive p-4 overflow-auto">
                <table class="table table-bordered">
                    <thead class="slate-gradient text-white">
                        <th>Intake ID</th>
                        <th>Campaign</th>
                        <th>Site</th>
                        <th>Intake date</th>
                        <th>Heads</th>
                        <th>Webcams</th>
                        <th>Headsets</th>
                        <th>PC's required date</th>
                        <th>WFH or Office</th>
                        <th>Training</th>
                        <th>Trainer</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($intakes as $intake)
                        <tr x-data="{completed: {{$intake->completed}}}" :class="{ 'bg-light-success' : completed === 1 }">
                            <td>{{$intake->id}}</td>
                            <td>{{$intake->campaigns->title}}</td>
                            <td>{{$intake->site}}</td>
                            <td>{{date('d M y', strtotime($intake->intake_date))}}</td>
                            <td>{{$intake->heads}}</td>
                            <td>{{$intake->webcams}}</td>
                            <td>{{$intake->headsets}}</td>
                            <td>{{date('d M y', strtotime($intake->date_pc_required))}}</td>
                            <td>{{$intake->work_location}}</td>
                            <td>{{$intake->training_location}}</td>
                            <td>{{$intake->trainer}}</td>
                            <td>
                                <div class="btn-group dropleft">
                                    <button type="button" class="btn btn-teal btn-sm pr-3 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                    </button>
                                    <div class="dropdown-menu">
                                    <a class="dropdown-item text-success" href="javascript:void[0]" wire:click="complete({{$intake->id}});completed = 1">Mark as complete</a>
                                    <a class="dropdown-item text-primary" href="javascript:void[0]" wire:click="incomplete({{$intake->id}});completed = 0">Mark as Incomplete</a>
                                    <a data-toggle="modal" data-target="#modelId" class="dropdown-item" href="javascript:void[0]" wire:click="showModal({{$intake->id}})">View \ Add notes</a>
                                     <div class="dropdown-divider"></div>
                                    <a onclick="return confirm('Are you sure?')" class="dropdown-item text-danger text-center" href="javascript:void[0]" wire:click="delete({{$intake->id}})">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <div class="pagination-sm ml-4 py-2">
        <div>{{$intakes->links()}}</div>
    </div>

    @endif

    @if($intake)
    <div wire:ignore.self class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Intake</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">

                    @isset($intake->id)

                    <div class="row form-group">
                        <div class="col">
                            <label><b>Campaign:</b></label> {{$intake->campaigns->title}}
                        </div>
                        <div class="col">
                            <label><b>Site:</b></label> {{$intake->site}}
                        </div>
                        <div class="col">
                            <label><b>Intake date:</b></label> {{ Carbon\Carbon::parse($intake->intake_date)->format('d-m-Y');}}
                        </div>
                        <div class="col">
                            <label><b>No heads:</b></label> {{$intake->heads}}
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col">
                            <label><b>No headsets:</b></label> {{$intake->headsets}}
                        </div>
                        <div class="col">
                            <label><b>No Webcams:</b></label> {{$intake->webcams}}
                        </div>
                        <div class="col">
                            <label><b>Date PC required:</b></label> {{ Carbon\Carbon::parse($intake->date_pc_required)->format('d-m-Y');}}
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col">
                            <label><b>Work location:</b></label> {{$intake->work_location}}
                        </div>
                        <div class="col">
                            <label><b>Training locatation:</b></label> {{$intake->training_location}}
                        </div>
                        <div class="col">
                            <label><b>Trainer</b></label> {{$intake->trainer}}
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <div class="col">
                            <label><b>Notes:</b></label>
                            <div style="max-height:200px" class="overflow-auto">
                                @if($intake->notes)
                                    @foreach($intake->notes as $note)
                                        <div>{{ \App\Models\User::find($note['user_id'])->name; }} Commented on {{ \Carbon\Carbon::parse($note['date'])->format('d/m/Y H:m:s') }}</div>
                                        <div class="text-dark">{{$note['notes']}}</div>
                                        <hr>
                                    @endforeach
                                @endif
                            </div>
                            <div x-data="{showComment : false}">
                                <div x-show="showComment">
                                    <textarea class="form-control w-50" wire:model="comment">

                                    </textarea>
                                    <div class="mt-2">
                                        <button x-on:click="showComment = !showComment" wire:click="saveComment({{$intake->id}})" class="btn btn-success btn-sm">Save</button>
                                    </div>
                                </div>
                                <div class="mt-5" x-show="!showComment">
                                    <h6>Add a new comment - <button class="btn btn-primary btn-sm" x-on:click="showComment = !showComment"><i class="fas fa-comment"></i></button></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endisset

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @else
       <h3 class="text-center">Nothing here</h3>
    @endif
</div>
