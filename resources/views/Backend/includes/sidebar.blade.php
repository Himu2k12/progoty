<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
        <div class="sidebar-brand-icon">
            <img src="{{asset('asset/')}}/images/logo.png" width="60px">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
@can('isSuper')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{url('/admin-dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
@endcan
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Links
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @can('isSuper')

     <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Role</span>
        </a>
        <div id="collapseTwo" class="collapse {!! Request::is('add-role') ? 'show':'' !!}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">All Roles:</h6>
                <a class="collapse-item {!! Request::is('add-role') ? 'active':'' !!}" href="{{url('/add-role')}}">Role</a>
            </div>
        </div>

    </li>
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseno" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Schemes</span>
        </a>
        <div id="collapseno" class="collapse {!! Request::is('scheme') ? 'show':'' !!}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">All Roles:</h6>
                <a class="collapse-item {!! Request::is('scheme') ? 'active':'' !!}" href="{{url('/scheme')}}">Add scheme</a>
            </div>
        </div>

    </li>
        <li class="nav-item {!! Request::is('new-member-requests') ? 'active':'' !!}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>Members</span>
            </a>
            <div id="collapseUtilities2" class="collapse @if(Request::is('new-member-requests') || Request::is('verified-members') ) show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Member Related:</h6>
                    <a class="collapse-item {!! Request::is('new-member-requests') ? 'active':'' !!}" href="{{url('/new-member-requests')}}">New Members</a>
                    <a class="collapse-item {!! Request::is('verified-members') ? 'active':'' !!}" href="{{url('/verified-members')}}">Verified Members</a>
                    <a class="collapse-item {!! Request::is('all-closed-members') ? 'active':'' !!}" href="{{url('/all-closed-members')}}">Closed Members</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsenos" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Collections</span>
        </a>
        <div id="collapsenos" class="collapse {!! Request::is('scheme') ? 'show':'' !!}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Sheets:</h6>
                <a class="collapse-item {!! Request::is('scheme') ? 'active':'' !!}" href="{{url('/all-sheets')}}">All Sheets</a>
            </div>
        </div>

    </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>Employee</span>
            </a>
            <div id="collapseUtilities" class="collapse {!! Request::is('register-staffs') ? 'show':'' !!}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Employee Related:</h6>
                    <a class="collapse-item {!! Request::is('register-staffs') ? 'active':'' !!}" href="{{url('/register-staffs')}}">Employee Management</a>
                 </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCase" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-hands-helping"></i>
                <span>Loan</span>
            </a>
            <div id="collapseCase" class="collapse @if(Request::is('loan-request-admin') || Request::is('approved-loans')|| Request::is('admin-all-active-loans')||Request::is('loan-statements'))||Request::is('ready-to-dispatch-loan-request-admin') show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Loan Related:</h6>
                    <a class="collapse-item {!! Request::is('loan-request-admin') ? 'active':'' !!}" href="{{url('/loan-request-admin')}}">New Loan Applications</a>
                    <a class="collapse-item {!! Request::is('ready-to-dispatch-loan-request-admin') ? 'active':'' !!}" href="{{url('ready-to-dispatch-loan-request-admin')}}">Ready to Dispatch Loans</a>
                    
                    <a class="collapse-item {!! Request::is('admin-all-active-loans') ? 'active':'' !!}" href="{{url('/admin-all-active-loans')}}">All Active Loan</a>
                    <a class="collapse-item {!! Request::is('loan-statements') ? 'active':'' !!}" href="{{url('loan-statements')}}">Loan Statement</a>
                    <a class="collapse-item {!! Request::is('approved-loans') ? 'active':'' !!}" href="{{url('/approved-loans')}}">ALL Loans</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePatient" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-piggy-bank"></i>
                <span>Savings</span>
            </a>
            <div id="collapsePatient" class="collapse  @if(Request::is('savings-withdraw-request-by-supervisor') || Request::is('approved-withdraws-admin')|| Request::is('withdraw-history')) show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Savings Related:</h6>
                    <a class="collapse-item {!! Request::is('savings-withdraw-request-by-supervisor') ? 'active':'' !!}" href="{{url('/savings-withdraw-request-by-supervisor')}}">Savings Withdraw Requests</a>
                    <a class="collapse-item {!! Request::is('approved-withdraws-admin') ? 'active':'' !!}" href="{{url('/approved-withdraws-admin')}}">Approved Withdraws</a>
                    <a class="collapse-item {!! Request::is('withdraw-history') ? 'active':'' !!}" href="{{url('/withdraw-history')}}">Withdraw History</a>
                    {{--                <a class="collapse-item {!! Request::is('/all-cases') ? 'active':'' !!}" href="{{url('/all-cases')}}">All Cases</a>--}}
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities34" aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="fas fa-fw fa-file-pdf"></i>
                <span>Reports</span>
            </a>
            <div id="collapseUtilities34" class="collapse @if( Request::is('savings-report')||  Request::is('Loan-report') || Request::is('Expense-reports') || Request::is('Collection-reports') || Request::is('attendance-reports')) show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Report Management:</h6>
                    <a class="collapse-item {!! Request::is('savings-report') ? 'active':'' !!}" href="{{url('savings-report')}}">Savings Collections</a>
                    <a class="collapse-item {!! Request::is('show-dispatch-report') ? 'active':'' !!}" href="{{url('show-dispatch-report')}}">Loan Dispatch</a>
                    <a class="collapse-item {!! Request::is('Loan-report') ? 'active':'' !!}" href="{{url('Loan-report')}}">Loan Collections</a>
                    <a class="collapse-item {!! Request::is('Expense-reports') ? 'active':'' !!}" href="{{url('Expense-reports')}}">Expense Report</a>
                    <a class="collapse-item {!! Request::is('Collection-reports') ? 'active':'' !!}" href="{{url('Collection-reports')}}">Additional Collection</a>
                    <a  class="collapse-item {!! Request::is('field-officers-statement') ? 'active':'' !!}" href="{{url('field-officers-statement')}}">Field officers</a>
                </div>
            </div>
        </li>
    @endcan
    @can('isFieldMan')
    <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-users-cog"></i>
                <span> Members Info</span>
            </a>
            <div id="collapseUtilities" class="collapse {!! Request::is('fieldOfficer-included-members') ? 'show':'' !!}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Member Related:</h6>
                    <a class="collapse-item {!! Request::is('fieldOfficer-included-members') ? 'active':'' !!}" href="{{url('/fieldOfficer-included-members')}}"> My Included Members</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSavings" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-piggy-bank"></i>
                <span> Savings </span>
            </a>
            <div id="collapseSavings" class="collapse @if(Request::is('savings-form') || Request::is('today-saving-collection') || Request::is('withdraw-savings')) @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Savings Related:</h6>
                    <a class="collapse-item {!! Request::is('savings-form') ? 'active':'' !!}" href="{{url('/savings-form')}}"> Savings Form</a>
                    <a class="collapse-item {!! Request::is('today-saving-collection') ? 'active':'' !!}" href="{{url('/today-saving-collection')}}"> Daily Savings Collection</a>
                    <a class="collapse-item {!! Request::is('withdraw-savings') ? 'active':'' !!}" href="{{url('/withdraw-savings')}}">Withdraw Savings Account</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLoans" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-hands-helping"></i>
                <span> Loans </span>
            </a>
            <div id="collapseLoans" class="collapse  {!! Request::is('new-loan-by-customer') ? 'show':'' !!}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Loan Related:</h6>
                    <a class="collapse-item {!! Request::is('new-loan-by-customer') ? 'active':'' !!}" href="{{url('/new-loan-by-customer')}}">My All Loans</a>
                    <a class="collapse-item {!! Request::is('all-loan-by-fieldofficer') ? 'active':'' !!}" href="{{url('/all-loan-by-fieldofficer')}}">My Current Loans</a>
                </div>
            </div>
        </li>

         @endcan
    @can('isCashier')
    <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-coins"></i>
                <span>Daily Collections</span>
            </a>
            <div id="collapseUtilities" class="collapse @if(Request::is('daily-field-officer-collection') || Request::is('today-saving-collection')) show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Collection Related:</h6>
                    <a class="collapse-item {!! Request::is('daily-field-officer-collection') ? 'active':'' !!}" href="{{url('/daily-field-officer-collection')}}">Officers Collection</a>
                    <a class="collapse-item {!! Request::is('today-saving-collection') ? 'active':'' !!}" href="{{url('/today-saving-collection')}}">Details Collection</a>
                    <a class="collapse-item {!! Request::is('all-received-collection') ? 'active':'' !!}" href="{{url('/all-received-collection')}}">Received Sheets</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsedwcollection" aria-expanded="true" aria-controls="collapsedwcollection">
                <i class="fas fa-fw fa-hands-helping"></i>
                <span> Date wise Collection</span>
            </a>
            <div id="collapsedwcollection" class="collapse  @if(Request::is('cashier-daily-entry')) show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Cashier Collection:</h6>
                    <a class="collapse-item {!! Request::is('cashier-daily-entry') ? 'active':'' !!}" href="{{url('/cashier-daily-entry')}}">Cashier Daily collection</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLoans" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-hands-helping"></i>
                <span> Loan Despatch</span>
            </a>
            <div id="collapseLoans" class="collapse  @if(Request::is('loan-for-dispatch') || Request::is('all-active-loans') ) show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Loan Related:</h6>
                    <a class="collapse-item {!! Request::is('loan-for-dispatch') ? 'active':'' !!}" href="{{url('loan-for-dispatch')}}">Loans for Despatch </a>
                    <a class="collapse-item {!! Request::is('all-active-loans') ? 'active':'' !!}" href="{{url('/all-active-loans')}}">Active Loans </a>
                    <a class="collapse-item {!! Request::is('all-time-loan') ? 'active':'' !!}" href="{{url('all-time-loan')}}">All Loans</a>

                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilitiesCost" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-money-check-alt"></i>
                <span>Additional Expenses</span>
            </a>
            <div id="collapseUtilitiesCost" class="collapse {!! Request::is('additional-cost-form') ? 'show':'' !!}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Expense Related:</h6>
                    <a class="collapse-item {!! Request::is('additional-cost-form') ? 'active':'' !!}" href="{{url('/additional-cost-form')}}">New Expense</a>
                    <a class="collapse-item {!! Request::is('additional-cost-category-form') ? 'active':'' !!}" href="{{url('/additional-cost-category-form')}}">New Expense Category</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCollection" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-money-check-alt"></i>
                <span>Additional Collections</span>
            </a>
            <div id="collapseCollection" class="collapse @if(Request::is('additional-collection-form')) show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Collection Related:</h6>
                    <a class="collapse-item {!! Request::is('additional-collection-form') ? 'active':'' !!}" href="{{url('/additional-collection-form')}}">New Collection</a>
                    <a class="collapse-item {!! Request::is('additional-category-form') ? 'active':'' !!}" href="{{url('/additional-category-form')}}">New Collection Category</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSavings" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-piggy-bank"></i>
                <span> Savings Close </span>
            </a>
            <div id="collapseSavings" class="collapse @if(Request::is('despatch-savings-withdraw-money') || Request::is('despatched-savings-money') ) show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Savings Related:</h6>
                    <a class="collapse-item {!! Request::is('despatch-savings-withdraw-money') ? 'active':'' !!}" href="{{url('/despatch-savings-withdraw-money')}}">Despatch Request</a>
                    <a class="collapse-item {!! Request::is('despatched-savings-money') ? 'active':'' !!}" href="{{url('/despatched-savings-money')}}">Despatch History</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities34" aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="fas fa-fw fa-file-pdf"></i>
                <span>Reports</span>
            </a>
            <div id="collapseUtilities34" class="collapse @if( Request::is('savings-report')||  Request::is('Loan-report') || Request::is('Expense-reports') || Request::is('Collection-reports') || Request::is('attendance-reports')) show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Report Management:</h6>
                    <a class="collapse-item {!! Request::is('savings-report') ? 'active':'' !!}" href="{{url('savings-report')}}">Savings Collections</a>
                    <a class="collapse-item {!! Request::is('show-dispatch-report') ? 'active':'' !!}" href="{{url('show-dispatch-report')}}">Loan Dispatch</a>
                    <a class="collapse-item {!! Request::is('Loan-report') ? 'active':'' !!}" href="{{url('Loan-report')}}">Loan Collections</a>
                    <a class="collapse-item {!! Request::is('Expense-reports') ? 'active':'' !!}" href="{{url('Expense-reports')}}">Expense Report</a>
                    <a class="collapse-item {!! Request::is('Collection-reports') ? 'active':'' !!}" href="{{url('Collection-reports')}}">Additional Collection</a>
                    <a  class="collapse-item {!! Request::is('field-officers-statement') ? 'active':'' !!}" href="{{url('field-officers-statement')}}">Field officers</a>
                    <a  class="collapse-item {!! Request::is('sheet-report') ? 'active':'' !!}" href="{{url('sheet-report')}}">Sheet Report</a>
                </div>
            </div>
        </li>
         @endcan
    @can('isSupervisor')
        <li class="nav-item">
            <a class="nav-link" href="{{url('/')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>Members</span>
            </a>
            <div id="collapseUtilities2" class="collapse @if(Request::is('new-member-requests') || Request::is('verified-members') ) show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Member Related:</h6>
                    <a class="collapse-item {!! Request::is('new-member-requests') ? 'active':'' !!}" href="{{url('/new-member-requests')}}">New Members</a>
                    <a class="collapse-item {!! Request::is('verified-members') ? 'active':'' !!}" href="{{url('/verified-members')}}">Verified Members</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities3" aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="fas fa-fw fa-coins"></i>
                <span>Daily Collections</span>
            </a>
            <div id="collapseUtilities3" class="collapse @if(Request::is('daily-Collections') || Request::is('daily-all-Collections') ) show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Collection Related:</h6>
                    <a class="collapse-item {!! Request::is('daily-Collections') ? 'active':'' !!}" href="{{url('/daily-Collections')}}">Field-Officer Collections</a>
                    <a class="collapse-item {!! Request::is('daily-all-Collections') ? 'active':'' !!}" href="{{url('/daily-all-Collections')}}">Total Collections</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities4" aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="fas fa-fw fa-piggy-bank"></i>
                <span>Savings </span>
            </a>
            <div id="collapseUtilities4" class="collapse @if(Request::is('withdraw-requests') || Request::is('pending-withdraw-requests') ) show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Withdraw Related:</h6>
                    <a class="collapse-item {!! Request::is('withdraw-requests') ? 'active':'' !!}" href="{{url('/withdraw-requests')}}">Withdraw Requests</a>
                    <a class="collapse-item {!! Request::is('pending-withdraw-requests') ? 'active':'' !!}" href="{{url('/pending-withdraw-requests')}}">Pending For Release</a>
                    <a class="collapse-item {!! Request::is('savings-statements') ? 'active':'' !!}" href="{{url('savings-statements')}}">Savings Statement</a>
                </div>
            </div>
        </li>
        <li class="nav-item ">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities5" aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="fas fa-fw fa-hands-helping"></i>
                <span>Loans</span>
            </a>
            <div id="collapseUtilities5" class="collapse @if(Request::is('all-time-loan')||Request::is('new-loan-request') || Request::is('new-loan-documents') || Request::is('All-current-loans') ) show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Loan Related:</h6>
                    <a class="collapse-item {!! Request::is('new-loan-request') ? 'active':'' !!}" href="{{url('/new-loan-request')}}">New Loan Applications</a>
                    <a class="collapse-item {!! Request::is('new-loan-documents') ? 'active':'' !!}" href="{{url('/new-loan-documents')}}">Pending Loans</a>
                    <a class="collapse-item {!! Request::is('All-current-loans') ? 'active':'' !!}" href="{{url('/All-current-loans')}}">All Active Loans</a>
                    <a class="collapse-item {!! Request::is('loan-statements') ? 'active':'' !!}" href="{{url('loan-statements')}}">Loan Statement</a>
                    <a class="collapse-item {!! Request::is('all-time-loan') ? 'active':'' !!}" href="{{url('all-time-loan')}}">All Loans</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities34" aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="fas fa-fw fa-file-pdf"></i>
                <span>Reports</span>
            </a>
            <div id="collapseUtilities34" class="collapse @if( Request::is('savings-report')||  Request::is('Loan-report') || Request::is('Expense-reports') || Request::is('Collection-reports') || Request::is('field-officers-statement')) show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Report Management:</h6>
                    <a class="collapse-item {!! Request::is('savings-report') ? 'active':'' !!}" href="{{url('savings-report')}}">Savings Collections</a>
                    <a class="collapse-item {!! Request::is('show-dispatch-report') ? 'active':'' !!}" href="{{url('show-dispatch-report')}}">Loan Dispatch</a>
                    <a class="collapse-item {!! Request::is('Loan-report') ? 'active':'' !!}" href="{{url('Loan-report')}}">Loan Collections</a>
                    <a class="collapse-item {!! Request::is('Expense-reports') ? 'active':'' !!}" href="{{url('Expense-reports')}}">Expense Report</a>
                    <a class="collapse-item {!! Request::is('Collection-reports') ? 'active':'' !!}" href="{{url('Collection-reports')}}">Additional Collection</a>
                    <a  class="collapse-item {!! Request::is('field-officers-statement') ? 'active':'' !!}" href="{{url('field-officers-statement')}}">Field officers</a>
                    <a  class="collapse-item {!! Request::is('sheet-report') ? 'active':'' !!}" href="{{url('sheet-report')}}">Sheet Report</a>
                </div>
            </div>
        </li>
    @endcan
    @can('isIT')
        <li class="nav-item">
            <a class="nav-link" href="{{url('/')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2" aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>Slider</span>
            </a>
            <div id="collapseUtilities2" class="collapse @if(Request::is('slider-input')) show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Slide Related:</h6>
                    <a class="collapse-item {!! Request::is('slider-input') ? 'active':'' !!}" href="{{url('/slider-input')}}">Slide Settings</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities234" aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="far fa-id-badge"></i>
                <span>Staff's Profile</span>
            </a>
            <div id="collapseUtilities234" class="collapse @if(Request::is('all-staffs')||Request::is('manage-staff-info')) show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Staff profile Related:</h6>
                    <a class="collapse-item {!! Request::is('all-staffs') ? 'active':'' !!}" href="{{url('all-staffs')}}">New Profile</a>
{{--                    <a class="collapse-item {!! Request::is('manage-staff-info') ? 'active':'' !!}" href="{{url('/manage-staff-info')}}">Manage Profiles</a>--}}
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities221" aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="fas fa-address-card"></i>
                <span>About Settings</span>
            </a>
            <div id="collapseUtilities221" class="collapse @if(Request::is('new-about-info')) show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">About ORG Related:</h6>
                    <a class="collapse-item {!! Request::is('new-about-info') ? 'active':'' !!}" href="{{url('new-about-info')}}">About Settings</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEvents" aria-expanded="true" aria-controls="collapseUtilities2">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>Event Settings</span>
            </a>
            <div id="collapseEvents" class="collapse @if(Request::is('all-event')) show @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Event Related:</h6>
                    <a class="collapse-item {!! Request::is('all-event') ? 'active':'' !!}" href="{{url('all-event')}}">All Event</a>
                </div>
            </div>
        </li>

    @endcan
    <!-- Divider -->
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
