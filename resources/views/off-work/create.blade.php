
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Off Work') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>                                    
                                @endforeach
                            </ul>
                        </div>
                        
                    @endif
                    <form method="POST" action="{{ route('off-works.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="employee_id" class="col-md-4 col-form-label text-md-right">{{ __('Employee') }}</label>

                            <div class="col-md-6">
                                <select name="employee_id" id="employee_id" class="form-control @error('employee_id') is-invalid @enderror" value="{{ old('employee_id') }}" autofocus>
                                    <option value="" selected disabled>Choose Employee</option>
                                    @if (auth()->user()->role_id == \App\Models\Role::KARYAWAN)
                                        <option value="{{ auth()->user()->id }}" selected>{{ auth()->user()->name }}</option>
                                    @else
                                        @foreach ($employes as $employe)
                                            <option value="{{ $employe->id }}">( {{ $employe->off_work_total }} Days) | {{ $employe->name }}</option>
                                        @endforeach
                                    @endif
                                </select>

                                @error('employee_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description"  required autocomplete="description" autofocus>{{ old('description') }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
{{-- 
                        <div class="form-group row">
                            <label for="date_range" class="col-md-4 col-form-label text-md-right">{{ __('Date Range') }}</label>

                            <div class="col-md-6">
                                <input id="date_range" type="text" class="form-control @error('date_range') is-invalid @enderror" name="date_range" value="{{ old('date_range') }}" required autocomplete="date_range">

                                @error('date_range')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}
                        
                        <div class="form-group row">
                            <label for="date_start" class="col-md-4 col-form-label text-md-right">{{ __('Date Start') }}</label>

                            <div class="col-md-6">
                                <input id="date_start" type="date" class="form-control @error('date_start') is-invalid @enderror" name="date_start" value="{{ $offWork->date_start ??  old('date_start') }}" required autocomplete="date_start">

                                @error('date_start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_end" class="col-md-4 col-form-label text-md-right">{{ __('Date End') }}</label>

                            <div class="col-md-6">
                                <input id="date_end" type="date" class="form-control @error('date_end') is-invalid @enderror" name="date_end" value="{{ $offWork->date_end ??  old('date_end') }}" required autocomplete="date_end">

                                @error('date_end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        @if (auth()->user()->role_id != \App\Models\Role::KARYAWAN)
                        <div class=" row">
                            <label for="" class="col-md-4">&nbsp;</label>
                            <div class="form-check col-md-6">
                                <input type="hidden" name="accepted_by" value="{{ auth()->user()->id }}" />
                                <input id="accepted_at" type="checkbox" class=" @error('accepted_at') is-invalid @enderror" name="accepted_at" value="{{ old('accepted_at') ?? 1}}" autocomplete="accepted_at" checked>
                                <label for="accepted_at" class="  ">{{ __('Accept This Off Work') }}</label>
    
                                @error('accepted_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @error('accepted_by')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <br>
                        @endif


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $('input[name="date_range"]').daterangepicker();
</script>

@endsection


@push('scripts')
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    
@endpush