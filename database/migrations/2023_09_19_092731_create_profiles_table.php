<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            
             $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
             $table->string('first_name');
             $table->string('last_name');
             $table->date('birthday')->nullable();
             $table->enum('gender',['male','female'])->nullable();
             $table->string('street_address')->nallable();
             $table->string('city')->nallable();
             $table->string('state')->nallable();
             $table->string('postal_code')->nallable();
             $table->char('country',2);
             $table->char('locale',2)->default('en');
             $table->timestamps();
             $table->primary('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
