<?php

namespace App\Http\Livewire;


use Livewire\Component;
use App\Models\Question;

class ShowQuestion extends Component
{
    public $quizze_id,$StudentId ,$data ,$counter=0 ;
    public function render()
    {
        $this->data=Question::where('quizze_id',$this->quizze_id)->get();
        return view('livewire.show-question',['data']);
    }
}   
