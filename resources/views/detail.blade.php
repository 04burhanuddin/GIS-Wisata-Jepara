@extends('layouts.app')
@section('content')
    <div class="card">
        <a href="{{ url('/') }}">bakc</a>
        <img src="https://cdn.idntimes.com/content-images/post/20190312/xbalmaulana-43e63bdbc7993f707e462817b9314282.jpg"
            style="height: 20vh" class=" card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{ $wisata->title }}</h5>
            <p class="card-text">{{ $wisata->description }}</p>
            <p class="card-text"><small class="text-muted">{{ $wisata->updated_at }}</small></p>
            <a href="#" class="btn btn-primary">Lihat Detail</a>
        </div>
    </div>
@endsection
