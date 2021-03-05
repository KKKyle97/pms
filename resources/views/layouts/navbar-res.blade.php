<div class="pt-3">
    <img src="{{asset('/image/ribbon.png')}}" alt="ribbon" height="40px" width="50px" style="display: block">
</div>
{{-- <div class="col d-flex flex-column py-5">
    <a href="{{url('/')}}">
        <div class="font-semi p-3 row d-flex align-items-center m-0">
            <span class="material-icons px-3">
                home
            </span>
            Home
        </div>
    </a>
    <a href="{{route('patients.create')}}">
        <div class="font-semi p-3 row d-flex align-items-center m-0">
            <span class="material-icons px-3">
                add_circle_outline
            </span>
            Add New Patient
        </div>
    </a>
    <a href="{{route('patients.index')}}">
        <div class="font-semi p-3 row d-flex align-items-center m-0">
            <span class="material-icons px-3">
                format_list_bulleted
            </span>
            View All Patients
        </div>
    </a>
    <a href="{{route('notifications.index')}}">
        <div class="font-semi p-3 row d-flex align-items-center m-0">
            <span class="material-icons px-3">
                notifications_active
            </span>
            Notifications
        </div>
    </a>
    <a href="{{route('users.show',[Auth::user()->id])}}">
        <div class="font-semi p-3 row d-flex align-items-center m-0">
            <span class="material-icons px-3">
                face
            </span>
            My Profile
        </div>
    </a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
        <div class="font-semi p-3 row d-flex align-items-center m-0">
            <span class="material-icons px-3">
                login
            </span>

            {{ __('Logout') }}

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </a>
</div> --}}
<div id="mySidenav" class="sidenav">
    <div class="title p-3">
        <p class="font-18 pl-5 m-0">Child Of Light</p>
        <div class="closebtn">
            <a class="p-0" href="javascript:void(0)" onclick="closeNav()"> &times;</a>
        </div>
        
    </div>
    
    <a href="{{url('/')}}">
        <div class="font-semi pt-2 pb-3 px-3 row d-flex align-items-center m-0">
            <span class="material-icons px-3">
                home
            </span>
            Home
        </div>
    </a>
    <a href="{{route('patients.create')}}">
        <div class="font-semi p-3 row d-flex align-items-center m-0">
            <span class="material-icons px-3">
                add_circle_outline
            </span>
            Add New Patient
        </div>
    </a>
    <a href="{{route('patients.index')}}">
        <div class="font-semi p-3 row d-flex align-items-center m-0">
            <span class="material-icons px-3">
                format_list_bulleted
            </span>
            View All Patients
        </div>
    </a>
    <a href="{{route('notifications.index')}}">
        <div class="font-semi p-3 row d-flex align-items-center m-0">
            <span class="material-icons px-3">
                notifications_active
            </span>
            Notifications
        </div>
    </a>
    <a href="{{route('users.show',[Auth::user()->id])}}">
        <div class="font-semi p-3 row d-flex align-items-center m-0">
            <span class="material-icons px-3">
                face
            </span>
            My Profile
        </div>
    </a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
        <div class="font-semi p-3 row d-flex align-items-center m-0">
            <span class="material-icons px-3">
                login
            </span>

            {{ __('Logout') }}

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </a>
</div>
<div class="burger">
    <span style="font-size:30px;cursor:pointer;" onclick="openNav()">&#9776;</span>
</div>


<script>
    function openNav() {
    document.getElementById("mySidenav").style.width = "300px";
    }

    function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    }
</script>
     
