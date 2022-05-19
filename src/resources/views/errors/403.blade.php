@extends(Auth::check() ? 'layouts.auth' : 'layouts.guest')

@section('title', '403 Forbidden')

@section('content')
    <h1 class="page-header">@yield('title')</h1>

    <div class="row">
        <div class="col-md-12">
            <p></p>

            <p><img src="{{ url('img/error.png') }}" alt="sorry" class="img-responsive"></p>
        </div>
    </div>
@endsection
