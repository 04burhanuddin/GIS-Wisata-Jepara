<div class="container mt-5">
    <h5 class="mb-3">{{ $title }}</h5>
    <img src="{{ asset('/storage/images/' . $imageUrl) }}" style="height: 60vh; width:50%" class=" card-img-top"
        alt="...">
    <p class="mt-4">{{ $description }}</p>
    <p class=""><small class="text-muted">{{ $updated_at }}</small></p>
</div>
<div class="container mt-5">
    <div class="mb-2 d-flex justify-content-end">
        <button type="button" class="btn btn-secondary btn-sm" data-container="body" data-toggle="popover"
            data-placement="right" title="Cara mendapatkan rute wisata"
            data-content="Silahkan pilih posisi lokasi anda pada peta untuk mendapatkan rute wisata posis anda ditandai dengan marker berwarna merah">
            <div class="d-flex mb-1">
                <i class="bi bi-info-circle"></i>
                <i class="px-2 text-white mb-0 opacity-75">How to get rute</i>
            </div>
        </button>
    </div>

    <div id="info" style="display:none"></div>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 border-primary">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0 ">
            <div wire:ignore id='map' class="border border-grey mb-5" style='width: 100%; height: 70vh'>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        const defaultLocation = [110.66215850051299, -6.588701387742191];
        mapboxgl.accessToken = "{{ env('KEY_MAPBOX') }}";
        let map = new mapboxgl.Map({
            container: "map",
            center: defaultLocation,
            zoom: 10.50,
            style: "mapbox://styles/mapbox/streets-v11",
            interactive: true
        });
        map.addControl(new mapboxgl.NavigationControl());
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
            geojson.features.forEach(function(marker) {
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
                const start = geometry.coordinates;
                async function getRoute(end) {
                    const query = await fetch(
                        `https://api.mapbox.com/directions/v5/mapbox/cycling/${start[0]},${start[1]};${end[0]},${end[1]}?steps=true&geometries=geojson&access_token=pk.eyJ1IjoiYXJub21leCIsImEiOiJjbDZxa2trNGwwZWRvM2JtaDFkd2cybXdhIn0.i06PI_42IAmJFJkzztpIKQ`, {
                            method: 'GET'
                        }
                    );
                    const json = await query.json();
                    const data = json.routes[0];
                    const route = data.geometry.coordinates;
                    const geojson = {
                        type: 'Feature',
                        properties: {},
                        geometry: {
                            type: 'LineString',
                            coordinates: route
                        }
                    };
                    if (map.getSource('route')) {
                        map.getSource('route').setData(geojson);
                    } else {
                        map.addLayer({
                            id: 'route',
                            type: 'line',
                            source: {
                                type: 'geojson',
                                data: geojson
                            },
                            layout: {
                                'line-join': 'round',
                                'line-cap': 'round'
                            },
                            paint: {
                                'line-color': '#3887be',
                                'line-width': 5,
                                'line-opacity': 0.75
                            }
                        });
                    }
                }
                map.on('click', (event) => {
                    const coords = Object.keys(event.lngLat).map((key) => event.lngLat[key]);
                    const end = {
                        type: 'FeatureCollection',
                        features: [{
                            type: 'Feature',
                            properties: {},
                            geometry: {
                                type: 'Point',
                                coordinates: coords
                            }
                        }]
                    };
                    if (map.getLayer('end')) {
                        map.getSource('end').setData(end);
                    } else {
                        map.addLayer({
                            id: 'end',
                            type: 'circle',
                            source: {
                                type: 'geojson',
                                data: {
                                    type: 'FeatureCollection',
                                    features: [{
                                        type: 'Feature',
                                        properties: {},
                                        geometry: {
                                            type: 'Point',
                                            coordinates: coords
                                        }
                                    }]
                                }
                            },
                            paint: {
                                'circle-radius': 10,
                                'circle-color': '#f30'
                            }
                        });
                    }
                    getRoute(coords);
                });
                new mapboxgl.Marker(el)
                    .setLngLat(geometry.coordinates)
                    .addTo(map);
            });
        }
        loadGeoJSON({!! $geoJson !!})
    </script>
@endpush
