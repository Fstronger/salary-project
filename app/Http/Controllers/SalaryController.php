<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalculateRequest;
use App\Models\CalculateSalary;
use App\Models\InputSalary;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class SalaryController extends Controller
{
    /**
     * @var Repository|Application|mixed
     * Месячный расчетный показатель из конфиг файла (Натстраивается в .env файле)
     */
    private $mrp;
    /**
     * @var Repository|Application|mixed
     * Минимальная заработная плата из конфиг файла (Натстраивается в .env файле)
     */
    private $mzp;

    public function __construct()
    {
        $this->mrp = config('salary.mrp');
        $this->mzp = config('salary.mzp');
    }

    /**
     * Display a listing of the resource.
     *
     * @param CalculateRequest $request
     * @return array[]|Application|Factory|View
     */
    public function calculate(CalculateRequest $request)
    {
        //Оклад
        $salary = $request->salary_tg;

        //Норма дней в месяц
        $norm_day = $request->norm_day;

        //Отработанное количество дней
        $worked_day = $request->worked_day;

        //Имеется ли налоговый вычет 1 МЗП
        $tax_deduction = $request->tax_deduction;

        //Календарный год
        $year = $request->year;

        //Календарный месяц
        $months = $request->months;

        //Является ли сотрудник пенсионером
        $pensioner = $request->pensioner;

        //Является ли сотрудник инвалидом, если да, то какой группы.
        $disabled_person = $request->disabled_person;

        //Обязательные пенсионные взносы
        $OPV = $salary * 0.1;

        //Обязательное социальное медицинское страхование
        $OSMS = $salary * 0.02;

        //Взносы на обязательное социальное медицинское Страхование
        $VOSMS = $salary * 0.02;

        //Социальные отчисления
        $SO = ($salary - $OPV) * 0.035;

        //Проверяем МЗП есть отчисления или нет
        $mzp_1 = $tax_deduction ? $this->mzp : 0;

        //Проверка корректировки если ЗП меньше 25 МРП
        $correct = $salary < $this->mrp * 25 ? ($salary - $OPV - $mzp_1 - $VOSMS) * 0.9 : 0;

        //Обязательные пенсионные взносы для инвалидов III группы проверяем
        $OPV_disabled_person = $disabled_person === 3 ? $OPV : 0;

        //Проверяем если у инвалида ЗП выше чем 882 МРП то начисляем ему ИПН
        $IPN_disabled_person = $salary > $this->mrp * 882 && $disabled_person !== 0 ? ($salary - $OPV_disabled_person - $mzp_1 - 0 - $correct) * 0.1 : 0 ;

        //Считаем ИПН обычного пользователя
        $IPN = ($salary - $OPV - $mzp_1 - $VOSMS - $correct) * 0.1;

        //Массив для вывода данных
        $data = [
            'IPN' => $IPN,
            'OPV' => $OPV,
            'OSMS' => $OSMS,
            'VOSMS' => $VOSMS,
            'SO' => $SO,
            'ZP' => $salary,
            'ZPn' => $salary - $IPN - $OPV - $VOSMS
        ];

        //Если пенсионер переписываем массив вывода данных
        if ($pensioner) {
            $IPN = ($salary - 0 - $mzp_1 - 0 - $correct) * 0.1;
            $data = [
                'IPN' => $IPN,
                'OPV' => 0,
                'OSMS' => 0,
                'VOSMS' => 0,
                'SO' => 0,
                'ZP' => $salary,
                'ZPn' => $salary - $IPN
            ];

            //Если пенсионер и инвалид какой либо группы то переписываем массив делаем его без налогов
            if ($disabled_person != 0) {
                $data = [
                    'IPN' => 0,
                    'OPV' => 0,
                    'OSMS' => 0,
                    'VOSMS' => 0,
                    'SO' => 0,
                    'ZP' => $salary,
                    'ZPn' => $salary
                ];
            }
        }

        //Проверяем если первой или второй группы инвалид то массив переписываем
        if ($disabled_person == 1 || $disabled_person == 2) {
            $data = [
                'IPN' => $IPN_disabled_person,
                'OPV' => 0,
                'OSMS' => 0,
                'VOSMS' => 0,
                'SO' => $SO,
                'ZP' => $salary,
                'ZPn' => $salary
            ];
        }

        //Проверяем если инвалид третьей группы то переписываем массив
        if ($disabled_person == 3) {
            $data = [
                'IPN' => $IPN_disabled_person,
                'OPV' => $OPV,
                'OSMS' => 0,
                'VOSMS' => 0,
                'SO' => $SO,
                'ZP' => $salary,
                'ZPn' => $salary - $OPV - $IPN_disabled_person
            ];
        }

        //Входящий парамент save определяет откуда пришел запрос, если запрос пришел с AJAX (0) тогда просто показываем результат
        if ($request->input('save') == 0) {
            return ['data' => $data];
        }

        //Сохраняем входящие значения
        $input_salary = new InputSalary();

        $input_salary->salary_tg = $salary;
        $input_salary->norm_day = $norm_day;
        $input_salary->worked_day = $worked_day;
        $input_salary->tax_deduction = $tax_deduction;
        $input_salary->year = $year;
        $input_salary->months = $months;
        $input_salary->pensioner = $pensioner;
        $input_salary->disabled_person = $disabled_person;

        if ($input_salary->save()){
            //Сохраняем результат калькуляции
            $calculate_salary = new CalculateSalary();

            $calculate_salary->input_id = $input_salary->id;
            $calculate_salary->ipn = $data['IPN'];
            $calculate_salary->opv = $data['OPV'];
            $calculate_salary->osms = $data['OSMS'];
            $calculate_salary->vosms = $data['VOSMS'];
            $calculate_salary->so = $data['SO'];
            $calculate_salary->zp = $data['ZP'];
            $calculate_salary->zpn = $data['ZPn'];

            $calculate_salary->save();
        }

        //передаем в сессию введеные данные пользователя
        session()->flashInput($request->input());

        return view('welcome', ['data' => $data]);

    }

}
