<div class="banner-image w-100 vh-100 d-flex justify-content-center align-items-center">
    <div class="content text-center">
        <h1 class="display-4 text-white font-weight-bold mb-4">WELCOME TO JEPARA</h1>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 gx-5 mb-4">
            <div class="bg-image hover-overlay ripple shadow-2-strong rounded-5" data-mdb-ripple-color="light">
                <img src="https://mdbootstrap.com/img/new/slides/031.jpg" class="img-fluid" />
                <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                </a>
            </div>
        </div>

        <div class="col-md-6 gx-5 mb-4">
            <h4><strong>Facilis consequatur eligendi</strong></h4>
            <p class="text-muted">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis consequatur
                eligendi quisquam doloremque vero ex debitis veritatis placeat unde animi laborum
                sapiente illo possimus, commodi dignissimos obcaecati illum maiores corporis.
            </p>
            <p><strong>Doloremque vero ex debitis veritatis?</strong></p>
            <p class="text-muted">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod itaque voluptate
                nesciunt laborum incidunt. Officia, quam consectetur. Earum eligendi aliquam illum
                alias, unde optio accusantium soluta, iusto molestiae adipisci et?
            </p>
        </div>
    </div>
</div>
<div class="container">
    <hr class="my-5" />
    <h3 class="text-center font-weight-bold mt-5 mb-4">WISATA TERBARU</h3>
    <P class="text-center mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vulputate auctor vestibulum mi
        varius ornare rutrum
        consectetur
        volutpat consectetur.
        Proin et eget consequat scelerisque. Diam sed lobortis vel amet lectus. Ac tortor, ut lacus interdum molestie
        lectus
        nisi, tellus velit.
    </P>
</div>
<div class="container">
    <div id="carouselMultiItemExample" class="carousel slide carousel-dark text-center" data-mdb-ride="carousel">
        <div class="carousel-inner py-4">
            <!-- Single item -->
            <div class="carousel-item active">
                <div class="container">
                    <div class="row d-flex justify-content-end">
                        <a class="nav-link mb-2 text-" href="{{ route('list.wisata') }}">Tampilkan Semua</a>
                    </div>
                    <div class="row">
                        @foreach ($tours->take(3) as $wisata)
                            <div class="col-lg-4">
                                <div class="card">
                                    <img src="{{ asset('/storage/images/' . $wisata->image) }}" style="height: 25vh"
                                        class="card-img-top" alt="Waterfall" />
                                    <div class="card-body">
                                        <h5 class="card-title text-capitalize">{{ $wisata->title }}</h5>
                                        <p class="card-text text-runcate">
                                            {{ Str::limit($wisata->description, 100) }}more</p>
                                        <a href="{{ route('detail.wisata', $wisata->id) }}"
                                            class="btn btn-primary">Detail</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <hr class="my-5" />
    <h3 class="text-center font-weight-bold mt-5 mb-4">SEMUA WISATA</h3>
    <P class="text-center mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vulputate
        auctor vestibulum mi
        varius ornare rutrum
        consectetur
        volutpat consectetur.
        Proin et eget consequat scelerisque. Diam sed lobortis vel amet lectus. Ac tortor, ut lacus
        interdum molestie
        lectus
        nisi, tellus velit.
    </P>
</div>
<div class="container mt-5">
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 border-primary">
        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
            <div id='map' class="border border-grey mb-5" style='width: 100%; height: 70vh'></div>
        </div>
    </div>
</div>
<footer class="mt-2" id="about" style="background-color: #EFF2F6">
    <div class="container">
        <div class="row row-cols-1 row-cols-lg-1 py-5 justify-content-center">
            <div class="col">
                <p class="text-dark text-center fs-6 mt-0 mb-sm-3 opacity-75">Kamu ngga perlu bimbang, apakah kamu
                    akan
                    sukses atau gagal. Karena, orang sukses tidak pernah percaya mengenai kegagalan. Dia hanya
                    percaya bahwa dia sedang Menemukan suatu cara untuk tidak mencapai hasil yang dia harapkan</p>

            </div>
        </div>
        <hr class="my-2" />
        <div class="text-center py-4 align-items-center">
            <p>Follow Wisata Jepara on social media</p>
            <a href="#" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
                <i class="bi bi-youtube"></i>
            </a>
            <a href="#" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="#" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
                <i class="bi bi-twitter"></i>
            </a>
            <a href="#" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
                <i class="bi bi-github"></i>
            </a>
        </div>
    </div>
    <div class="text-center py-3 align-items-center" style="background-color: #D7D9DD">
        <p>Copyright © {{ date('Y') }} Makarno</p>
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
                    // Costum marker
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
            const style = "light-v11"
            map.setStyle(`mapbox://styles/mapbox/${style}`);
            const getLongLatByMarker = () => {
                const lngLat = marker.getLngLat();
                return 'Longitude: ' + lngLat.lng + '<br />Latitude: ' + lngLat.lat;
            }
        })
    </script>
@endpush
