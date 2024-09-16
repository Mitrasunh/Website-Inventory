<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(HttpRequest $request)
    {
        if ($request->ajax()) {
            $data = Employee::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                // ->addColumn('action', function($row){
                //     $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)"  class="delete btn btn-danger btn-sm">Delete</a>';
                //     return $actionBtn;
                // })
                ->rawColumns(['action'])
                ->make(true);
        }
        $currentPageHeading = 'Employee List'; // Set the desired heading

        return view('master.employee', compact('currentPageHeading'));
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
    public function store(StoreEmployeeRequest $request)
    {
        $validate = $request->validated();

        $employee = new employee;
        $employee->nik = $request->txtnik;
        $employee->username = $request->txtusername;
        $employee->email = $request->txtemail;
        $employee->phone = $request->txtphone;
        $employee->save();

        $currentPageHeading = 'Add New Employees';
        return redirect('employees')->with('msg', 'Tambah data employee ');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employees, $nik)
    {
        $employee = Employee::where('nik', $nik)->first();

        return view('master.editemployee', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employees, $nik)
    {
        $data = $employees->find($nik);
        $data->username = $request->txtusername;
        $data->email = $request->txtemail;
        $data->phone = $request->txtphone;
        $data->status = $request->txtstatus;

        $data->save();

        return redirect('employees')->with('msg', 'Edit data karyawan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $nik)
    {
        try {
            $employee = Employee::where('nik', $nik)->first();
    
            if ($employee) {
                $employee->delete();
    
                return response()->json(['message' => 'Data berhasil dihapus']);
            } else {
                return response()->json(['message' => 'Karyawan tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data: ' . $e->getMessage()], 500);
        }
    }
}
