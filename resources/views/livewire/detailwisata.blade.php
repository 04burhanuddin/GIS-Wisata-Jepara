<div class="container mt-5">
    <h5 class="mb-3">{{ $title }}</h5>
    <img src="{{ asset('/storage/images/' . $imageUrl) }}" style="height: 60vh" class=" card-img-top" alt="...">
    <p class="mt-4">{{ $description }}</p>
    <p class=""><small class="text-muted">{{ $updated_at }}</small></p>
</div>
<div class="container mt-5">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 border-primary">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <div wire:ignore id='map' class="border border-dark mb-5" style='width: 100%; height: 70vh'></div>
        </div>
    </div>
</div>
<div id="info" style="display:none"></div>

@push('script')
    <script>
        document.addEventListener('livewire:load', () => {
            const defaultLocation = [110.66215850051299, -6.588701387742191];
            const coordinateInfo = document.getElementById('info');
            mapboxgl.accessToken = "{{ env('KEY_MAPBOX') }}";
            let map = new mapboxgl.Map({
                container: "map",
                center: defaultLocation,
                zoom: 10.50,
                style: "mapbox://styles/mapbox/streets-v11",
                interactive: true
            });
            map.addControl(new mapboxgl.NavigationControl());
            // my location
            map.addControl(
                new mapboxgl.GeolocateControl({
                    positionOptions: {
                        enableHighAccuracy: true
                    },
                    trackUserLocation: true,
                    showUserHeading: true
                })
            );
            const loadGeoJSON = (geojson) => {
                geojson.features(function(marker) {
                    const {
                        geometry,
                        properties
                    } = marker
                    const {
                        iconSize,
                        locationId,
                        title,
                        image,
                        description
                    } = properties
                    let el = document.createElement('div');
                    el.className = 'marker' + locationId;
                    el.id = locationId;
                    el.style.backgroundImage = 'url({{ asset('image/marker.png') }})';
                    el.style.backgroundSize = 'cover';
                    el.style.width = iconSize[0] + 'px';
                    el.style.height = iconSize[1] + 'px';
                    const pictureLocation = '{{ asset('/storage/images') }}' + '/' + image

                    const content = `
                        <div style="overflow-y: auto; max-height:400px; width:100%;" class="mt-2">
                            <a>${title}</a>
                        </div>`;
                    let popup = new mapboxgl.Popup({
                        offset: [0, -16]
                    }).setHTML(content).setMaxWidth("400px");

                    el.addEventListener('click', (e) => {
                        const locationId = e.toElement.id
                        @this.findLocationById(locationId)

                    });
                    new mapboxgl.Marker(el)
                        .setLngLat(geometry.coordinates)
                        .setPopup(popup)
                        .addTo(map);
                });
            }
            loadGeoJSON({!! $geoJson !!})
            //light-v10, outdoors-v11, satellite-v9, streets-v11, dark-v10
            const style = "light"
            map.setStyle(`mapbox://styles/mapbox/${style}`);
            const getLongLatByMarker = () => {
                const lngLat = marker.getLngLat();
                return 'Longitude: ' + lngLat.lng + '<br />Latitude: ' + lngLat.lat;
            }
        })
    </script>
@endpush
