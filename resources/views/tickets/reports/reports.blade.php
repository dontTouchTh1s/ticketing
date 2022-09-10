@extends('admin.dashboard.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">گزارشات</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">گزارشات</li>
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
                                    <th scope="col">محتوای گزارش شده</th>
                                    <th scope="col">محتوا</th>
                                    <th class="text-center" scope="col">عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reports as $report)
                                    <tr>
                                        <th>{{ __($loop->index) }}</th>
                                        <td>{{ __($report['sender']->name) }}</td>
                                        <td>
                                            <div class="report-container">
                                                <!-- Open Model -->
                                                <button class="btn btn-outline-primary col-12" data-toggle="modal"
                                                        data-target="#reportableInfoModal"
                                                        type="button">{{ 'مشاهده' }}</button>
                                                <input type="hidden" id="{{ $report['reportable'] }}"
                                                       class="report-id">
                                            </div>
                                        </td>
                                        <td>{{ __($report['content']) }}</td>
                                        <td>
                                            <div class="row">
                                                <form class="col-6"
                                                      action="{{ route('tickets.manage', $report['id']) }}"
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
        <!-- Modal -->
        <div class="modal fade" id="reportableInfoModal" tabindex="-1" aria-labelledby="reportableInfoModal"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportableInfoModal">تغییر دپارتمان تیکت</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p/> برای ارجاع دادن این تیکت به یک دپارتمان دیگر دپارتمان مورد نظر را انتخاب کنید و بر روی دکمه
                        تغییر کلیک کنید.
                        <form action="{{ route('tickets.change_department')  }}" method="POST"
                              id="modal-form">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="ticket"/>
                                <label for="department"></label>
                                <select name="department" id="department" class="form-control">

                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>

                        <button type="submit" class="btn btn-primary" id="modal-form-submit">
                            تغییر
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/AJAX.js"></script>
@endsection
