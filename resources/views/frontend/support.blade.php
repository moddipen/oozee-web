@extends('frontend.layout.app')
@section('content')
    <section class="breadcrumbs-custom">
        <div class="container">
            <div class="breadcrumbs-custom__inner">
                <p class="breadcrumbs-custom__title">Support</p>
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Submit a request
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="section-lg section-lg-custom bg-default">
        <div class="container">
            <div class="row row-50">
                <div class="col-md-7 col-lg-8">
                    <h3>Submit a request
                    </h3>
                    <form class="rd-mailform rd-mailform_style-1" id="support-form" data-form-output="form-output-global"
                          data-form-type="contact" method="post" enctype="multipart/form-data" action="{{ route('support.store') }}">
                        @csrf
                        <div class="form-wrap form-wrap_icon linear-icon-envelope">
                            <input class="form-input" id="contact-email" type="email" name="email"
                                   data-constraints="@Email @Required">
                            <label class="form-label" for="contact-email">Your email address *</label>
                        </div>
                        <div class="form-wrap form-wrap_icon linear-icon-telephone">
                            <input class="form-input" id="contact-phone" type="text" name="phone">
                            <label class="form-label" for="contact-phone">Your phone</label>
                        </div>
                        <div class="form-wrap form-wrap_icon linear-icon-pencil">
                            <input class="form-input" id="contact-subject" type="text" name="subject"
                                   data-constraints="@Required">
                            <label class="form-label" for="contact-subject">Subject *</label>
                        </div>
                        <div class="form-wrap form-wrap_icon linear-icon-feather">
                            <textarea class="form-input" id="contact-message" name="message"
                                      data-constraints="@Required"></textarea>
                            <label class="form-label" for="contact-message">Your message *</label>
                        </div>
                        <div class="form-wrap form-wrap_icon linear-icon-link">
                            <input class="form-input" id="attachment" style="display: none" type="file" name="attachment">
                            <label class="form-label" for="contact-phone">Attachment</label>
                            <a class="form-input" href="javascript:" onclick="$('#attachment').click()"></a>
                        </div>
                        <button class="button button-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection