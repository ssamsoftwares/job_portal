<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ExperienceController extends Controller
{


    //SHOW LIST OF Experience
    public function experience(Request $request)
    {
        $search = $request->search;
        $experience = Experience::query();

        $experience->where(function ($query) use ($search) {
            $query->where('experiences', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%');
        });

        $experience = $experience->orderBy('id', 'desc')->paginate(10);

        return view('superadmin.experience.index', compact('experience'));
    }


    //STORE Experience

    public function store(Request $request)
    {

        $validated = $request->validate([
            'experiences' => ['required'],
            'status' => ['required']

        ]);

        DB::beginTransaction();

        try {
            $data = [
                'experiences' => $request->experiences,
                'status' => $request->status,
            ];

            Experience::create($data);
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.experiences')->with('status', 'Experience created Successfully done!');
    }

    // Edit Experience
    public function edit($experience_id)
    {
        $experience = Experience::where('id', $experience_id)
            ->first();
        return response()->json(['status' => 200, 'data' => $experience]);
    }



    //UPDATE Experience

    public function update(Request $request, Experience $experience)
    {

        $validated = $request->validate([
            'experiences' => ['required'],
            'status' => ['required']

        ]);
        DB::beginTransaction();

        try {

            $experienceUpdate = Experience::find($request->id);
            $experienceUpdate->update([
                'experiences' => $request->experiences,
                'status' => $request->status,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.experiences')->with('status', 'Experience Updated Successfully done!');
    }


    //DELETE Experience

    public function delete(Experience $experience)
    {
        DB::beginTransaction();

        try {
            $experience->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.experiences')->with('status', 'Experience Delete Successfully done!');
    }

    //UPDATE STATUS Experience
    public function statusUpdate($experience)
    {
        $status = Experience::find($experience);
        $status->status = $status->status == 'active' ? 'block' : 'active';
        $status->update();
        return Redirect::back()->with('status', 'status has been updated.');
    }
}
