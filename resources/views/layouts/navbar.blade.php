<!-- MENU Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">

                <li class="has-submenu">
                    <a href="{{route('main')}}"><i class="ti-home"></i>Dashboard</a>
                </li>

                <li class="has-submenu">
                    <a href="#"><i class="ti-light-bulb"></i>Job Info</a>
                    <ul class="submenu">
                        <li><a href="{{route('job.information')}}">Information</a></li>
                        <li><a href="{{route('job.pending')}}">Pending Job</a></li>
                        <li><a href="{{route('job.all')}}">Job Tally</a></li>
                        <li><a href="{{route('job.add')}}">Add New</a></li>
                        <li><a href="{{route('job.feedback')}}">Feedback</a></li>
                        <li><a href="{{route('job.deadline')}}">Deadline</a></li>

                    </ul>
                </li>


                <li class="has-submenu">
                    <a href="#"><i class="ti-bookmark-alt"></i>Reporting</a>
                    <ul class="submenu">
                        <li><a href="advanced-animation.html">Report</a></li>
                        <li><a href="{{route('report.performance')}}">Performance</a></li>
                        <li><a href="advanced-rating.html">Job History</a></li>
                        <li><a href="advanced-nestable.html">Hourly Report</a></li>
                        <li><a href="advanced-nestable.html">Daily Work Info</a></li>
                    </ul>
                </li>


                <li class="has-submenu">
                    <a href="#"><i class="ti-notepad"></i>Brief</a>
                    <ul class="submenu">
                        <li><a href="{{route('brief.check')}}">Brief Check</a></li>
                        <li><a href="{{route('brief.index')}}">Brief</a></li>
                        <li><a href="{{route('brief.add')}}">Add Brief</a></li>
                    </ul>
                </li>


                <li class="has-submenu">
                    <a href="#"><i class="ti-money"></i>Billing</a>
                    <ul class="submenu">
                        <li><a href="{{route('bill.addRate')}}">Add Rate</a></li>
                        <li><a href="advanced-highlight.html">Edit Bill</a></li>
                        <li><a href="{{route('bill.summery')}}">Bill Summery</a></li>
                        <li><a href="advanced-nestable.html">Invoice</a></li>
                        <li><a href="advanced-nestable.html">Bill Copy</a></li>
                    </ul>
                </li>



                <li class="has-submenu">
                    <a href="#"><i class="ti-arrow-circle-down"></i>Other</a>
                    <ul class="submenu">
                        <li class="has-submenu">
                            <a href="#">Leave</a>
                            <ul class="submenu">
                                <li><a href="{{route('leave.apply')}}">Apply Leave</a></li>
                                <li><a href="{{route('leave.show')}}">Show Leave</a></li>
                            </ul>
                        </li>
                        <li><a href="advanced-nestable.html">Time Calculator</a></li>

                        @if(Auth::user()->userType == USER_TYPE[1])
                        <li><a href="{{route('file.check')}}">File Check</a></li>
                        @endif

                        <li><a href="{{route('team.index')}}">Team</a></li>

                        <li class="has-submenu">
                            <a href="#">Shift</a>
                            <ul class="submenu">
                                <li><a href="{{route('shift.create')}}">Create Shift</a></li>
                                <li><a href="{{route('shift.index')}}">View Shift</a></li>
                            </ul>
                        </li>


                        <li class="has-submenu">
                            <a href="#">Client</a>
                            <ul class="submenu">
                                <li><a href="{{route('client.add')}}">Add</a></li>
                                <li><a href="{{route('client.show')}}">Show</a></li>
                            </ul>
                        </li>

                        @if(Auth::user()->userType ==USER_TYPE[0] || Auth::user()->userType ==USER_TYPE[1])
                            <li class="has-submenu">
                                <a href="#">User</a>
                                <ul class="submenu">
                                    <li><a href="{{route('user.create')}}">Create User</a></li>
                                    <li><a href="{{route('user.show')}}">Show User</a></li>
                                </ul>
                            </li>

                        @endif

                        <li class="has-submenu">
                            <a href="#">Service</a>
                            <ul class="submenu">
                                <li><a href="{{route('service.show')}}">Show</a></li>
                            </ul>
                        </li>

                    </ul>
                </li>




            </ul>
            <!-- End navigation menu -->
        </div> <!-- end #navigation -->
    </div> <!-- end container -->
</div> <!-- end navbar-custom -->