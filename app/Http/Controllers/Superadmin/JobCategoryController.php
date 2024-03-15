<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class JobCategoryController extends Controller
{
    //SHOW LIST OF JOB CATEGORY
    public function jobCategory(Request $request)
    {
        $search = $request->search;
        $jobCategory = JobCategory::query();

        $jobCategory->where(function ($query) use ($search) {
            $query->where('category', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%');
        });

        $jobCategory = $jobCategory->orderBy('id', 'desc')->paginate(15);

        return view('superadmin.jobCategory.index', compact('jobCategory'));
    }


    //STORE JOB CATEGORY

    public function store(Request $request)
    {

        $validated = $request->validate([
            'category' => ['required'],
            'status' => ['required']

        ]);
        DB::beginTransaction();

        try {
            $data = [
                'category' => $request->category,
                'status' => $request->status,
            ];

            JobCategory::create($data);
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.jobCategory')->with('status', 'Job Category created Successfully done!');
    }

    // Edit JOB CATEGORY
    public function editJobCategory($jobCategory_id)
    {
        $jobCategory = JobCategory::where('id', $jobCategory_id)
            ->first();
        return response()->json(['status' => 200, 'data' => $jobCategory]);
    }


    //UPDATE JOB CATEGORY

    public function update(Request $request, JobCategory $jobCategory)
    {
        $validated = $request->validate([
            'category' => ['required'],
            'status' => ['required']

        ]);
        DB::beginTransaction();

        try {
            $data = [
                'category' => $request->category,
                'status' => $request->status,
            ];

            $jobCategoryUpdate = JobCategory::find($request->id);
            $jobCategoryUpdate->update($data);

        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.jobCategory')->with('status', 'Job Category Updated Successfully done!');
    }


    //DELETE JOB CATEGORY

    public function delete(JobCategory $jobCategory)
    {
        DB::beginTransaction();

        try {
            $jobCategory->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.jobCategory')->with('status', 'Job Category Delete Successfully done!');
    }

    //UPDATE STATUS JOB CATEGORY
    public function jobCategoryStatusUpdate($jobRole)
    {
        $status = JobCategory::find($jobRole);
        $status->status = $status->status == 'active' ? 'block' : 'active';
        $status->update();
        return Redirect::back()->with('status', 'status has been updated.');
    }
}
