@extends('frontend.layout.app')
@section('content')
    <section class="section-xl section-lg-custom bg-default text-center search_listheader_bf">
        <div class="container">
            <div class="row row-30 justify-content-lg-center">
                <div class="col-lg-11 col-xl-9">
                    <form method="post" id="search-form" action="{{ route('frontend.search') }}">
                        @csrf
                        <div class="blue-bg">
                            <div class="search-header">
                                <div class="dropdown">
                                    <select name="iso" required>
                                        @foreach($countries as $country)
                                            <option @if($data['country']->iso == $country->iso) selected
                                                    @endif value="{{ $country->iso }}">{{ $country->iso }}
                                                +{{ $country->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="searchbox">
                                    <input type="number" required name="number" autocomplete="off"
                                           value="{{ $data['phone_number'] }}"
                                           class="numbers form-control form-control-sm" id="number"
                                    >
                                    <a href="javascript:" onclick="$('#search-form').submit()" class="searhv-icon-inner">
                                <img src="{{ asset('public/frontend/images/main/search2.png') }}" alt="">
                            </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="section-xl section-lg-custom bg-default text-center">
        <div class="container">
            @if($data['phone_number_id'] != '')
                <div class="row row-30 justify-content-lg-center">
                    <div class="col-lg-11 col-xl-9">
                        <div class="card card-custom text-center">
                            <div class="card-body profile-block">
                                <img src="{{ $data['photo'] ? $data['photo'] : asset('public/images/no_profile.png') }}"
                                     class="profile-pic" alt="">
                                <h3>
                                    <span id="name-text">{{  $data['name'] ? $data['name'] : '+'.$data['country']->code.$data['phone_number']}}</span>
                                    <a href="javascript:" data-toggle="modal" data-target="#suggestName">
                                        <i><img src="{{ asset('public/images/suggest.png') }}" alt=""></i>
                                    </a>
                                </h3>
                                <div class="gallerydiv">
                                    <a style="color: black;" href="javascript:" class="top-tag" data-toggle="modal"
                                       data-target=".bd-example-modal-lg">
                                        @if($data['tag'])
                                            <span><i class="material-icons">palette</i></span>{{ $data['tag'] }}
                                        @else
                                            Add tag<span><i class="material-icons icon-custom">+</i></span>
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <div class="row">
                                    <div class="col">
                                        <a href="#">
                                            <i><img src="{{ asset('public/images/call.png') }}" alt=""></i> Call</a>
                                    </div>
                                    {{--                                    <div class="col">--}}
                                    {{--                                        <a href="#"><i class="material-icons">message</i> Message</a>--}}
                                    {{--                                    </div>--}}
                                    <div class="col spam-content">
                                        @if(!$data['spam'])
                                            <a href="javascript:" data-toggle="modal" data-target="#spamModal">
                                                <i><img src="{{ asset('public/images/spam.png') }}" alt=""></i> Mark as
                                                spam</a>
                                        @else
                                            <a href="javascript:" class="spam-data" onclick="unspam()">
                                                <i><img src="{{ asset('public/images/spam.png') }}" alt=""></i> Unmark
                                                as spam</a>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <a href="javascript:" data-toggle="modal" data-target="#suggestName"><i><img
                                                        src="{{ asset('public/images/suggest.png') }}" alt=""></i>Suggest
                                            name</a>
                                    </div>
                                    <div class="col"><a href="javascript:">
                                            <form id="vcard-form" action="{{ route('download.contact') }}"
                                                  method="post">
                                                @csrf
                                                <input type="hidden" name="cname" id="cname"
                                                       value="{{  $data['name'] ? $data['name'] : '+'.$data['country']->code.$data['phone_number']}}">
                                                <input type="hidden" name="caddress" id="caddress"
                                                       value="{{ $data['address'] }}">
                                                <input type="hidden" name="cemail" id="cemail"
                                                       value="{{ $data['email'] }}">
                                                <input type="hidden" name="cphoto" id="cphoto"
                                                       value="{{ $data['photo'] }}">
                                                <input type="hidden" name="cnumber" id="cnumber"
                                                       value="{{ '+'.$data['country']->code.$data['phone_number']}}">
                                            </form>
                                            <i onclick="$('#vcard-form').submit()"><img
                                                        src="{{ asset('public/images/save_contact.png') }}" alt=""></i>
                                            Save contact</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-11 col-xl-9">
                        <div class="card card-custom">
                            <div class="card-body profile-block">
                                <div class="card-block"><i><img src="{{ asset('public/images/call.png') }}" alt=""></i>
                                    <div class="card-text">
                                        <h3>{{ $data['phone_number'] }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($data['email'])
                        <div class="col-lg-11 col-xl-9">
                            <div class="card card-custom">
                                <div class="card-body profile-block">
                                    <div class="card-block"><i><img src="{{ asset('public/images/email.png') }}" alt=""></i>
                                        <div class="card-text">
                                            <h3>{{ $data['email'] }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($data['address'])
                        <div class="col-lg-11 col-xl-9">
                            <div class="card card-custom">
                                <div class="card-body profile-block">
                                    <div class="card-block"><i><img src="{{ asset('public/images/location_icon.png') }}"
                                                                    alt=""></i>
                                        <div class="card-text">
                                            <h3>{{ $data['address'] }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    {{--                <div class="col-lg-11 col-xl-9">--}}
                    {{--                    <div class="card ">--}}
                    {{--                        <div class="card-body profile-block">--}}
                    {{--                            <div class="card-block"><i class="material-icons">domain</i>--}}
                    {{--                                <div class="card-text">--}}
                    {{--                                    <h3>Loacation here</h3>--}}
                    {{--                                    <p>Fixed line - Line Local Providers</p>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}
                </div>
            @else
                <div class="row row-30 justify-content-lg-center">
                    <div class="col-lg-11 col-xl-9">
                        <div class="card text-center">
                            <div class="card-body profile-block">
                                <h3><b>No result found</b></h3>
                                <br>
                                <h3>
                                    <span id="name-text">"{{ $data['phone_number'] }}" is not yet available.</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    @if($data['phone_number_id'] != '')
        <!--Suggest Modal -->
        <div class="modal fade" id="suggestName" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Suggest a better name</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="name" autocomplete="off" class="input-text"
                               placeholder="Suggest a better name">
                    </div>
                    <div class="modal-footer footermenu">
                        <a href="#" data-dismiss="modal">Close</a>
                        <a href="#" data-dismiss="modal" onclick="suggestName()">Save</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Spam Modal -->
        <div class="modal fade" id="spamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Are you sure you want to
                            mark {{ $data['name'] ? $data['name'] : '+'.$data['country']->code.$data['phone_number'] }}
                            as
                            spam?
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="mark-name" autocomplete="off" class="input-text"
                               placeholder="Suggest a better name">
                    </div>
                    <div class="modal-footer footermenu">
                        <a href="#" data-dismiss="modal">Cancel</a>
                        <a href="#" data-dismiss="modal" onclick="spam()">Mark</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tag Modal -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Is this a business? <br> Describe it to improve
                            OOZEE.</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="selected-tag-div">
                            @if($data['tag'])
                                <div class="galleryblock">
                                    <div class="gallerydiv">
                                        <a href="javascript:" style="color: black;" data-dismiss="modal"
                                           onclick="addTag(null)">
                                            <span aria-hidden="false">×</span>{{ $data['tag'] }}
                                        </a>
                                    </div>
                                </div>
                                <hr><br>
                            @endif
                        </div>
                        @foreach($tags as $tag)
                            <div class="galleryblock">
                                <div class="gallerydiv">
                                    <a href="javascript:" style="color: black;" data-dismiss="modal"
                                       onclick="addTag('{{ $tag->name }}')">
                                    <span class="purple-color"><i
                                                class="material-icons">palette</i></span>{{ $tag->name }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('after-scripts')
    <script type="application/javascript">
        function suggestName() {
            var name = $('#name').val() != '' ? $('#name').val() : $('#mark-name').val();
            if (name !== '') {
                $('#name-text').text(name);
                var data = {
                    name: name,
                    type: 'name',
                    number: "{{ $data['phone_number'] }}"
                };
                update(data);
            }
            setTimeout(() => {
                $('#name').val('');
                $('#mark-name').val('');
            }, 500);
        }

        function addTag(name) {
            if (name) {
                $('.selected-tag-div').html('<div class="galleryblock">\n' +
                    '                                <div class="gallerydiv">\n' +
                    '                                    <a href="javascript:" style="color: black;" data-dismiss="modal" onclick="addTag(null)">\n' +
                    '                                        <span aria-hidden="false">×</span>' + name + '' +
                    '                                    </a>\n' +
                    '                                </div>\n' +
                    '                            </div>\n' +
                    '                            <hr><br>');
                $('.top-tag').html('<span><i class="material-icons">palette</i></span>' + name);
            } else {
                $('.selected-tag-div').html('');
                $('.top-tag').html('Add tag<span><i class="material-icons icon-custom">+</i></span>');
            }
            var data = {
                name: name,
                type: 'tag',
                number: "{{ $data['phone_number'] }}"
            };
            update(data);
        }

        function spam() {
            $('.spam-content').html('<a href="javascript:" class="spam-data" onclick="unspam()"><i class="material-icons">block</i> Unmark as spam</a>');
            var data = {
                type: 'spam',
                number: "{{ $data['phone_number'] }}"
            };
            update(data);
            suggestName();
        }

        function unspam() {
            $('.spam-content').html('<a href="javascript:" data-toggle="modal" data-target="#spamModal"><i class="material-icons">block</i> Mark as spam</a>');
            var data = {
                type: 'spam',
                number: "{{ $data['phone_number'] }}"
            };
            update(data);
        }

        function update(data) {
            $.ajax({
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('update.contact') }}",
                data: data,
                success: function (data) {
                    output.text(data);
                },
                error: function (jqxhr, status, exception) {
                    output.text('Error ' + exception);
                }
            });
        }
    </script>
@endsection