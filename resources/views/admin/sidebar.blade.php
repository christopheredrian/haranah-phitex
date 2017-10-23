<div class="col-md-3">
    <div class="panel panel-default panel-flush">
        <div class="panel-heading">
            Sidebar
        </div>

        <div class="panel-body">
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/admin') }}">
                        Dashboard
                    </a>
                </li>
                <li role="presentation">
                    <a href="{{ url('/admin/buyers') }}">
                        Buyers
                    </a>
                </li>
                <li role="presentation">
                    <a href="{{ url('/admin/sellers') }}">
                        Sellers
                    </a>
                </li>
                <li role="presentation">
                    <a href="{{ url('/admin/events') }}">
                        Events
                    </a>
                </li>
                {{--<li role="presentation">--}}
                    {{--<a href="{{ url('/admin/administrators') }}">--}}
                        {{--Administrators--}}
                    {{--</a>--}}
                {{--</li><li role="presentation">--}}
                    {{--<a href="{{ url('/admin/super-administrators') }}">--}}
                        {{--Super Administrators--}}
                    {{--</a>--}}
                {{--</li>--}}

            </ul>
        </div>
    </div>
</div>
