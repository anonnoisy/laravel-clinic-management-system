<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('admin::home') }}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><span style="color: #2fa97c"><i class="fas fa-tachometer-alt"></i></span></div><span class="badge badge-pill badge-success float-right">3</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin::department::index') }}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><span style="color: #2fa97c"><i class="fas fa-building"></i></span></div>
                        <span>Departments</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><span style="color: #2fa97c"><i class="fas fa-hospital"></i></span></div>
                        <span>Monitor Hospital</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('admin::invoice::index') }}">Payment History</a></li>
                        <li><a href="javascript: void(0);" class="has-arrow">Bed</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('admin::bed::index') }}">Bed</a></li>
                                <li><a href="{{ route('admin::bed::allotment::index') }}">Allotment</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript: void(0);" class="has-arrow">Blood</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('admin::blood::bank::index') }}">Bank</a></li>
                                <li><a href="{{ route('admin::blood::donor::index') }}">Donor</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript: void(0);" class="has-arrow">Medicine</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('admin::medicine::index') }}">Medicine</a></li>
                                <li><a href="{{ route('admin::medicine::sale::index') }}">Sales</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript: void(0);" class="has-arrow">Report</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('admin::report::operation::index') }}">Operation</a></li>
                                <li><a href="{{ route('admin::report::birth::index') }}">Birth</a></li>
                                <li><a href="{{ route('admin::report::death::index') }}">Death</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><span style="color: #2fa97c"><i class="fas fa-users"></i></span></div>
                        <span>Users Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('admin::user::doctor::index') }}">Doctors</a></li>
                        <li><a href="{{ route('admin::user::patient::index') }}">Patients</a></li>
                        <li><a href="{{ route('admin::user::nurse::index') }}">Nurses</a></li>
                        <li><a href="{{ route('admin::user::pharmacist::index') }}">Pharmacists</a></li>
                        <li><a href="{{ route('admin::user::laboratorist::index') }}">Laboratorists</a></li>
                        <li><a href="{{ route('admin::user::accountant::index') }}">Accountants</a></li>
                        <li><a href="{{ route('admin::user::receptionist::index') }}">Receptionists</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin::department::index') }}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><span style="color: #2fa97c"><i class="fas fa-receipt"></i></span></div>
                        <span>Payroll</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><span style="color: #2fa97c"><i class="fas fa-cog"></i></span></div>
                        <span>Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="{{ route('admin::setting::system::edit') }}">System Settings</a></li>
                        <li><a href="{{ route('admin::setting::sms::edit') }}">SMS Settings</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->