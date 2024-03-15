<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'company_id', 'custom_comapny_name', 'job_category_id', 'total_vacancies', 'deadline','location','salary_option', 'minimum_salary', 'maximum_salary', 'custom_salary','salaryType_id','experience_id','jobRole_id','education_id','jobType_id','tags_id', 'skills_id','benefits','description', 'job_featured_type','job_working_type', 'receive_applications','status','created_by',
    ];


    public function createBy(){
        return $this->belongsTo(User::class,'created_by');
    }


    public function company(){
        return $this->belongsTo(User::class,'company_id');
    }


    public function jobCategory(){
        return $this->belongsTo(JobCategory::class,'job_category_id');
    }


    public function experience(){
        return $this->belongsTo(Experience::class,'experience_id');
    }


    public function jobRole(){
        return $this->belongsTo(JobRole::class,'jobRole_id');
    }

    public function education(){
        return $this->belongsTo(Education::class,'education_id');
    }

    public function jobType(){
        return $this->belongsTo(JobType::class,'jobType_id');
    }

    public function tags_id(){
        return $this->belongsTo(Tag::class,'tags_id');
    }

    public function skills_id(){
        return $this->belongsTo(Skill::class,'skills_id');
    }

    public function salaryType(){
        return $this->belongsTo(Salary::class,'salaryType_id');
    }

}
