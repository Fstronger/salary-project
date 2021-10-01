<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputSalaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_salary', function (Blueprint $table) {
            $table->id();
            $table->string('salary_tg')->nullable()->comment('Оклад');
            $table->string('norm_day')->nullable()->comment('Норма дней в месяц');
            $table->string('worked_day')->nullable()->comment('Отработанное количество дней');
            $table->string('tax_deduction')->nullable()->comment('Имеется ли налоговый вычет 1 МЗП');
            $table->string('year')->nullable()->comment('Календарный год');
            $table->string('months')->nullable()->comment('Календарный месяц');
            $table->string('pensioner')->nullable()->comment('Является ли сотрудник пенсионером');
            $table->string('disabled_person')->nullable()->comment('Является ли сотрудник инвалидом, если да, то какой группы.');
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
        Schema::dropIfExists('input_salary');
    }
}
