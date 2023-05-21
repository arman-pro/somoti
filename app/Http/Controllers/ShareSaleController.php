<?php

namespace App\Http\Controllers;

use App\Models\ShareSale;
use App\Http\Controllers\Controller;
use App\Http\Requests\SharePurchaseRequest;
use App\Models\Member;
use Illuminate\Http\Request;
use DB;

class ShareSaleController extends Controller
{

    protected $v_path = "pages.sharesale.";

    public function __construct()
    {
        // set permission
        $this->middleware('permission:shareSale-index', ['only' => ['index','show']]);
        $this->middleware('permission:shareSale-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:shareSale-update', ['only' => ['edit','update']]);
        $this->middleware('permission:shareSale-destroy', ['only' => ['destroy']]);
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
        $share_sale = ShareSale::with(['member'])->where('share_type', 'sale')->orderBy('id', 'desc');
        return DataTables()->eloquent($share_sale)
        ->editColumn('date', function (ShareSale $share) {
            return printDateFormat($share->date);
        })
        ->editColumn('share_type', '{{ucfirst($share_type)}}')
        ->addColumn('action', function (ShareSale $share) {
            return view('action.sale-share', compact('share'));
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
            $data['share_type'] = 'sale';
            $data['vouchar_no'] = $request->vouchar_no ?? generateSharePurchaseVoucharNo('SL');
            ShareSale::create($data);
            DB::commit();
        }catch(\Exception $e) {
            DB::rollback();
            abort(505, $e->getMessage());
        }        
        return response()->json([
            'success' => true,
            'message' => 'Share Sale created successfull!',
        ]);   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShareSale  $shareSale
     * @return \Illuminate\Http\Response
     */
    public function show(ShareSale $shareSale)
    {
        return view($this->v_path . "view", compact('shareSale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShareSale  $shareSale
     * @return \Illuminate\Http\Response
     */
    public function edit(ShareSale $shareSale)
    {
        $members = Member::select('id', 'name')->whereIsActive(true)->get();
        return view($this->v_path . "edit", compact('shareSale', 'members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShareSale  $shareSale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShareSale $shareSale)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            $data['date'] = saveDateFormat($data['date']);
            $shareSale->update($data);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Share Sale updated successfull!',
            ]);
        }catch(\Exception $e) {
            DB::rollback();
            abort(505, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShareSale  $shareSale
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShareSale $shareSale)
    {
        $shareSale->delete();      
        return response()->json([
            'success' => true,
            'text' => 'Share Sale deleted succesfull!',
        ]);
    }
}
