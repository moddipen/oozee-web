<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.news.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     * Fetch all admin users for datatable
     */
    public function getNews()
    {
        $news = News::with('creator')->get();

        return DataTables::of($news)
            ->editColumn('status', function ($blog) {
                $html = '';
                if ($blog->status) {
                    $html .= '<span class="badge badge-success">Enabled</span>';
                } else {
                    $html .=  '<span class="badge badge-danger">Disabled</span>';
                }
                return $html;
            })
            ->addColumn('creator', function ($blog) {
                return $blog->creator->name;
            })
            ->addColumn('action', function ($new) {
                $html = '<form class="form-inline" id="form'.$new->id.'" action="'.route('admin.news.destroy', $new->id).'"  method="post">';

//                if (Auth::guard('admin')->user()->hasAnyPermission(['news-show'])) {
//                    $html .= '<form class="form-inline" id="form'.$new->id.'" action="'.route('admin.news.destroy', $new->id).'"  method="post"><a href="'.route('admin.news.show',$this->encrypt($new->id)).'" class = "btn btn-info" ><i class="fa fa-eye"></i></a>';
//                } else {
//                    $html .= '<form class="form-inline" id="form'.$new->id.'" action="'.route('admin.news.destroy', $new->id).'"  method="post">';
//                }

                if (Auth::guard('admin')->user()->hasAnyPermission(['news-edit'])) {
                    $html .= '<a href="'.route('admin.news.edit',$this->encrypt($new->id)).'" class = "btn btn-primary" ><i class="fa fa-edit"></i></a>';
                } else {
                    $html .= '';
                }

                if (Auth::guard('admin')->user()->hasAnyPermission(['news-delete'])) {
                    $html .= ''.method_field("delete").csrf_field().'<button class="btn btn-danger" onclick="confirmDelete('.$new->id.')" type="button"><i class = "fa fa-trash "></i></button></form><script></script>';
                } else {
                    $html .= '</form>';
                }

                return $html;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:news',
            'content' => 'required'
        ]);

        $news = new News();
        $news->title = $request->title;
        $news->content = $request->content;
        $news->created_by = Auth::id();
        $news->status = $request->status ?? 0;
        if ($news->save()) {
            if ($request->hasFile('image')) {
                $news->addMediaFromRequest('image')->toMediaCollection('news');
            }
            Session::put('success', 'News created successfully !');
        } else {
            Session::put('error', 'Unable to create news !');
        }
        return redirect('admin/news');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = $this->decrypt($id);
        $news = News::find($id);
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = $this->decrypt($id);
        $news = News::find($id);
        $media = $news->getMedia('news')->first();
        if ($media) {
            $news->image = $media->getFullUrl();
        } else {
            $news->image = '';
        }
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => [
                'required', Rule::unique('news')->ignore($id),],
            'content' => 'required'
        ]);
        $news = News::find($id);
        $news->content = $request->content;
        $news->status = $request->status ?? 0;
        if ($news->save()) {
            $news->slug = null;
            $news->update(['title' => $request->title]);
            if ($request->hasFile('image')) {
                $news->clearMediaCollection('news');
                $news->addMediaFromRequest('image')->toMediaCollection('news');
            }
            Session::put('success', 'News updated successfully !');
        } else {
            Session::put('error', 'Unable to update News !');
        }
        return redirect('admin/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = News::find($id);
        if (!$blog) {
            Session::put('success', 'News deleted successfully !');
            return redirect('admin/news');
        }
        if ($blog->delete()) {
            Session::put('success', 'News deleted successfully !');
        } else {
            Session::put('error', 'Unable to delete News !');
        }
        return redirect('admin/news');
    }
}
