<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('dashboard')->default(0)->nullable();
            $table->integer('addproduct')->default(0)->nullable();
            $table->integer('viewproduct')->default(0)->nullable();
            $table->integer('saleslist')->default(0)->nullable();
            $table->integer('newsale')->default(0)->nullable();
            $table->integer('adduser')->default(0)->nullable();
            $table->integer('viewuser')->default(0)->nullable();
            $table->integer('addbranch')->default(0)->nullable();
            $table->integer('viewbranch')->default(0)->nullable();
            $table->integer('addreport')->default(0)->nullable();
            $table->integer('viewreport')->default(0)->nullable();
            $table->integer('addbrand')->default(0)->nullable();
            $table->integer('viewbrand')->default(0)->nullable();
            $table->integer('addmodel')->default(0)->nullable();
            $table->integer('viewmodel')->default(0)->nullable();
            $table->integer('addnumber')->default(0)->nullable();
            $table->integer('numberlist')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesses');
    }
}
