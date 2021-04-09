@extends('layouts.app', ['title' => __('Payment Method')])

@section('content')
    @include('users.partials.header', [
        'title' => "",
    ])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Edit Payment Method') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('paymentMethod.update', $pm->id ) }}" autocomplete="off">
                            @csrf
                            @method('put')


                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <input type="text" name="user_id"  value="{{ Auth()->user()->id }}" hidden>


                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ $pm->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-phone">{{ __('Type') }}</label>
<br>
                                    <select name="type"  id="type" class="form-control form-control-alternative{{ $errors->has('type') ? ' is-invalid' : '' }}"  required>
                                        <option value="{{ $pm->type }}">{{ $pm->type }}</option>
                                        <option value="pago movil">Pago Movil</option>
                                        <option value="Zelle">Zelle</option>
                                        <option value="Dash">Dash</option>
                                    </select>


                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('desc') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Description') }}</label>
                                    <textarea  name="desc" id="input-email" class="form-control form-control-alternative{{ $errors->has('desc') ? ' is-invalid' : '' }}" placeholder="{{ __('Add the description for the payment method: number account, id, telephone etc. all the specification for this payment') }}"  required>{{ $pm->desc }}</textarea>

                                    @if ($errors->has('desc'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('desc') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection

@section('js')
    <script>
        $('#loadbtn').hide();
        $('#close_acc_btn').on('click', function() {
            if (confirm('{{ __("Are you sure you want to cancel the account and all their data?") }}')) {
                this.parentElement.submit();
                $('#loadbtn').show();
            } else {
                return false;
            }
        });
    </script>
@endsection
