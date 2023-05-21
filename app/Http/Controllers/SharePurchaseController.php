<?php

namespace App\Http\Controllers;

use App\Models\SharePurchase;
use App\Http\Controllers\Controller;
use App\Http\Requests\SharePurchaseRequest;
use App\Models\Member;
use Illuminate\Http\Request;
use DataTables;
use DB;

class SharePurchaseController extends Controller
{

    protected $v_path = "pages.sharepurchase.";

    public function __construct()
    {
        // set permission
        $this->middleware('permission:sharePurchase-index', ['only' => ['index','show']]);
        $this->middleware('permission:sharePurchase-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:sharePurchase-update', ['only' => ['edit','update']]);
        $this->middleware('permission:sharePurchase-destroy', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return $this->datatables();
        }
        $members = Member::select('id', 'name')->whereIsActive(true)->get();
        return view($this->v_path . "index", compact('members'));
    }

    public function datatables()
    {
        $share_purchase = SharePurchase::with(['member'])->orderBy('id', 'desc');
        return DataTables()->eloquent($share_purchase)
        ->editColumn('date', function (SharePurchase $share) {
            return printDateFormat($share->date);
        })
        ->addColumn('action', function (SharePurchase $share) {
            return view('action.share-purchase', compact('share'));
        })
        ->rawColumns(['action'])
        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->v_path . "create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\SharePurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SharePurchaseRequest $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            $data['date'] = saveDateFormat($data['date']);
            $data['vouchar_no'] = $request->vouchar_no ?? generateSharePurchaseVoucharNo();
            SharePurchase::create($data);
            DB::commit();
        }catch(\Exception $e) {
            DB::rollback();
            abort(505, $e->getMessage());
        }        
        return response()->json([
            'success' => true,
            'message' => 'Share Purchase created successfull!',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SharePurchase  $sharePurchase
     * @return \Illuminate\Http\Response
     */
    public function show(SharePurchase $sharePurchase)
    {
        return view($this->v_path . "view", compact('sharePurchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SharePurchase  $sharePurchase
     * @return \Illuminate\Http\Response
     */
    public function edit(SharePurchase $sharePurchase)
    {
        $members = Member::select('id', 'name')->whereIsActive(true)->get();
        return view($this->v_path . "edit", compact('sharePurchase', 'members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\SharePurchaseRequest  $request
     * @param  \App\Models\SharePurchase  $sharePurchase
     * @return \Illuminate\Http\Response
     */
    public function update(SharePurchaseRequest $request, SharePurchase $sharePurchase)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            $data['date'] = saveDateFormat($data['date']);
            $sharePurchase->update($data);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Share Purchase updated successfull!',
            ]);
        }catch(\Exception $e) {
            DB::rollback();
            abort(505, $e->getMessage());
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SharePurchase  $sharePurchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(SharePurchase $sharePurchase)
    {
        $sharePurchase->delete();      
        return response()->json([
            'success' => true,
            'text' => 'Share Purchase deleted succesfull!',
        ]);
    }
}
