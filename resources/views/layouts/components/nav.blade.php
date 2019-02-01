@auth()
<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
  <a class="navbar-brand" href="{{url('/')}}">{{config('app.name')}}</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <form action="{{route('customer.index')}}" class="form-inline">
    <div class="form-group">
        <select name="customer" id="" class="form-control" style="min-width: 250px;">
                <?php $customers = $_customers::orderby('created_at','desc')->get()?>
                @foreach($customers as $customer)
                    <option value="{{$customer->id}}">{{$customer->fullname()}}</option>
                @endforeach
        </select>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary btn-sm" value="view customer">
    </div>
  </form>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ml-auto">
        <li class="nav-item ">
            <a href="{{route('customer.index')}}" class="nav-link">
                Customers
            </a>
        </li>
        <li class="nav-item ">
            <a href="{{route('order.index')}}" class="nav-link">
                All Orders
            </a>
        </li>

        <li class="nav-item dropdown">
            <a href="{{route('order.index')}}" class="nav-link dropdown-toggle" id="orders-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Monthly Orders
            </a>
            <div class="dropdown-menu" id="nav-orders" aria-labelledby="orders-dropdown">
                      <div class="dropdown-item">
                        <form action="{{route('order.index')}}" >
                            <div class="form-group">
                            <label for="">Select month</label>
                                <input type="month" name="month" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Show Orders" class="btn btn-primary btn-block">
                            </div>

                        </form>
                      </div> 
            </div>
        </li>

        <li class="nav-item ">
            <a href="{{route('supplies')}}" class="nav-link">
                All supplies
            </a>
        </li>

        <li class="nav-item dropdown">
            <a href="{{route('supplies')}}" class="nav-link dropdown-toggle" id="supplies-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Monthly supplies
            </a>
            <div class="dropdown-menu" id="nav-supplies" aria-labelledby="supplies-dropdown">
                      <div class="dropdown-item">
                        <form action="{{route('supplies')}}" >
                            <div class="form-group">
                            <label for="">Select month</label>
                                <input type="month" name="month" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Show Supplies" class="btn btn-primary btn-block">
                            </div>

                        </form>
                      </div> 
            </div>
        </li>

      <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="create-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Create
            </a>
                <div class="dropdown-menu" aria-labelledby="create-dropdown">
                <a class="dropdown-item" href="{{route('customer.create')}}">New Customer</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('order.create')}}">New Order</a>
                <div class="dropdown-divider"></div>
                @if(auth()->user()->position === 4)
                    <a class="dropdown-item" href="{{route('user.create')}}">New User</a>
                @endif
            </div>
      </li>
    </ul>

<!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
                
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ auth()->user()->firstname }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{route('user.index')}}" class="dropdown-item">All users</a>
                           <a href="{{route('user.show',[auth()->user()->id])}}" class="dropdown-item">My Transactions</a>
                            <a href="{{route('password.change',[auth()->user()->id])}}" class="dropdown-item">Change password</a>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li> 
                   

        </ul>
  </div>
</nav>
@endauth
<a href="{{route('staff')}}" style="position: fixed;z-index: 1200; bottom: 10px; right: 10px; width: 40px; height: 40px; border-radius: 50%; box-shadow: 0px 10px 10px rgba(0,0,0,.2);background-color: #000" title="sleep"></a>
