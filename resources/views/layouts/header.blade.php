<div class="color-switch" hidden="True">
    <ul>
        <li><a id="brown" class="brown change" href="#brown"><i class="fa fa-check"></i></a></li>
        <li><a id="red" class="red change" href="#red"><i class="fa fa-check"></i></a></li>
        <li><a id="yellow" class="yellow change" href="#yellow"><i class="fa fa-check"></i></a></li>
        <li><a id="blue" class="blue change" href="#blue"><i class="fa fa-check"></i></a></li>
        <li><a id="green" class="green change" href="#green"><i class="fa fa-check"></i></a></li>
        <li><a id="gray" class="gray change" href="#gray"><i class="fa fa-check"></i></a></li>
        <li><a id="modernstyle" class="modernstyle change" href="#modernstyle"><i class="fa fa-check"></i></a></li>
    </ul>
    <i class="fa fa-paint-brush"></i>
</div>
<div class="nav-top">
    <div class="userbar">
        <div class="contact">
            <a href="/">
                <img src="{{ asset('img/header-logo.png') }}"/>
            </a>
        </div>

    @if(session('user_id') == null)
        <!-- Before Login -->
            <a href="/login"><b>Welcome to Hoseh</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-log-in"></span> Login</a>
            <!-- End Before Login -->
    @elseif(session('user_id') == 1)
        <!-- after Login -->
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle header-menu-profile" type="button"
                        data-toggle="dropdown"><span
                            class="glyphicon glyphicon-log-in"></span> {{ Auth::user()->nick_name }}
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="/p/m">Product Management</a></li>
                    <li><a href="/d/m">Lucky Draw Management</a></li>
                    <li><a href="/b/m">Auction Management</a></li>
                    <li><a href="/u/p/s">Token Pricing</a></li>
                    <li><a href="/r">Reports</a></li>
                    <li><a href="/c">Configurations</a></li>
                    <li><a href="/u/t">Testimonials</a></li>
                    <li><a href="/logout">Logout</a></li>
                </ul>
            </div>
            <!-- End after Login -->
    @else
        <!-- after Login -->
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle header-menu-profile" type="button"
                        data-toggle="dropdown"><span class="glyphicon glyphicon-piggy-bank"></span> <span
                            id="btn-dashboard-tokens">{{ 'Tokens ( ' . Auth::user()->tokens . ' )' }}</span>
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="/u/p/s">Buy Tokens</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle header-menu-profile" type="button"
                        data-toggle="dropdown"><span
                            class="glyphicon glyphicon-log-in"></span> {{ Auth::user()->nick_name }}
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="/u/u">Account Settings</a></li>
                    <li><a href="/u/p/h">Payment History</a></li>
                    <li><a href="/logout">Logout</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle header-menu-profile" type="button" data-toggle="dropdown"
                        onclick="location.href='/u/d/w';"><span class="glyphicon glyphicon-shopping-cart"></span> <span
                            id="btn-dashboard-cart">{!! Auth::user()->pending_payments() !!}</span></button>
            </div>
            <!-- End after Login -->
        @endif
    </div>
</div>
