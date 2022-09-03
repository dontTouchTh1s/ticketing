@extends('admin.dashboard.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">تیکت ها</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">تیکت ها</li>
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
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">فرستنده</th>
                                    <th scope="col">موضوع</th>
                                    <th scope="col">اولویت</th>
                                    <th scope="col">سرویس</th>
                                    <th scope="col">دپارتمان</th>
                                    <th scope="col">وضعیت</th>
                                    <th class="text-center" scope="col">عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tickets as $ticket)
                                    <tr>
                                        <th>{{ __($loop->index) }}</th>
                                        <td>{{ __($ticket['customer']) }}</td>
                                        <td>{{ __($ticket['subject']) }}</td>
                                        <td>{{ __($ticket['priority']) }}</td>
                                        <td>{{ __($ticket['service']) }}</td>
                                        <td>{{ __($ticket['department']) }}</td>
                                        <td>{{ __($ticket['active']) }}</td>
                                        <td>
                                            <div class="row">
                                                <form class="col-6"
                                                      action="{{ route('tickets.manage', $ticket['id']) }}"
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
