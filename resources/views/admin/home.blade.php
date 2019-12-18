@extends('admin.layout.dashboard')
@section('title')
    Dashboard
    @parent
@stop
@section('content-header')
    <h1>Welcome to Dashboard</h1>
    <ol class="breadcrumb">
        <li class="active">
            <a href="{{ route('admin.home') }}">
                <i class="livicon" data-name="home" data-size="14" data-color="#333" data-hovercolor="#333"></i>
                Dashboard
            </a>
        </li>
    </ol>
@endsection
@section('styles')
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet'>
    <link href='https://static-assets.mapbox.com/gl-js-pricing/dist/mapbox-gl.css' rel='stylesheet' />
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.3.0/mapbox-gl-geocoder.css' type='text/css' />
    <style>
        .box-title {
            font-size: 16px !important;
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
@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="lightbluebg no-radius">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <br>
                        <div class="row">
                            <div class="square_box col-xs-7 text-right">
                                <span class="box-title">Paid Users</span>
                                <div class="number">{{ $data->paid }}</div>
                            </div>
                            <i class="livicon  pull-right" data-name="users" data-l="true" data-c="#fff"
                               data-hc="#fff" data-s="70"></i>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInUpBig">
            <!-- Trans label pie charts strats here-->
            <div class="redbg no-radius">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <br>
                        <div class="row">
                            <div class="square_box col-xs-7 pull-left">
                                <span class="box-title">Free Users</span>
                                <div class="number">{{ $data->free }}</div>
                            </div>
                            <i class="livicon pull-right" data-name="users" data-l="true" data-c="#fff"
                               data-hc="#fff" data-s="70"></i>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6 margin_10 animated fadeInDownBig">
            <!-- Trans label pie charts strats here-->
            <div class="goldbg no-radius">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <br>
                        <div class="row">
                            <div class="square_box col-xs-7 pull-left">
                                <span class="box-title">Android Users</span>
                                <div class="number">{{ $data->android }}</div>
                            </div>
                            <i class="livicon pull-right" data-name="users" data-l="true" data-c="#fff"
                               data-hc="#fff" data-s="70"></i>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInRightBig">
            <!-- Trans label pie charts strats here-->
            <div class="palebluecolorbg no-radius">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <br>
                        <div class="row">
                            <div class="square_box col-xs-7 pull-left">
                                <span>IOS Users</span>
                                <div class="number">{{ $data->ios }}</div>
                            </div>
                            <i class="livicon pull-right" data-name="users" data-l="true" data-c="#fff" data-hc="#fff"
                               data-s="70"></i>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-9 col-md-6 col-sm-6">
            <div id="map_view" class='map' style="width:100%; height:600px;"></div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 location-user-box">
            <div class="lightbluebg no-radius">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <br>
                        <div class="row">
                            <div class="square_box col-xs-7 pull-left">
                                <span class="box-title">Total Users in entire areas</span>
                                <div class="number" id="LocationUsers"></div>
                            </div>
                            <i class="livicon pull-right" data-name="users" data-l="true" data-c="#fff" data-hc="#fff"
                               data-s="70"></i>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src='https://static-assets.mapbox.com/gl-js-pricing/dist/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.3.0/mapbox-gl-geocoder.min.js'></script>
    <script>
        $('.location-user-box').hide();
        mapboxgl.accessToken = "{{ config('services.map.key') }}";

        // This adds the map
        var map = new mapboxgl.Map({
            // container id specified in the HTML
            container: 'map_view',
            // style URL
            style: 'mapbox://styles/mapbox/streets-v11',
            // initial position in [long, lat] format
            center: [78.962883, 20.593683],
            // initial zoom
            zoom: 5,
            scrollZoom: true
        });

        var geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl
        });

        map.addControl(geocoder);

        geocoder.on('result', (e) => {
            let long = e.result.geometry.coordinates[0];
            let lat = e.result.geometry.coordinates[1];
            getUsers(long, lat);
        });

        function getUsers(long, lat) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('admin.location.users') }}",
                data: {
                    _token: CSRF_TOKEN,
                    longitude: long,
                    latitude: lat
                },
                type: 'POST',
                dataType: 'json',
                success: (response) => {
                    $('.location-user-box').show();
                    $('#LocationUsers').html(response.count);
                    let stores = {
                        type: "FeatureCollection",
                        "features": response.users
                    };
                    setUsers(stores, long, lat);
                },
                error: (err) => {
                    console.log(err)
                },
                complete: () => {
                    console.log('done!')
                }
            });
        }

        function setUsers(stores, long, lat) {
            // This is where your interactions with the symbol layer used to be
            // Now you have interactions with DOM markers instead
            // This adds the map
            var map = new mapboxgl.Map({
                // container id specified in the HTML
                container: 'map_view',
                // style URL
                style: 'mapbox://styles/mapbox/streets-v11',
                // initial position in [long, lat] format
                center: [long, lat],
                // initial zoom
                zoom: 10,
                scrollZoom: true
            });
            stores.features.forEach((marker, i) => {
                // Create an img element for the marker
                var el = document.createElement('div');
                el.id = "marker-" + i;
                el.className = 'marker';
                // Add markers to the map at all points
                new mapboxgl.Marker(el, {offset: [0, -23]})
                    .setLngLat(marker.geometry.coordinates)
                    .addTo(map);
            });
        }
    </script>
@endsection