<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
  <div>
    <div class="logo-wrapper" style="height: auto; width:200px;"><a href="{{ url('/') }}"><img class="img-fluid for-light" src="{{ asset(env('APP_LOGO_DARK')) }}" alt=""><img class="img-fluid for-dark" src="{{ asset(env('APP_LOGO_LIGHT')) }}" alt=""></a>
      <div class="back-btn"><i class="fa fa-angle-left"></i></div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
    </div>
    <div class="logo-icon-wrapper"><a href="{{ url('/') }}"><img class="img-fluid" width="50px" src="{{ asset(env('APP_FAVICON')) }}" alt=""></a></div>
    <nav class="sidebar-main">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="sidebar-menu">
        <ul class="sidebar-links" id="simple-bar">
          <li class="back-btn"><a href="{{ url('/') }}"><img class="img-fluid" src="{{ asset(env('APP_FAVICON')) }}" alt=""></a>
            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
          </li>
          <li class="sidebar-main-title">
            <div>
              <h6>General</h6>
            </div>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title link-nav {{Route::is('dashboard') ? 'active' : ''}}" href="{{ route('dashboard') }}">
              <i data-feather="home"></i><span>Dashboard</span>
            </a>
          </li>
          @if(auth()->user()->role_as === 'Admin')
          <li class="sidebar-main-title">
            <div>
              <h6>Masters</h6>
            </div>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title link-nav {{Route::is('brand.index') ? 'active' : ''}}" href="{{ route('brand.index') }}">
              <i data-feather="bold"></i><span>Brand</span>
            </a>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title link-nav {{Route::is('category.index') ? 'active' : ''}}" href="{{ route('category.index') }}">
              <i data-feather="code"></i><span>Category</span>
            </a>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title link-nav {{Route::is('season.index') ? 'active' : ''}}" href="{{ route('season.index') }}">
              <i data-feather="cloud"></i><span>Season</span>
            </a>
          </li>
         
          {{-- <li class="sidebar-list">
            <a class="sidebar-link sidebar-title link-nav {{Route::is('item.create') ? 'active' : ''}}" href="{{ route('item.create') }}">
              <i data-feather="home"></i><span>Article</span>
            </a>
          </li> --}}
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="#">
              <i data-feather="layers"></i><span>Manage Article</span>
            </a>
            <ul class="sidebar-submenu">
              <li><a href="{{ route('item.create') }}">Add Article</a></li>
              <li><a href="{{ route('item.index') }}">All Article</a></li>
            </ul>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title link-nav {{Route::is('barcode.print.index') ? 'active' : ''}}" href="{{ route('barcode.print.index') }}">
              <i data-feather="film"></i><span>Barcode</span>
            </a>
          </li>
          @endif
          @if(auth()->user()->role_as === 'Stock_Management' || auth()->user()->role_as === 'Admin')
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="#">
              <i data-feather="archive"></i><span>Manage Stock</span>
            </a>
            <ul class="sidebar-submenu">
              <li><a href="{{route('manage_stock.index','title=in')}}">Stock In </a></li>
              <li><a href="{{route('manage_stock.index','title=out')}}">Stock Out</a></li>
              <li><a href="{{route('manage_stock.average')}}">Remaining Stock</a></li>
              <li><a href="{{route('manage_stock.report','title=all')}}">Stock Alert</a></li>
            </ul>
          </li>
          @endif
          @if(auth()->user()->role_as === 'Purchase_Management' || auth()->user()->role_as === 'Admin')
          <li class="sidebar-main-title">
            <div>
              <h6>Purchase Order</h6>
            </div>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="#">
              <i data-feather="file-plus"></i><span>Manage Purchase</span>
              <label class="badge badge-light-danger">*</label>
            </a>
            <ul class="sidebar-submenu">
              <li><a href="{{route('purchase.create')}}">Add Purchase </a></li>
              <li><a href="{{route('purchase.index')}}">All Purchases</a></li>
              <li><a href="{{route('purchase.report')}}">Purchase Report</a></li>
            
            </ul>
          </li>
          @endif
          @if(auth()->user()->role_as === 'Order_Management' || auth()->user()->role_as === 'Admin')
          <li class="sidebar-main-title">
            <div>
              <h6>Sale Order</h6>
            </div>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="#">
              <i data-feather="folder-minus"></i><span>Manage Sale</span>
              <label class="badge badge-light-danger">*</label>
            </a>
            <ul class="sidebar-submenu">
              <li><a href="{{route('sale.create')}}">Add Sale </a></li>
              <li><a href="{{route('sale.index')}}">All Sales</a></li>
              <li><a href="{{route('sale.report')}}">Sale Report</a></li>
            
            </ul>
          </li>
          @endif
          @if(auth()->user()->role_as === 'Admin')
          <li class="sidebar-main-title">
            <div>
              <h6>Expense / Income</h6>
            </div>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title link-nav {{Route::is('expense.index') ? 'active' : ''}}" href="{{ route('expense.index') }}">
              <i data-feather="minus-circle"></i><span>Manage Expense</span>
            </a>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title link-nav {{Route::is('income.index') ? 'active' : ''}}" href="{{ route('income.index') }}">
              <i data-feather="plus-circle"></i><span>Manage Income</span>
            </a>
          </li>
          <li class="sidebar-main-title">
            <div>
              <h6>Vendor / Customer</h6>
            </div>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title link-nav {{ request()->routeIs('ledger.index') && request('from') === 'Vendor' ? 'active' : '' }}"
               href="{{ route('ledger.index', ['from' => 'Vendor']) }}">
                <i data-feather="minus-circle"></i><span>Manage Vendor</span>
            </a>
        </li>
        
        <li class="sidebar-list">
            <a class="sidebar-link sidebar-title link-nav {{ request()->routeIs('ledger.index') && request('from') === 'Customer' ? 'active' : '' }}"
               href="{{ route('ledger.index', ['from' => 'Customer']) }}">
                <i data-feather="plus-circle"></i><span>Manage Customer</span>
            </a>
        </li>
        
        
          <li class="sidebar-main-title">
            <div>
              <h6>Account</h6>
            </div>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="#">
              <i data-feather="book"></i><span>Manage Master</span>
              <label class="badge badge-light-danger">*</label>
            </a>
            <ul class="sidebar-submenu">
              <li><a href="{{route('account_master.index')}}">Account Master </a></li>
              <li><a href="{{route('payment_master.index')}}">Payment Master </a></li>
              {{-- <li><a href="{{route('ledger.index','from=expense')}}">Expense</a></li>
              <li><a href="{{route('ledger.index','from=income')}}">Income</a></li> --}}
              {{-- <li><a href="{{route('ledger.index','from=Vendor')}}">Vendor</a></li>
              <li><a href="{{route('ledger.index','from=Customer')}}">Customer</a></li> --}}
            </ul>
          </li>
          <li class="sidebar-main-title">
            <div>
              <h6>Report</h6>
            </div>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title link-nav {{Route::is('transaction.report') ? 'active' : ''}}" href="{{ route('transaction.report') }}">
              <i data-feather="clipboard"></i><span>Transaction Report</span>
            </a>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title link-nav {{Route::is('stock.report') ? 'active' : ''}}" href="{{ route('stock.report') }}">
              <i data-feather="database"></i><span>Stock Report</span>
            </a>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title link-nav {{Route::is('profit.report') ? 'active' : ''}}" href="{{ route('profit.report') }}">
              <i data-feather="dollar-sign"></i><span>Profit & Loss Report</span>
            </a>
          </li>
          <li class="sidebar-main-title">
            <div>
              <h6>Settings</h6>
            </div>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title link-nav {{Route::is('user.index') ? 'active' : ''}}" href="{{ route('user.index') }}">
              <i data-feather="settings"></i><span>Employee</span>
            </a>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title link-nav {{Route::is('website.setting') ? 'active' : ''}}" href="{{ route('website.setting') }}">
              <i data-feather="settings"></i><span>Website Setting</span>
            </a>
          </li>
        </ul>
        @endif
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
  </div>
</div>