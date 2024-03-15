<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\TeamSize;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TeamSizeController extends Controller
{


    //SHOW LIST OF TeamSize
    public function teamSize(Request $request)
    {
        $search = $request->search;
        $teamSize = TeamSize::query();

        $teamSize->where(function ($query) use ($search) {
            $query->where('team_size', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%');
        });

        $teamSize = $teamSize->orderBy('id', 'desc')->paginate(10);

        return view('superadmin.teamSize.index', compact('teamSize'));
    }


    //STORE TeamSize

    public function store(Request $request)
    {

        $validated = $request->validate([
            'team_size' => ['required'],
            'status' => ['required']

        ]);

        DB::beginTransaction();

        try {
            $data = [
                'team_size' => $request->team_size,
                'status' => $request->status,
            ];

            TeamSize::create($data);
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.teamSize')->with('status', 'TeamSize created Successfully done!');
    }

     // Edit TeamSize
     public function edit($teamSize_id)
     {
         $teamSize = TeamSize::where('id', $teamSize_id)
             ->first();
         return response()->json(['status' => 200, 'data' => $teamSize]);
     }


    //UPDATE TeamSize

    public function update(Request $request, TeamSize $teamSize)
    {

        $validated = $request->validate([
            'team_size' => ['required'],
            'status' => ['required']

        ]);
        DB::beginTransaction();

        try {

            $team_size = TeamSize::find($request->id);
            $team_size->update([
                'team_size' => $request->team_size,
                'status' => $request->status,
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.teamSize')->with('status', 'TeamSize Updated Successfully done!');
    }


    //DELETE TeamSize

    public function delete(TeamSize $teamSize)
    {
        DB::beginTransaction();

        try {
            $teamSize->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.teamSize')->with('status', 'TeamSize Delete Successfully done!');
    }

    //UPDATE STATUS TeamSize
    public function statusUpdate($teamSize)
    {
        $status = TeamSize::find($teamSize);
        $status->status = $status->status == 'active' ? 'block' : 'active';
        $status->update();
        return Redirect::back()->with('status', 'status has been updated.');
    }


}
