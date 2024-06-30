@if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert">@php
        echo $message;
    @endphp</div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger" role="alert">@php
        echo $message;
    @endphp</div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning" role="alert">@php
        echo $message;
    @endphp</div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info" role="alert">@php
        echo $message;
    @endphp</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger" role="alert">{{ $errors->first() }}</div>
@endif
