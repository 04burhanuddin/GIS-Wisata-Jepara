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
                        <a class="nav-link" href="{{ route('list.wisata') }}">Tampilkan Semua</a>
                    </div>
                    <div class="row">
                        @foreach ($tours->take(3) as $wisata)
                            <div class="col-lg-4">
                                <div class="card">
                                    <img src="{{ asset('/storage/images/' . $wisata->image) }}" style="height: 25vh"
                                        class="card-img-top" alt="Waterfall" />
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $wisata->title }}</h5>
                                        <p class="card-text">{{ Str::limit($wisata->description, 100) }} ...more</p>
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
<footer class="mt-2 bg-primary" id="about">
    <div class="container gx-4" id="contact">
        <div class="row align-items-center justify-content-between flex-column flex-sm-row">
            <div class="row row-cols-1 row-cols-lg-3 py-5 justify-content-center">
                <div class="col">
                    <p class="mb-4 text-white fs-6 mt-0 mb-sm-3 opacity-75">Mitra Terpercaya Menuju
                        Koperasi Yang
                        Sehat,
                        Kuat, Mandiri dalam mewujudkan Kesejahteraan Anggota</p>
                </div>
                <div class="col">
                    <div class="h5 mb-3 text-white">Informasi</div>
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
    </div>
</footer>
<div class="text-center py-4 align-items-center">
    <p>Copyright © {{ date('Y') }} Makarno</p>
</div>

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
