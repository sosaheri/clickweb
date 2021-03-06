<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">



        @yield('title')
        <title>{{ config('app.name', 'FoodTiger') }}</title>

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('custom') }}/css/custom.css" rel="stylesheet">
        <!-- Select2 -->
        <link type="text/css" href="{{ asset('custom') }}/css/select2.min.css" rel="stylesheet">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{{ asset('vendor') }}/jasny/css/jasny-bootstrap.min.css">
        <!-- Flatpickr datepicker -->
        <link rel="stylesheet" href="{{ asset('vendor') }}/flatpickr/flatpickr.min.css">

         <!-- Font Awesome Icons -->
        <link href="{{ asset('argonfront') }}/css/font-awesome.css" rel="stylesheet" />

        <!-- Range datepicker -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


        {{-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css">



        @yield('head')
        @laravelPWA

        <!-- Custom CSS defined by admin -->
        <link type="text/css" href="{{ asset('byadmin') }}/back.css" rel="stylesheet">

<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"
/>


    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @if(\Request::route()->getName() != "order.success")
                @include('layouts.navbars.sidebar')
            @endif
        @endauth

        <div class="main-content">
            @include('layouts.navbars.navbar')
            @yield('content')
        </div>

        @guest()
            @include('layouts.footers.guest')
        @endguest

        <!-- Commented because navtabs includes same script -->
        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>

        <script src="{{ asset('argonfront') }}/js/core/popper.min.js" type="text/javascript"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        @yield('topjs')

        <!-- Navtabs -->
        <script src="{{ asset('argonfront') }}/js/core/jquery.min.js" type="text/javascript"></script>


        <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

        <!-- Nouslider -->
        <script src="{{ asset('argon') }}/vendor/nouislider/distribute/nouislider.min.js" type="text/javascript"></script>

        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="{{ asset('vendor') }}/jasny/js/jasny-bootstrap.min.js"></script>
        <!-- Custom js -->
        <script src="{{ asset('custom') }}/js/orders.js"></script>
         <!-- Custom js -->
        {{-- <script src="{{ asset('custom') }}/js/mresto.js"></script> --}}
        <!-- AJAX -->

        <!-- SELECT2 -->
        {{-- <script src="{{ asset('custom') }}/js/select2.js"></script> --}}
        <script src="{{ asset('vendor') }}/select2/select2.min.js"></script>

        <!-- DATE RANGE PICKER -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <!-- All in one -->
        {{-- <script src="{{ asset('custom') }}/js/js.js?id={{ config('config.version')}}"></script> --}}




         <!-- Import Vue -->
        <script src="{{ asset('vendor') }}/vue/vue.js"></script>

        <!-- Import AXIOS --->
        <script src="{{ asset('vendor') }}/axios/axios.min.js"></script>

        <!-- Flatpickr datepicker -->
        <script src="{{ asset('vendor') }}/flatpickr/flatpickr.js"></script>

        <!-- Notify JS -->
        <script src="{{ asset('custom') }}/js/notify.min.js"></script>


        <script>
            var ONESIGNAL_APP_ID = "{{ config('settings.onesignal_app_id') }}";
            var USER_ID = '{{  auth()->user()&&auth()->user()?auth()->user()->id:"" }}';
            var PUSHER_APP_KEY = "{{ config('broadcasting.connections.pusher.key') }}";
            var PUSHER_APP_CLUSTER = "{{ config('broadcasting.connections.pusher.options.cluster') }}";
        </script>

        <!-- OneSignal -->
        @if(strlen( config('settings.onesignal_app_id'))>4)
            <script src="{{ asset('vendor') }}/OneSignalSDK/OneSignalSDK.js" async=""></script>
            <script src="{{ asset('custom') }}/js/onesignal.js"></script>
        @endif

        @stack('js')
        @yield('js')

        <script src="{{ asset('custom') }}/js/rmap.js"></script>

         <!-- Pusher -->
         @if(strlen( config('broadcasting.connections.pusher.app_id'))>2)
            <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
            <script src="{{ asset('custom') }}/js/pusher.js"></script>


        @endif


{{-- <script src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"></script> --}}
{{-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>



                        <script type="text/javascript">

                                var minDate, maxDate, cminDate, cmaxDate;

                                $.fn.dataTable.ext.search.push(
                                    function( settings, data, dataIndex ) {
                                        var min = minDate.val();
                                        var max = maxDate.val();
                                        var date = new Date( data[2]) || 0;

                                        if (
                                            ( min === null && max === null ) ||
                                            ( min === null && date <= max ) ||
                                            ( min <= date   && max === null ) ||
                                            ( min <= date   && date <= max )
                                        ) {
                                            return true;
                                        }
                                        return false;
                                    }
                                );

                                $.fn.dataTable.ext.search.push(
                                    function( settings, data, dataIndex ) {
                                        var min = cminDate.val();
                                        var max = cmaxDate.val();
                                        var date = new Date( data[3]) || 0;

                                        if (
                                            ( min === null && max === null ) ||
                                            ( min === null && date <= max ) ||
                                            ( min <= date   && max === null ) ||
                                            ( min <= date   && date <= max )
                                        ) {
                                            return true;
                                        }
                                        return false;
                                    }
                                );

                                $.fn.dataTable.ext.search.push(
                                    function( settings, data, dataIndex ) {
                                        var min = rminDate.val();
                                        var max = rmaxDate.val();
                                        var date = new Date( data[2]) || 0;

                                        if (
                                            ( min === null && max === null ) ||
                                            ( min === null && date <= max ) ||
                                            ( min <= date   && max === null ) ||
                                            ( min <= date   && date <= max )
                                        ) {
                                            return true;
                                        }
                                        return false;
                                    }
                                );



                             $(document).ready(function() {
                                  // Create date inputs
                                minDate = new DateTime($('#min'), {
                                    format: 'MMMM Do YYYY'
                                });

                                maxDate = new DateTime($('#max'), {
                                    format: 'MMMM Do YYYY'
                                });

                                cminDate = new DateTime($('#cmin'), {
                                    format: 'MMMM Do YYYY'
                                });

                                cmaxDate = new DateTime($('#cmax'), {
                                    format: 'MMMM Do YYYY'
                                });


                                rminDate = new DateTime($('#rmin'), {
                                    format: 'MMMM Do YYYY'
                                });

                                rmaxDate = new DateTime($('#rmax'), {
                                    format: 'MMMM Do YYYY'
                                });

                                dTable = $('#drivers_table').DataTable({
                                    "processing": true,
                                    "serverSide": false,
                                    "ajax": "{{ route('datatable.drivers') }}",
                                    "columns": [
                                        {orderable: true, data: 'name', name: 'name'},
                                        {orderable: true, data: 'email', name: 'email'},
                                        {data: 'created_at', name: 'created_at'},
                                        {
                                            orderable: false,
                                            data: null,
                                            render: function (data, type, row) {
                                                return '<button onclick=\'window.location="{{ url("/drivers/") }}/'+ row.id + '/edit'+ '"\' class="btn btn-info btn-sm"></i><span>Ver</span></button>'
                                            }
                                        }

                                    ],
                                    "responsive": true,
                                    "language": {
                                        "sProcessing":    "Procesando...",
                                        "sLengthMenu":    "Mostrar _MENU_ registros",
                                        "sZeroRecords":   "No se encontraron resultados",
                                        "sEmptyTable":    "Ning??n dato disponible en esta tabla",
                                        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
                                        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                                        "sInfoPostFix":   "",
                                        "sSearch":        "Filtra por cualquier campo:",
                                        "sUrl":           "",
                                        "sInfoThousands":  ",",
                                        "sLoadingRecords": "Cargando...",
                                        "oPaginate": {
                                            "sFirst":    "Primero",
                                            "sLast":    "??ltimo",
                                            "sNext":    "Siguiente",
                                            "sPrevious": "Anterior"
                                        },
                                        "oAria": {
                                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                        }
                                    },
                                    "bLengthChange": true,

                                })
                                .columns.adjust();

                                cTable = $('#clients_table').DataTable({
                                    "processing": true,
                                    "serverSide": false,
                                    "ajax": "{{ route('datatable.clients') }}",
                                    "columns": [
                                        {orderable: true, data: 'name', name: 'name'},
                                        {orderable: true, data: 'name', name: 'name'},
                                        {orderable: true, data: 'email', name: 'email'},
                                        {data: 'created_at', name: 'created_at'},
                                        {
                                            orderable: false,
                                            data: null,
                                            render: function (data, type, row) {
                                                return '<button onclick=\'window.location="{{ url("/clients/") }}/'+ row.id + '/edit'+ '"\' class="btn btn-info btn-sm"></i><span>Ver</span></button>'
                                            }
                                        }

                                    ],
                                    "responsive": true,
                                    "language": {
                                        "sProcessing":    "Procesando...",
                                        "sLengthMenu":    "Mostrar _MENU_ registros",
                                        "sZeroRecords":   "No se encontraron resultados",
                                        "sEmptyTable":    "Ning??n dato disponible en esta tabla",
                                        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
                                        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                                        "sInfoPostFix":   "",
                                        "sSearch":        "Filtra por cualquier campo:",
                                        "sUrl":           "",
                                        "sInfoThousands":  ",",
                                        "sLoadingRecords": "Cargando...",
                                        "oPaginate": {
                                            "sFirst":    "Primero",
                                            "sLast":    "??ltimo",
                                            "sNext":    "Siguiente",
                                            "sPrevious": "Anterior"
                                        },
                                        "oAria": {
                                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                        }
                                    },
                                    "bLengthChange": true,

                                })
                                .columns.adjust();

                                rTable = $('#restaurants_table').DataTable({
                                    "processing": true,
                                    "serverSide": false,
                                    "ajax": "{{ route('datatable.restaurant') }}",
                                    "columns": [
                                        {orderable: true, data: 'name', name: 'name'},
                                        {
                                            orderable: false,
                                            data: null,
                                            render: function (data, type, row) {
                                                return '<img class="rounded" src="' + row.icon +'" width="50px" height="50px"></img>'

                                            }
                                        },
                                        {data: 'created_at', name: 'created_at'},
                                        {
                                            orderable: false,
                                            data: null,
                                            render: function (data, type, row) {
                                                return 'status'
                                            }
                                        },
                                        {
                                            orderable: false,
                                            data: null,
                                            render: function (data, type, row) {
                                                return '<button onclick=\'window.location="{{ url("/restaurants/") }}/'+ row.id + '/edit'+ '"\' class="btn btn-info btn-sm"></i><span>Ver</span></button>'
                                            }
                                        }




                                    ],
                                    "responsive": true,
                                    "language": {
                                        "sProcessing":    "Procesando...",
                                        "sLengthMenu":    "Mostrar _MENU_ registros",
                                        "sZeroRecords":   "No se encontraron resultados",
                                        "sEmptyTable":    "Ning??n dato disponible en esta tabla",
                                        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
                                        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
                                        "sInfoPostFix":   "",
                                        "sSearch":        "Filtra por cualquier campo:",
                                        "sUrl":           "",
                                        "sInfoThousands":  ",",
                                        "sLoadingRecords": "Cargando...",
                                        "oPaginate": {
                                            "sFirst":    "Primero",
                                            "sLast":    "??ltimo",
                                            "sNext":    "Siguiente",
                                            "sPrevious": "Anterior"
                                        },
                                        "oAria": {
                                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                                        }
                                    },
                                    "bLengthChange": true,

                                })
                                .columns.adjust();

                                // Refilter the table
                                $('#min, #max').on('change', function () {
                                    dTable.draw();
                                });

                                $('#cmin, #cmax').on('change', function () {
                                    cTable.draw();
                                });

                                $('#rmin, #rmax').on('change', function () {
                                    rTable.draw();
                                });


                            });

                        </script>





        <!-- Custom JS defined by admin -->
        <?php echo file_get_contents(base_path('public/byadmin/back.js')) ?>
    </body>
</html>
