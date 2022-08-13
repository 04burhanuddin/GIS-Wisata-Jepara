<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Wisata;
use Livewire\Component;

class Dashboard extends Component
{

    public $count = 5;
    public $locationId, $long, $lat, $title, $description, $image;
    public $imageUrl;
    public $geoJson;
    public $created_at;
    public $isEdit = false;

    private function getLocations()
    {
        $locations = Wisata::orderBy('created_at', 'desc')->get();

        $customLocation = [];

        foreach ($locations as $location) {
            $customLocation[] = [
                'type' => 'Feature',
                'geometry' => [
                    'coordinates' => [
                        $location->long, $location->lat
                    ],
                    'type' => 'Point'
                ],
                'properties' => [
                    'message' => $location->description,
                    'iconSize' => [27, 33],
                    'locationId' => $location->id,
                    'title' => $location->title,
                    'image' => $location->image,
                    'description' => $location->description
                ]
            ];
        };

        $geoLocations = [
            'type' => 'FeatureCollection',
            'features' => $customLocation
        ];

        $geoJson = collect($geoLocations)->toJson();
        $this->geoJson = $geoJson;
    }

    public function mount()
    {
    }


    public function render()
    {
        $this->getLocations();
        return view('livewire.dashboard', [
            'tours' => Wisata::Get()->all()
        ]);
    }
}