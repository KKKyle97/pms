<div class="col row d-flex align-items-center py-5 m-0 mt-5">
    <img src="{{asset('/image/ribbon.png')}}" alt="ribbon" height="40px" width="50px" style="display: block">
    <p class="p-0 m-0 font-28 font-semi font-white">Child Of Light</p>
</div>
<div class="col d-flex flex-column py-5 px-0">
    <a href="{{url('/')}}">
        <div class="font-18 font-semi p-3 row d-flex align-items-center m-0">
            <span class="material-icons px-3">
                home
            </span>
            Home
        </div>
    </a>
    <a href="{{route('patients.create')}}">
        <div class="font-18 font-semi p-3 row d-flex align-items-center m-0">
            <span class="material-icons px-3">
                add_circle_outline
            </span>
            Add New Patient
        </div>
    </a>
    <a href="{{route('patients.index')}}">
        <div class="font-18 font-semi p-3 row d-flex align-items-center m-0">
            <span class="material-icons px-3">
                format_list_bulleted
            </span>
            View All Patients
        </div>
    </a>
    <a href="{{route('notifications.index')}}">
        <div class="font-18 font-semi p-3 row d-flex align-items-center m-0">
            <span class="material-icons px-3">
                notifications_active
            </span>
            Notifications
        </div>
    </a>
    <a href="{{route('users.show',[Auth::user()->id])}}">
        <div class="font-18 font-semi p-3 row d-flex align-items-center m-0">
            <span class="material-icons px-3">
                face
            </span>
            My Profile
        </div>
    </a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
        <div class="font-18 font-semi p-3 row d-flex align-items-center m-0">
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
<div>
    
</div>