<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\JobRole;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class JobRoleController extends Controller
{

    //SHOW LIST OF JOB ROLE
    public function jobRole(Request $request)
    {
        $search = $request->search;
        $jobRole = JobRole::query();

        $jobRole->where(function ($query) use ($search) {
            $query->where('job_role', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%');
        });

        $jobRole = $jobRole->orderBy('id', 'desc')->paginate(10);

        return view('superadmin.jobRole.index', compact('jobRole'));
    }


    //STORE JOB ROLE

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'job_role' => ['required'],
            'status' => ['required']

        ]);
        DB::beginTransaction();

        try {
           $jobRole = JobRole::create([
                'job_role'=>$request->job_role,
                'status'=>$request->status,
            ]);

        }
        catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }

        DB::commit();
        return Redirect::back()->with('status', 'Job ROLE created Successfully done!');
    }

    // Edit JOB ROLE
    public function editJobRole($jobrole_id)
    {
        $jobRole = JobRole::where('id', $jobrole_id)
            ->first();
        return response()->json(['status' => 200, 'data' => $jobRole]);
    }

    //UPDATE JOB ROLE

    public function update(Request $request, JobRole $jobRole)
    {

        $validated = $request->validate([
            'job_role' => ['required'],
            'status' => ['required']

        ]);
        DB::beginTransaction();

        try {

            $jobRoleUpdate = JobRole::find($request->id);

            $jobRoleUpdate->update([
                'job_role' => $request->job_role,
                'status' => $request->status,
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.jobRole')->with('status', 'Job Role Updated Successfully done!');
    }


    //DELETE JOB ROLE

    public function delete(JobRole $jobRole)
    {
        DB::beginTransaction();

        try {
            $jobRole->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.jobRole')->with('status', 'Job Role Delete Successfully done!');
    }

    //UPDATE STATUS JOB ROLE
    public function jobRoleStatusUpdate($id)
    {
        $status = JobRole::find($id);
        $status->status = $status->status == 'active' ? 'block' : 'active';
        $status->update();
        return Redirect::back()->with('status', 'status has been updated.');
    }
}
