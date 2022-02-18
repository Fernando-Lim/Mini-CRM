<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedBigInteger('companie_id')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->timestamps();
            // $table->unsignedBigInteger('created_by_id')->nullable()->index();
            // $table->unsignedBigInteger('updated_by_id')->nullable()->index();
            $table->foreign('companie_id')->references('id')->on('companies')->onDelete('cascade');
            // $table->foreign('created_by_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
