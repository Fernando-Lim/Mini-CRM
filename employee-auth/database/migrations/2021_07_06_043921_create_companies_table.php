<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('logo');
            $table->string('website');
            $table->timestamps();
            // $table->unsignedBigInteger('created_by_id')->nullable()->index();
            // $table->unsignedBigInteger('updated_by_id')->nullable()->index();

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
        Schema::dropIfExists('companies');
    }
}
