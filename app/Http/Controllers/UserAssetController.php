<?php

namespace App\Http\Controllers;

use App\Models\UserAsset;
use App\Http\Requests\StoreUserAssetRequest;
use App\Http\Requests\UpdateUserAssetRequest;
use App\Models\Asset;
use App\Models\Employee;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Facades\DataTables;

class UserAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(HttpRequest $request)
    {
        
        if ($request->ajax()) {
            $data = UserAsset::where('status', true)->select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        $currentPageHeading = 'User-Asset';
        return view('userAsset/userAsset', compact('currentPageHeading'));
    }

    /**
     * Show the form for creating a new resource.
     */
   
     public function create($idAsset = null)
{
    $currentPageHeading = 'Add New User-Asset';
    $userAsset = $idAsset ? UserAsset::find($idAsset) : null;

    // Fetch only assets with status not true in both Asset and UserAsset tables
    $assets = Asset::where('status', true)
    ->whereDoesntHave('userAsset', function ($query) {
        $query->where('status', true);
    })->get();

    // Fetch only employees with status not true in both Employee and UserAsset tables
    $employees = Employee::where('status', true)
        ->whereDoesntHave('userAsset', function ($query) {
            $query->where('status', true);
        })->get();

    $selectedAssetIds = UserAsset::pluck('idAsset')->toArray();
    $selectedEmployeeNiks = UserAsset::pluck('nik')->toArray();

    return view('userAsset.addUserAsset', compact('currentPageHeading', 'assets', 'employees', 'userAsset', 'selectedAssetIds', 'selectedEmployeeNiks'));
}

     
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserAssetRequest $request)
{
    // $validatedData = $request->validated();

    $asset = Asset::find($request->txtidAsset);
    $employee = Employee::where('nik', $request->txtnik)->first();

    $userAsset = new UserAsset();

    $userAsset->idAsset = $asset->idAsset;
    $userAsset->name = $asset->name;
    $userAsset->brand = $asset->brand;
    $userAsset->type = $asset->type;
    $userAsset->nik = $employee->nik;
    $userAsset->username = $employee->username;
    $userAsset->startdate = $request->txtstartDate;
    // $userAsset->enddate = $request->txtendDate;

    $userAsset->save();

    
    return redirect('userAssets')->with('msg', 'Data employee berhasil ditambahkan');
}

    /**
     * Display the specified resource.
     */
    public function show(UserAsset $userAsset)
    {
        return view('userAssets', compact('userAsset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
   
     public function userAssetHistory()
    {
        $assets = UserAsset::orderBy('idAsset')->orderByDesc('startDate')->get();

        $assetHistory = [];
        foreach ($assets as $asset) {
            if (!isset($assetHistory[$asset->idAsset])) {
                $assetHistory[$asset->idAsset] = [
                    'id' => $asset->idAsset,
                    'type' => $asset->type,
                    'name' => $asset->name,
                    'users' => [], 
                    'user_start_dates' => [], 
                    'user_end_dates' => []
                ];
            }
        
            $assetHistory[$asset->idAsset]['users'][] = $asset->username;
            $assetHistory[$asset->idAsset]['user_start_dates'][] = $asset->startDate;
            $assetHistory[$asset->idAsset]['user_end_dates'][] = $asset->endDate;
        }

        return view('userAsset.userAssetHistory', compact('assetHistory'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserAssetRequest $request, UserAsset $userAsset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idAsset)
{
    try {
        $userAsset = UserAsset::where('idAsset', $idAsset);

        if ($userAsset) {
            $userAsset->update(['status' => false]);

            return response()->json(['message' => 'Data berhasil diubah']);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    } catch (\Exception $e) {
        return response()->json(['message' => 'Gagal mengubah data: ' . $e->getMessage()], 500);
    }
}



}
