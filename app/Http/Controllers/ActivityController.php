<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public string $v_path = "pages.activity.";

    public function __construct()
    {
        // set permission
        $this->middleware('permission:miscellaneous-activity_log', ['only' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            return $this->datatable();
        }
        return view($this->v_path . "index");
    }

    /**
     * datatables
     * @return \Illuminate\Http\Resources\Json
     */
    public function datatable()
    {
        $activity = Activity::with(['causer'])->orderBy('id', 'desc');
        return DataTables()->eloquent($activity)
        ->addIndexColumn()
        ->editColumn('created_at', function(Activity $activity) {
            $carbon = new Carbon($activity->created_at);
            return $carbon->diffForHumans();
        })
        ->editColumn('subject_type', function(Activity $activity) {
            return modelAlais($activity->subject_type) . ' (' . $activity->subject_id . ')';
        })
        ->addColumn('changes', function(Activity $activity) {
            return view('datatables.activity', compact('activity'));
        })
        ->addColumn('action', function(Activity $activity) {
            return '<button type="button" class="btn btn-xs btn-success detail_btn"><i class="fa fa-eye"></i></button>';
        })
        ->rawColumns(['action', 'changes'])
        ->toJson();
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
        //
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
        //
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
