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
        Schema::create('mailler_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('ref_id');
            $table->string('group_name');
            $table->string('smtp_config');
            $table->string('job_total');
            $table->string('can_send');
            $table->string('company_name')->default("No");
            $table->string('sending_from_mail')->default("No");
            $table->string('reply_to_name')->default("No");
            $table->string('reply_to_mail')->default("No");
            $table->string('mail_content')->default("No");
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
        Schema::dropIfExists('mailler_jobs');
    }
};
