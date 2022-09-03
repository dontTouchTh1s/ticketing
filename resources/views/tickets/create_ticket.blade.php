@extends('admin.dashboard.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">ایجاد تیکت</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">ایجاد تیکت</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-8">

                    <form action="{{ route('tickets.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="service">{{ __('سرویس') }}</label>
                            <select id="service" name="service_id" class="form-control">
                                <option value="" disabled selected>{{ __('یک سرویس انتخاب کنید ...') }}</option>
                                @foreach($services as $service)
                                    <option value="{{ __($service->id) }}">{{ __($service->title) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="department" class="form-label">{{ __('دپارتمان') }}</label>
                            <select id="department" name="department_id" class="form-control">
                                <option value="" disabled selected>{{ __('یک گزینه را انتخاب کنید ...') }}</option>
                                @foreach($departments as $department)
                                    <option value="{{ __($department->id) }}">{{ __($department->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="form-label">{{ __('موضوع') }}</label>
                            <input id="subject" name="subject" class="form-control" type="text">
                        </div>
                        <div class="form-group">
                            <label for="content" class="form-label">{{ __('متن') }}</label>
                            <textarea id="content" name="content" class="form-control" rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mt-8">
                            {{ __('ایجاد') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
