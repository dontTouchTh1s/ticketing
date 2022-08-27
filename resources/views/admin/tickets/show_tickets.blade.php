
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($tickets as $ticket)
            <div class="card">
                <div class="card-header">{{ __($ticket->subject) }}</div>

                <div class="card-body">
                    {{ __($ticket->content) }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
