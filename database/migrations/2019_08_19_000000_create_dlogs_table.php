<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDlogsTable extends Migration
{
    public function up()
    {
        Schema::create('dlogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("ip");
            $table->string('url');
            $table->string('method')->index();
            $table->longText('header')->nullable();
            $table->longText('request')->nullable();
            $table->longText('response')->nullable();
            $table->decimal('duration', 6, 4);
            $table->string('status',10);
            $table->string('controller');
            $table->string('action');
            $table->string('models');
            $table->string('exception')->nullable();
            $table->enum('result', ['success', 'error'])->default('success');
            $table->timestamps();

            $table->index('created_at');
        });
    }
    public function down()
    {
        Schema::dropIfExists('dlogs');
    }
}