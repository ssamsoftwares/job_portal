<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SalaryTypeController extends Controller
{


    //SHOW LIST OF SalaryType
    public function salaryType(Request $request)
    {
        $search = $request->search;
        $salaryType = Salary::query();

        $salaryType->where(function ($query) use ($search) {
            $query->where('salary_type', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%');
        });

        $salaryType = $salaryType->orderBy('id', 'desc')->paginate(10);

        return view('superadmin.salaryType.index', compact('salaryType'));
    }


    //STORE SalaryType

    public function store(Request $request)
    {

        $validated = $request->validate([
            'salary_type' => ['required'],
            'status' => ['required']

        ]);

        DB::beginTransaction();

        try {
            $data = [
                'salary_type' => $request->salary_type,
                'status' => $request->status,
            ];

            Salary::create($data);
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.salaryTypes')->with('status', 'SalaryType created Successfully done!');
    }

     // Edit SalaryType
     public function edit($salaryType_id)
     {
         $salaryTypes = Salary::where('id', $salaryType_id)
             ->first();
         return response()->json(['status' => 200, 'data' => $salaryTypes]);
     }


    //UPDATE SalaryType

    public function update(Request $request, Salary $salaryType)
    {

        $validated = $request->validate([
            'salary_type' => ['required'],
            'status' => ['required']

        ]);
        DB::beginTransaction();

        try {

            $salaryType = Salary::find($request->id);
            $salaryType->update([
                'salary_type' => $request->salary_type,
                'status' => $request->status,
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.salaryTypes')->with('status', 'SalaryType Updated Successfully done!');
    }


    //DELETE SalaryType

    public function delete(Salary $salaryType)
    {
        DB::beginTransaction();

        try {
            $salaryType->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.salaryTypes')->with('status', 'SalaryType Delete Successfully done!');
    }

    //UPDATE STATUS SalaryType
    public function statusUpdate($salaryType)
    {
        $status = Salary::find($salaryType);
        $status->status = $status->status == 'active' ? 'block' : 'active';
        $status->update();
        return Redirect::back()->with('status', 'status has been updated.');
    }



}
