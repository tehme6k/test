<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBprsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bprs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('mpr_id');
            $table->integer('lot_number')->unsigned();
            $table->integer('bottle_count')->unsigned();
            $table->integer('created_by');
            $table->integer('approved_by')->nullable();
            $table->string('status')->default('quarantine');

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
        Schema::dropIfExists('bprs');
    }
}
