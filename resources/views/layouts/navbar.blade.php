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
                        <li class="has-submenu">
                            <a href="#">Deadline</a>
                            <ul class="submenu">

                                <li><a href="{{route('job.deadline')}}">Todays Deadline</a></li>
                                <li><a href="{{route('job.deadline')}}">Tomorrows Deadline</a></li>
                            </ul>
                        </li>


                    </ul>
                </li>


                <li class="has-submenu">
                    <a href="#"><i class="ti-bookmark-alt"></i>Reporting</a>
                    <ul class="submenu">
                        <li><a href="advanced-animation.html">Report</a></li>
                        <li><a href="advanced-highlight.html">Performance</a></li>
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

                        <li><a href="{{route('team.index')}}">Team</a></li>

                        <li class="has-submenu">
                            <a href="#">Shift</a>
                            <ul class="submenu">
                                <li><a href="{{route('shift.create')}}">Create Shift</a></li>
                                <li><a href="{{route('shift.show')}}">View Shift</a></li>
                            </ul>
                        </li>


                        <li class="has-submenu">
                            <a href="#">Client</a>
                            <ul class="submenu">
                                <li><a href="{{route('client.add')}}">Add</a></li>
                                <li><a href="{{route('client.show')}}">Show</a></li>
                            </ul>
                        </li>

                        <li class="has-submenu">
                            <a href="#">Service</a>
                            <ul class="submenu">
                                <li><a href="{{route('service.add')}}">Add</a></li>
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