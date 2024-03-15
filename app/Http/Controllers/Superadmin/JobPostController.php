<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;
use App\Models\JobCategory;
use App\Models\JobPost;
use App\Models\JobRole;
use App\Models\JobType;
use App\Models\Salary;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class JobPostController extends Controller
{

    public function jobPost(Request $request)
    {
        $search = $request->search;
        $jobPosts = JobPost::with('createBy', 'company', 'jobCategory', 'experience', 'jobRole', 'salaryType');

        if (!empty($search)) {
            $jobPosts->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('job_working_type', 'LIKE', '%' . $search . '%')
                    ->orWhere('minimum_salary', 'LIKE', '%' . $search . '%')
                    ->orWhere('maximum_salary', 'LIKE', '%' . $search . '%')
                    ->orWhere('status', 'LIKE', '%' . $search . '%');
            })
            ->orWhereHas('company', function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })

            ->orWhereHas('createBy', function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })

            ->orWhereHas('jobCategory', function ($query) use ($search) {
                $query->where('category', 'LIKE', '%' . $search . '%');
            });
        }

        $jobPosts = $jobPosts->orderBy('id', 'desc')->paginate(10);
        return view('superadmin.jobPost.index', compact('jobPosts'));
    }


    public function create()
    {

        $data['company'] = User::whereHas('roles', function ($query) {
            $query->where('name', 'employer');
        })
            ->get();

        $data['jobCategory'] = JobCategory::where('status', 'active')->pluck('category', 'id')->toArray();

        $data['salaryType'] = Salary::where('status', 'active')->pluck('salary_type', 'id')->toArray();
        $data['experience'] = Experience::where('status', 'active')->pluck('experiences', 'id')->toArray();

        $data['jobRole'] = JobRole::where('status', 'active')->pluck('job_role', 'id')->toArray();
        $data['education'] = Education::where('status', 'active')->pluck('education', 'id')->toArray();
        $data['jobType'] = JobType::where('status', 'active')->pluck('job_type', 'id')->toArray();

        $data['tags'] = Tag::where('status', 'active')->get();
        $data['skills'] = Skill::where('status', 'active')->get();

        return view('superadmin.jobPost.add', compact('data'));
    }



    public function store(Request $request)
    {


        $validated = $request->validate([
            'title' => ['required', 'string',],
            'company_id' => ['required',],
            'custom_comapny_name' => ['nullable',],
            'job_category_id' => ['required',],
            'total_vacancies' => ['required',],
            'deadline' => ['required',],
            'location' => ['required',],
            'salary_option' => ['required',],
            'minimum_salary' => ['nullable',],
            'maximum_salary' => ['nullable',],
            'custom_salary' => ['nullable',],
            'salaryType_id' => ['required',],
            'experience_id' => ['required',],
            'jobRole_id' => ['required',],
            'education_id' => ['required',],
            'jobType_id' => ['required',],
            'tags_id' => ['required',],
            'skills_id' => ['required',],
            'benefits' => ['nullable',],
            'description' => ['required',],
            'job_featured_type' => ['nullable',],
            'job_working_type' => ['required',],
            'receive_applications' => ['nullable',],
            'status' => ['nullable',],
        ]);

        DB::beginTransaction();
        try {

            $data = [
                'title' => $request->title,
                'company_id' => $request->company_id,
                'custom_comapny_name' => $request->custom_comapny_name,
                'job_category_id' => $request->job_category_id,
                'total_vacancies' => $request->total_vacancies,
                'deadline' => $request->deadline,
                'location' => $request->location,
                'salary_option' => $request->salary_option,
                'minimum_salary' => $request->minimum_salary,
                'maximum_salary' => $request->maximum_salary,
                'custom_salary' => $request->custom_salary,
                'salaryType_id' => $request->salaryType_id,
                'experience_id' => $request->experience_id,
                'jobRole_id' => $request->jobRole_id,
                'education_id' => $request->education_id,
                'jobType_id' => $request->jobType_id,
                'tags_id' => json_encode($request->tags_id),
                'skills_id' => json_encode($request->skills_id),
                'benefits' => $request->benefits ?? null,
                'description' => $request->description,
                'job_featured_type' => $request->job_featured_type,
                'job_working_type' => $request->job_working_type,
                'receive_applications' => $request->receive_applications ?? null,
                'status' => $request->status ?? 'active',
                'created_by' => Auth::id(),
            ];

            JobPost::create($data);
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.jobPost')->with('status', 'Job Post created Successfully done!');
    }


    public function edit(JobPost $jobPost)
    {

        $data['company'] = User::whereHas('roles', function ($query) {
            $query->where('name', 'employer');
        })
            ->get();

        $data['jobCategory'] = JobCategory::where('status', 'active')->pluck('category', 'id')->toArray();

        $data['salaryType'] = Salary::where('status', 'active')->pluck('salary_type', 'id')->toArray();
        $data['experience'] = Experience::where('status', 'active')->pluck('experiences', 'id')->toArray();

        $data['jobRole'] = JobRole::where('status', 'active')->pluck('job_role', 'id')->toArray();
        $data['education'] = Education::where('status', 'active')->pluck('education', 'id')->toArray();
        $data['jobType'] = JobType::where('status', 'active')->pluck('job_type', 'id')->toArray();

        $data['tags'] = Tag::where('status', 'active')->get();
        $data['skills'] = Skill::where('status', 'active')->get();

        return view('superadmin.jobPost.edit', compact('jobPost', 'data'));
    }


    public function view(JobPost $jobPost)
    {

        $data['company'] = User::whereHas('roles', function ($query) {
            $query->where('name', 'employer');
        })
            ->get();

        $data['jobCategory'] = JobCategory::where('status', 'active')->pluck('category', 'id')->toArray();

        $data['salaryType'] = Salary::where('status', 'active')->pluck('salary_type', 'id')->toArray();
        $data['experience'] = Experience::where('status', 'active')->pluck('experiences', 'id')->toArray();

        $data['jobRole'] = JobRole::where('status', 'active')->pluck('job_role', 'id')->toArray();
        $data['education'] = Education::where('status', 'active')->pluck('education', 'id')->toArray();
        $data['jobType'] = JobType::where('status', 'active')->pluck('job_type', 'id')->toArray();

        $data['tags'] = Tag::where('status', 'active')->get();
        $data['skills'] = Skill::where('status', 'active')->get();

        return view('superadmin.jobPost.view', compact('jobPost', 'data'));
    }


    public function update(Request $request, JobPost $jobPost)
    {

        $validated = $request->validate([
            'title' => ['required', 'string',],
            'company_id' => ['required',],
            'custom_comapny_name' => ['nullable',],
            'job_category_id' => ['required',],
            'total_vacancies' => ['required',],
            'deadline' => ['required',],
            'location' => ['required',],
            'salary_option' => ['required',],
            'minimum_salary' => ['required',],
            'maximum_salary' => ['required',],
            'custom_salary' => ['nullable',],
            'salaryType_id' => ['required',],
            'experience_id' => ['required',],
            'jobRole_id' => ['required',],
            'education_id' => ['required',],
            'jobType_id' => ['required',],
            'tags_id' => ['required',],
            'skills_id' => ['required',],
            'benefits' => ['nullable',],
            'description' => ['required',],
            'job_featured_type' => ['nullable',],
            'job_working_type' => ['required',],
            'receive_applications' => ['nullable',],
            'status' => ['nullable',],
        ]);

        DB::beginTransaction();
        try {

            $data = [
                'title' => $request->title,
                'company_id' => $request->company_id,
                'custom_comapny_name' => $request->custom_comapny_name,
                'job_category_id' => $request->job_category_id,
                'total_vacancies' => $request->total_vacancies,
                'deadline' => $request->deadline,
                'location' => $request->location,
                'salary_option' => $request->salary_option,
                'minimum_salary' => $request->minimum_salary,
                'maximum_salary' => $request->maximum_salary,
                'custom_salary' => $request->custom_salary,
                'salaryType_id' => $request->salaryType_id,
                'experience_id' => $request->experience_id,
                'jobRole_id' => $request->jobRole_id,
                'education_id' => $request->education_id,
                'jobType_id' => $request->jobType_id,
                'tags_id' => json_encode($request->tags_id),
                'skills_id' => json_encode($request->skills_id),
                'benefits' => $request->benefits ?? null,
                'description' => $request->description,
                'job_featured_type' => $request->job_featured_type,
                'job_working_type' => $request->job_working_type,
                'receive_applications' => $request->receive_applications ?? null,
                'status' => $request->status ?? 'active',
            ];

            $jobPostUpdate =  $jobPost->update($data);
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('status', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.jobPost')->with('status', 'Job Post updated Successfully done!');
    }


    public function delete(JobPost $jobPost)
    {
        DB::beginTransaction();
        try {
            $jobPost->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('status', $e->getMessage());
        }
        DB::commit();
        return Redirect::route('admin.jobPost')->with('status', 'Job Post deleted Successfully done!');
    }


    // Job Post status change
    public function jobPostStatusUpdate($id)
    {
        $status = JobPost::find($id);
        $status->status = $status->status == 'active' ? 'block' : 'active';
        $status->update();
        return Redirect::back()->with('status', 'status has been updated.');
    }
}
