@auth()
<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
  <a class="navbar-brand" href="{{url('/')}}">
    <img src="{{ asset('storage/images/global50-50-logo.png') }}" height="40px" />
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <form action="{{route('customer.index')}}" class="form-inline">
    <div class="form-group">
        <select name="customer" id="" class="form-control" style="min-width: 250px; border-radius: 3px 0px 0px 3px">
                <?php $customers = $_customer::orderby('created_at','desc')->get()?>
                @foreach($customers as $customer)
                    <option value="{{$customer->id}}">{{$customer->fullname()}}</option>
                @endforeach
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-sm" style="border-radius: 0px 3px 3px 0px"><i class="fa fa-eye"></i> view customer</button>
    </div>
  </form>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ml-auto">
        <li class="nav-item ">
            <a href="{{route('customer.index')}}" class="nav-link">
               <i class="fa fa-users"></i> Customers
            </a>
        </li>

        <li class="nav-item ">
            <a href="{{route('supplies')}}" class="nav-link">
                <i class="fa fa-upload"></i> Supplies
            </a>
        </li>

        <li class="nav-item ">
            <a href="{{route('payments')}}" class="nav-link">
                <i class="fa fa-upload"></i> Payments
            </a>
        </li>


        <!-- <li class="nav-item dropdown">
            <a href="{{route('supplies')}}" class="nav-link dropdown-toggle" id="supplies-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-calendar"></i> Monthly transaction
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
        </li> -->

      <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="create-dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-plus"></i> Create
            </a>
                <div class="dropdown-menu" aria-labelledby="create-dropdown">
                <a class="dropdown-item" href="{{route('customer.create')}}"><i class="fa fa-user"></i> New Customer</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('supply.create')}}"><i class="fa fa-question-circle"></i> New Supply</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('payment.create')}}"><i class="fa fa-question-circle"></i> New Payment</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('user.create')}}"><i class="fa fa-user-tie"></i> New User</a>
            </div>
      </li>
    </ul>

<!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
                
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fa fa-user"></i> {{ auth()->user()->firstname }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{route('user.index')}}" class="dropdown-item"><i class="fa fa-users"></i> All users</a>
                           <a href="{{route('user.show',[auth()->user()->id])}}" class="dropdown-item"><i class="fa fa-history"></i> My Transactions</a>
                            <a href="{{route('user.password.change',[auth()->user()->id])}}" class="dropdown-item"><i class="fa fa-key"></i> Change password</a>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out-alt"></i> {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li> 
                   

        </ul>
  </div>
</nav>
<a href="{{route('pause')}}" style="position: fixed;z-index: 1200; bottom: 10px; right: 10px; color: red; font-size: 60px" title="pause">
    <i class="fa fa-pause-circle"></i>
</a>
@endauth

