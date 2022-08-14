<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Wisata as LivewireWisata;
use App\Models\Wisata;
use Livewire\Component;

class Detailwisata extends Component
{

    public $wisata;
    public $locationId, $long, $lat, $title, $description, $image, $updated_at;
    public $imageUrl;
    public $geoJson;


    private function getLocations()
    {
        $locations = Wisata::orderBy('created_at', 'desc')->get();

        $customLocation = [];

        foreach ($locations as $location) {
        };
    }

    public function mount($id)
    {
        $this->getLocations();
        $wisata = Wisata::findOrFail($id);
        $this->title = $wisata->title;
        $this->description = $wisata->description;
        $this->imageUrl = $wisata->image;
        $this->updated_at = $wisata->updated_at;

        $customLocation[] = [
            'type' => 'Feature',
            'geometry' => [
                'coordinates' => [
                    $wisata->long, $wisata->lat
                ],
                'type' => 'Point'
            ],
            'properties' => [
                'message' => $wisata->description,
                'iconSize' => [27, 33],
                'locationId' => $wisata->id,
                'title' => $wisata->title,
                'image' => $wisata->image,
                'description' => $wisata->description
            ]
        ];

        $geoLocations = [
            'type' => 'FeatureCollection',
            'features' => $customLocation
        ];

        $geoJson = collect($geoLocations)->toJson();
        $this->geoJson = $geoJson;

        return view('livewire.detailwisata');
    }
}