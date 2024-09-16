<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserAccessoryRequest;
use App\Models\Accessory;
use App\Models\Employee;
use App\Models\UserAccessory;
use App\Models\UserAsset;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserAccessoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = UserAccessory::where('status', true);
            return DataTables::of($data)
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        $currentPageHeading = 'User-Accessory';
        return view('userAccessory/userAccessory', compact('currentPageHeading'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create($nik = null)
    {
        $employees = UserAsset::where('status', true)->get(['nik', 'username']);
    //  $existingModelNumbers = UserAccessory::where('status', true)->pluck('modelNumber')->toArray();
        $accessories_data = [];
        $count = 0;
        foreach (Accessory::all() as $acc){
        $user_accessories = UserAccessory::where('modelNumber', $acc->modelNumber)->where('status', 1)->count();
        if($acc->qty > $user_accessories){
            $accessories_data[$count]['modelNumber'] = $acc->modelNumber;
            $accessories_data[$count]['category'] = $acc->category;
            $count++;
        }
        }
    //  $accessories = Accessory::whereNotIn('modelNumber', $existingModelNumbers)->get();
    
        return view('userAccessory.addUserAccessory', compact('accessories_data', 'nik', 'employees'));
    }
     

     
    /**
     * Store a newly created resource in storage.
     */

   public function store(StoreUserAccessoryRequest $request)
   {
       $employee = Employee::where('nik', $request->txtnik)->first();
   
       $selectedModelNumbers = $request->txtmodelNumber;
   
       foreach ($selectedModelNumbers as $selectedModelNumber) {
           $accessory = Accessory::where('modelNumber', $selectedModelNumber)->first();
   
           $userAccessory = new UserAccessory();
           $userAccessory->nik = $employee->nik;
           $userAccessory->username = $employee->username;
           $userAccessory->modelNumber = $accessory->modelNumber;
           $userAccessory->category = $accessory->category;
           $userAccessory->startdate = $request->txtstartDate;
           $userAccessory->status = true; 
           $userAccessory->save();
       }
   
       return redirect('userAccessories')->with('msg', 'Data employee berhasil ditambahkan');
   }
   
   public function detail($nik)
   {
       $userAsset = UserAsset::where('nik', $nik)->first();
   
       if (!$userAsset) {
           return redirect()->back()->with('error', 'User not found for the given NIK.');
       }
   
       $detailUserAccessories = UserAccessory::where('nik', $nik)->get();
       $hasAccessories = !$detailUserAccessories->isEmpty();
       $username = $hasAccessories ? $detailUserAccessories->first()->username : $userAsset->username;
    //    $currentPageHeading = "Detail Accessory " . $username;

       return view('userAccessory.detailUserAccessory', compact('detailUserAccessories', 'nik', 'hasAccessories', 'userAsset'));
   }
   
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($modelNumber)
    {
        try {
            $userAccessory = UserAccessory::where('modelNumber', $modelNumber);
    
            if ($userAccessory) {
                $userAccessory->update(['status' => false]);
                $qty = Accessory::where('modelNumber', $userAccessory->modelNumber)->first()->qty;
                Accessory::where('modelNumber', $userAccessory->modelNumber)->update([
                    'qty' => $qty--
                ]);
                
                return response()->json(['message' => 'Data berhasil diubah']);
            } else {
                return response()->json(['message' => 'Data tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal mengubah data: ' . $e->getMessage()], 500);
        }
    }
    


    
    
}
