<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->longText('company_name')->unique()->nullable();
            $table->string('mobile_number')->unique();
            $table->string('secondary_phone')->unique()->nullable();
            $table->string('profile_image')->nullable();
            $table->longText('address')->nullable();
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->longText('about_us')->nullable();

            $table->string('organization_type')->nullable();
            $table->string('industry_type')->nullable();
            $table->string('team_size')->nullable();
            $table->string('year_of_establishment')->nullable();
            $table->string('website_url')->nullable();
            $table->longText('company_vision')->nullable();
            $table->longText('country')->nullable();
            $table->longText('state')->nullable();
            $table->longText('city')->nullable();
            $table->longText('company_address')->nullable();

            // Social Media Profile
            $table->longText('facebook')->nullable();
            $table->longText('linkedin')->nullable();
            $table->longText('instagram')->nullable();
            $table->longText('youTube')->nullable();
            $table->longText('twitter')->nullable();
            $table->longText('skype')->nullable();
            $table->longText('other_social_media')->nullable();

            $table->longText('professional_title')->nullable();
            $table->string('job_role')->nullable();
            $table->string('experience_level')->nullable();
            $table->string('education_level')->nullable();
            $table->string('personal_website')->nullable();
            $table->string('dob')->nullable();
            $table->enum('gender',['female','male','other'])->nullable();
            $table->enum('marital_status',['single','married'])->nullable();
            $table->string('profession_id')->nullable();
            $table->string('your_availability')->nullable();
            $table->longText('skill')->nullable();
            $table->longText('language_id')->nullable();
            $table->longText('biography')->nullable();

            $table->enum('employer_type',['company','individual'])->nullable();
            $table->enum('status',['pending','rejected','verified'])->nullable();
            $table->longText('status_reason')->nullable();
            $table->enum('account_status',['activated','deactivated'])->nullable()->default('activated');
            $table->boolean('accept_terms')->nullable();
            $table->string('resume')->nullable();

            $table->timestamp('email_verified_at')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
