@extends('admin.dashboard.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">پاسخ ها</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">پاسخ ها</li>
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
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">پیام های ارسال شده در این تیکت</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-7">
                                    <form>
                                        <div class="form-group">
                                            <label for="service">{{ __('فرستنده') }}</label>
                                            <input id="service" class="form-control" type="text" readonly
                                                   value="{{ __($ticket['customer']) }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="service">{{ __('سرویس') }}</label>
                                            <input id="service" class="form-control" type="text" readonly
                                                   value="{{ __($ticket['service']) }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="department" class="form-label">{{ __('دپارتمان') }}</label>
                                            <input id="department" class="form-control"
                                                   value="{{ __($ticket['department']) }}" type="text"
                                                   readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject" class="form-label">{{ __('موضوع') }}</label>
                                            <input id="subject" class="form-control" type="text" readonly
                                                   value="{{ __($ticket['subject']) }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="content" class="form-label">{{ __('متن') }}</label>
                                            <textarea id="content" name="content" class="form-control" rows="3"
                                                      readonly>
                                                {{ __($ticket['content']) }}
                                            </textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            پاسخ ها
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        @foreach($replies as $reply)
                                            <div class="row {{ __($reply['justify']) }}">
                                                <div class="col-lg-6">
                                                    <div class="card card-secondary">
                                                        <div class="reply-header">
                                                            <h5 class="reply-title">
                                                                {{ __($reply['sender']->name) }}
                                                            </h5>
                                                        </div>
                                                        <div class="reply-body">
                                                            {{ __($reply['content']) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
