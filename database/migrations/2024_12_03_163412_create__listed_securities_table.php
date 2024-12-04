<?php
// database/migrations/xxxx_xx_xx_create_listed_securities_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListedSecuritiesTable extends Migration
{
    public function up()
    {
        Schema::create('listed_securities', function (Blueprint $table) {
            $table->id();
            $table->string('stock_id');
            $table->date('Date');
            $table->decimal('S_ID');
            $table->string('symbol');
            $table->string('Name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('listed_securities');
    }
}
