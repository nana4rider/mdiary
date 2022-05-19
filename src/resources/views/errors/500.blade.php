@extends(Auth::check() ? 'layouts.auth' : 'layouts.guest')

@section('title', '500 Internal Server Error')

@section('content')
    @if(Auth::guest())
        <h1 class="page-header">@yield('title')</h1>
    @endif

    <div class="row">
        <div class="col-md-12">
            <p></p>

            <p><img src="{{ url('img/error.png') }}" alt="sorry" class="img-responsive"></p>
        </div>
    </div>
@endsection
