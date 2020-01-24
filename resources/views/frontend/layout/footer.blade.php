<!--Page Footer-->
{{--<section class="pre-footer-corporate">--}}
{{--    <div class="container">--}}
{{--        <div class="row justify-content-sm-center justify-content-lg-start row-30 row-md-60">--}}
{{--            <div class="col-sm-10 col-md-6 col-lg-3 col-xl-3">--}}
{{--                <h6>Quick Links</h6>--}}
{{--                <ul class="list-xxs">--}}
{{--                    @foreach($commonPages as $page)--}}
{{--                        <li><a href="{{ url('/'.$page->slug) }}">{{ $page->title }}</a></li>--}}
{{--                    @endforeach--}}
{{--                    <li><a href="{{ route('support') }}">Support</a></li>--}}
{{--                    <li><a href="{{ route('blog') }}">Blog</a></li>--}}
{{--                    <li><a href="{{ route('news') }}">News</a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <div class="col-sm-10 col-md-6 col-lg-5 col-xl-3">--}}
{{--                <h6>Recent News</h6>--}}
{{--                <ul class="list-xs">--}}
{{--                    @foreach($commonNews as $new)--}}
{{--                        <li>--}}
{{--                            <article class="comment-minimal">--}}
{{--                                <p><span class="post-inline__time">{{ $new->created_at->diffForHumans() }}</span>&nbsp;&nbsp;&nbsp;<span class="comment-minimal__author">by {{ $new->creator->name }}</span></p>--}}
{{--                                <p class="comment-minimal__link"><a href="{{ route('news.details', $new->slug) }}">{{ $new->title }}</a></p>--}}
{{--                            </article>--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <div class="col-sm-10 col-md-6 col-lg-10 col-xl-3">--}}
{{--                <h6>Recent Blog</h6>--}}
{{--                <ul class="list-xs">--}}
{{--                    @foreach($commonBlogs as $blog)--}}
{{--                        <li>--}}
{{--                            <article class="comment-minimal">--}}
{{--                                <p><span class="post-inline__time">{{ $blog->created_at->diffForHumans() }}</span>&nbsp;&nbsp;&nbsp;<span class="comment-minimal__author">by {{ $blog->creator->name }}</span></p>--}}
{{--                                <p class="comment-minimal__link"><a href="{{ route('blog.details', $blog->slug) }}">{{ $blog->title }}</a></p>--}}
{{--                            </article>--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <div class="col-sm-10 col-md-6 col-lg-4 col-xl-3">--}}
{{--                <h6>Contacts</h6>--}}
{{--                <ul class="list-xs">--}}
{{--                    <li>--}}
{{--                        <dl class="list-terms-minimal">--}}
{{--                            <dt>Address</dt>--}}
{{--                            <dd>4578 Marmora Road, Glasgow, D04 89GR</dd>--}}
{{--                        </dl>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <dl class="list-terms-minimal">--}}
{{--                            <dt>Phones</dt>--}}
{{--                            <dd>--}}
{{--                                <ul class="list-semicolon">--}}
{{--                                    <li><a href="tel:#">(800) 123-0045</a></li>--}}
{{--                                    <li><a href="tel:#">(800) 123-0045</a></li>--}}
{{--                                </ul>--}}
{{--                            </dd>--}}
{{--                        </dl>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <dl class="list-terms-minimal">--}}
{{--                            <dt>E-mail</dt>--}}
{{--                            <dd><a href="mailto:info@oozee.com">info@oozee.com</a></dd>--}}
{{--                        </dl>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <dl class="list-terms-minimal">--}}
{{--                            <dt>We are open</dt>--}}
{{--                            <dd>Mn-Fr: 10 am-8 pm</dd>--}}
{{--                        </dl>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
<footer class="footer-corporate">
    <div class="container">
        <div class="footer-corporate__inner">
            <p class="rights"><span class="copyright-year"></span>&nbsp;&copy; oozee-All Rights Reserved to Silicon Enterprise
            </p>
{{--            <ul class="list-inline-xxs">--}}
{{--                <li><a class="icon icon-xxs icon-primary fa fa-facebook" href="#"></a></li>--}}
{{--                <li><a class="icon icon-xxs icon-primary fa fa-twitter" href="#"></a></li>--}}
{{--                <li><a class="icon icon-xxs icon-primary fa fa-google-plus" href="#"></a></li>--}}
{{--                <li><a class="icon icon-xxs icon-primary fa fa-vimeo" href="#"></a></li>--}}
{{--                <li><a class="icon icon-xxs icon-primary fa fa-youtube" href="#"></a></li>--}}
{{--                <li><a class="icon icon-xxs icon-primary fa fa-pinterest" href="#"></a></li>--}}
{{--            </ul>--}}
        </div>
    </div>
</footer>