<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kriteria', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('kode'); // Column for the criteria code
            $table->string('nama_kriteria'); // Column for the criteria name
            $table->enum('atribut', ['cost', 'benefit']); // Column for the attribute type (either 'cost' or 'benefit')
            $table->enum('bobot', ['1', '2', '3', '4', '5']); // Column for the weight of the criteria
            $table->timestamps(); // Laravel-managed created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kriteria'); // Drops the table if it exists
    }
}
