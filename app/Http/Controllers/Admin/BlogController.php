<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blogs.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     * Fetch all admin users for datatable
     */
    public function getBlogs()
    {
        $blogs = Blog::all();

        return DataTables::of($blogs)
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
            ->addColumn('action', function ($blog) {
                $html = '<form class="form-inline" id="form'.$blog->id.'" action="'.route('admin.blogs.destroy', $blog->id).'"  method="post">';

//                if (Auth::guard('admin')->user()->hasAnyPermission(['blog-show'])) {
//                    $html .= '<form class="form-inline" id="form'.$blog->id.'" action="'.route('admin.blogs.destroy', $blog->id).'"  method="post"><a href="'.route('admin.blogs.show',$this->encrypt($blog->id)).'" class = "btn btn-info" ><i class="fa fa-eye"></i></a>';
//                } else {
//                    $html .= '<form class="form-inline" id="form'.$blog->id.'" action="'.route('admin.blogs.destroy', $blog->id).'"  method="post">';
//                }

                if (Auth::guard('admin')->user()->hasAnyPermission(['blog-edit'])) {
                    $html .= '<a href="'.route('admin.blogs.edit',$this->encrypt($blog->id)).'" class = "btn btn-primary" ><i class="fa fa-edit"></i></a>';
                } else {
                    $html .= '';
                }

                if (Auth::guard('admin')->user()->hasAnyPermission(['blog-delete'])) {
                    $html .= ''.method_field("delete").csrf_field().'<button class="btn btn-danger" onclick="confirmDelete('.$blog->id.')" type="button"><i class = "fa fa-trash "></i></button></form><script></script>';
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
        return view('admin.blogs.create');
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
            'title' => 'required',
            'content' => 'required'
        ]);
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->created_by = Auth::id();
        $blog->status = $request->status ?? 0;
        if ($blog->save()) {
            if ($request->hasFile('image')) {
                $blog->addMediaFromRequest('image')->toMediaCollection('blog');
            }
            Session::put('success', 'Blog created successfully !');
        } else {
            Session::put('error', 'Unable to create blog !');
        }
        return redirect('admin/blogs');
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
        $blog = Blog::find($id);
        return view('admin.blogs.show', compact('blog'));
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
        $blog = Blog::find($id);
        $media = $blog->getMedia('blog')->first();
        if ($media) {
            $blog->image = $media->getFullUrl();
        } else {
            $blog->image = '';
        }
        return view('admin.blogs.edit', compact('blog'));
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
            'title' => 'required',
            'content' => 'required'
        ]);
        $blog = Blog::find($id);
        $blog->content = $request->content;
        $blog->status = $request->status ?? 0;
        if ($blog->save()) {
            $blog->slug = null;
            $blog->update(['title' => $request->title]);
            if ($request->hasFile('image')) {
                $blog->clearMediaCollection('blog');
                $blog->addMediaFromRequest('image')->toMediaCollection('blog');
            }
            Session::put('success', 'Blog updated successfully !');
        } else {
            Session::put('error', 'Unable to update blog !');
        }
        return redirect('admin/blogs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            Session::put('success', 'Blog deleted successfully !');
            return redirect('admin/blogs');
        }
        if ($blog->delete()) {
            Session::put('success', 'Blog deleted successfully !');
        } else {
            Session::put('error', 'Unable to delete blog !');
        }
        return redirect('admin/blogs');
    }
}
