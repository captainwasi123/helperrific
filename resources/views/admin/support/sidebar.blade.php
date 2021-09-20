<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">MANAGEMENT</li>
                        <li> 
                            <a class="waves-effect" href="{{URL::to('/admin')}}" aria-expanded="false">
                                <i class="mdi mdi-gauge"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li> 
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="fa fa-users"></i>
                                <span class="hide-menu">Users</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{URL::to('/admin/site-user/employers')}}">Employers</a></li>
                                <li><a href="{{URL::to('/admin/site-user/helpers')}}">Helpers</a></li>
                                <li><a href="{{URL::to('/admin/site-user/agencies')}}">Agencies</a></li>
                            </ul>
                        </li>
                        <li> 
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="fa fa-comments"></i>
                                <span class="hide-menu">Chats Log</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{URL::to('/admin/chat-log')}}">All Logs</a></li>
                                <li><a href="{{URL::to('/admin/chat-log/filter')}}">Filter</a></li>
                            </ul>
                        </li>
                        <li> 
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="fa fa-question"></i>
                                <span class="hide-menu">Enquiries</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{URL::to('/admin/enquiries/pending')}}">Pending</a></li>
                                <li><a href="{{URL::to('/admin/enquiries')}}">All</a></li>
                            </ul>
                        </li>
                        <li> 
                            <a class="waves-effect" href="{{URL::to('/admin/reviewReports')}}" aria-expanded="false">
                                <i class="mdi mdi-block-helper"></i>
                                <span class="hide-menu">Review Reports</span>
                            </a>
                        </li>
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">SETTINGS</li>
                        <li> 
                            <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class="fa fa-users"></i>
                                <span class="hide-menu">Users</span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{URL::to('/admin/users/add')}}">Add</a></li>
                                <li><a href="{{URL::to('/admin/users')}}">View List</a></li>
                            </ul>
                        </li>
                        <li> 
<<<<<<< HEAD
                            <a class="waves-effect" href="{{URL::to('/admin/site_maintenance')}}" aria-expanded="false">
                                <i class="mdi mdi-tune"></i>
                                <span class="hide-menu">Site Settings</span>
=======
                            <a class="waves-effect" href="{{URL::to('/admin/websiteSetting')}}" aria-expanded="false">
                                <i class="mdi mdi-settings"></i>
                                <span class="hide-menu">Website Setting</span>
>>>>>>> 7362012579add8637f368b2fd6967a56779dffcb
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>