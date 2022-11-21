<ul id="menu" class="page-sidebar-menu">

    <li class="">
        <a class="single_url" href="{{ URL::to('/') }}">
            <i class="livicon" data-name="dashboard" data-size="18" data-c="#EF6F6C" data-hc="#EF6F6C" data-loop="true"></i>
            Dashboard
        </a>
    </li>
    @if(Auth::user()->hasRole('admin'))

    <!-- {{-- <li>
        <a href="#">
            <i class="livicon" data-name="doc-portrait" data-c="#67C5DF" data-hc="#67C5DF" data-size="18" data-loop="true"></i>
            <span class="title">Board Configuration</span>
            <span class="fa arrow"></span>
        </a>

        <ul class="sub-menu">

            <li class="">
                <a href="{{ URL::to('/board-configuration') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Boards List
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-angle-double-right"></i>
                    Create Board
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-angle-double-right"></i>
                    Archived
                </a>
            </li>
        </ul>
    </li> --}} -->
    <li class="">
        <a href="{{ URL::to('/test-list') }}">
            <i class="livicon" data-name="doc-portrait" data-size="18" data-c="#EF6F6C" data-hc="#EF6F6C"
            data-loop="true"></i>
            Create New Test
        </a>
    </li>

    <li>
        <a href="#">
            <i class="livicon" data-name="doc-portrait" data-c="#67C5DF" data-hc="#67C5DF" data-size="18" data-loop="true"></i>
            <span class="title">Item Configuration</span>
            <span class="fa arrow"></span>
        </a>

        <ul class="sub-menu">

            <li class="">
                <a href="{{ URL::to('/item-level') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Difficulty Level
                </a>
            </li>
            <li class="">
                <a href="{{ URL::to('/candidate-type') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Candidate Type
                </a>
            </li>
            <li class="">
                <a href="{{ URL::to('/item-category') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <?php
                        $menu = DB::table('item_tag_maps')->where('tag', 'tag0')->count();
                        if($menu>0)
                        {
                            $mnu = DB::table('item_tag_maps')->where('tag', 'tag0')->value('name');
                            echo $mnu;
                        }
                        else{
                            echo 'Tag 0';
                        }
                    ?>
                </a>
            </li>
            <li class="">
                <a href="{{ URL::to('/item-tag1') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <?php
                        $menu = DB::table('item_tag_maps')->where('tag', 'tag1')->count();
                        if($menu>0)
                        {
                            $mnu = DB::table('item_tag_maps')->where('tag', 'tag1')->value('name');
                            echo $mnu;
                        }
                        else{
                            echo 'Tag 1';
                        }
                    ?>
                </a>
            </li>
            <li class="">
                <a href="{{ URL::to('/item-tag2') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <?php
                        $menu = DB::table('item_tag_maps')->where('tag', 'tag2')->count();
                        if($menu>0)
                        {
                            $mnu = DB::table('item_tag_maps')->where('tag', 'tag2')->value('name');
                            echo $mnu;
                        }
                        else{
                            echo 'Tag 2';
                        }
                    ?>
                </a>
            </li>
            <li class="">
                <a href="{{ URL::to('/item-tag3') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <?php
                        $menu = DB::table('item_tag_maps')->where('tag', 'tag3')->count();
                        if($menu>0)
                        {
                            $mnu = DB::table('item_tag_maps')->where('tag', 'tag3')->value('name');
                            echo $mnu;
                        }
                        else{
                            echo 'Tag 3';
                        }
                    ?>
                </a>
            </li>
            <li class="">
                <a href="{{ URL::to('/item-tag4') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <?php
                        $menu = DB::table('item_tag_maps')->where('tag', 'tag4')->count();
                        if($menu>0)
                        {
                            $mnu = DB::table('item_tag_maps')->where('tag', 'tag4')->value('name');
                            echo $mnu;
                        }
                        else{
                            echo 'Tag 4';
                        }
                    ?>
                </a>
            </li>
            <li class="">
                <a href="{{ URL::to('/item-tag5') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <?php
                        $menu = DB::table('item_tag_maps')->where('tag', 'tag5')->count();
                        if($menu>0)
                        {
                            $mnu = DB::table('item_tag_maps')->where('tag', 'tag5')->value('name');
                            echo $mnu;
                        }
                        else{
                            echo 'Tag 5';
                        }
                    ?>
                </a>
            </li>
            <li class="">
                <a href="{{ URL::to('/item-tag6') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <?php
                        $menu = DB::table('item_tag_maps')->where('tag', 'tag6')->count();
                        if($menu>0)
                        {
                            $mnu = DB::table('item_tag_maps')->where('tag', 'tag6')->value('name');
                            echo $mnu;
                        }
                        else{
                            echo 'Tag 6';
                        }
                    ?>
                </a>
            </li>
            <li class="">
                <a href="{{ URL::to('/item-tag7') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <?php
                        $menu = DB::table('item_tag_maps')->where('tag', 'tag7')->count();
                        if($menu>0)
                        {
                            $mnu = DB::table('item_tag_maps')->where('tag', 'tag7')->value('name');
                            echo $mnu;
                        }
                        else{
                            echo 'Tag 7';
                        }
                    ?>
                </a>
            </li>
            <li class="">
                <a href="{{ URL::to('/item-mapping') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Rename Tags
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#">
        <i class="livicon" data-name="doc-portrait" data-size="18" data-c="#EF6F6C" data-hc="#EF6F6C" data-loop="true"></i>
            <span class="title">Create Items</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="">
                <a href="{{ URL::to('/create-new-item') }}">
                <i class="fa fa-angle-double-right"></i>
                    Item Create
                </a>
            </li>
            <li>
                <a href="{{ URL::to('/create-memory-item') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Create Memory Item
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#">
            <i class="livicon" data-name="table" data-c="#67C5DF" data-hc="#67C5DF" data-size="18" data-loop="true"></i>
            <span class="title">Item Bank</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{ URL::to('/item-bank/active') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Active
                </a>
            </li>
            <li>
                <a href="{{ URL::to('/item-bank/no_answer') }}">
                    <i class="fa fa-angle-double-right"></i>
                    No-Answer
                </a>
            </li>
            <li>
                <a href="{{ URL::to('/item-bank/test') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Test Item
                </a>
            </li>
            <li>
                <a href="{{ URL::to('/item-bank/inactive') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Inactive
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#">
            <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C"
                   data-size="18" data-loop="true"></i>
            <span class="title">Sets Configuration</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{ URL::to('/create-set') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Create Set
                </a>
            </li>
            <li>
                <a href="{{ URL::to('/question-set') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Question Set
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="#">
            <i class="livicon" data-name="settings" data-c="#67C5DF" data-hc="#67C5DF" data-size="18" data-loop="true"></i>
            <span class="title">Tests Configuration</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">

            <li>
                <a href="{{ URL::to('/new-test-configuration') }}">
                    <i class="fa fa-angle-double-right"></i>
                    <span class="title">Create Test Config</span>
                </a>
            </li>
            <li>
                <a href="{{ URL::to('/test-group') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Test Grouping
                </a>
            </li>
            <li>
                <a href="{{ URL::to('/test-configuration-list') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Test Config List
                </a>
            </li>
        </ul>
    </li>

    <!-- <li>
        <a href="#">
            <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
            <span class="title">Memory Item</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{ URL::to('/create-memory-item') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Create Memory Item
                </a>
            </li>
        </ul>
    </li> -->


    <li>
        <a href="#">
            <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C"
               data-size="18" data-loop="true"></i>
            <span class="title">Board Configuration</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{ URL::to('/question-set-and-test-configuration-list') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Question Set And Test Configuration List
                </a>
            </li>
        </ul>
    </li>
    {{-- <li>
        <a href="#">
            <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
            <span class="title">Examiners</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="#">
                    <i class="fa fa-angle-double-right"></i>
                    Assign Examiners
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-angle-double-right"></i>
                    Exam List
                </a>
            </li>
        </ul>
    </li> --}}

    <li>
        <a href="#">
            <i class="livicon" data-name="wrench" data-c="#67C5DF" data-hc="#67C5DF" data-size="18" data-loop="true"></i>
            <span class="title">Role Management</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li {!! (Request::is('admin/users') || Request::is('admin/users/create') || Request::is('admin/user_profile') || Request::is('admin/users/*') || Request::is('admin/deleted_users') ? 'class="active"' : '' ) !!}>
                <a href="{{ URL::to('/users') }}">
                    <i class="livicon" data-name="user" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                    <span class="title">Users</span>
                </a>
            </li>
            <li {!! (Request::is('/roles') ? 'class="active"' : '' ) !!}>
                <a href="{{ URL::to('/roles') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Roles
                </a>
            </li>
            <li {!! (Request::is('/permissions') ? 'class="active"' : '' ) !!}>
                <a href="{{ URL::to('/permissions') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Permissions
                </a>
            </li>

        </ul>
    </li>

    <li>
        <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('frm-logout').submit();">
            <i class="livicon" data-name="sign-out" data-s="15"></i>
            <span class="title">Logout</span>
        </a>
        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
    @endif

    @if(Auth::user()->hasRole('testing'))
    <li>
        <a href="#">
            <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
            <span class="title">Uploads Section</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="#">
                    <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                    <span class="title">TAT / BL</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ URL::to('/tat-bl-list') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Create TAT / BL
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                    <span class="title">Session Calender</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ URL::to('/session-calender-list') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Create Session
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                    <span class="title">Testing Schedule</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ URL::to('/testing-schedule-list') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Create Schedule
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                    <span class="title">Announcement</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ URL::to('/announcement-list') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Create Announcement
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                    <span class="title">Course Schedule</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ URL::to('/course-schedule-list') }}">
                            <i class="fa fa-angle-double-right"></i>
                            Create Schedule
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>

    <li>
        <a href="#">
            <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
            <span class="title">Upcoming Events</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{ URL::to('/upcoming-events-list') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Create Events
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="{{ URL::to('/test-configuration-list') }}">
            <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
            <span class="title">Instruction Sliders</span>
        </a>
    </li>
    <li>
        <a href="{{ route('boardCandidate.index') }}">
            <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
            <span class="title">Board & Candidate</span>
        </a>
    </li>

    <!--  Testing list Start -->
    <li>
        <a href="#">
            <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
            <span class="title">Test List</span>
            <span class="fa arrow"></span>
        </a>
        @forelse($testingConfig as $key=>$testingData)
        <ul class="sub-menu">
            <li>
                <a href="#">
                    <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                    <span class="title">{{$testingData->test_name}}</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ URL::to('/examConfig/create?test_config_id='.$testingData->id) }}">
                            <i class="fa fa-angle-double-right"></i>
                            Create {{$testingData->test_name}}
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/examConfig?test_config_id='.$testingData->id) }}">
                            <i class="fa fa-angle-double-right"></i>
                             {{$testingData->test_name}} List
                        </a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/test-result?test_config_id='.$testingData->id) }}">
                            <i class="fa fa-angle-double-right"></i>
                             {{$testingData->test_name}} Test Result
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
        @empty

        @endforelse
    </li>
        <!--  Testing list End -->

    <li>
        <a href="{{ route('examConfig.index') }}">
            <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
            <span class="title">Test List</span>
        </a>
    </li>

    <li>
        <a href="{{ route('stdSeatPlan') }}">
            <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
            <span class="title">Seat Plan</span>
        </a>
    </li>

    {{-- START REPORTS --}}
    <li>
        <a href="#">
            <i class="livicon" data-name="doc-portrait" data-c="#67C5DF" data-hc="#67C5DF" data-size="18" data-loop="true"></i>
            <span class="title">Reports</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{ URL::to('/exam-wise-result') }}">
                    <i class="fa fa-angle-double-right"></i>
                    Assessment Wise Report
                </a>
            </li>
        </ul>
    </li>
    {{-- END REPORTS --}}

    <li>
        <a href="{{ route('genarateToken') }}">
            <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
            <span class="title">Genarate Token</span>
        </a>
    </li>

    {{-- <li>
        <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('frm-logout').submit();">
            <i class="livicon" data-name="sign-out" data-s="15"></i>
            <span class="title">Logout</span>
        </a>
        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li> --}}

    @endif

    @if(Auth::user()->hasRole('user'))
        <li>
            <a href="{{ URL::to('/tat-bl') }}">
                <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                <span class="title">TAT / BL</span>
            </a>

        </li>

        <li>
            <a href="{{ URL::to('/session-calender') }}">
                <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                <span class="title">Session Calender</span>

            </a>

        </li>

        <li>
            <a href="{{ URL::to('/testing-schedule') }}">
                <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                <span class="title">Testing Schedule</span>
            </a>

        </li>

        <li>
            <a href="{{ URL::to('/announcement') }}">
                <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                <span class="title">Announcement</span>
            </a>
        </li>

        <li>
            <a href="{{ URL::to('/upcoming-events') }}">
                <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                <span class="title">Upcoming Events</span>
            </a>
        </li>

        <li>
            <a href="{{ URL::to('/course-schedule') }}">
                <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                <span class="title">Course Schedule</span>
            </a>
        </li>

        <li>
            <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('frm-logout').submit();">
                <i class="livicon" data-name="sign-out" data-s="15"></i>
                <span class="title">Logout</span>
            </a>
            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>

    @endif

    {{-- @if(Auth::user()->hasRole('conductingOfficer'))
        <li>
            <a href="{{ route('stdSeatPlan') }}">
                <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                <span class="title">Seat Plan</span>
            </a>
        </li>

        <li>
            <a href="{{ route('examScheduleList') }}">
                <i class="livicon" data-name="settings" data-c="#EF6F6C" data-hc="#EF6F6C" data-size="18" data-loop="true"></i>
                <span class="title">Exam Schedules</span>
            </a>
        </li>
    @endif --}}
</ul>
