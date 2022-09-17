@extends('admin.dashboard.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ trans('show_notification.page-title') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">{{ trans('show_notification.page-title') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-hover table-valign-middle">
                                <caption>اعلان های ایجاد شده</caption>
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">عنوان</th>
                                    <th scope="col">متن</th>
                                    <th scope="col">نوع</th>
                                    <th scope="col" class="text-center">سرویس</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($notifications as $notification)
                                    <tr>
                                        <th scope="row">{{ __($loop->index) }}</th>
                                        <td>{{ __($notification['title']) }}</td>
                                        <td>{{ __($notification['body']) }}</td>
                                        <td>{{ __($notification['type']) }}</td>

                                        <td>
                                            <div class="row">
                                                <form class="col-12"
                                                      action="{{ route('notifications.edit', $notification['id']) }}"
                                                      method="GET">
                                                    <button class="btn btn-primary"
                                                            type="submit">{{ __('مدیریت') }}</button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
