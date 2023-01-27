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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('cust_id');
            $table->string('fname');
            $table->string('mob_no')->unique();
            $table->string('otp')->nullable();
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
        Schema::dropIfExists('students');
    }
};


// https://urlsdemo.xyz/ibc-telecom/

// ---------Database--------
// u148312424_ibctelecom
// u148312424_ibctelecom
// b3=W$V#Q&d3

// --------FTP--------
// ftp.urlsdemo.xyz
// u148312424.ibctelecom
// aG0*0p185yUX
