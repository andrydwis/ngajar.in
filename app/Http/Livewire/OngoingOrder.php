<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class OngoingOrder extends Component
{

    public $order;
    public $duration;
    public $hours;
    public $minutes;
    public $seconds;



    public function render()
    {

        $now = Carbon::now();
        $until = Carbon::make($this->order->day . ' ' . $this->order->hour_end);
        $this->duration = $until->diffInSeconds($now);
        //dd($this->duration);
        $this->hours = floor($this->duration / 3600);
        $this->minutes = floor(($this->duration / 60) % 60);
        $this->seconds = $this->duration % 60;
        //dd($this->minutes);
        return view('livewire.ongoing-order');
    }
}
