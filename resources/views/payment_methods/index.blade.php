@extends('layouts.app', ['title' => __('Payment Methods')])
@section('admin_title')
    {{__('Payment Method')}}
@endsection
@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    </div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Payment Methods') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('paymentMethod.create') }}" class="btn btn-sm btn-primary">{{ __('Add Payment Method') }}</a>

                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        @include('partials.flash')
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Name') }}</th>
                                     <th scope="col">{{ __('Type') }}</th>
                                    <th scope="col">{{ __('Description') }}</th>
                                    <th scope="col">{{ __('State') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($pm as $item)
                                    <tr>

                                        <td> <a href="{{ route('paymentMethod.show', $item->id ) }}">{{ $item->name }} </a></td>
                                         <td>{{   $item->type }}</td>
                                        <td>{{   $item->desc }}</td>

                                        <td>
                                           @if($item->status == 1)
                                                <span class="badge badge-success">{{ __('Active') }}</span>
                                           @else
                                                <span class="badge badge-warning">{{ __('Not active') }}</span>
                                           @endif
                                        </td>
                                        <td>

                                        <form action="{{ route('paymentMethod.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-icon btn-1 btn-sm btn-danger" type="button" onclick="confirm('{{ __("Are you sure you want to delete this Payment Method?") }}') ? this.parentElement.submit() : ''" data-toggle="tooltip" data-placement="top" title="{{ __('Delete') }} {{$item->name}}">
                                                <span class="btn-inner--icon"><i class="fa fa-trash"></i></span>
                                            </button>
                                        </form>



                                            </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $pm->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
