<div>
    @if(count($intakes))
    <div>
        <div style="max-height:300px" class="table-responsive p-4 overflow-auto">
            <table class="table table-bordered table-striped table-sm">
                <thead class="slate-gradient text-white">
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
                    <tr>
                        <td>{{$intake->campaigns->title}}</td>
                        <td class="text-capitalize">{{$intake->site}}</td>
                        <td>{{date('d M y', strtotime($intake->intake_date))}}</td>
                        <td>{{$intake->heads}}</td>
                        <td>{{$intake->webcams}}</td>
                        <td>{{$intake->headsets}}</td>
                        <td>{{date('d M y', strtotime($intake->date_pc_required))}}</td>
                        <td>{{$intake->work_location}}</td>
                        <td>{{$intake->training_location}}</td>
                        <td>{{$intake->trainer}}</td>
                        <td>
                            <button data-toggle="modal" data-target="#modelId" wire:click="showModal({{$intake->id}})" class="btn btn-teal btn-sm p-1">Edit</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="pagination-sm ml-4 py-2">
        <div>{{$intakes->links()}}</div>
    </div>
    <hr>
    @endif

    <h3 class="pb-5 pt-2 text-eco-blue">Campaign details</h3>
        <form wire:submit.prevent="submit" method="POST">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                <div class="col form-group">
                    <label class="font-weight-bold" for="campaign">Campaign</label>
                    <select wire:model.defer="campaign_id" class="form-control" required>
                        <option value=""><--Choose a campaign--></option>
                            @foreach($allCampaigns as $sCampaign)
                                <option value="{{$sCampaign->id}}">{{$sCampaign->title}}</option>
                            @endforeach
                    </select>
                </div>

                <div class="col form-group">
                    <label class="font-weight-bold">Site</label>
                    <select wire:model.defer="site" class="form-control" required>
                        <option value=""><--Choose--></option>
                        <option value="boldon">Boldon</option>
                        <option value="sheffield">Sheffield</option>
                        <option value="doxford">Doxford</option>
                    </select>
                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" for="intake_date">Intake date</label>
                    <input type="date" min="{{$tomorrow}}" class="form-control"  wire:model.defer="intake_date" id="intake_date" aria-describedby="helpId" required>
                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" for="heads">Heads</label>
                    <input type="number" class="form-control" min="0" wire:model.defer="heads" id="heads" aria-describedby="helpId" required>
                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" for="telephone">Webcams</label>
                    <input type="number" class="form-control" min="0" wire:model.defer="webcams" id="webcams" aria-describedby="helpId" required>

                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" for="headsets">Headsets</label>
                    <input type="number" class="form-control" min="0" wire:model.defer="headsets" id="headsets" aria-describedby="helpId" required>

                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" for="pc_required">Date PC required</label>
                    <input type="date" min="{{$tomorrow}}" class="form-control" wire:model.defer="date_pc_required" id="pc_required" aria-describedby="helpId" required>
                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" for="work_location">Work location</label>
                    <select class="form-control" wire:model.defer="work_location" required>
                        <option value=""><--Choose--></option>
                        <option value="WFO - Then home">Work from Office - Then home</option>
                        <option value="WFO">Work from Office</option>
                        <option value="WFH">Work from Home</option>
                        <option value="TBC">TBC</option>
                    </select>
                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" for="training_location">Training location</label>
                    <select class="form-control" wire:model.defer="training_location" required>
                        <option value=""><--Choose--></option>
                        <option value="TBC">TBC</option>
                        <option value="Home">Home</option>
                        <option value="Office">Office</option>
                    </select>
                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" for="trainer">Trainer</label>
                    <input type="text" class="form-control" wire:model.defer="trainer" id="trainer" aria-describedby="helpId" required>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2">
                <div class="col form-group">
                    <label class="font-weight-bold" for="">Notes</label>
                    <textarea style="height:150px" class="form-control w-100"  wire:model.defer="notes" id="notes" aria-describedby="helpId"></textarea>
                </div>
                <div class="col">
                </div>

            </div>

            <div>
                <button class="btn btn-teal" type="submit">Submit</button>
            </div>
        </form>

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

                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
                            <input type="hidden" wire:model="intakeId" value="{{$intakeId}}">

                            <div class="col form-group">
                                <label class="font-weight-bold" for="campaign">Campaign</label>
                                <select wire:model.defer="campaign_id" class="form-control" required>
                                    <option value=""><--Choose--></option>
                                        @foreach($allCampaigns as $mCampaign)
                                            <option value="{{$mCampaign->id}}">{{$mCampaign->title}}</option>
                                        @endforeach
                                </select>
                            </div>

                            <div class="col form-group">
                                <label class="font-weight-bold" for="campaign">Site</label>
                                <select wire:model.defer="site" class="form-control" required>
                                    <option disabled value=""><--Choose--></option>
                                    <option value="boldon">Boldon</option>
                                    <option value="sheffield">Sheffield</option>
                                    <option value="doxford">Doxford</option>
                                </select>
                            </div>

                            <div class="col form-group">
                                <label class="font-weight-bold" for="intake_date">Intake date</label>
                                <input type="date" min="{{$tomorrow}}" class="form-control" wire:model.defer="intake_date"  aria-describedby="helpId" required>
                            </div>

                            <div class="col form-group">
                                <label class="font-weight-bold" for="heads">Heads</label>
                                <input type="number" class="form-control" min="0" wire:model.defer="heads" aria-describedby="helpId" required>
                            </div>

                            <div class="col form-group">
                                <label class="font-weight-bold" for="telephone">Webcams</label>
                                <input type="number" class="form-control" min="0" wire:model.defer="webcams" aria-describedby="helpId" required>

                            </div>

                            <div class="col form-group">
                                <label class="font-weight-bold" for="headsets">Headsets</label>
                                <input type="number" class="form-control" min="0" wire:model.defer="headsets" id="headsets" aria-describedby="helpId" required>

                            </div>


                            <div class="col form-group">
                                <label class="font-weight-bold" for="pc_required">Date PC required</label>
                                <input type="date" min="{{$tomorrow}}" class="form-control" wire:model.defer="date_pc_required"  aria-describedby="helpId" required>
                            </div>

                            <div class="col form-group">
                                <label class="font-weight-bold" for="work_location">Work location</label>
                                <select class="form-control" wire:model.defer="work_location">
                                    <option value="" ><--Choose--></option>
                                    <option value="WFO - Then home">WFO - Then home</option>
                                    <option value="WFO">Work from Office</option>
                                    <option value="WFH">Work from Home</option>
                                    <option value="TBC">TBC</option>
                                </select>
                            </div>

                            <div class="col form-group">
                                <label class="font-weight-bold" for="training_location">Training location</label>
                                <select class="form-control" wire:model.defer="training_location">
                                    <option value=""><--Choose--></option>
                                    <option value="TBC">TBC</option>
                                    <option value="Home">Home</option>
                                    <option value="Office">Office</option>
                                </select>
                            </div>

                            <div class="col form-group">
                                <label class="font-weight-bold" for="trainer">Trainer</label>
                                <input type="text" class="form-control" wire:model.defer="trainer"  aria-describedby="helpId">
                            </div>
                        </div>

                        <div class="col-12 form-group">
                            <label class="font-weight-bold" for="">Previous notes</label>
                            <div id="mynotes" style="max-height:200px" class="overflow-auto">
                                @isset($notes)
                                    @foreach($notes as $note)
                                        <div>{{ \App\Models\User::find($note['user_id'])->name; }} Commented on {{ \Carbon\Carbon::parse($note['date'])->format('d/m/Y h:m:s')}}</div>
                                        <div class="text-dark">{{$note['notes']}}</div>
                                        <hr>
                                    @endforeach
                                @endisset
                            </div>
                        </div>

                        <div class="col-12 form-group">
                            <label class="font-weight-bold" for="">Add notes</label>
                            <textarea class="form-control w-100 w-md-50" wire:model="newNote"></textarea>
                        </div>

                </div>
                <div class="modal-footer">
                    <button wire:click="clear" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click="update" class="btn btn-teal" type="submit">Submit</button>
                </div>

            @endisset
            </div>
        </div>
    </div>
<script>
    window.addEventListener('closeModal', event => {
    $('#modelId').modal('hide')
})
</script>
</div>
