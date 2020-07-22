<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_times', function (Blueprint $table) {
            $table->id();
            $table->double('time');
            $table->unsignedBigInteger('event_id');
            $table->foreignId('issue_id')->constrained()->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('event_issues')->onDelete('cascade');
            $table->timestamps();
            $table->index('issue_id');
            $table->index('event_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issue_times');
    }
}
