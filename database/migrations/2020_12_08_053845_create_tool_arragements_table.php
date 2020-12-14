<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolArragementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_arragements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tool_id')->constrained()->cascadeOnDelete();
            $table->string('table');
            $table->string('rak')->nullable();
            $table->bigInteger('qty');
            $table->string('goodCondition')->default('0')->nullable();
            $table->string('badCondition')->default('0')->nullable();
            $table->string('outTool')->nullable();
            $table->string('barcode')->default('0')->nullable();
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
        Schema::dropIfExists('tool_arragements');
    }
}
