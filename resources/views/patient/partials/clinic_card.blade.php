<div class="col-md-6 col-lg-4">
    <div class="profile-widget patient-favour">
        <div class="fav-head">
            <div class="doc-img">
                <a href="doctor-profile.html">
                    <img class="img-fluid" alt="User Image" src={{ asset('img/clinic/clinic-' . rand(1, 12) . '.jpg') }}>
                </a>
            </div>
            <div class="pro-content">
                <h3 class="title">
                    <a href="doctor-profile.html">{{ $clinic->name }}</a>
                    <i class="fas fa-check-circle verified"></i>
                </h3>
                <p class="speciality"><span class="badge text-bg-primary py-1">{{ $clinic->speciality->name }}</span></p>
                <div class="rating">
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    <span class="d-inline-block average-rating">5.0</span>
                </div>
                <ul class="available-info">
                    <li>
                        <span><i class="fa-solid fa-calendar-day"></i></span>Next Availability : 23 Mar 2024
                    </li>
                    <li>
                        <span><i class="fas fa-map-marker-alt"></i></span>Location : {{ $clinic->area }}
                    </li>
                </ul>
                <div class="last-book">
                    <p>Last Book on 21 Jan 2023</p>
                </div>
            </div>
        </div>
        <div class="fav-footer">
            <div class="row row-sm">
                <div class="col-6">
                    <a href="{{ route('patient.clinic.show', $clinic->id) }}" class="btn view-btn">View Details</a>
                </div>
                <div class="col-6">
                    <a href="booking.html" class="btn book-btn">Book Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
