<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{

    //SHOW LIST OF Language
    public function language(Request $request)
    {
        $search = $request->search;
        $language = Language::query();

        $language->where(function ($query) use ($search) {
            $query->where('language', 'LIKE', '%' . $search . '%')
                ->orWhere('status', 'LIKE', '%' . $search . '%');
        });

        $language = $language->orderBy('id', 'desc')->paginate(10);

        return view('superadmin.language.index', compact('language'));
    }


    //STORE Language

    public function store(Request $request)
    {

        $validated = $request->validate([
            'language' => ['required'],
            'status' => ['required']

        ]);

        DB::beginTransaction();

        try {
            $data = [
                'language' => $request->language,
                'status' => $request->status,
            ];

            Language::create($data);
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.language')->with('status', 'Language created Successfully done!');
    }


       // Edit Language
       public function edit($language_id)
       {
           $language = Language::where('id', $language_id)
               ->first();
           return response()->json(['status' => 200, 'data' => $language]);
       }


    //UPDATE Language

    public function update(Request $request, Language $language)
    {

        $validated = $request->validate([
            'language' => ['required'],
            'status' => ['required']

        ]);
        DB::beginTransaction();

        try {

            $languageUpdate = Language::find($request->id);
            $languageUpdate->update([
                'language' => $request->language,
                'status' => $request->status,
            ]);


        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.language')->with('status', 'Language Updated Successfully done!');
    }


    //DELETE Language

    public function delete(Language $language)
    {
        DB::beginTransaction();

        try {
            $language->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.language')->with('status', 'Language Delete Successfully done!');
    }

    //UPDATE STATUS Language
    public function statusUpdate($language)
    {
        $status = Language::find($language);
        $status->status = $status->status == 'active' ? 'block' : 'active';
        $status->update();
        return Redirect::back()->with('status', 'status has been updated.');
    }


}
