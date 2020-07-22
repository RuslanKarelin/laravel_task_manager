<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_issues', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->foreignId('issue_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->index('issue_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_issues');
    }
}
