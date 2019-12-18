<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Models\PlanFeature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class PlanController extends Controller
{

    /**
     * @return mixed
     * @throws \Exception
     * Fetch all admin users for datatable
     */
    public function getPlans()
    {
        $plans = Plan::all();

        return DataTables::of($plans)
            ->addColumn('action', function ($plan) {
                $html = "";

                if (Auth::guard('admin')->user()->hasAnyPermission(['plan-edit'])) {
                    $html .= '<form id="form' . $plan->id . '" action="' . route('admin.plans.destroy', $this->encrypt($plan->id)) . '"  method="post" >
                        <a href="' . route('admin.plans.edit', $this->encrypt($plan->id)) . '" class = "btn btn-primary" ><i class="fa fa-edit"></i></a>';
                } else {
                    $html .= '<form id="form' . $plan->id . '" action="' . route('admin.plans.destroy', $this->encrypt($plan->id)) . '"  method="post" >';
                }

                if (Auth::guard('admin')->user()->hasAnyPermission(['plan-delete'])) {
                    $html .= '' . method_field("delete") . csrf_field() . '<button class="btn btn-danger" onclick="confirmDelete(' . $plan->id . ')"  type="button"><i class="fa fa-trash"></i></button>
                    </form> 
                    <script> </script>';
                } else {
                    $html .= '</form>';
                }

                return $html;
            })->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.plans.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $plan = Plan::find($id);
        $features = PlanFeature::where('for', 2)->get();
        $defaultFeatures = PlanFeature::where('for', $plan->type)->get();
        if ($plan) {
            return view('admin.plans.edit',compact('plan','features', 'defaultFeatures'));
        } else {
            return abort(404);
        }
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
            'name' => [
                'required', Rule::unique('plans')->ignore($id)],
//            'features' => 'present|array'
        ]);

        $plan = Plan::find($id);
        $plan->name = $request->name;
        $plan->price = $request->price;
        if (!empty($request->features)) {
            $plan->features = implode(',', $request->features);
        } else {
            $plan->features = '';
        }

        if ($plan->save()) {
            return redirect('admin/plans')->with('success', 'Plan Updated successfully !');
        } else {
            return redirect()->back()->with('error', 'Unable to update plan !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
