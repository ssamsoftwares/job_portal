<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\OrganizationType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OrganizationTypeController extends Controller
{


    //SHOW LIST OF OrganizationType
    public function organizationType(Request $request)
    {
        $search = $request->search;
        $organizationType = OrganizationType::query();

        $organizationType->where(function ($query) use ($search) {
            $query->where('organization_type', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%');
        });

        $organizationType = $organizationType->orderBy('id', 'desc')->paginate(10);

        return view('superadmin.organizationType.index', compact('organizationType'));
    }


    //STORE OrganizationType

    public function store(Request $request)
    {

        $validated = $request->validate([
            'organization_type' => ['required'],
            'status' => ['required']

        ]);

        DB::beginTransaction();

        try {
            $data = [
                'organization_type' => $request->organization_type,
                'status' => $request->status,
            ];

            OrganizationType::create($data);
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.organizationTypes')->with('status', 'OrganizationType created Successfully done!');
    }


     // Edit OrganizationType
     public function edit($organizationType_id)
     {
         $organizationType = OrganizationType::where('id', $organizationType_id)
             ->first();
         return response()->json(['status' => 200, 'data' => $organizationType]);
     }



    //UPDATE OrganizationType

    public function update(Request $request, OrganizationType $organizationType)
    {

        $validated = $request->validate([
            'organization_type' => ['required'],
            'status' => ['required']

        ]);
        DB::beginTransaction();

        try {

            $organizationTypeUpdate = OrganizationType::find($request->id);

            $organizationTypeUpdate->update([
                'organization_type' => $request->organization_type,
                'status' => $request->status,
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.organizationTypes')->with('status', 'OrganizationType Updated Successfully done!');
    }


    //DELETE OrganizationType

    public function delete(OrganizationType $organizationType)
    {
        DB::beginTransaction();

        try {
            $organizationType->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.organizationTypes')->with('status', 'OrganizationType Delete Successfully done!');
    }

    //UPDATE STATUS OrganizationType
    public function statusUpdate($organizationType)
    {
        $status = OrganizationType::find($organizationType);
        $status->status = $status->status == 'active' ? 'block' : 'active';
        $status->update();
        return Redirect::back()->with('status', 'status has been updated.');
    }


}
