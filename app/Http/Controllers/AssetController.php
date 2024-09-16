<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Facades\DataTables;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(HttpRequest $request)
    {
        if ($request->ajax()) {
            $data = Asset::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)"  class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $currentPageHeading = 'Asset List';
        return view('master/asset', compact('currentPageHeading'));
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
    public function store(StoreAssetRequest $request)
    {
        $validate = $request->validated();

        $data = new asset();
        $data->idAsset = $request->txtidAsset;
        $data->name = $request->txtname;
        $data->brand = $request->txtbrand;
        $data->type = $request->txttype;
        $data->processor = $request->txtprocessor;
        $data->ramCapacity = $request->txtramCapacity;
        $data->storage = $request->txtstorage;
        $data->operatingSystem = $request->txtoperatingSystem;
        $data->supplier = $request->txtsupplier;
        $data->ipAddress1 = $request->txtipAddress1;
        $data->ipAddress2 = $request->txtipAddress2;
        $data->macAddress = $request->txtmacAddress;
        $data->antivirus = $request->txtantivirus;
        $data->batteryHealth = $request->txtbatteryHealth;
        $data->serialNumber = $request->txtserialNumber;
        $data->purchase = $request->txtpurchase;
        $data->status = $request->txtstatus;
        $data->notes = $request->txtnotes;
        $data->image_path = $request->txtimage_path;
        $data->save();

        return redirect('assets')->with('msg', 'Tambah data asset');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $assets, $idAsset)
    {
        $asset = Asset::where('idAsset', $idAsset)->first();

        return view('master.editasset', compact('asset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssetRequest $request, Asset $assets, $idAsset)
    {
        $data = $assets->find($idAsset);

        $data->name = $request->txtname;
        $data->brand = $request->txtbrand;
        $data->type = $request->txttype;
        $data->processor = $request->txtprocessor;
        $data->ramCapacity = $request->txtramCapacity;
        $data->storage = $request->txtstorage;
        $data->operatingSystem = $request->txtoperatingSystem;
        $data->supplier = $request->txtsupplier;
        $data->ipAddress1 = $request->txtipAddress1;
        $data->ipAddress2 = $request->txtipAddress2;
        $data->macAddress = $request->txtmacAddress;
        $data->antivirus = $request->txtantivirus;
        $data->batteryHealth = $request->txtbatteryHealth;
        $data->serialNumber = $request->txtserialNumber;
        $data->purchase = $request->txtpurchase;
        $data->status = $request->txtstatus;
        $data->notes = $request->txtnotes;
        $data->image_path = $request->txtimage_path;
        $data->save();

        return redirect('assets')->with('msg', 'Edit data asset');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idAsset)
    {
        try {
            $asset = Asset::find($idAsset);
            if ($asset) {
                $asset->delete();
                //$user_asset->update(['status' => false]);

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
        $assets = Asset::all();

        $countByBrand = [];

        foreach ($assets as $asset) {
            $brand = $asset->brand;

            if (isset($countByBrand[$brand])) {
                $countByBrand[$brand]++;
            } else {
                $countByBrand[$brand] = 1;
            }
        }

        $data = [
            'labels' => array_keys($countByBrand),
            'data' => array_values($countByBrand),
        ];

        $currentPageHeading = 'Diagram Asset';
        return view('diagram/diagramAccessory', compact('data', 'currentPageHeading'));
    }
}
