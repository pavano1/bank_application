
    <!-- Menu items -->
 
<div class="overlay"></div>
<aside id="minileftbar" class="minileftbar">
    <ul class="menu_list">
        <li>
            <a href="javascript:void(0);" class="bars"></a>
         <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Madilu">
            </a>
        </li>
        <li><a href="javascript:void(0);" class="btn_overlay hidden-sm-down"><i class="zmdi zmdi-search"></i></a></li>
        <li><a href="javascript:void(0);" class="menu-sm"><i class="zmdi zmdi-swap"></i></a></li>
        <li class="menuapp-btn"><a href="javascript:void(0);"><i class="zmdi zmdi-apps"></i></a></li>
        <li><a href="javascript:void(0);" class="fullscreen" data-provide="fullscreen"><i class="zmdi zmdi-fullscreen"></i></a></li>
     <li class="power">
    <a href="javascript:void(0);" onclick="event.preventDefault(); document.querySelector('form[action=\'{{ route('logout') }}\']').submit();">
        <i class="zmdi zmdi-power"></i>
    </a>
</li>

    </ul>
</aside>
<aside class="right_menu">
    <div id="leftsidebar" class="sidebar">
        <div class="menu">
            <ul class="list">
                <!-- <li>
                    <div class="user-info m-b-20">
                        <div class="detail">
                            <a href="dashboard.php"><img src="assets/img/logo.png"></a>
                        </div>
                    </div>
                </li> -->
                <li class="header">MAIN</li>
               
                <li><a href="javascript:void(0);" class="menu-toggle"><i class="material-icons">home</i><span>Account</span> </a>
               <ul class="ml-menu">
    @if(Auth::user()->is_admin)
        <!-- Menu for Admin -->
        <li class="nav-item">
            <a href="{{ route('admin.create_savings_accounts') }}">Add Account</a>
        </li>
        <li>
            <a href="{{ route('admin.accounts') }}">View Accounts</a>
        </li>
    @else
        <!-- Menu for Non-Admin User -->
        <li>
            <a href="{{ route('user.account') }}">View Account</a>
        </li>
    @endif
</ul>

                </li>
              
                <li><a href="javascript:void(0);" class="menu-toggle"><i class="material-icons">description</i><span>Transaction</span> </a>
                     <ul class="ml-menu">
                        <li><a href="{{ route('transaction.transfer_form')}}">Transfer Amount</a></li>
                        <li><a href="{{ route('transaction.transfer_history')}}">View Transcation</a></li>
                    </ul>
                </li>
                  <li class="power">
    <li><a href="{{ route('logout')}}">Logout</a></li>
        
    </a>
</li>

                <!-- <li><a href="javascript:void(0);" class="menu-toggle"><i class="material-icons">local_hospital</i><span>Consultation</span> </a>
                    <ul class="ml-menu">
                        <li><a href="add-consultation.php">Create New</a></li>
                        <li><a href="order-consultation-domestic.php">Domestic Booking</a></li>
                        <li><a href="order-consultation-intl.php">International Booking</a></li>
                    </ul>
                </li> -->
                
                <!-- <li><a href="javascript:void(0);" class="menu-toggle"><i class="material-icons">local_hospital</i><span>Return Management</span> </a>
                    <ul class="ml-menu">
                        <li><a href="order-returns.php">New Case</a></li>
                        <li><a href="order-returns-history.php">History</a></li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>
</aside>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
    $(".menu-toggle").on("click", function () {
        var submenu = $(this).next(".ml-menu"); // Find the next submenu
        submenu.stop(true, true).slideToggle(); // Slide it open/closed
        $(this).toggleClass("opened"); // Optionally toggle a class to indicate whether it's opened
    });
});
</script>

