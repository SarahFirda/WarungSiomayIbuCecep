<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use Livewire\Component;

class SelectOption extends Component
{
    public $pesananData;
    public $selectedMenu;
    public $selectedOptionData;

    public function mount($pesananData = null)
    {
        $this->pesananData = $pesananData;
        $this->selectedMenu = $pesananData->id_menu;
        if ($pesananData) {
            $this->selectedOptionData = Menu::find($pesananData->id_menu);
        }
    }

    public function render()
    {
        $menu = Menu::all();
        return view('livewire.select-option', ['menu' => $menu]);
    }

    public function updatedSelectedMenu($value)
    {
        $this->selectedOptionData = Menu::find($value);
    }
}
