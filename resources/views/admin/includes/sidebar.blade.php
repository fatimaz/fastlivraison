    <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo"><a href=""><i class="icon ion-android-star-outline"></i> megameublle</a></div>
    <div class="sl-sideleft">


      <div class="sl-sideleft-menu">
        <a href="{{route('admin.dashboard')}}" class="sl-menu-link active">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Dashboard</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

         <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
            <span class="menu-item-label">Users</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.users')}}"  class="nav-link">Show all  <span
                            class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\User::count()}} </span></a></li>
          <li class="nav-item"><a href="{{route('admin.users.create')}}"  class="nav-link">Add new user</a></li>
        </ul>
        

          <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
            <span class="menu-item-label">Categories</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.categories')}}" class="nav-link">Show all  <span
                            class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Category::count()}} </span></a></li>
          <li class="nav-item"><a href="{{route('admin.categories.create')}}" class="nav-link">Add new category</a></li>
      
        </ul>

          <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
            <span class="menu-item-label">Trips</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.trips')}}" class="nav-link">Show all  <span
                            class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Trip::count()}} </span></a></li>
          <li class="nav-item"><a href="{{route('admin.trips.create')}}" class="nav-link">Add new trip</a></li>
        </ul>
    
    
          <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
            <span class="menu-item-label">Shipment</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.shipments')}}" class="nav-link">Show all  <span
                            class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Shipment::count()}} </span></a></li>
          <li class="nav-item"><a href="{{route('admin.shipments.create')}}" class="nav-link">Add new shipment</a></li>
        </ul>


          <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
            <span class="menu-item-label">Countries</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.countries')}}" class="nav-link">Show all  <span
                            class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Country::count()}} </span></a></li>
          <li class="nav-item"><a href="{{route('admin.countries.create')}}" class="nav-link">Add new Country</a></li>
        </ul>
    
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
            <span class="menu-item-label">Orders</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.orders')}}"  class="nav-link">Orders</a></li>
            <li class="nav-item"><a href="{{route('admin.orders.create')}}" class="nav-link">Add new orders</a></li>

        </ul>

        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
            <span class="menu-item-label">Trips</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.trips')}}"  class="nav-link">Trips</a></li>
            <li class="nav-item"><a href="{{route('admin.trips.create')}}" class="nav-link">Add new Trip</a></li>
        </ul>

     
         <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
            <span class="menu-item-label">Others</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
    
          <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.demandes')}}"  class="nav-link">Demandes</a></li>      
        </ul>
      </div><!-- sl-sideleft-menu -->

      <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->