<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}">

        <title>salary-project.loc</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <form action="{{ route('salary.calculate') }}" id="calculate_form" method="POST">
                    <input type="hidden" name="save" value="1">
                    <div id="error" style="display: none">
                        <b style="color: red">???????????? ??????????????????, ?????????????????? ???????????? ?? ???????????????????? ?????? ??????</b>
                    </div><br>

                    @if($errors->any())
                        {!! implode('', $errors->all('<div>:message</div>')) !!}
                        <br>
                    @endif
                    {{ csrf_field() }}
                    <div>
                        <label for="salary_tg">?????????? ?? ??????????<br>
                            <input required style="width: 100%;" type="text" id="salary_tg" name="salary_tg" value="{{old('salary_tg') ?: ''}}" placeholder="?????????? ?? ??????????">
                        </label>
                    </div>
                    <div>
                        <label for="norm_day">?????????? ???????? ?? ?????????? (???????????? 22)<br>
                            <input required style="width: 100%;" type="text" id="norm_day" name="norm_day" value="{{old('norm_day') ?: '22'}}" placeholder="22">
                        </label>
                    </div>
                    <div>
                        <label for="worked_day">???????????????????????? ???????????????????? ????????<br>
                            <input required style="width: 100%;" type="text" id="worked_day" name="worked_day" value="{{old('worked_day') ?: ''}}" placeholder="???????????????????????? ???????????????????? ????????">
                        </label>
                    </div>
                    <div>
                        <label for="tax_deduction">?????????????? ???? ?????????????????? ?????????? 1 ??????<br>
                            <select required style="width: 100%;" id="tax_deduction" name="tax_deduction">
                                <option selected disabled>???????????????? ????????????????</option>
                                <option value="0">???? ??????????????</option>
                                <option value="1">??????????????</option>
                            </select>
                        </label>
                    </div>
                    <div>
                        <label for="year">?????????????????????? ??????<br>
                            <select required style="width: 100%;"  id="year" name="year">
                                <option selected disabled>???????????????? ??????</option>
                                @for($year = config('salary.years.min'); $year <= config('salary.years.max'); $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </label>
                    </div>
                    <div>
                        <label for="months">?????????????????????? ??????????<br>
                            <select required style="width: 100%;" id="months" name="months">
                                <option selected disabled>???????????????? ??????????</option>
                                @foreach(config('salary.months') as $val => $month)
                                    <option value="{{ $val }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div>
                        <label for="pensioner">???????????????? ???? ?????????????????? ??????????????????????<br>
                            <select required style="width: 100%;" id="pensioner" name="pensioner">
                                <option selected disabled>???????????????? ????????????????</option>
                                <option value="0">???? ????????????????</option>
                                <option value="1">????????????????</option>
                            </select>
                        </label>
                    </div>
                    <div>
                        <label for="disabled_person">???????????????? ???? ?????????????????? ??????????????????, ???????? ????, ???? ?????????? ????????????.<br>
                            <select required style="width: 100%;" id="disabled_person" name="disabled_person">
                                <option selected disabled>???????????????? ????????????????</option>
                                <option value="0">???? ????????????????</option>
                                <option value="1">I ????????????</option>
                                <option value="2">II ????????????</option>
                                <option value="3">III ????????????</option>
                            </select>
                        </label>
                    </div>
                    <br>
                    <div>
                        <a href="#" id="calculate_a" style="margin-right: 250px;">???????????????? ??????????????????</a>
                        <button type="submit"> ?????????????????? </button>
                    </div>
                </form>

                <div id="success" style="display: none">
                </div>

                @if(isset($data))
                    <div id="success_post">
                        <span>?????????????????? ?????????????? ?? ??????????????????????</span><br>
                        @foreach($data as $title => $value)
                            <b>{{ $title }}:</b> {{ $value }} <br>
                        @endforeach
                    </div>
                @endif


                    <br><br>
                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Vladimir Gruzdev <a href="https://t.me/FStronger" target="_blank">@FStronger</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function()
    {
        const $form = $('#calculate_form');

        $('#calculate_a').on('click', function(e) {
            $("#success").empty()
            $("#success_post").empty()
            e.preventDefault();

            const $salary_tg = $('#salary_tg');
            const $norm_day = $('#norm_day');
            const $worked_day = $('#worked_day');
            const $tax_deduction = $('#tax_deduction');
            const $year = $('#year');
            const $months = $('#months');
            const $pensioner = $('#pensioner');
            const $disabled_person = $('#disabled_person');
            let $html = '';

            $.ajax({
                url: '/',
                type: 'POST',
                async: true,
                dataType: 'json',
                data: {
                    save: 0,
                    _token: $('meta[name="_token"]').attr('content'),
                    salary_tg: $salary_tg.val(),
                    norm_day: $norm_day.val(),
                    worked_day: $worked_day.val(),
                    tax_deduction: $tax_deduction.val(),
                    year: $year.val(),
                    months: $months.val(),
                    pensioner: $pensioner.val(),
                    disabled_person: $disabled_person.val(),
                },
                success: function(data) {
                    $("#success").css("display", "block");
                    $("#error").css("display", "none");
                    $html = '<br><span>?????????????????? ?????????????? ?????? ????????????????????</span><br>';
                    $.each( data.data, function( key, value ) {
                        $html += '<b>' + key + '</b> : ' + value + '<br>';
                    });

                    $('#success').prepend($html);

                },
                error: function() {
                    $("#success").css("display", "none");
                    $("#error").css("display", "block");
                }
            });
        });
    });
</script>
