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
                            <form class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="service">{{ __('فرستنده') }}</label>
                                            <input id="service" class="form-control" type="text" readonly
                                                   value="{{ __($ticket['customer']) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="service">{{ __('سرویس') }}</label>
                                            <input id="service" class="form-control" type="text" readonly
                                                   value="{{ __($ticket['service']) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="department" class="form-label">{{ __('دپارتمان') }}</label>
                                            <input id="department" class="form-control"
                                                   value="{{ __($ticket['department']) }}" type="text"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="subject" class="form-label">{{ __('موضوع') }}</label>
                                            <input id="subject" class="form-control" type="text" readonly
                                                   value="{{ __($ticket['subject']) }}">
                                        </div>
                                    </div>
                            </form>
                        </div>
                        <div class="card card-secondary card-replies">
                            <div class="card-header">
                                <h3 class="card-title">
                                    پاسخ ها
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-start">
                                    <div class="col-lg-12">
                                        <div class="reply">
                                            <div class="reply-header">
                                                <h5 class="reply-title">
                                                    {{ 'متن تیکت' }}
                                                </h5>
                                                <div class="dropdown">
                                                    <button class="reply-more-info dropdown-toggle"
                                                            type="button" id="dropdownMenuButton"
                                                            data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false">
                                                        ...
                                                    </button>
                                                    <div class="dropdown-menu"
                                                         aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" href="#">یچیزی</a>
                                                        <a class="dropdown-item" href="#">کپی</a>
                                                        <a class="dropdown-item report-reply" href="#"
                                                           data-toggle="modal"
                                                           data-target="#reportReplyModal">گزارش</a>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="reply-body">
                                                {{ $ticket['content'] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $lastTime = "unknow";
                                @endphp
                                @foreach($replies as $reply)
                                    @php
                                        $time = $reply['created_date'];
                                        if ($time == $lastTime)
                                            $time = "";
                                        else
                                            $lastTime = $time;
                                    @endphp
                                    <div class="time-scope">{{ $time }}</div>
                                    <div class="row {{ __($reply['justify']) }}">
                                        <div class="col-lg-6">
                                            <div class="reply" id="{{ __($reply['id']) }}">
                                                <div class="reply-header">
                                                    <h5 class="reply-title">
                                                        {{ __($reply['sender']->name) }}
                                                    </h5>
                                                    <div class="dropdown">
                                                        <button class="reply-more-info dropdown-toggle"
                                                                type="button" id="dropdownMenuButton"
                                                                data-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false">
                                                            ...
                                                        </button>
                                                        <div class="dropdown-menu"
                                                             aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#">یچیزی</a>
                                                            <a class="dropdown-item" href="#">کپی</a>
                                                            <a class="dropdown-item report-reply" href="#"
                                                               data-toggle="modal"
                                                               data-target="#reportReplyModal">گزارش</a>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="reply-body">

                                                    {!! $reply['content'] !!}

                                                </div>
                                                <div class="reply-footer">
                                                    {{ $reply['created_time'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                            <div class="add-reply">
                                <form class="add-reply" method="post" action="{{ route('replies.create') }}">
                                    @csrf
                                    <input type="hidden" name="ticket" value="{{ $ticket['id'] }}">
                                    <textarea name="content" id="editor"></textarea>


                                    <button class="btn btn-primary btn-reply-send">
                                        ارسال
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="reportReplyModal" tabindex="-1" aria-labelledby="reportReplyModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportReplyModal">گزارش</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p/>در صورت مشاهده محتوای خلاف قوانین یا مواردی که نیاز به اطلاع رسانی به مدیر دارد میتوانید از
                    این قسمت گزارش دهید.
                    <form action="{{ route('reports.create')  }}" method="POST"
                          id="modal-form">
                        @csrf

                        <input type="hidden" id="reply-id" name="reply">
                        <input type="hidden" id="ticket" name="ticket" value="{{ __($ticket['id']) }}">
                        <div class="form-group">
                            <label for="content">
                                متن گزارش
                            </label>
                            <textarea class="form-control" name="content" id="content" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>

                    <button type="submit" class="btn btn-primary" id="modal-form-submit">
                        ارسال
                    </button>

                </div>
            </div>
        </div>
    </div>
    <script src="/plugins/ckeditor/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                placeholder: 'Type the content here!',
                language: {
                    // The UI will be English.
                    ui: 'en',
                    // But the content will be edited in Arabic.
                    content: 'ar'
                },
                toolbar: ['bold', 'italic', 'bulletedList', 'numberedList'],
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection

