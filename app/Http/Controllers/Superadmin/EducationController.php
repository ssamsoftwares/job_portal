<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class EducationController extends Controller
{

    //SHOW LIST OF Education
    public function educations(Request $request)
    {
        $search = $request->search;
        $educations = Education::query();

        $educations->where(function ($query) use ($search) {
            $query->where('education', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%');
        });

        $educations = $educations->orderBy('id', 'desc')->paginate(10);

        return view('superadmin.education.index', compact('educations'));
    }


    //STORE Education

    public function store(Request $request)
    {

        $validated = $request->validate([
            'education' => ['required'],
            'status' => ['required']

        ]);

        DB::beginTransaction();

        try {
            $data = [
                'education' => $request->education,
                'status' => $request->status,
            ];

            Education::create($data);
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.educations')->with('status', 'Education created Successfully done!');
    }


      // Edit Education
      public function edit($education_id)
      {
          $educations = Education::where('id', $education_id)
              ->first();
          return response()->json(['status' => 200, 'data' => $educations]);
      }


    //UPDATE Education

    public function update(Request $request, Education $education)
    {

        $validated = $request->validate([
            'education' => ['required'],
            'status' => ['required']

        ]);
        DB::beginTransaction();

        try {

            $educationUpdate = Education::find($request->id);
            $educationUpdate->update([
                'education' => $request->education,
                'status' => $request->status,
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.educations')->with('status', 'Education Updated Successfully done!');
    }


    //DELETE Education

    public function delete(Education $education)
    {
        DB::beginTransaction();

        try {
            $education->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.educations')->with('status', 'Education Delete Successfully done!');
    }

    //UPDATE STATUS Education
    public function statusUpdate($education)
    {
        $status = Education::find($education);
        $status->status = $status->status == 'active' ? 'block' : 'active';
        $status->update();
        return Redirect::back()->with('status', 'status has been updated.');
    }



}
