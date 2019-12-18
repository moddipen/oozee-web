@extends('frontend.layout.app')
@section('content')
    <section class="breadcrumbs-custom">
        <div class="container">
            <div class="breadcrumbs-custom__inner">
                <p class="breadcrumbs-custom__title">Blog</p>
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class="active">Blog</li>
                </ul>
            </div>
        </div>
    </section>
    <div class="section-md section-divided">
        <div class="container">
            <div class="row row-50 row-md-75">
                <div class="col-lg-8 section-divided__main">
                    @php $i = 0; @endphp
                    @foreach($blogs as $blog)
                        @php $i++; @endphp
                        <section class="section-md">
                            <h5><a href="{{ route('blog.details', $blog->slug) }}">{{ $blog->title }}</a></h5>
                            <div class="row @if($i%2 == 0) {{ 'flex-md-row-reverse' }} @endif row-30">
                                <div class="col-md-6">
                                    {!! $blog->content !!}
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('blog.details', $blog->slug) }}">
                                        <figure class="figure">
                                            <img src="{{ $blog->getFirstMediaUrl('blog') ? asset($blog->getFirstMediaUrl('blog')) : 'public/frontend/images/typography-2-418x315.jpg' }}"
                                                 alt="" width="418" height="315"/>
                                        </figure>
                                    </a>
                                    <p><span class="post-inline__time">{{ $blog->created_at->diffForHumans() }}</span>&nbsp;&nbsp;&nbsp;<span
                                                class="comment-minimal__author">by {{ $blog->creator->name }}</span></p>
                                </div>
                            </div>
                        </section>
                    @endforeach
                </div>
                <div class="col-lg-4 section-divided__aside">
                    <!--Categories-->
{{--                    <section class="section-md">--}}
{{--                        <h5>Categories</h5>--}}
{{--                        <ul class="list-linked">--}}
{{--                            <li><a href="#">Retina Homepage</a></li>--}}
{{--                            <li><a href="#">New Page Examples</a></li>--}}
{{--                            <li><a href="#">Parallax Sections</a></li>--}}
{{--                            <li><a href="#">Shortcode Central</a></li>--}}
{{--                            <li><a href="#">Ultimate Font Collection</a></li>--}}
{{--                        </ul>--}}
{{--                    </section>--}}
                    <!--Posts-->
                    <section class="section-md">
                        <h5>Latest Blogs</h5>
                        <ul class="list-sm">
                            @foreach($commonBlogs as $blog)
                                <li>
                                    <!--Post inline-->
                                    <article class="post-inline">
                                        <div class="post-inline__header"><span class="post-inline__time">{{ $blog->created_at->diffForHumans() }}</span>&nbsp;&nbsp;&nbsp;<span class="comment-minimal__author">by {{ $blog->creator->name }}</span></div>
                                        <p class="post-inline__link"><a href="{{ route('blog.details', $blog->slug) }}">{{ $blog->title }}</a></p>
                                    </article>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                    <section class="section-md">
                        <h5>Latest News</h5>
                        <ul class="list-sm">
                            @foreach($commonNews as $news)
                                <li>
                                    <!--Post inline-->
                                    <article class="post-inline">
                                        <div class="post-inline__header"><span
                                                    class="post-inline__time">{{ $news->created_at->diffForHumans() }}</span>&nbsp;&nbsp;&nbsp;<span
                                                    class="comment-minimal__author">by {{ $news->creator->name }}</span>
                                        </div>
                                        <p class="post-inline__link"><a
                                                    href="{{ route('news.details', $news->slug) }}">{{ $news->title }}</a>
                                        </p>
                                    </article>
                                </li>
                            @endforeach
                        </ul>
                    </section>
{{--                    <!--Tags-->--}}
{{--                    <section class="section-md">--}}
{{--                        <h5>Tags</h5>--}}
{{--                        <ul class="list-tags">--}}
{{--                            <li><a href="#">Retina Homepage</a></li>--}}
{{--                            <li><a href="#">New Page Examples</a></li>--}}
{{--                            <li><a href="#">Ultimate Font Collection</a></li>--}}
{{--                            <li><a href="#">Parallax Sections</a></li>--}}
{{--                            <li><a href="#">Shortcode Central</a></li>--}}
{{--                        </ul>--}}
{{--                    </section>--}}
                </div>
            </div>
        </div>
    </div>
@endsection