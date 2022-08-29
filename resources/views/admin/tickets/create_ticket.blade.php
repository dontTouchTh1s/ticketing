@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
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
            <div class="col-md-8">

                <form action="{{ route('ticket.store') }}" method="POST">
                    @csrf
                    <div class="col-md-4">
                        <label for="service" class="form-label">{{ __('Service') }}</label>
                        <select id="service" name="service_id" class="form-control">
                            <option value="" disabled selected>{{ __('Select service ...') }}</option>
                            @foreach($services as $service)
                                <option value="{{ __($service['id']) }}">{{ __($service['title']) }}</option>
                            @endforeach
                        </select>
                        <label for="department" class="form-label">{{ __('Department') }}</label>
                        <select id="department" name="department_id" class="form-control">
                            <option value="" disabled selected>{{ __('Select Department ...') }}</option>
                            @foreach($departments as $department)
                                <option value="{{ __($department['id']) }}">{{ __($department['name']) }}</option>
                            @endforeach
                        </select>
                        <label for="subject" class="form-label">{{ __('Subject') }}</label>
                        <input id="subject" name="subject" class="form-control" type="text" >
                        <label for="content" class="form-label">{{ __('Content') }}</label>
                        <textarea id="content" name="content" class="form-control"></textarea>

                        <button type="submit" class="btn btn-primary mt-8">
                            Create
                        </button>
                    </div>

                </form>

            </div>
        </>
    </div>
@endsection
