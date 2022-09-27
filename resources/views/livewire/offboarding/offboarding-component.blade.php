<div>

    @if(!$selected)
        <div>
        <h4>Search</h4>
            <div class="form-group">
                <input class="w-100 form-control" type="search" wire:model.debounce500ms="searchTerm" placeholder="Search...">
            </div>

            @if($searchTerm && count($users) > 0)
                <table class="mt-5 table table-hover">
                    <thead class="slate-gradient text-white">
                        <tr>
                            <th>Action</th>
                            <th>User</th>
                            <th>Account</th>
                            <th>Domain</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><button wire:click="selectedUser({{$user->id}})"   class="float-left btn btn-danger btn-sm">Select</button></td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->username}}</td>
                                <td class="text-capitalize">{{$user->domain}}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @elseif(strlen($searchTerm) > 0 && count($users) == 0)
                <h4 class="text-center">Nothing to show</h4>
            @endif

        </div>
    @else
        <div>
            <h3>Offboard</h3>
            <hr>
                <div class="form-group mt-3">
                    <h5 class="text-danger">Make this offboarding immediate</h5>
                    <input type="checkbox" wire:model="immediate">
                </div>

            <div class="form-group mt-3">
                <div class="text-danger">@error('leaveDate')@enderror</div>
                <h5>Choose an offboarding date for <span class="h4 text-danger">{{$user->name}}</span></h5>
                <input class="mt-2 form-control w-100 w-md-50" min="{{$today}}" wire:model.defer="leaveDate" @if($immediate) disabled @endif type="date">
                @error('leaveDate') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div>
            <div wire:loading>
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
                <button wire:loading.remove wire:click="offBoard" class="btn btn-danger">Submit</button>
            </div>
        </div>
    @endif


    <!-- Modal -->
    <div class="modal fade" id="modal_message" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attention</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <h2 class="text-danger">Attention!</h2>
                    <h4>If the leaver is a home worker they <b>must</b> complete an IT equipment return request.</h4>
                    <p>This can be found at <a href="https://returns.ecoutsourcing.co.uk">https://returns.ecoutsourcing.co.uk</a></p>
                    <p>Please provide them with the above link</p>
                    <p>Thanks, the IT team</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    document.addEventListener("DOMContentLoaded", function(){

            window.addEventListener('modal', event => {

                $('#modal_message').modal('show');
            })
    });

</script>


