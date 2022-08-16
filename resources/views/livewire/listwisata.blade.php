<div class="container mt-4">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-3">
        @foreach ($listwisata as $items)
            <div class="col my-1">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('/storage/images/' . $items->image) }}" alt="Card image cap"
                        style="height:20vh; width:100%">
                    <div class="card-body">
                        <h5 class="card-title text-capitalize">{{ $items->title }}</h5>
                        <p class="card-text text-runcate">
                            {{ Str::limit($items->description, 90) }}more</p>
                        <p class="card-text"><small class="text-muted">Last update {{ $items->updated_at }}</small>
                        </p>
                        <a href="{{ route('detail.wisata', $items->id) }}"
                            class="btn btn-primary rounded-0 text-white">Lihat
                            Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<footer class="mt-5" id="about" style="background-color: #EFF2F6">
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
            <a href="https://youtube.com" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
                <i class="bi bi-youtube"></i>
            </a>
            <a href="https://id-id.facebook.com/" class="btn btn-primary m-1" role="button" rel="nofollow"
                target="_blank">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="https://twitter.com/i/flow/login" class="btn btn-primary m-1" role="button" rel="nofollow"
                target="_blank">
                <i class="bi bi-twitter"></i>
            </a>
        </div>
    </div>
    <div class="text-center py-3 align-items-center" style="background-color: #D7D9DD">
        <p>Copyright © {{ date('Y') }} Makarno</p>
    </div>
</footer>
