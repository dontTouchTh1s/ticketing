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
                                                <button class="btn btn-outline-primary col-12" data-bs-toggle="modal"
                                                        data-bs-target="#reportableInfoModal"
                                                        type="button">{{ 'مشاهده' }}</button>
                                                @csrf
                                                <input type="hidden" id="{{ $report['reportable_id'] }}"
                                                       class="reportable-id">
                                                <input type="hidden" reportable_type="{{ $report['reportable_type'] }}"
                                                       class="reportable-type">
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
                        <h5 class="modal-title" id="reportableInfoModal">محتوای گزارش شده</h5>
                        <button type="button" class="btn-close btn-close-modal" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div class="reportable-info">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>نوع متحوا</label>
                                    <p class="form-control" id="reportable-type"></p>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>فرستنده</label>
                                    <a href="#" class="form-control" id="sender-name"></a>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label>محتوا</label>
                                    <p class="form-control" id="content"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close-modal btn btn-secondary" data-bs-dismiss="modal">
                            بستن
                        </button>

                        <a href="#" class="btn btn-primary" id="modal-form-submit">
                            مشاهده کامل
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @vite(['resources/js/AJAX_request.js'])
@endsection
