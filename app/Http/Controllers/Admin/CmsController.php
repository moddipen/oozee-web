<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cms.index');
    }

    /**
     * @return mixed
     * @throws \Exception
     * Fetch all admin users for datatable
     */
    public function getCms()
    {
        $cms = Cms::all();

        return DataTables::of($cms)
            ->editColumn('status', function ($cms) {
                $html = '';
                if ($cms->status) {
                    $html .= '<span class="badge badge-success">Enabled</span>';
                } else {
                    $html .=  '<span class="badge badge-danger">Disabled</span>';
                }
                return $html;
            })
            ->addColumn('creator', function ($cm) {
                return $cm->creator->name;
            })
            ->addColumn('action', function ($cm) {
                $html = '<form class="form-inline" id="form'.$cm->id.'" action="'.route('admin.cms.destroy', $cm->id).'"  method="post">';

//                if (Auth::guard('admin')->user()->hasAnyPermission(['cms-show'])) {
//                    $html .= '<form class="form-inline" id="form'.$cm->id.'" action="'.route('admin.cms.destroy', $cm->id).'"  method="post"><a href="'.route('admin.cms.show',$this->encrypt($cm->id)).'" class = "btn btn-info" ><i class="fa fa-eye"></i></a>';
//                } else {
//                    $html .= '<form class="form-inline" id="form'.$cm->id.'" action="'.route('admin.cms.destroy', $cm->id).'"  method="post">';
//                }

                if (Auth::guard('admin')->user()->hasAnyPermission(['cms-edit'])) {
                    $html .= '<a href="'.route('admin.cms.edit',$this->encrypt($cm->id)).'" class = "btn btn-primary" ><i class="fa fa-edit"></i></a>';
                } else {
                    $html .= '';
                }

                if (Auth::guard('admin')->user()->hasAnyPermission(['cms-delete'])) {
                    $html .= ''.method_field("delete").csrf_field().'<button class="btn btn-danger" onclick="confirmDelete('.$cm->id.')" type="button"><i class = "fa fa-trash "></i></button></form><script></script>';
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
        return view('admin.cms.create');
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
            'title' => 'required|unique:cms',
            'content' => 'required'
        ]);
        $blog = new Cms();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->created_by = Auth::id();
        $blog->status = $request->status ?? 0;
        if ($blog->save()) {
            Session::put('success', 'Cms created successfully !');
        } else {
            Session::put('error', 'Unable to create Cms !');
        }
        return redirect('admin/cms');
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
        $cms = Cms::find($id);
        return view('admin.cms.show', compact('cms'));
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
        $cms = Cms::find($id);
        return view('admin.cms.edit', compact('cms'));
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
                'required', Rule::unique('cms')->ignore($id),],
            'content' => 'required'
        ]);
        $blog = Cms::find($id);
        $blog->content = $request->content;
        $blog->status = $request->status ?? 0;
        if ($blog->save()) {
            $blog->slug = null;
            $blog->update(['title' => $request->title]);
            Session::put('success', 'Cms updated successfully !');
        } else {
            Session::put('error', 'Unable to update cms !');
        }
        return redirect('admin/cms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Cms::find($id);
        if (!$blog) {
            Session::put('success', 'Cms deleted successfully !');
            return redirect('admin/cms');
        }
        if ($blog->delete()) {
            Session::put('success', 'Cms deleted successfully !');
        } else {
            Session::put('error', 'Unable to delete cms !');
        }
        return redirect('admin/cms');
    }
}
