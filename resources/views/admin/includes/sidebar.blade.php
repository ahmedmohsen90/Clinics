<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ aurl('') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ settings()->logo }}" style="height: 35px;" alt="{{ settings()->name }}">
            </span>
            <span class="app-brand-text demo menu-text fw-bold">{{ settings()->name }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ activeMenu('/') }}">
            <a href="{{ aurl('') }}" class="menu-link">
                <i class="fas fa-home"></i>&nbsp;&nbsp;
                <div>{{ trans('admin.Dashboard') }}</div>
            </a>
        </li>

        <!-- Apps & Pages -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ trans('admin.Reports') }}</span>
        </li>

        <li class="menu-item {{ openMenu('/cases') }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fas fa-user-injured"></i>&nbsp;&nbsp;
                <div>{{ trans('admin.Cases') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ activeMenu('/cases') }}">
                    <a href="{{ aurl('cases') }}" class="menu-link">
                        <div>{{ trans('admin.All Cases') }}</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ openMenu('/profits') }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fas fa-chart-bar"></i>&nbsp;&nbsp;
                <div>{{ trans('admin.Profits') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ activeMenu('/profits') }}">
                    <a href="{{ aurl('profits') }}" class="menu-link">
                        <div>{{ trans('admin.All Profits') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ activeMenu('/profits/today') }}">
                    <a href="{{ aurl('profits/today') }}" class="menu-link">
                        <div>{{ trans('admin.Profits Today') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ activeMenu('/profits/week') }}">
                    <a href="{{ aurl('profits/week') }}" class="menu-link">
                        <div>{{ trans('admin.Profits Week') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ activeMenu('/profits/month') }}">
                    <a href="{{ aurl('profits/month') }}" class="menu-link">
                        <div>{{ trans('admin.Profits Month') }}</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Apps & Pages -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ trans('admin.Content') }}</span>
        </li>

        <li class="menu-item {{ openMenu('/admins') }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fas fa-user-secret"></i>&nbsp;&nbsp;
                <div>{{ trans('admin.Admins') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ activeMenu('/admins') }}">
                    <a href="{{ aurl('admins') }}" class="menu-link">
                        <div>{{ trans('admin.All Admins') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ activeMenu('/admins/create') }}">
                    <a href="{{ aurl('admins/create') }}" class="menu-link">
                        <div>{{ trans('admin.Add New Admin') }}</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ openMenu('/specializations') }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fas fa-clinic-medical"></i>&nbsp;&nbsp;
                <div>{{ trans('admin.Specializations') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ activeMenu('/specializations') }}">
                    <a href="{{ aurl('specializations') }}" class="menu-link">
                        <div>{{ trans('admin.All Specializations') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ activeMenu('/specializations/create') }}">
                    <a href="{{ aurl('specializations/create') }}" class="menu-link">
                        <div>{{ trans('admin.Add New Specialization') }}</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ openMenu('/doctors') }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fas fa-user-md"></i>&nbsp;&nbsp;
                <div>{{ trans('admin.Doctors') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ activeMenu('/doctors') }}">
                    <a href="{{ aurl('doctors') }}" class="menu-link">
                        <div>{{ trans('admin.All Doctors') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ activeMenu('/doctors/create') }}">
                    <a href="{{ aurl('doctors/create') }}" class="menu-link">
                        <div>{{ trans('admin.Add New Doctor') }}</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ openMenu('/customers') }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fas fa-users"></i>&nbsp;&nbsp;
                <div>{{ trans('admin.Customers') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ activeMenu('/customers') }}">
                    <a href="{{ aurl('customers') }}" class="menu-link">
                        <div>{{ trans('admin.All Customers') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ activeMenu('/customers/create') }}">
                    <a href="{{ aurl('customers/create') }}" class="menu-link">
                        <div>{{ trans('admin.Add New Customer') }}</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ openMenu('/reservations') }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fas fa-calendar-alt"></i>&nbsp;&nbsp;
                <div>{{ trans('admin.Reservations') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ activeMenu('/reservations') }}">
                    <a href="{{ aurl('reservations') }}" class="menu-link">
                        <div>{{ trans('admin.All Users') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ activeMenu('/reservations/create') }}">
                    <a href="{{ aurl('reservations/create') }}" class="menu-link">
                        <div>{{ trans('admin.Add New User') }}</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Apps & Pages -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ trans('admin.Settings') }}</span>
        </li>

        <li class="menu-item {{ openMenu('/settings') }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fas fa-cogs"></i>&nbsp;&nbsp;
                <div>{{ trans('admin.Settings') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ activeMenu('/settings') }}">
                    <a href="{{ aurl('settings') }}" class="menu-link">
                        <div>{{ trans('admin.Settings') }}</div>
                    </a>
                </li>
            </ul>
        </li>

    </ul>
</aside>
