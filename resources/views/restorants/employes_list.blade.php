@extends('layouts.app', ['title' => __('Orders')])
@section('admin_title')
   Empleados
@endsection


 @section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>


    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <!-- Order Card -->
                                <div class="card shadow">
                                    <div class="card-header border-0">
                                       
                                        <form method="GET">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <h3 class="mb-0">Lista de Empleados</h3>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <a href="{{ url('new/employ/register') }}" class="btn btn-success btn-sm order-action">Nuevo Empleado</a>
                                                </div>
                                            </div>
                                            <br/>
                                   
                                        </form>
                                     
                                    </div>
                                    <div class="col-12">
                                        @include('partials.flash')
                                    </div>
                                    @if(count($drivers))
                                    <div class="table-responsive">
                                        <table class="table align-items-center">
                                       
                                                             <thead class="thead-light">
                                                                <tr>
                                                                    <th scope="col">{{ __('ID') }}</th>

                                                                  
                                                                    <th class="table-web" scope="col">Nombre</th>
                                                                    <th class="table-web" scope="col">Estado</th>
                                                                  
                                                                   
                                                                    <th scope="col">{{ __('Actions') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($drivers as $driver)
                                                                <tr>
                                                                    <td>

                                                                        <a class="btn badge badge-success badge-pill">#{{ $driver->id }}</a>
                                                                    </td>
                                                          

                                                                 
                                                                    <td class="table-web">
                                                                        {{$driver->name}}
                                                                    </td>
                                                                    <td class="table-web">
                                                                        @if($driver->active == 1)
                                                                          Activo
                                                                        @else
                                                                       Desactivado
                                                                           @endif
                                                                    </td>
                                                                           <td class="table-web">
                                                                     @if($driver->active == 1)
                                                                                     <a href="{{ url('employ/updatestatus/0/'.$driver->id ) }}" class="btn btn-danger btn-sm order-action">Desactivar</a>
                                                                                @else
                                                                                       <a href="{{ url('employ/updatestatus/1/'.$driver->id ) }}" class="btn btn-success btn-sm order-action">Activar</a>
                                                                              
                                                                                @endif
                                                                    </td>
                                                                               
                                                                            </tr>
                                                                @endforeach
                                                            </tbody>

                               
                                        </table>
                                    </div>
                                         @else
                                     <p>Aun no cuenta con empleados</p>
                                    @endif
                                    <div class="card-footer py-4">
                                      
                                    </div>
                                </div>
        
            </div>
        </div>
        @include('layouts.footers.auth')
       
    </div>


@endsection




