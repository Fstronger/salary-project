<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CalculateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'salary_tg' => 'required|integer',
            'norm_day' => 'required|integer',
            'worked_day' => 'required|integer',
            'tax_deduction' => 'required|integer',
            'year' => 'required|integer',
            'months' => 'required|integer',
            'pensioner' => 'required|integer',
            'disabled_person' => 'required|integer',
        ];
    }

    /**
     * Messages for validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'salary_tg.required' => '<b>Оклад в тенге</b> не указан',
            'salary_tg.integer' => '<b>Оклад в тенге</b> должен быть целочисленным значением',

            'norm_day.required' => '<b>Норма дней в месяц</b> не указана',
            'norm_day.integer' => '<b>Норма дней в месяц должна</b> быть целочисленным значением',

            'worked_day.required' => '<b>Отработанное количество дней</b> не указано',
            'worked_day.integer' => '<b>Отработанное количество дней</b> должно быть целочисленным значением',

            'tax_deduction.required' => '<b>Имеется ли налоговый вычет 1 МЗП</b> не указан',
            'tax_deduction.integer' => '<b>Имеется ли налоговый вычет 1 МЗП</b> должен быть целочисленным значением',

            'year.required' => '<b>Календарный год</b> не указан',
            'year.integer' => '<b>Календарный год</b> должен быть целочисленным значением',

            'months.required' => '<b>Календарный месяц</b> не указан',
            'months.integer' => '<b>Календарный месяц</b> должен быть целочисленным значением',

            'pensioner.required' => '<b>Является ли сотрудник пенсионером</b> не указано',
            'pensioner.integer' => '<b>Является ли сотрудник пенсионером</b> должно быть целочисленным значением',

            'disabled_person.required' => '<b>Является ли сотрудник инвалидом, если да, то какой группы</b> не указан',
            'disabled_person.integer' => '<b>Является ли сотрудник инвалидом, если да, то какой группы</b> должен быть целочисленным значением',

        ];
    }
}
