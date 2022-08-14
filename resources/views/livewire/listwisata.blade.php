<div class="container">
    <div class="row mt-5 mb-1">
        <h6>Semua Wisata</h6>
    </div>
</div>
<div class="container">
    <div class="card-deck mb-2">
        @foreach ($listwisata as $items)
            <div class="row mr-2 mb-2 mt-2">
                <div class="card">
                    <img src="{{ asset('/storage/images/' . $items->image) }}" style="height: 200px; width:260px"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $items->title }}</h5>
                        <p class="card-text"><small class="text-muted">{{ $items->updated_at }}</small></p>
                        <a href="{{ route('detail.wisata', $items->id) }}"
                            class="btn btn-outline-primary rounded-0">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $listwisata->links() }}
</div>
