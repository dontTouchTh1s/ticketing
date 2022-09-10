@extends('admin.dashboard.layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">مدیریت تیکت</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">مدیریت تیکت</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <p/>میتوانید تیکت را به دپارتمان دیگیری ارجاع بدهید.
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
                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">اطلاعات تیکت</h3>
                        </div>
                        <div class="card-body">
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
                                    <textarea id="content" name="content" class="form-control" rows="3" readonly>
                                        {{ __($ticket['content']) }}
                                    </textarea>
                                </div>

                                <a class="btn btn-secondary" href="{{ route('replies', $ticket['id']) }}">
                                    {{ __("مشاهده پاسخ ها") }}
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                    <div class="card card-outline">
                        <div class="card-header">
                            <h3 class="card-title">عملیات ها</h3>
                        </div>
                        <div class="card-body">
                            <p/> میتوانید تیکت را به دپارتمان دیگری ارجاع بدهید.
                            <div class="col-12">
                                <!-- Open Model -->
                                <button class="btn btn-outline-primary col-12" data-toggle="modal"
                                        data-target="#changeDepartmentModal"
                                        type="button">{{ __('تغییر دپارتمان') }}</button>
                            </div>
                        </div>

                    </div>
                    <div class="card card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                غیر فعال کردن
                            </h3>
                        </div>
                        <div class="card-body">
                            <p/>می توانید تیکت را از این قسمت غیر فعال کنید. پس از عملیات نمیتوان به تیکت پاسخ یا گزارشی
                            اضافه کرد.
                            <form action="{{ route('tickets.deactivate') }}"
                                  method="POST">
                                @method('PATCH')
                                @csrf
                                <input type="hidden" name="ticket" value="{{ __($ticket['id']) }}">
                                <button class="btn btn-outline-primary col-12"
                                        type="submit">{{ __('غیر فعال کردن') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="changeDepartmentModal" tabindex="-1" aria-labelledby="changeDepartmentModal"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changeDepartmentModal">تغییر دپارتمان تیکت</h5>
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
                                <input type="hidden" name="ticket" value="{{ __($ticket['id']) }}"/>
                                <label for="department"></label>
                                <select name="department" id="department" class="form-control">
                                    @foreach($departments as $department)
                                        @if($department['name'] == $ticket['department'])
                                            <option value="{{__($department['id'])}}" selected>
                                                {{__($department['name'])}}
                                            </option>
                                        @endif
                                        <option value="{{__($department['id'])}}">{{__($department['name'])}}</option>
                                    @endforeach
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
@endsection
