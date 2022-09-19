@extends('admin.dashboard.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ trans('create_notification.page-title') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">{{ trans('create_notification.page-title') }}</li>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('create_notification.main-card-title') }}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('notifications.store') }}" method="POST">
                                @csrf
                                <label>نمایش برای</label>
                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label for="service" for="customers" for="groups">{{ __('سرویس ها') }}</label>
                                        <select id="service" name="service_id" class="form-control selectpicker"
                                                data-live-search="true">
                                            <option value="" disabled
                                                    selected>{{ __('یک سرویس انتخاب کنید ...') }}</option>
                                            @foreach($services as $service)
                                                <option
                                                    value="{{ __($service['id']) }}">{{ __($service['title']) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="service" for="customers" for="groups">{{ __('گروه ها') }}</label>
                                        <select class="selectpicker" data-live-search="true">
                                            <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
                                            <option data-tokens="mustard">Burger, Shake and a Smile</option>
                                            <option data-tokens="frosting">Sugar, Spice and all things nice</option>
                                        </select>

                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="service" for="customers" for="groups">{{ __('مشتری ها') }}</label>
                                        <select id="service" name="service_id" class="form-control">
                                            <option value="" disabled
                                                    selected>{{ __('یک سرویس انتخاب کنید ...') }}</option>
                                            @foreach($services as $service)
                                                <option
                                                    value="{{ __($service['id']) }}">{{ __($service['title']) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="service">{{ __('نوع') }}</label>
                                    <select id="service" name="service_id" class="form-control">
                                        <option value="" disabled
                                                selected>{{ __('نوع اعلان را انتخاب کنید ...') }}</option>
                                        <option value="0">{{ 'اخطار' }}</option>
                                        <option value="1">{{ 'خطر' }}</option>
                                        <option value="2">{{ 'اطلاعیه' }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="form-label">{{ __('عنوان') }}</label>
                                    <input id="title" name="title" class="form-control" type="text">
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
        </div>
    </div>
@endsection
