<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProfessionController extends Controller
{


    //SHOW LIST OF Profession
    public function professions(Request $request)
    {
        $search = $request->search;
        $professions = Profession::query();

        $professions->where(function ($query) use ($search) {
            $query->where('profession', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%');
        });

        $professions = $professions->orderBy('id', 'desc')->paginate(10);

        return view('superadmin.profession.index', compact('professions'));
    }


    //STORE Profession

    public function store(Request $request)
    {

        $validated = $request->validate([
            'profession' => ['required'],
            'status' => ['required']

        ]);

        DB::beginTransaction();

        try {
            $data = [
                'profession' => $request->profession,
                'status' => $request->status,
            ];

            Profession::create($data);
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.professions')->with('status', 'Job Profession created Successfully done!');
    }


    // Edit Profession
    public function edit($profession_id)
    {
        $professions = Profession::where('id', $profession_id)
            ->first();
        return response()->json(['status' => 200, 'data' => $professions]);
    }



    //UPDATE Profession

    public function update(Request $request, Profession $profession)
    {

        $validated = $request->validate([
            'profession' => ['required'],
            'status' => ['required']

        ]);
        DB::beginTransaction();

        try {
            $professionUpdate = Profession::find($request->id);
            $professionUpdate->update([
                'profession' => $request->profession,
                'status' => $request->status,
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.professions')->with('status', 'Job Profession Updated Successfully done!');
    }


    //DELETE Profession

    public function delete(Profession $profession)
    {
        DB::beginTransaction();

        try {
            $profession->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.professions')->with('status', 'Job Profession Delete Successfully done!');
    }

    //UPDATE STATUS Profession
    public function professionStatusUpdate($industryType)
    {
        $status = Profession::find($industryType);
        $status->status = $status->status == 'active' ? 'block' : 'active';
        $status->update();
        return Redirect::back()->with('status', 'status has been updated.');
    }
}
