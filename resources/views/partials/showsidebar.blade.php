
@auth
    <div class="container">

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{session()->get('success')}}
            </div>
        @endif

        @if(session()->has('fail'))
            <div class="alert alert-danger">
                {{session()->get('fail')}}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{session()->get('error')}}
            </div>
        @endif

        <div class="row">
            {{--Sidebar--}}
            <div class="col-md-4">

                <ul class="list-group">

                    @if(auth()->user()->isAdmin())
                        <li class="list-group-item">
                            <a href="{{route('users.index')}}">
                                Users
                            </a>
                        </li>
                    @endif

                    <li class="list-group-item">
                        <a href="{{route('categories.index')}}">Categories</a>
                    </li>

                    <li class="list-group-item">
                        <a href="{{ route('products.index') }}">Products</a>
                    </li>

                    <li class="list-group-item">
                        <a href="{{ route('projects.index') }}">Projects</a>
                    </li>

                    <li class="list-group-item">
                        <a href="{{ route('inventories.index') }}">Inventory</a>
                    </li>

                    <li class="list-group-item">
                        <a href="{{ route('boxes.index') }}">Retention</a>
                    </li>

                </ul>

                <ul class="list-group mt-5">

                    <li class="list-group-item">
                        Trashed
                    </li>

                </ul>

            </div>
            {{--Right side--}}
            <div class="col-md-8">
                <div class="container">
                    @include('partials.errors')
                    <section class="jumbotron text-center">
                        <div class="container">
                            <h1 class="jumbotron-heading">
                                @yield('jumbotron-header')
                            </h1>
                            <h2>
                                @yield('jumbotron-under-header')
                            </h2>
                            <p class="lead text-muted">
                            @yield('jumbotron-content')
                            <p>
                            @yield('jumbotron-buttons')
                            </p>
                        </div>
                    </section>

                    @if(isset($table_hide))

                    @else
                        <table class="table">
                            <thead>
                            @yield('table-header')
                            </thead>
                            <tbody>
                            @yield('table-body')
                            </tbody>
                        </table>
                    @endif


                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@else
    @yield('content')
@endauth