<?php

namespace App\Http\Livewire;

use App\Models\Wisata;
use Livewire\Component;
use Livewire\WithPagination;

class Listwisata extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.listwisata', [
            'listwisata' => Wisata::orderBy('created_at', 'desc')->paginate(8),
        ]);
    }
}