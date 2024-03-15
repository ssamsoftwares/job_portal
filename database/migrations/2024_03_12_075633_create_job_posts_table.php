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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('created_by');
            $table->string('custom_comapny_name')->nullable();
            $table->unsignedBigInteger('job_category_id');
            $table->string('total_vacancies')->nullable();
            $table->string('deadline')->nullable();

            $table->longText('location');
            $table->enum('salary_option',['salary_range','custom_salary']);
            $table->string('minimum_salary')->nullable();
            $table->string('maximum_salary')->nullable();
            $table->string('custom_salary')->nullable();
            $table->unsignedBigInteger('salaryType_id');

            $table->unsignedBigInteger('experience_id');
            $table->unsignedBigInteger('jobRole_id');
            $table->unsignedBigInteger('education_id');
            $table->unsignedBigInteger('jobType_id');
            $table->longText('tags_id');
            $table->longText('skills_id');
            $table->longText('benefits')->nullable();
            $table->longText('description')->nullable();

            $table->enum('job_featured_type',['featured','highlight']);
            $table->enum('job_working_type',['on_site','remote'])->default('on_site');

            $table->string('receive_applications')->nullable();
            $table->enum('status',['active','block'])->default('active');

            $table->timestamps();


            $table->foreign('created_by')->references('id')->on('users');

            $table->foreign('company_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('job_category_id')->references('id')->on('job_categories');
            $table->foreign('salaryType_id')->references('id')->on('salaries');
            $table->foreign('experience_id')->references('id')->on('experiences');
            $table->foreign('jobRole_id')->references('id')->on('job_roles');
            $table->foreign('education_id')->references('id')->on('education');
            $table->foreign('jobType_id')->references('id')->on('job_types');

        });
    }

    /**
     *
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
