<!DOCTYPE html>

<!--

Template Name: Enigma - HTML Admin Dashboard Template

Author: Left4code

Website: http://www.left4code.com/

Contact: muhammadrizki@left4code.com

Purchase: https://themeforest.net/user/left4code/portfolio

Renew Support: https://themeforest.net/user/left4code/portfolio

License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->

<html class="{{ $darkMode ? 'dark' : '' }}{{ $colorScheme != 'default' ? ' ' . $colorScheme : '' }}"

    lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- BEGIN: Head -->



<head>

    <meta charset="utf-8">

    <link href="{{ Vite::asset('resources/images/logo.svg') }}" rel="shortcut icon">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description"

        content="Enigma admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">

    <meta name="keywords"

        content="admin template, Enigma Admin Template, dashboard template, flat admin template, responsive admin template, web app">

    <meta name="author" content="LEFT4CODE">

    <style>

        .form-control {

            display: block !important;

            width: 100% !important;

            height: calc(1.5em + 0.9rem + 2px) !important;

            padding: 0.45rem 0.9rem !important;

            font-size: .875rem !important;

            font-weight: 400 !important;

            line-height: 1.5 !important;

            color: #6c757d !important;

            background-color: #fff !important;

            background-clip: padding-box !important;

            border: 1px solid #ced4da !important;

            border-radius: 5px !important;

            /* transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out !important; */

        }





        .btn-success {

            box-shadow: 0 0 0 rgba(68, 207, 156, .5);

        }



        .btn-success {

            color: #fff !important;

            background-color: #44cf9c !important;

            border-color: #44cf9c !important;

        }



        .btn {

            display: inline-block;

            font-weight: 400;

            color: #6c757d;

            text-align: center;

            vertical-align: middle;

            cursor: pointer;

            -webkit-user-select: none;

            -ms-user-select: none;

            user-select: none;

            background-color: transparent;

            border: 1px solid transparent;

            padding: 0.45rem 0.9rem;

            font-size: .875rem;

            line-height: 1.5;

            border-radius: 0.15rem;

            /* transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out; */

        }

        .btn-sm{

            padding: 0 12px;

        }

    </style>

    @yield('head')



    <!-- BEGIN: CSS Assets-->

    @vite('resources/css/app.css')

    @stack('styles')

    <!-- END: CSS Assets-->



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"

        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="

        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css"

        integrity="sha512-MQXduO8IQnJVq1qmySpN87QQkiR1bZHtorbJBD0tzy7/0U9+YIC93QWHeGTEoojMVHWWNkoCp8V6OzVSYrX0oQ=="

        crossorigin="anonymous" referrerpolicy="no-referrer" />



        <style>.my-active span{

            background-color: #5cb85c !important;

            color: white !important;

            border-color: #5cb85c !important;

        }

        ul.pager>li {

            display: inline-flex;

            padding: 5px;

        }</style>



</head>

<!-- END: Head -->



<body>

    @yield('content')



    @vite('resources/js/app.js')



    <!-- BEGIN: Vendor JS Assets-->

    @stack('vendors')

    <!-- END: Vendor JS Assets-->



    <!-- BEGIN: Pages, layouts, components JS Assets-->





    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>





    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"

        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="

        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"

        integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA=="

        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        @stack('scripts')

    <script>



        $('body').on('click', '.btn_add_visite', function() {

            $('.add_other_visit').append(

                '<div class="grid-cols-12 grid"><div class="col-span-6"><div class="input-form mt-3"><label>Visit Date</label><input name="visit_date[]" type="date" required="required" class="form-control"></div></div><div class="lg:col-span-2 lg:col-span-2 pt-5 mt-3"><button type="button" class="btn btn-success btn_remove_visite">Remove</button></div></div>'

                )

        });

        $('body').on('click', '.btn_remove_address', function() {

            $(this).parent().parent().remove();

        });











        $('body').on('click', '.btn_remove_visite', function() {

            $(this).parent().parent().remove();

        });

        $('.select').select2();



        $(document).ready(function() {





            // jQuery.ajax({

			// 		  url: 'ajax_function.php',

			// 		  type: "POST",

			// 		  data: 'Hidden_Get_PRC_Section=Yes',

			// 		  success:function(data){



			// 		  }

			// 		});









            $("#start-date").on("change", function() {

                // $(".add_other_visit").remove();

                $(".add_other_visit").html("");

                var month = $('#contract_type').val();

                var visit = $('#visit').val();

                month11 = parseInt(month) * 30;

                var startDate = new Date($(this).val());

                var endDate = new Date(startDate.getTime() + (month11 * 24 * 60 * 60 * 1000)).toISOString().split('T')[0];

                var day = (month / visit);

                var dmonth11 = parseInt(day) * 30;

                var day1 = (month / visit) * 30;
                var i = 1;

                $("#end-date").attr("max", endDate);

                $("#end-date").attr("value", endDate);


                var occurences = day1;
                var start_date = startDate;

                var start = "";
                for(i=1; i <= visit; i++){
                    var result = "";
                    if(start == "")
                    {
                        var result = new Date(start_date);
                    }
                    else
                    {
                        var result = new Date(start);
                    }
                    result.setDate(result.getDate() + day1);
                    var date = result;

                    var day =date.getDate();
                    var month=date.getMonth()+1;
                    var year=date.getFullYear();

                    if(day == 1)
                    {
                        day = '0'+ day;
                    }
                    else if(day == 2)
                    {
                        day = '0'+ day;
                    }
                    else if(day == 3)
                    {
                        day = '0'+ day;
                    }
                    else if(day == 4)
                    {
                        day = '0'+ day;
                    }
                    else if(day == 5)
                    {
                        day = '0'+ day;
                    }
                    else if(day == 6)
                    {
                        day = '0'+ day;
                    }
                    else if(day == 7)
                    {
                        day = '0'+ day;
                    }
                    else if(day == 8)
                    {
                        day = '0'+ day;
                    }
                    else if(day == 9)
                    {
                        day = '0'+ day;
                    }

                    if(month == 1)
                    {
                        month = '0'+ month;
                    }
                    else if(month == 2)
                    {
                        month = '0'+ month;
                    }
                    else if(month == 3)
                    {
                        month = '0'+ month;
                    }
                    else if(month == 4)
                    {
                        month = '0'+ month;
                    }
                    else if(month == 5)
                    {
                        month = '0'+ month;
                    }
                    else if(month == 6)
                    {
                        month = '0'+ month;
                    }
                    else if(month == 7)
                    {
                        month = '0'+ month;
                    }
                    else if(month == 8)
                    {
                        month = '0'+ month;
                    }
                    else if(month == 9)
                    {
                        month = '0'+ month;
                    }

                    var start = year + '-' + month + '-' + day;

                    $('.add_other_visit').append('<div class="grid-cols-12 grid"><div class="col-span-3"><label>Visit Date '+ i +' : </label> </div><div class="col-span-6"><input name="visit_date[]" type="text" required="required" readonly value="'+ start +'" class="form-control"></div><div class="col-span-3"></div>')
                }


            });



            $('.date_time').flatpickr({

                enableTime: true,

                dateFormat: "Y-m-d H:i:00",

            });

        });





        $('body').on('change', '.status', function() {

            var status = $('.status:checked').val();

            if (status == 'Assign') {

                $('.technician_id').removeClass('hidden');

            } else {

                $('.technician_id').addClass('hidden');

            }

            console.log(status);

        })

    </script>





@stack('script')

    <!-- END: Pages, layouts, components JS Assets-->

</body>



</html>

