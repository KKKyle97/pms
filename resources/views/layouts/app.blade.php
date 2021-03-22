<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    {{-- google chart API --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- material icon --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    

</head>

<body>
    <main class="background">
        @include('sweetalert::alert')
        <div class="container-fluid fullscreen">
            <div class="backbone-panel content-wrapper row" style="margin-bottom:0px">
                <div class="nav-bar nav-normal">
                    @include('layouts.navbar')
                </div>
                <div class="nav-bar nav-responsive">
                    @include('layouts.navbar-res')
                </div>
                <div class="px-0 content-body">
                    @yield('content')
                </div>
            </div>
        </div>

    </main>
     <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

<script>
    // $(document).ready(function(){
        
    //     if ($('#patient-list').attr('id') == 'patient-list') {
    //         fetch_customer_data();
    //     }
        
    
    //     function fetch_customer_data(query = ''){
    //         $.ajax({
    //             url:"{{ route('patients.search') }}",
    //             method:'GET',
    //             data:{query:query},
    //             dataType:'json',
    //             success:function(data)
    //                 {
    //                     console.log('yes');
    //                     $('#search-result').html(data.table_data);
    //                     $('#total_records').text(data.total_data);
    //                 },
    //                 error: function(xhr, status, error){
    //                     var errorMessage = xhr.status + ': ' + xhr.statusText
    //                     alert('Error - ' + errorMessage);
    //                 }
    //         })
    //     }
    
    //     $(document).on('keyup', '#search', function(){
    //         var query = $(this).val();
    //         fetch_customer_data(query);
    //     });
    // });
</script>

</html>