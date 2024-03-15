<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\IndustryType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class IndustryTypeController extends Controller
{

    //SHOW LIST OF INDUSTRY TYPE
    public function industryType(Request $request)
    {
        $search = $request->search;
        $industryType = IndustryType::query();

        $industryType->where(function ($query) use ($search) {
            $query->where('industry_type', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%');
        });

        $industryType = $industryType->orderBy('id', 'desc')->paginate(10);

        return view('superadmin.industryType.index', compact('industryType'));
    }


    //STORE INDUSTRY TYPE

    public function store(Request $request)
    {

        $validated = $request->validate([
            'industry_type' => ['required'],
            'status' => ['required']

        ]);

        DB::beginTransaction();

        try {
            $data = [
                'industry_type' => $request->industry_type,
                'status' => $request->status,
            ];

            IndustryType::create($data);
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.industryTypes')->with('status', 'Job Industry Types created Successfully done!');
    }


    // Edit INDUSTRY TYPE
    public function editIndustryType($industryType_id)
    {
        $industryType = IndustryType::where('id', $industryType_id)
            ->first();
        return response()->json(['status' => 200, 'data' => $industryType]);
    }


    //UPDATE INDUSTRY TYPE

    public function update(Request $request, IndustryType $industryType)
    {

        $validated = $request->validate([
            'industry_type' => ['required'],
            'status' => ['required']

        ]);
        DB::beginTransaction();

        try {

            $industryTypeUpdate = IndustryType::find($request->id);
            $industryTypeUpdate->update([
                'industry_type' => $request->industry_type,
                'status' => $request->status,
            ]);


        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.industryTypes')->with('status', 'Job Industry Type Updated Successfully done!');
    }


    //DELETE INDUSTRY TYPE

    public function delete(IndustryType $industryType)
    {
        DB::beginTransaction();

        try {
            $industryType->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.industryTypes')->with('status', 'Job Industry Type Delete Successfully done!');
    }

    //UPDATE STATUS INDUSTRY TYPE
    public function industryTypesStatusUpdate($industryType)
    {
        $status = IndustryType::find($industryType);
        $status->status = $status->status == 'active' ? 'block' : 'active';
        $status->update();
        return Redirect::back()->with('status', 'status has been updated.');
    }
}
