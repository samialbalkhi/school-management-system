<?php

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('from_grade');
            $table->unsignedBigInteger('from_Classroom');
            $table->unsignedBigInteger('from_section');
            $table->unsignedBigInteger('to_grade');
            $table->unsignedBigInteger('to_Classroom');
            $table->unsignedBigInteger('to_section');

            $table->timestamps();

        });
        
        Schema::table('promotions', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('from_grade')->references('id')->on('grades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('from_Classroom')->references('id')->on('classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('from_section')->references('id')->on('sections')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_grade')->references('id')->on('grades')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_Classroom')->references('id')->on('classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('to_section')->references('id')->on('sections')->onDelete('cascade')->onUpdate('cascade');
        });

    
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');

    }
};
