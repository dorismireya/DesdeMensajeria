<head>
    <link rel="shortcut icon" href="/img/fpva.jpg" />
    <meta charset="UTF-8">
    <title> FPVA - @yield('htmlheader_title', '') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/sweetalert.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('js/jquery/jquery-3.2.0.min.js')}}"></script>
    <script src="{{ asset('js/jquery/jquery.form.js')}}"></script>
    <script src="{{ asset('js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ asset('daterangepicker/moment.min.js')}}"></script>
    <script src="{{ asset('daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{ asset('js/tools.js')}}"></script>
    <script src="{{ asset('js/tinymce/tinymce.min.js')}}"></script>
    <script src="{{ asset('js/sweetalert/sweetalert.min.js')}}"></script>

    <!-- <script src="{{ asset('js/jquery/bootstrap.min.js')}}"></script> -->
    
    
    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <script>
        //See https://laracasts.com/discuss/channels/vue/use-trans-in-vuejs
        window.trans = @php
            // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
            $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
            $trans = [];
            foreach ($lang_files as $f) {
                $filename = pathinfo($f)['filename'];
                $trans[$filename] = trans($filename);
            }
            $trans['adminlte_lang_message'] = trans('adminlte_lang::message');
            echo json_encode($trans);
        @endphp
    </script>
</head>
