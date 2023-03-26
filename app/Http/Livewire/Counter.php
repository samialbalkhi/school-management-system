<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Religion;
use App\Models\Notionalitio;

class Counter extends Component
{

    public $searsh="";
    public function render()
    {


            return view('livewire.counter', [
                'Nationalities' => Religion::all(),
                  
                
            
            ]);
    
    }

    public $count = 0;

    public function increment (){

        $this->count ++ ;
    }
    public function decrement (){
        $this->count -- ;
    }
}
