<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SkillsController extends Controller
{

    //SHOW LIST OF  SKILLS
    public function skills(Request $request)
    {
        $search = $request->search;
        $skills = Skill::query();

        $skills->where(function ($query) use ($search) {
            $query->where('skill', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%');
        });

        $skills = $skills->orderBy('id', 'desc')->paginate(10);

        return view('superadmin.skill.index', compact('skills'));
    }


    //STORE JOB SKILL

    public function store(Request $request)
    {

        $validated = $request->validate([
            'skill' => ['required'],
            'status' => ['required']

        ]);
        DB::beginTransaction();

        try {
            $data = [
                'skill' => $request->skill,
                'status' => $request->status,
            ];

            Skill::create($data);
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.skills')->with('status', 'Job SKILL created Successfully done!');
    }


    // Edit JOB Skill
    public function editSkill($skill_id)
    {
        $skills = Skill::where('id', $skill_id)
            ->first();
        return response()->json(['status' => 200, 'data' => $skills]);
    }

    //UPDATE JOB SKILL

    public function update(Request $request, Skill $skill)
    {

        $validated = $request->validate([
            'skill' => ['required'],
            'status' => ['required']

        ]);
        DB::beginTransaction();

        try {

            $skillUpdate = Skill::find($request->id);

            $skillUpdate->update([
                'skill' => $request->skill,
                'status' => $request->status,
            ]);


        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.skills')->with('status', 'Job skill Updated Successfully done!');
    }


    //DELETE JOB SKILL

    public function delete(Skill $skill)
    {
        DB::beginTransaction();

        try {
            $skill->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.skills')->with('status', 'Job skill Delete Successfully done!');
    }

    //UPDATE STATUS JOB SKILL
    public function skillStatusUpdate($skill)
    {
        $status = Skill::find($skill);
        $status->status = $status->status == 'active' ? 'block' : 'active';
        $status->update();
        return Redirect::back()->with('status', 'status has been updated.');
    }
}
