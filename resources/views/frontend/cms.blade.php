@extends('frontend.layout.app')
@section('content')
    {!! $page->content !!}

{{--    @if(Request::is('about-us'))--}}
{{--        <section class="section-xl bg-default text-center">--}}
{{--            <div class="container">--}}
{{--                <div class="row row-30 justify-content-lg-center">--}}
{{--                    <div class="col-lg-11 col-xl-9">--}}
{{--                        <h3>Latest news</h3>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="row row-50 offset-top-1">--}}
{{--                    @foreach($commonNews as $news)--}}
{{--                        <div class="col-md-6 col-lg-4">--}}
{{--                            <div class="thumb thumb-corporate">--}}
{{--                                <div class="thumb-corporate__main">--}}
{{--                                    <a href="{{ route('news.details', $news->slug) }}">--}}
{{--                                        <img src="{{ $news->getFirstMediaUrl('news') ? asset($news->getFirstMediaUrl('news')) : 'public/frontend/images/brian-king-480x362.jpg' }}"--}}
{{--                                             alt="" height="362" width="480"/>--}}
{{--                                    </a>--}}
{{--                                    <div class="thumb-corporate__overlay">--}}
{{--                                        <ul class="list-inline-sm thumb-corporate__list">--}}
{{--                                            <li>&nbsp;</li>--}}
{{--                                            <li>&nbsp;</li>--}}
{{--                                            <li>&nbsp;</li>--}}
{{--                                            <li>&nbsp;</li>--}}
{{--                                            <li>&nbsp;</li>--}}
{{--                                            <li>&nbsp;</li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="thumb-corporate__caption">--}}
{{--                                    <p class="thumb__title"><a href="{{ route('news.details', $news->slug) }}">{{ $news->title }}</a></p>--}}
{{--                                    <p class="thumb__subtitle">by {{ $news->creator->name }}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    @endif--}}
@endsection
@if(Request::is('contact-us'))
    @section('after-styles')
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet'>
    <link href='https://static-assets.mapbox.com/gl-js-pricing/dist/mapbox-gl.css' rel='stylesheet' />
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.3.0/mapbox-gl-geocoder.css' type='text/css' />
    <style>
        .mapboxgl-map {
            position: unset !important;
        }
        .marker {
            border: none;
            cursor: pointer;
            height: 56px;
            width: 56px;
            background-image: url('https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi2.png');
            background-repeat: no-repeat;
            background-color: rgba(0, 0, 0, 0);
        }

        .clearfix { display:block; }
        .clearfix:after {
            content:'.';
            display:block;
            height:0;
            clear:both;
            visibility:hidden;
        }

        /* Marker tweaks */
        .mapboxgl-popup {
            padding-bottom: 50px;
        }

        .mapboxgl-popup-close-button {
            display:none;
        }
        .mapboxgl-popup-content {
            font:400 15px/22px 'Source Sans Pro', 'Helvetica Neue', Sans-serif;
            padding:0;
            width:180px;
        }
        .mapboxgl-popup-content-wrapper {
            padding:1%;
        }
        .mapboxgl-popup-content h3 {
            background:#91c949;
            color:#fff;
            margin:0;
            display:block;
            padding:10px;
            border-radius:3px 3px 0 0;
            font-weight:700;
            margin-top:-15px;
        }

        .mapboxgl-popup-content h4 {
            margin:0;
            display:block;
            padding: 10px 10px 10px 10px;
            font-weight:400;
        }

        .mapboxgl-popup-content div {
            padding:10px;
        }

        .mapboxgl-container .leaflet-marker-icon {
            cursor:pointer;
        }

        .mapboxgl-popup-anchor-top > .mapboxgl-popup-content {
            margin-top: 15px;
        }

        .mapboxgl-popup-anchor-top > .mapboxgl-popup-tip {
            border-bottom-color: #91c949;
        }
    </style>
@endsection
    @section('after-scripts')
        <script src='https://static-assets.mapbox.com/gl-js-pricing/dist/mapbox-gl.js'></script>
        <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.3.0/mapbox-gl-geocoder.min.js'></script>
        <script>
            mapboxgl.accessToken = "{{ config('services.map.key') }}";

            // This adds the map
            var map = new mapboxgl.Map({
                // container id specified in the HTML
                container: 'map_view',
                // style URL
                style: 'mapbox://styles/mapbox/light-v10',
                // initial position in [long, lat] format
                center: [72.555010, 23.038880],
                // initial zoom
                zoom: 15,
                scrollZoom: true
            });
            var marker = new mapboxgl.Marker()
                .setLngLat([72.555010, 23.038880])
                .addTo(map);
        </script>
    @endsection
@endif