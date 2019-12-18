<?php

namespace App\Http\Controllers\Frontend;

use App\Models\AdminUser;
use App\Models\Blog;
use App\Models\Cms;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Support as SupportMail;

class GeneralController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $ccode = $this->getCurrentCountryCode();
        return view('frontend.index', compact('ccode'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function download()
    {
        return view('frontend.download');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function support()
    {
        return view('frontend.support');
    }

    /**
     * @param Request $request
     */
    public function supportStore(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $support = new Support();
        $support->email = $request->email;
        $support->subject = $request->subject;
        $support->message = $request->message;
        $support->phone = $request->phone ?? null;
        if ($support->save()) {
            if ($request->hasFile('attachment')) {
                $support->addMediaFromRequest('attachment')->toMediaCollection('support');
            }
            $data = [
                'subject' => $support->subject,
                'message' => $support->message,
                'from' => $support->email,
                'attach' => base_path().$support->getFirstMediaUrl('support') ?? ''
            ];
            try {
                $admins = AdminUser::select('email')->get();
                foreach ($admins as $admin) {
                    Mail::to($admin->email)->send(new SupportMail($data));
                }
                die('MF000');
            } catch (\Exception $e) {
                echo $e->getMessage();
                die('MF255');
            }
        } else {
            die('MF255');
        }
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cms($slug)
    {
        $page = Cms::where('slug', $slug)->where('status', 1)->first();
        if ($page) {
            return view('frontend.cms', compact('page'));
        } else {
            abort(404);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function blog()
    {
        $blogs = Blog::with('creator')->where('status', 1)->get();
        return view('frontend.blog', compact('blogs'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function blogDetails($slug)
    {
        $blog = Blog::where('slug', $slug)->where('status', 1)->first();
        if ($blog) {
            return view('frontend.blog-details', compact('blog'));
        } else {
            abort(404);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function news()
    {
        $news = News::with('creator')->where('status', 1)->get();
        return view('frontend.news', compact('news'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newsDetails($slug)
    {
        $news = News::where('slug', $slug)->where('status', 1)->first();
        if ($news) {
            return view('frontend.news-details', compact('news'));
        } else {
            abort(404);
        }
    }
}
