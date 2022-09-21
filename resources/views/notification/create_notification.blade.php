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
                <div class="col-lg-8 col-sm-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('create_notification.main-card-title') }}</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('notifications.store') }}" method="POST">
                                @csrf
                                <label>نمایش برای</label>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="tag-container">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label for="service">{{ __('سرویس ها') }}</label>
                                        <div class="search-select">
                                            <select id="service" name="services_id[]" class="form-control select-bar"
                                                    multiple>
                                                <option value="" disabled
                                                        selected>{{ __('یک سرویس انتخاب کنید ...') }}</option>
                                                @foreach($services as $service)
                                                    <option
                                                        value="{{ __($service['id']) }}">{{ __($service['title']) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-4">
                                        <label for="groups">{{ __('گروه ها') }}</label>
                                        <div class="search-select">
                                            <select id="groups" name="groups_id[]" class="form-control select-bar"
                                                    multiple>
                                                <option value="" disabled
                                                        selected>{{ __('یک گروه انتخاب کنید ...') }}</option>
                                                @foreach($groups as $group)
                                                    <option
                                                        value="{{ __($group['id']) }}">{{ __($group['title']) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-4">
                                        <label for="customers">{{ __('مشتری ها') }}</label>
                                        <div class="search-select">
                                            <select id="customers" name="customers_id[]" class="form-control select-bar"
                                                    multiple>
                                                <option value="" disabled
                                                        selected>{{ __('یک مشتری انتخاب کنید ...') }}</option>
                                                @foreach($customers as $customer)
                                                    <option
                                                        value="{{ __($customer['id']) }}">{{ __($customer['name']) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="type">{{ __('نوع') }}</label>
                                    <select id="type" name="type" class="form-control">
                                        <option value="" disabled
                                                selected>{{ __('نوع اعلان را انتخاب کنید ...') }}</option>
                                        @foreach($types as $type)
                                            <option
                                                value="{{ __($type['id']) }}">{{ __($type['title']) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="form-label">{{ __('عنوان') }}</label>
                                    <input id="title" name="title" class="form-control" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="body" class="form-label">{{ __('متن') }}</label>
                                    <textarea id="body" name="body" class="form-control" rows="5"></textarea>
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
    @vite(['resources/js/tag.js', 'resources/js/search-select.js'])
@endsection
