<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculateSalaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculate_salary', function (Blueprint $table) {
            $table->id();
            $table->integer('input_id')->nullable()->comment('ID из таблицы входящих данных');
            $table->string('ipn')->nullable()->comment('Индивидуальный подоходный налог');
            $table->string('opv')->nullable()->comment('Обязательные пенсионные взносы');
            $table->string('osms')->nullable()->comment('Обязательное социальное медицинское страхование');
            $table->string('vosms')->nullable()->comment('Взносы на обязательное социальное медицинское Страхование');
            $table->string('so')->nullable()->comment('Социальные отчисления');
            $table->string('zp')->nullable()->comment('Заработная плата');
            $table->string('zpn')->nullable()->comment('Заработная плата на руки');
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
        Schema::dropIfExists('calculate_salary');
    }
}
