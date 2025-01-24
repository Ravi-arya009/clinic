<div class="col-xl-4 col-lg-6 col-md-6 d-flex">
    <div class="appointment-wrap appointment-grid-wrap">
        <ul>
            <li>
                <div class="appointment-grid-head">
                    <div class="patinet-information">
                        <a href="{{ route('admin.user.show', $user->id) }}">
                            <img src="{{asset('img/doctors-dashboard/profile-0'.rand(1, 8).'.jpg')}}" alt="User Image">
                        </a>
                        <div class="patient-info">
                            <p>#Apt0001</p>
                            <h6><a href="patient-profile.html">{{ $name}}</a></h6>
                            <ul>
                                <li>Age : 42</li>
                                <li>{{ $user->gender == 1 ? 'Male' : 'Female' }}</li>
                                <li>AB+</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <li class="appointment-info">
                <p><i class="fa-solid fa-phone"></i>{{ $phone}}</p>
                <p class="mb-0"><i class="fa-solid fa-brands fa-whatsapp"></i>{{ $user->whatsapp}}</p>
            </li>
            <li class="appointment-action">
                <div class="patient-book">
                    <p><i class="fa-solid fa-user-tag"></i>Role: <span>{{$role}}</span></p>
                </div>
            </li>
        </ul>
    </div>
</div>
