<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = ['name', 'email', 'password', 'company_name', 'mobile_number', 'secondary_phone', 'logo', 'banner', 'about_us', 'organization_type', 'industry_type', 'team_size', 'year_of_establishment', 'website_url', 'company_vision', 'country', 'state', 'city', 'company_address','address','facebook', 'linkedin', 'instagram', 'youTube', 'twitter', 'skype', 'other_social_media', 'professional_title', 'experience_level', 'personal_website', 'dob', 'gender', 'marital_status', 'profession', 'your_availability', 'skills', 'languages', 'biography', 'status', 'status_reason', 'account_status','employer_type','profile_image'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function organizationType(){
        return $this->belongsTo(OrganizationType::class,'organization_type');
    }

    public function industryType(){
        return $this->belongsTo(IndustryType::class,'industry_type');
    }

    public function teamSize(){
        return $this->belongsTo(TeamSize::class,'team_size');
    }


}
