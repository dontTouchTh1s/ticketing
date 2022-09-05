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
                                <div class="col-lg-12">
                                    @foreach($replies as $reply)
                                        <div class="row {{ __($reply['justify']) }}">
                                            <div class="col-lg-6">
                                                <div class="card card-secondary">
                                                    <div class="card-header">
                                                        <h5 class="card-title">
                                                            {{ __($reply['sender']->name) }}
                                                        </h5>
                                                    </div>
                                                    <div class="card-body">
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
@endsection
