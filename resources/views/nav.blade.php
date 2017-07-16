<nav class="navbar navbar-default">
    <div class="@if(Auth::check()) @if(Auth::user()->type === 'user') container @else container-fluid @endif @else container @endif">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">ePharma</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            @if(Auth::check())

                @if(Auth::user()->type === 'user')
                    <li>
                        <a href="/checkout"> <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"> </span> Checkout</a>
                    </li>
                @endif

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if(Auth::user()->type === 'user')
                            <li>
                                <a href="/receipts">Receipts</a>
                            </li>

                            <li>
                                <a href="/user/info">Settings</a>
                            </li>
                        @endif
                        <li>
                            <a href="/logout">Logout</a>
                        </li>
                    </ul>
                </li>
            @else
                <li>
                    <a href="/register">Register</a>
                </li>
                <li>
                    <a href="/login">Login</a>
                </li>
            @endif
        </ul>

        @if(Auth::check())
            @if(Auth::user()->type === 'user')
                <form class="navbar-form navbar-right" method="GET" action="/search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search Medicines" name="medicine">
                    </div>
                </form>
            @endif
        @endif


    </div>
</nav>