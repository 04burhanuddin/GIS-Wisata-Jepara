<div class="banner-image w-100 vh-100 d-flex justify-content-center align-items-center">
    <div class="content text-center">
        <h1 class="display-4 text-white font-weight-bold mb-4">WELCOME TO JEPARA</h1>
    </div>
</div>
<div class="container">
    <h3 class="text-center font-weight-bold mt-5 mb-4">WISATA TERBARU</h3>
    <P class="text-center mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vulputate auctor vestibulum mi
        varius ornare rutrum
        consectetur
        volutpat consectetur.
        Proin
        et eget consequat scelerisque. Diam sed lobortis vel amet lectus. Ac tortor, ut lacus interdum molestie lectus
        nisi, tellus velit.</P>
</div>
<div class="container">
    <div class="card-deck">
        @foreach ($tours->take(4) as $wisata)
            <div class="card">
                <img src="{{ asset('/storage/images/' . $wisata->image) }}" style="height: 20vh" class=" card-img-top"
                    alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $wisata->title }}</h5>
                    <p class="card-text"><small class="text-muted">{{ $wisata->updated_at }}</small></p>
                    <a href="{{ route('detail.wisata', $wisata->id) }}" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="container mt-5">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 border-primary">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <div id='map' class="border border-dark mb-5" style='width: 100%; height: 70vh'></div>
        </div>
    </div>
</div>
<footer class="mt-2 bg-primary" id="about">
    <div class="container gx-4" id="contact">
        <div class="row align-items-center justify-content-between flex-column flex-sm-row">
            <div class="row row-cols-1 row-cols-lg-3 py-5 justify-content-center">
                <div class="col">
                    <p class="mb-4 text-white fs-6 mt-0 mb-sm-3 opacity-75">Mitra Terpercaya
                        Menuju
                        Koperasi Yang Sehat,
                        Kuat,
                        Mandiri dalam mewujudkan Kesejahteraan Anggota</p>
                </div>
                <div class="col">
                    <div class="h5 mb-3 text-white" wire:model='title'>Informasi</div>
                    <div class="d-flex">
                        <i class="bi-telephone-plus-fill text-white opacity-75"></i>
                        <p class="px-2 text-white mb-0 opacity-75">+62 5435 5354</p>
                    </div>
                </div>
                <div class="col">
                    <div class="h5 mb-3 text-white">Alamat</div>
                    <div class="d-flex opacity-75">
                        <i class="bi-geo-alt text-white"></i>
                        <p class="px-2 text-white mt-0 mb-4">Jln. Jepara Bangsri</p>
                    </div>
                    <p class="mb-4 text-white fs-6 mt-4 mb-sm-3 opacity-75"></p>
                </div>
            </div>
        </div>
        <div class="">
            <span class="text-white text-sm text-center mb-4 d-sm-inline-block">Copyright © {{ date('Y') }}
                Makarno</span>
        </div>
    </div>
</footer>
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

            // map.addControl(
            //     new MapboxDirections({
            //         accessToken: mapboxgl.accessToken

            //     }),
            //     'top-left'
            // );

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
