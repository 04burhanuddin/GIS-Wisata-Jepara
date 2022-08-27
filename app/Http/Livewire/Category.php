<?php

namespace App\Http\Livewire;

use App\Models\Category as ModelsCategory;
use Livewire\Component;

class Category extends Component
{

    public $cataegory_name;
    public $locationId, $long, $lat, $title, $description, $image, $updated_at;
    public $imageUrl;

    public function render()
    {
        return view('livewire.category', [
            'category' => ModelsCategory::all()
        ]);
     }
}
