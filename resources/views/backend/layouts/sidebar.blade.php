<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('backend.dashboard') }}" class="brand-link">
      <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
      <span class="brand-text font-weight-light">Desh Online</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo asset('/').'uploads/profile/'.Auth::user()->img_name;?>" width="160" height="160" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ route('backend.profile.view',Auth::user()->seller_id) }}" class="d-block">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
        </div>
      </div>

      @if(Request::is('admin*'))
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
             
          <li class="nav-item">
            <a href="{{ route('backend.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if(Auth::user()->role_id==1)

          <li class="nav-item">
            <a href="{{ route('backend.settings.create') }}" class="nav-link {{ Request::is('admin/settings') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="{{ route('backend.funds.create') }}" class="nav-link {{ Request::is('admin/funds') ? 'active' : '' }}">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Funds
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend.tree.view') }}" class="nav-link {{ Request::is('admin/treeview') ? 'active' : '' }}">
              <i class="nav-icon fas fa-bezier-curve"></i>
              <p>
                Tree
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('backend.tree.listv') }}" class="nav-link {{ Request::is('admin/treelistview') ? 'active' : '' }}">
              <i class="nav-icon fas fa-bezier-curve"></i>
              <p>
                Hierarchy
              </p>
            </a>
          </li>
         
          @endif
          <li class="nav-item">
            <a href="{{ route('backend.profile.view',Auth::user()->seller_id) }}" class="nav-link {{ Request::is('admin/profile') ? 'active' : '' }}">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="{{ route('backend.cashout.index') }}" class="nav-link {{ Request::is('admin/cashout') ? 'active' : '' }}">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>
                CashOut
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend.tree.index',Auth::user()->seller_id) }}" class="nav-link {{ Request::is('admin/tree') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>
               My Tree
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend.sales.create') }}" class="nav-link {{ Request::is('admin/sales') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Sales Update
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend.team.index') }}" class="nav-link {{ Request::is('admin/team') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
              My Team
              </p>
            </a>
          </li>
          
          @if(Auth::user()->role_id==1) 
           <li class="nav-item">
            <a href="{{ route('backend.pcn.list') }}" class="nav-link {{ Request::is('admin/pcn') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>
               PCN
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="{{ route('backend.cash.view') }}" class="nav-link {{ Request::is('admin/cashview') ? 'active' : '' }}">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>
                Transaction
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview
          @if (Request::is('admin/role/create') || Request::is('admin/role'))
           menu-open
          @endif 
          ">
            <a href="#" class="nav-link
            @if (Request::is('admin/role/create') || Request::is('admin/role')) 
              active  
            @endif
            ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Roles
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('backend.role.create') }}" class="nav-link {{ Request::is('admin/role/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Roles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('backend.role.index') }}" class="nav-link {{ Request::is('admin/role') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Role List</p>
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
              <i class="nav-icon fas fa-cart-arrow-down"></i>
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
              <li class="nav-item">
                <a href="{{ route('backend.sellerproduct.show') }}" class="nav-link {{ Request::is('admin/product') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Seller Product </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview
          @if (Request::is('admin/category/create') || Request::is('admin/category'))
           menu-open
          @endif 
          ">
            <a href="#" class="nav-link
            @if (Request::is('admin/category/create') || Request::is('admin/category')) 
              active  
            @endif
            ">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Categories 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('backend.category.create') }}" class="nav-link {{ Request::is('admin/category/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('backend.category.index') }}" class="nav-link {{ Request::is('admin/category') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview
          @if (Request::is('admin/subcategory/create') || Request::is('admin/subcategory'))
           menu-open
          @endif 
          ">
            <a href="#" class="nav-link
            @if (Request::is('admin/subcategory/create') || Request::is('admin/subcategory')) 
              active  
            @endif
            ">
              <i class="nav-icon fas fa-edit"></i>
              <p>
               SubCategories
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('backend.subcategory.create') }}" class="nav-link {{ Request::is('admin/subcategory/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add SubCategory</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('backend.subcategory.index') }}" class="nav-link {{ Request::is('admin/subcategory') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SubCategory List</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item has-treeview
          @if (Request::is('admin/brand/create') || Request::is('admin/brand'))
           menu-open
          @endif 
          ">
            <a href="#" class="nav-link
            @if (Request::is('admin/brand/create') || Request::is('admin/brand')) 
              active  
            @endif
            ">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Brands
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('backend.brand.create') }}" class="nav-link {{ Request::is('admin/brand/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Brand</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('backend.brand.index') }}" class="nav-link {{ Request::is('admin/brand') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brand List</p>
                </a>
              </li>
            </ul>
          </li>
         <!-- <li class="nav-item has-treeview
          @if (Request::is('admin/attributes/create') || Request::is('admin/attributes'))
           menu-open
          @endif 
          ">
            <a href="#" class="nav-link
            @if (Request::is('admin/attributes/create') || Request::is('admin/attributes')) 
              active  
            @endif
            ">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Attributes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('backend.attributes.create') }}" class="nav-link {{ Request::is('admin/attributes/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Attributes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('backend.attributes.index') }}" class="nav-link {{ Request::is('admin/attributes') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Attributes List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('backend.attributesvalues.create') }}" class="nav-link {{ Request::is('admin/attributesvalues/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Attributes Values</p>
                </a>
              </li>
            </ul>
          </li>-->
         
          <li class="nav-item has-treeview
          @if (Request::is('admin/create') || Request::is('admin/create'))
           menu-open
          @endif 
          ">
            <a href="#" class="nav-link
            @if (Request::is('admin/create') || Request::is('admin/create')) 
              active  
            @endif
            ">
              <i class="nav-icon fas fa-file"></i>
              <p>
               Admin
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             <!-- <li class="nav-item">
                <a href="{{ route('backend.admin.create') }}" class="nav-link {{ Request::is('admin/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Admin</p>
                </a>
              </li>-->
              <li class="nav-item">
                <a href="{{ route('backend.adminlist') }}" class="nav-link {{ Request::is('admin/adminlist') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview
          @if (Request::is('admin/seller/create') || Request::is('admin/seller'))
           menu-open
          @endif 
          ">
            <a href="#" class="nav-link
            @if (Request::is('admin/seller/create') || Request::is('admin/seller')) 
              active  
            @endif
            ">
              <i class="nav-icon fas fa-file"></i>
              <p>
               Seller
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('backend.seller.create') }}" class="nav-link {{ Request::is('admin/seller/create') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Seller</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('backend.seller.index') }}" class="nav-link {{ Request::is('admin/seller') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Seller List</p>
                </a>
              </li>
            </ul>
          </li>
         
          <li class="nav-item">
            <a href="{{ route('backend.customer') }}" class="nav-link {{ Request::is('admin/customer') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Customer
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend.order.index') }}" class="nav-link {{ Request::is('admin/order') ? 'active' : '' }}">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Orders
              </p>
            </a>
          </li>
                    @endif

          
           <li class="nav-item">
            <a href="{{ route('backend.order.myorder',Auth::user()->id) }}" class="nav-link {{ Request::is('admin/myorder') ? 'active' : '' }}">
              <i class="nav-icon fas fa-cog"></i>
              <p>
               My Orders
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('backend.stock') }}" class="nav-link {{ Request::is('admin/stock') ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Stock
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
      @endif
    </div>
    <!-- /.sidebar -->
  </aside>