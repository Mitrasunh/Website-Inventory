<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Http\Requests\StoreAccessoryRequest;
use App\Http\Requests\UpdateAccessoryRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AccessoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Accessory::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)"  class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        $accessories = Accessory::all();
    
        $countByCategory = [];
        foreach ($accessories as $accessory) {
            $category = $accessory->category;
            $qty = $accessory->qty;
    
            if (!isset($countByCategory[$category])) {
                $countByCategory[$category] = 0;
            }
    
            $countByCategory[$category] += $qty;
        }
    
        $currentPageHeading = 'Accessory List';
    
        return view('master/accessory', compact('currentPageHeading', 'countByCategory'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccessoryRequest $request)
    {
        $validate = $request->validated();

        $accessory = new Accessory();
        $accessory->modelNumber = $request->txtmodelNumber;
        $accessory->category = $request->txtcategory;
        $accessory->supplier = $request->txtsupplier;
        $accessory->purchase = $request->txtpurchase;
        $accessory->qty = $request->txtqty;
        $accessory->notes = $request->txtnotes;
        $accessory->image = $request->txtimage;
        $accessory->save();

        return redirect('accessories')->with('msg', 'Tambah data accessory ');
    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Accessory $accessories, $modelNumber)
    {
        $accessory = Accessory::where('modelNumber', $modelNumber)->first();

        return view('master.editaccessory', compact('accessory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccessoryRequest $request, Accessory $accessories, $modelNumber)
    {
        $data = $accessories->find($modelNumber);
        $data->category = $request->txtcategory;        
        $data->supplier = $request->txtsupplier;
        $data->purchase = $request->txtpurchase;
        $data->qty = $request->txtqty;
        $data->notes = $request->txtnotes;
        $data->image = $request->txtimage;

        $data->save();

        return redirect('accessories')->with('msg', 'Edit data accessory');
    }

    /**
     * Remove the specified resource from storage.
     */
        public function destroy($modelNumber)
    {
        try {
            $accessory = Accessory::destroy($modelNumber);

            if ($accessory) {
                return response()->json(['message' => 'Data berhasil dihapus']);
            } else {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data: ' . $e->getMessage()], 500);
        }
    }

    public function barChart()
    {
        $accessories = Accessory::all();

        $countByCategory = [];
    
        foreach ($accessories as $accessory) {
            $category = $accessory->category;
            $qty = $accessory->qty;
    
            if (!isset($countByCategory[$category])) {
                $countByCategory[$category] = 0;
            }
    
            $countByCategory[$category] += $qty;
            
        }
    
        $data = [
            'labels' => array_keys($countByCategory),
            'data' => array_values($countByCategory),
        ];

        $currentPageHeading = 'Diagram Accessory';
        return view('diagram.diagramAccessory', compact('data', 'currentPageHeading'));
    }
}
