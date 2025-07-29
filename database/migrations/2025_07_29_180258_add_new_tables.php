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
        Schema::create('developers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('github_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->enum('experience_level', ['Intern', 'Junior', 'Mid-level', 'Senior', 'Tech-lead']);
            $table->string('cv')->nullable();
            $table->timestamps();
        });

        Schema::create('stacks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('developer_stacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('stack_id')->constrained('stacks')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('technologies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('developer_technologies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('technology_id')->constrained()->onDelete('cascade');
        });

        Schema::create('recruiters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('company_name');
            $table->string('location');
            $table->string('company_logo')->nullable();
            $table->timestamps();
        });

        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('stack_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->decimal('salary')->nullable();
            $table->enum('location', ['Remote', 'Hybrid', 'OnSite']);
            $table->enum('status', ['Pending', 'Accepted', 'Rejected'])->default('Pending');
            $table->text('rejection_message')->nullable();
            $table->boolean('is_disclosed')->default(false);
            $table->timestamps();
        });

        Schema::create('job_listing_technologies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_listing_id')->constrained()->onDelete('cascade');
            $table->foreignId('technology_id')->constrained()->onDelete('cascade');
        });

        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_listing_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['Pending', 'Accepted', 'Rejected'])->default('Pending');
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name', 255)->unique();;
            $table->timestamps();
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->string('secret_code');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
        Schema::dropIfExists('job_listing_technologies');
        Schema::dropIfExists('job_listings');
        Schema::dropIfExists('recruiters');
        Schema::dropIfExists('developer_technologies');
        Schema::dropIfExists('technologies');
        Schema::dropIfExists('developer_stacks');
        Schema::dropIfExists('stacks');
        Schema::dropIfExists('developers');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('roles');
    }
};
