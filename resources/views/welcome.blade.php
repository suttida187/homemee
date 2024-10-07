@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    @foreach ($query as $item)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 border-0 shadow-sm">
                                @php
                                    $img_url = json_decode(htmlspecialchars_decode($item->img));
                                @endphp
                                @if ($img_url)
                                    <img src="{{ URL::asset('img/product/' . $img_url[0]) }}" class="card-img-top" alt="รูปภาพอสังหา" 
                                    style="height: 250px; object-fit: cover; cursor: pointer;" 
                                    data-bs-toggle="modal" data-bs-target="#propertyModal{{$item->id}}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->property_name }}</h5>
                                    <p class="card-text">
                                        <strong>{{ $item->property_type }}</strong> <br>
                                        {{ $item->location }} <br>
                                        ราคา: {{ $item->price }} บาท
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="propertyModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ $item->property_name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($img_url)
                                            <div id="carousel{{$item->id}}" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach ($img_url as $key => $url)
                                                        <div class="carousel-item @if($key == 0) active @endif">
                                                            <img src="{{ URL::asset('img/product/' . $url) }}" class="d-block w-100" style="height: 600px; object-fit: contain;" alt="รูปภาพอสังหา">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{$item->id}}" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carousel{{$item->id}}" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
@endsection
