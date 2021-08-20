<li class="nav-item">
            <a href="#" class="nav-link {{ Request::is('admin/settings') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Settings
              </p>
            </a>
          </li>
<li class="nav-item has-treeview 
          @if (Request::is('admin/user/create') || Request::is('admin/user'))
           menu-open
          @endif ">
            <a href="#" class="nav-link 
            @if (Request::is('admin/user/create') || Request::is('admin/user'))
              active
            @endif ">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('backend.user.create') }}" class="nav-link {{ Request::is('admin/user/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('backend.user.index') }}" class="nav-link {{ Request::is('admin/user') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend.customer.index') }}" class="nav-link {{ Request::is('admin/customer/index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Customer List
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend.agentuser.index') }}" class="nav-link {{ Request::is('admin/agentuser/index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-secret"></i>
              <p>
                Agent List
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview 
          @if (Request::is('admin/awb/create') || Request::is('admin/awb'))
           menu-open
          @endif ">
            <a href="#" class="nav-link 
            @if (Request::is('admin/awb/create') || Request::is('admin/awb'))
              active
            @endif ">
              <i class="nav-icon fas fa-plane"></i>
              <p>
                Air Way Bill
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('backend.awb.create') }}" class="nav-link {{ Request::is('admin/awb/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Storage</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('backend.awb.index') }}" class="nav-link {{ Request::is('admin/awb') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Storage List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview 
          @if (Request::is('admin/branch/create') || Request::is('admin/branch'))
           menu-open
          @endif 
          ">
            <a href="#" class="nav-link 
            @if (Request::is('admin/branch/create') || Request::is('admin/branch')) 
              active  
            @endif
            ">
              <i class="nav-icon fas fa-bezier-curve"></i>
              <p>
                Branches
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('backend.branch.create') }}" class="nav-link {{ Request::is('admin/branch/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Branch</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('backend.branch.index') }}" class="nav-link {{ Request::is('admin/branch') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Branch List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview
          @if (Request::is('admin/product/create') || Request::is('admin/product'))
           menu-open
          @endif 
          ">
            <a href="#" class="nav-link
            @if (Request::is('admin/product/create') || Request::is('admin/product')) 
              active  
            @endif
            ">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Products
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('backend.product.create') }}" class="nav-link {{ Request::is('admin/product/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('backend.product.index') }}" class="nav-link {{ Request::is('admin/product') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product List</p>
                </a>
              </li>
            </ul>
          </li>
           <!--   <li class="nav-item has-treeview 
          @if (Request::is('admin/awb/create') || Request::is('admin/awb'))
           menu-open
          @endif ">
            <a href="#" class="nav-link 
            @if (Request::is('admin/awb/create') || Request::is('admin/awb'))
              active
            @endif ">
              <i class="nav-icon fas fa-user-secret"></i>
              <p>
                Agent
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('backend.agent.create') }}" class="nav-link {{ Request::is('admin/agent/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Bill</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('backend.agent.index') }}" class="nav-link {{ Request::is('admin/agent') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bill List</p>
                </a>
              </li>
            </ul>
          </li>
      <li class="nav-item has-treeview 
          @if (Request::is('admin/bill/create') || Request::is('admin/bill'))
           menu-open
          @endif 
          ">
            <a href="#" class="nav-link 
            @if (Request::is('admin/bill/create') || Request::is('admin/bill'))
              active
            @endif 
            ">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                Billing
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('backend.bill.create') }}" class="nav-link {{ Request::is('admin/bill/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Bill</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('backend.bill.index') }}" class="nav-link {{ Request::is('admin/bill') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Bill</p>
                </a>
              </li>
            </ul>
          </li>-->
         <!-- <li class="nav-item has-treeview 
          @if (Request::is('admin/bill/create') || Request::is('admin/bill'))
           menu-open
          @endif 
          ">
            <a href="#" class="nav-link 
            @if (Request::is('admin/bill/create') || Request::is('admin/bill'))
              active
            @endif 
            ">
              <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                Billing
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('backend.agent.index') }}" class="nav-link {{ Request::is('admin/agent/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Agent</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('backend.bill.index') }}" class="nav-link  {{ Request::is('admin/bill/create') ? 'active' : '' }} {{ Request::is('admin/bill') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer</p>
                </a>
              </li>
            </ul>

          </li>
          <li class="nav-item">
            <a href="{{ route('backend.report.index') }}" class="nav-link {{ Request::is('admin/report/index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>
                Report
              </p>
            </a>
          </li>-->