<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <?php
            function url_contains($str)
            {
                    if (strpos(URL::current(), $str) !== false) {
                        return true;
                    } else {
                        return false;
                    }
            }

            function is_active($arr){
                foreach ($arr as $item){
                    if (url_contains($item)){
                        return 'active';
                    }
                }
                return '';
            }

            ?>
            {{--<li><a><i class="fa fa-home"></i> Users <span class="fa fa-chevron-down"></span></a>--}}
            {{--<ul class="nav child_menu">--}}
            {{--<li><a href="index.html">Dashboard</a></li>--}}
            {{--<li><a href="index2.html">Dashboard2</a></li>--}}
            {{--<li><a href="index3.html">Dashboard3</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            <li {{ is_active(['/administrators', '/buyers', '/sellers' ]) }}><a><i class="fa fa-home">
                    </i> Users <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li class="{{ url_contains('/administrators') ? 'current-page' : '' }}"><a href="/admin/administrators"> <i class="fa fa-user"></i> Administrators</a></li>
                    <li class="{{ url_contains('/buyers') ? 'current-page' : '' }}"><a href="/admin/buyers"><i class="fa fa-money" aria-hidden="true"></i>Buyers</a></li>
                    <li class="{{ url_contains('/sellers') ? 'current-page' : '' }}"><a href="/admin/sellers"><i class="fa fa-users" aria-hidden="true"></i>Sellers</a></li>
                </ul>
            </li>
            <li><a href="/admin/events"><i class="fa fa-table"></i>Events</a></li>
        </ul>
    </div>


</div>
<!-- /sidebar menu -->