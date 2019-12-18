@extends('frontend.layout.app')
@section('content')
    <section class="breadcrumbs-custom">
        <div class="container">
            <div class="breadcrumbs-custom__inner">
                <p class="breadcrumbs-custom__title">{{ $news->title }}</p>
                <ul class="breadcrumbs-custom__path">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/news') }}">News</a></li>
                    <li class="active">{{ $news->title }}</li>
                </ul>
            </div>
        </div>
    </section>
    <div class="section-md section-divided">
        <div class="container">
            <div class="row row-50 row-md-75">
                <div class="col-lg-8 section-divided__main">
                    <section class="section-md">
                        <h5>{{ $news->title }}</h5>
                        <figure class="figure"><img
                                    src="{{ $news->getFirstMediaUrl('news') ? asset($news->getFirstMediaUrl('news')) : 'public/frontend/images/typography-2-418x315.jpg' }}"
                                    alt="" width="886" height="668"/>
                        </figure>
                        <div>{!! $news->content !!}</div>
                        <p><span class="post-inline__time">{{ $news->created_at->diffForHumans() }}</span>&nbsp;&nbsp;&nbsp;<span
                                    class="comment-minimal__author">by {{ $news->creator->name }}</span></p>
                    </section>
                </div>
                <div class="col-lg-4 section-divided__aside">
                    <section class="section-md">
                        <h5>Latest Blogs</h5>
                        <ul class="list-sm">
                            @foreach($commonBlogs as $blog)
                                <li>
                                    <!--Post inline-->
                                    <article class="post-inline">
                                        <div class="post-inline__header"><span
                                                    class="post-inline__time">{{ $blog->created_at->diffForHumans() }}</span>&nbsp;&nbsp;&nbsp;<span
                                                    class="comment-minimal__author">by {{ $blog->creator->name }}</span>
                                        </div>
                                        <p class="post-inline__link"><a
                                                    href="{{ route('blog.details', $blog->slug) }}">{{ $blog->title }}</a>
                                        </p>
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
                </div>
            </div>
        </div>
    </div>
@endsection