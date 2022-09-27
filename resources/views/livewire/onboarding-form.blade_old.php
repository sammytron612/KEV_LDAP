<div>
    <div class="container bg-white px-5 pt-3 pb-5">
        @isset($result)
            @if($result == "success")
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Success</strong>
                    </div>

            @else
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>Oops something went wrong<strong>
                    </div>


            @endif
        @endisset
        <div>
            @livewire('onboarding-table', ['batch_no' => $batch_no])
        </div>
        <h3 class="py-3 text-eco-blue">Intake details form</h3>
        <hr>
        <form wire:submit.prevent="save">
            @if($batch_no == -1)
                <div class="form-group w-50 w-md-25">
                    <label class="font-weight-bold text-danger" for="total">Total heads for intake</label>
                    <input type="number" class="form-control"  wire:model.defer="total" name="total" id="total" aria-describedby="helpId" required>
                </div>
            @endif
            <div class="mt-5 row row-cols-1 row-cols-md-2 row-cols-lg-4">
                <div class="col form-group">
                    <label class="font-weight-bold" for="name">First name</label>@error('first_name')<span class="blinking text-danger">&nbspRequired</span>@enderror
                    <input type="text" class="form-control"  wire:model.defer="first_name" name="firstname" id="firstname" aria-describedby="helpId">
                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" for="name">Last name</label>@error('last_name')<span class="text-danger blinking">&nbspRequired</span>@enderror
                    <input type="text" class="form-control" wire:model.defer="last_name" name="lastname" id="lastname" aria-describedby="helpId">
                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" for="telephone">Internal transfer</label>@error('internal_transfer')<span class="text-danger blinking">&nbspRequired</span>@enderror
                    <select  class="form-control"  wire:model="internal_transfer" name="internal_transfer"  aria-describedby="helpId">
                        <option selected value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" for="telephone">Telephone</label>@error('telephone')<span class="text-danger blinking">&nbspRequired</span>@enderror
                    <input type="tel" class="form-control"  wire:model.defer="telephone" name="telephone" id="telephone" aria-describedby="helpId" @if($internal_transfer) disabled @endif>
                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" for="email">Email</label>@error('email')<span class="text-danger blinking">&nbspRequired</span>@enderror
                    <input type="email" class="form-control" wire:model.defer="email" name="email" id="email" aria-describedby="helpId" @if($internal_transfer) disabled @endif>

                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" for="campaign">Campaign</label>@error('campaign_id')<span class="text-danger blinking">&nbspRequired</span>@enderror
                    <select wire:change="updateDivision"  name="campaign_id" wire:model="campaign_id" class="form-control" @if($batch_no > 0) disabled @endif>
                        <option value=""><--Choose a campaign--></option>
                        @foreach($campaigns as $campaign)
                            <option value="{{$campaign->id}}">{{$campaign->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" >Division</label>@error('division_id')<span class="text-danger blinking">&nbspRequired</span>@enderror
                    <select wire:change="updateJobTitle" name="division_id" wire:model="division_id"class="form-control" @if($batch_no > 0) disabled @endif>
                        <option value=""><--Choose a division--></option>
                        @foreach($divisions as $division)
                            <option value="{{$division->id}}">{{$division->title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" for="campaign">Job title</label>@error('job_title')<span class="text-danger blinking">&nbspRequired</span>@enderror
                    <select wire:model="job_title" class="form-control" @if($batch_no > 0) disabled @endif>
                        <option value=""><--Choose a job title--></option>
                        @foreach($job_titles as $title)
                            <option value="{{$title->id}}">{{$title->job_title}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col form-group">
                    <label class="font-weight-bold">Site</label>@error('site')<span class="text-danger blinking">&nbspRequired</span>@enderror
                    <select class="form-control" wire:model.defer="site"  id="site" aria-describedby="helpId" @if($batch_no > 0) disabled @endif>
                        <option value=""><--- Choose --></option>
                        <option value="boldon">Boldon</option>
                        <option value="doxford park">Doxford park</option>
                        <option value="sheffield">Sheffield</option>
                    </select>
                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" for="start_date">Start date</label>@error('start_date')<span class="text-danger blinking">&nbspRequired</span>@enderror
                    <input  wire:model.defer="start_date" type="date" min="{{$today}}"  class="form-control" name="start_date" id="start_date" aria-describedby="helpId" @if($batch_no > 0) disabled @endif>
                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" for="internet_provider">Internet provider</label>
                    <input type="text" class="form-control" wire:model.defer="internet_provider"  name="internet_provider" id="internet_provider" aria-describedby="helpId">
                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" for="setup_location">Setup location</label>
                    <input type="text" class="form-control"  wire:model.defer="setup_location" name="setup_location" id="setup_location" aria-describedby="helpId">
                </div>

                <div class="col form-group">
                    <label class="font-weight-bold" for="">Ethernet length</label>
                    <select name="ethernet_cable" wire:model.defer="ethernet_cable" class="form-control">
                        <option value="None">None</option>
                        <option value="5 Meters">5 Meters</option>
                        <option value="10 Meters">10 Meters</option>
                        <option value="15 Meters">15 Meters</option>
                        <option value="20 Meters">20 Meters</option>
                        <option value="Massive">Massive</option>
                    </select>
                </div>

                <input type="hidden" wire:model.defer="batch_no" name="batch_no" value="{{$batch_no}}">

                <div class="col form-group">
                    <label class="font-weight-bold" for="">Equipment collection date\time</label>
                    <input type="datetime-local" wire:model.defer="equipment_collection" min="{{$today}}" class="form-control" name="equipment_collection" id="equipment_collection" aria-describedby="helpId">
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2">
                <div class="col form-group">
                    <label class="font-weight-bold" for="">Notes</label>
                    <textarea  class="h-50 form-control w-100" wire:model.defer="notes" name="notes" id="notes" aria-describedby="helpId"></textarea>
                </div>


            </div>

            <div>
                <div wire:loading>
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <button wire:loading.remove class="btn btn-teal float-left" type="submit">Submit</button>
                @if($batch_no > 0)
                    <a id="finish-button" href="{{ route('finishUp',$batch_no) }}" class="btn btn-success float-right">Finish up and email</a>
                @endif
            </div>
        </form>
    </div>

    @livewire('onboarding-edit')

    </div>
    <script>
        window.addEventListener('remove-finish', intakeId => {

            document.getElementById('finish-button').remove()

        });


    </script>
</div>
