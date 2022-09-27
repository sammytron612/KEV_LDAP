<div>
    <div class="container p-5 bg-white vh-75">
        <div class="row">
            <div class="col form-group">
                <label for="campaign"><h4>Campaign</h4></label>
                <select wire:change="select" id="campaign" wire:model="campaign" class="form-control">
                    <option value="0">Choose a campaign</option>
                    <option value="1">Buzz bingo</option>
                    <option value="2">ESB Boldon</option>
                    <option value="3">ESB Sheffield</option>
                    <option value="4">OVO Boldon</option>
                    <option value="5">OVO Sheffield</option>
                    <option value="6">Payment sesnse(Boldon)</option>
                    <option value="7">Scottish power(Boldon)</option>
                    <option value="8">Shell Sheffield</option>
                    <option value="9">SO Energy(Boldon)</option>
                    <option value="10">SO Energy(Sheffield)</option>
                    <option value="11">You garden(Boldon)</option>
                    <option value="12">You garden(Sheffield)</option>
                </select>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-md-3  row-cols-lg-4 justify-content-center mt-5">
            @foreach($campaignLinks as $campaignLink)
                <div class="col">
                    <div style="height:150px;width=250px;" class="border rounded-corners shadow text-center p-2 px-5">
                            <h5 class="py-2 border-bottom">{{$campaignLink->title}}</h5>
                            <a href="{{$campaignLink->url}}" class="stretched-link"><img class="img-fluid" src="{{url('images/' . $campaignLink->image)}}"></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
