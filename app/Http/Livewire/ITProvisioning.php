<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Recruitment;
use Livewire\WithPagination;
use Auth;

class ITProvisioning extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $totalHeads;
    public $totalWebcams;
    public $totalHeadsets;
    public $intake;
    public $comment;
    public $filter = '%';


    public function render()
    {
        $this->totalHeads = Recruitment::where('site','like',$this->filter)->where('completed', 0)->sum('heads');
        $this->totalWebcams = Recruitment::where('site','like',$this->filter)->where('completed', 0)->sum('webcams');
        $this->totalHeadsets = Recruitment::where('site','like',$this->filter)->where('completed', 0)->sum('headsets');

        $intakes = Recruitment::where('site','like',$this->filter)->OrderBy('date_pc_required','asc')->paginate(30);

        return view('livewire.i-t-provisioning', ['intakes' => $intakes]);
    }

    public function complete($id)
    {

        Recruitment::find($id)->update(['completed' => 1]);
    }

    public function incomplete($id)
    {

        Recruitment::find($id)->update(['completed' => 0]);
    }

    public function showModal($id)
    {

        $this->intake = Recruitment::where('id',$id)->first();

    }

    public function delete($id)
    {
        Recruitment::where('id',$id)->delete();
    }

    public function saveComment($id)
    {

        $data = Recruitment::find($id);
        if($this->comment)
        {
            $note = ["notes" => $this->comment,
            'user_id' => Auth::user()->id,
            'date' => now()
            ];

            if(is_array($data->notes))
            {
                $array = $data->notes;
                array_push($array, $note);
            } else
            {

                $array[] = $note;

            }
            $data->notes = $array;
        }

        $message = ['text' =>  'Updated','type' => 'success'];
        $this->emit('toast', $message);
        $data->save();


    }

}
