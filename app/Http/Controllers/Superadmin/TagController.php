<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TagController extends Controller
{


    //SHOW LIST OF TAGS
    public function tags(Request $request)
    {
        $search = $request->search;
        $tags = Tag::query();

        $tags->where(function ($query) use ($search) {
            $query->where('tag', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%');
        });

        $tags = $tags->orderBy('id', 'desc')->paginate(10);

        return view('superadmin.tag.index', compact('tags'));
    }


    //STORE JOB TAGS

    public function store(Request $request)
    {

        $validated = $request->validate([
            'tag' => ['required'],
            'status' => ['required']

        ]);
        DB::beginTransaction();

        try {
            $data = [
                'tag' => $request->tag,
                'status' => $request->status,
            ];

            Tag::create($data);
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.tags')->with('status', 'Job tag created Successfully done!');
    }


    // Edit JOB Tag
    public function editTag($tag_id)
    {
        $tags = Tag::where('id', $tag_id)->first();
        return response()->json(['status' => 200, 'data' => $tags]);
    }


    //UPDATE JOB TAGS

    public function update(Request $request, Tag $tag)
    {

        $validated = $request->validate([
            'tag' => ['required'],
            'status' => ['required']

        ]);
        DB::beginTransaction();

        try {

            $tagUpdate = Tag::find($request->id);
            $tagUpdate->update([
                'tag' => $request->tag,
                'status' => $request->status,
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.tags')->with('status', 'Job tag Updated Successfully done!');
    }


    //DELETE JOB Tag

    public function delete(Tag $tag)
    {
        DB::beginTransaction();

        try {
            $tag->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.tags')->with('status', 'Job tag Delete Successfully done!');
    }

    //UPDATE STATUS JOB Tag
    public function tagStatusUpdate($tag)
    {
        $status = Tag::find($tag);
        $status->status = $status->status == 'active' ? 'block' : 'active';
        $status->update();
        return Redirect::back()->with('status', 'status has been updated.');
    }
}
