<!-- MENU Start -->
<div class="navbar-custom">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">

                <li class="has-submenu">
                    <a href="{{route('main')}}"><i class="ti-home"></i>Dashboard</a>
                </li>

                @if(Auth::user()->userType!=USER_TYPE['User'])

                <li class="has-submenu">
                    <a href="#"><i class="ti-light-bulb"></i>Job Info</a>
                    <ul class="submenu">
                        <li><a href="{{route('job.pending')}}">Pending Job</a></li>
                        <li><a href="{{route('job.all')}}">Job Tally</a></li>
                        @if(USER_TYPE['Admin']== Auth::user()->userType || USER_TYPE['Support']== Auth::user()->userType)
                        <li><a href="{{route('job.add')}}">Add New</a></li>
                        @endif
                        <li><a href="{{route('job.feedback')}}">Feedback</a></li>
                        <li><a href="{{route('job.deadline')}}">Deadline</a></li>

                    </ul>
                </li>


                <li class="has-submenu">
                    <a href="#"><i class="ti-bookmark-alt"></i>Reporting</a>
                    <ul class="submenu">
                        <li><a href="{{route('report.all')}}">Report</a></li>
                        <li><a href="{{route('report.performance')}}">Performance</a></li>
                        {{--<li><a href="{{route('report.invoice')}}">Invoice</a></li>--}}
                      


                    </ul>
                </li>
                @endif

                @if(Auth::user()->userType==USER_TYPE['Admin'] || Auth::user()->userType==USER_TYPE['Supervisor'] || Auth::user()->userType==USER_TYPE['Production Manager'] || Auth::user()->userType==USER_TYPE['Processing Manager'] || Auth::user()->userType==USER_TYPE['Qc Manager'])


                <li class="has-submenu">
                    <a href="#"><i class="ti-notepad"></i>Brief</a>
                    <ul class="submenu">
                        <li><a href="{{route('brief.check')}}">Brief Check</a></li>
                        <li><a href="{{route('brief.index')}}">Brief</a></li>
                        <li><a href="{{route('brief.add')}}">Add Brief</a></li>
                    </ul>
                </li>

              @endif

                @if(USER_TYPE['Admin']== Auth::user()->userType || USER_TYPE['Accounts']== Auth::user()->userType)
                <li class="has-submenu">
                    <a href="#"><i class="ti-money"></i>Billing</a>
                    <ul class="submenu">
                        <li><a href="{{route('bill.addRate')}}">Add Bill</a></li>
                        {{--<li><a href="advanced-highlight.html">Edit Bill</a></li>--}}
                        <li><a href="{{route('report.invoice')}}">Bill Summery</a></li>
                        <li><a href="{{route('invoice.index')}}">Invoice</a></li>
                        <li><a href="advanced-nestable.html">Bill Copy</a></li>

                    </ul>
                </li>
                @endif

                @if(Auth::user()->userType == USER_TYPE['Admin'])
                <li class="has-submenu">
                    <a href="#"><i class="fa fa-cog"></i>Settings</a>
                    <ul class="submenu">
                        <li><a href="{{route('rate')}}">Rate</a></li>
                        <li><a href="{{route('bank.AllBankInfo')}}">Bank Information</a></li>
                        <li><a href="{{route('tcl.tclInfo')}}">Tech Cloud Information</a></li>
                    </ul>
                </li>
                @endif


                <li class="has-submenu">
                    <a href="#"><i class="ti-bookmark-alt"></i>Other</a>
                    <ul class="submenu">
                        <li class="has-submenu">
                            <a href="#">Leave</a>
                            <ul class="submenu">
                                <li><a href="{{route('leave.apply')}}">Apply Leave</a></li>
                                @if(Auth::user()->userType == USER_TYPE['Human Resource Management'])
                                    <li><a href="{{route('leave.showLeaveRequest')}}">Show Leave Request</a></li>
                                @endif
                                <li><a href="{{route('leave.show')}}">Show Leave</a></li>
                            </ul>
                        </li>

                        <li><a href="{{route('assign.history')}}">Job Assign History</a></li>

                        @if(Auth::user()->userType != USER_TYPE['User'])

                        @if(Auth::user()->userType == USER_TYPE['Supervisor'])
                            <li><a href="{{route('file.check')}}">File Check</a></li>
                        @endif

                        <li><a href="{{route('group.index')}}">Group</a></li>

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

                        @if(Auth::user()->userType ==USER_TYPE['Admin'] || Auth::user()->userType ==USER_TYPE['Supervisor'])
                            <li class="has-submenu">
                                <a href="#">User</a>
                                <ul class="submenu">
                                    <li><a href="{{route('user.create')}}">Create User</a></li>
                                    <li><a href="{{route('user.show')}}">Show User</a></li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#">PPD</a>
                                <ul class="submenu">
                                    <li><a href="{{route('team.myTeam')}}">Team</a></li>
                                </ul>
                            </li>
                        @endif

                        <li class="has-submenu">
                            <a href="#">Service</a>
                            <ul class="submenu">
                                <li><a href="{{route('service.show')}}">Show</a></li>
                            </ul>
                        </li>

                          @endif
                        <li><a href="{{route('employee.attendence')}}">Employee Attendence</a></li>

                    </ul>
                </li>

                @if(Auth::user()->userType==USER_TYPE['Admin'] || Auth::user()->userType==USER_TYPE['Human Resource Management'])

                <li class="has-submenu">
                    <a href="#"><i class="fa fa-times"></i>Time</a>
                    <ul class="submenu">
                        <li><a href="{{route('time.overtime')}}">Over Time</a></li>
                        <li><a href="{{route('time.late')}}">Late</a></li>
                        <li><a href="{{route('overtime.late')}}">Overtime & Late</a></li>

                    </ul>
                </li>
                @endif


                <li class="has-submenu"></li>




            </ul>
            <!-- End navigation menu -->
        </div> <!-- end #navigation -->
    </div> <!-- end container -->
</div> <!-- end navbar-custom -->