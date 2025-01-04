<?php

namespace App\View\Components;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Nav extends Component
{
    public $items;
    public $active;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->items = $this->preparItems(config('nav'));

        //$this->active = Route::currentRouteName();
    }

    /**
     * Get the view / contents that represent the com`ponent.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav');
    }

    public function preparItems($items)
    {
        $user =Auth::user();
        foreach($items as $key =>$item){
            if(isset($item['ability']) && !$user->can($item['ability'])){
                unset($items[$key]);
            }
       }
       return $items;
    }

}
