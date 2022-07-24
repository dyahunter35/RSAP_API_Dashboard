<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('bloodـtype')->nullable();
            $table->string('nat_num')->nullable()->comment("National Number");
            $table->boolean('gender');
            $table->string('allergies')->comment("الحساسيات");
            $table->date('birth_date')->nullable()->comment("Date Of Birth");
            $table->timestamps();
        });

        Schema::create('diseases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("patient_id");

            $table->foreign("patient_id")
                ->references('id')
                ->on('patients')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('treatment')->nullable();
            $table->boolean('chronic')->comment("مرض مزمن");
            $table->timestamps();
        });

        Schema::create('patients_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("patient_id");

            $table->foreign("patient_id")
                ->references('id')
                ->on('patients')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('url')->nullable();
            $table->string('extention')->nullable();
            $table->date("check_date")->default("");
            $table->string("size")->default("");
            $table->string("type")->default("");

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
        Schema::dropIfExists('patients');
        Schema::dropIfExists('diseases');
        Schema::dropIfExists('patients_files');
    }
};
