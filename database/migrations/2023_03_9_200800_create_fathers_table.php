<?php

use App\Models\Religion;
use App\Models\Notionalitio;
use App\Models\Type_blood;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fathers', function (Blueprint $table) {
            $table->id();

            $table->string('email')->unique();
            $table->string('password');

            ///////  Father's information          /////////
            $table->string('name');
            $table->integer('national_id');
            $table->integer('passport_id');
            $table->integer('phone');
            $table->string('job');
            $table
                ->foreignIdFor(Notionalitio::class)
             
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table
                ->foreignIdFor(Type_blood::class)
               
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table
                ->foreignIdFor(Religion::class)
          
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fathers');
    }
};
