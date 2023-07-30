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
        Schema::create('smtp_configs', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('ref_id');
            $table->string('provider_name');
            $table->string('mailler');
            $table->string('port');
            $table->string('host');
            $table->string('encryption');
            $table->string('sending_limit');
            $table->string('username');
            $table->string('password');
            $table->string('status');
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
        Schema::dropIfExists('smtp_configs');
    }
};
