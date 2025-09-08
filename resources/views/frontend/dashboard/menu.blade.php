<div class="side-bar-categories">
    <img src="{{ asset('frontend/assets/img/blog/blog-profile1.jpg') }}" class="mx-auto rounded d-block" alt="Image"
        style="width:100px; height:100px;"> <br><br>

    <ul>

        <li>
            <a href="{{ route('dashboard') }}">User Dashboard</a>
        </li>
        <li>
            <a href="{{ route('user.profil') }}">User Profile </a>
        </li>
        <li>
            <a href="#">Change Password</a>
        </li>
        <li>
            <a href="#">Booking Details </a>
        </li>
        <li>
            <a href="{{ route('user.logout') }}">Logout </a>
        </li>
    </ul>
</div>