<div>
    <div class="form-group">
        <label>No of questions</label>
            <select wire:model="total">
                <option>5</option>
                <option>10</option>
                <option>15</option>
                <option>20</option>
            </select>
        </div>
<form wire:submit.prevent="save">
    <div class="row row-cols-1 row-cols-md-2">
        @for($i = 0; $i < $total; $i++)
            <div class="border p-2">
                <div class="form-group">
                    <label><h3>Question-{{$i+1}}</h3></label>
                    <input wire:model.defer="questions.{{$i}}" class="form-control" required>
                    @error('questions') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                @for($q  = 0; $q < 4;$q++)
                    <div class="form-group">
                        @if($q == 3)
                            <label><h4>Answer-{{$q+1}} Correct</h4></label>
                            <input wire:model.defer="answers.{{$i}}.{{$q}}" class="border-success form-control" required>
                            @error('answers') <span class="text-danger">{{ $message }}</span> @enderror
                        @else
                            <label>Answer-{{$q+1}} Incorrect</label>
                            <input wire:model.defer="answers.{{$i}}.{{$q}}" class="border-danger form-control" required>
                            @error('answers') <span class="text-danger">{{ $message }}</span> @enderror
                        @endif
                    </div>
                @endfor
            </div>
        @endfor
    </div>
    @if($goBack)

        <a href="{{route('trainingsplash')}}" class="btn btn-block btn-success mt-3">Back to training</a>
    @else
        <button wire:loading.remove class="btn btn-block btn-teal mt-3" type="submit">Save</button>
    @endif
</form>

</div>
