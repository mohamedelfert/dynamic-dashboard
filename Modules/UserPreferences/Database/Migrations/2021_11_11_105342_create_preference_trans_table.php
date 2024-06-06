<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreferenceTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preference_trans', function (Blueprint $table) {
            $table->bigInteger('preference_id')->unsigned()->index();
            $table->foreign('preference_id')->references('id')->on('preferences');
            $table->integer('language_id')->unsigned()->index();
            $table->foreign('language_id')->references('id')->on('languages');
            $table->string('name');
            $table->text('description')->nullable();
            $table->jsonb('options')->nullable();
            $table->primary(['preference_id', 'language_id']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preference_trans');
    }
}
