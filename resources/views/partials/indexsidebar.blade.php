
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

                    <div class="card card-default mb-2">
                        <div class="card-header">
                            @yield('top-card-header')
                        </div>
                        <div class="card-body">
                            @yield('top-card-body')
                        </div>
                    </div>


                    <div class="card card-default">
                        <div class="card-header">
                            @yield('bottom-card-header')
                        </div>
                        <div class="card-body">
                            @yield('bottom-card-body')
                        </div>
                    </div>

                    @yield('content')

                </div>


            </div>
        </div>
    </div>
@else
    @yield('content')
@endauth