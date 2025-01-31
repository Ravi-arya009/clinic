<div class="card">
    <div class="card-body">
        <div class="doctor-widget">
            <div class="doc-info-left">
                <div class="doctor-img">
                    <a href="doctor-profile.html">
                        <img src={{ asset('img/doctors/doctor-thumb-' . str_pad(rand(1, 21), 2, '0', STR_PAD_LEFT) . '.jpg') }} class="img-fluid" alt="User Image">
                    </a>
                    <h4 class="doc-department mt-4"><img src={{ asset('img/specialities/' . $entity->speciality->image) }} class="img-fluid" alt="Speciality">{{ $entity->speciality->name }}</h4>
                </div>
                <div class="doc-info-cont">
                    <h4 class="doc-name"><a href="doctor-profile.html">{{ $entity->name }}</a></h4>
                    <p class="doc-location"><i class="fas fa-map-marker-alt"></i> {{ $entity->area }},
                        {{ $entity->city->name }}</p>
                    <div class="clinic-details">
                        <ul class="clinic-gallery">
                            <li>
                                <a href={{ asset('img/features/feature-01.jpg') }} data-fancybox="gallery">
                                    <img src={{ asset('img/features/feature-01.jpg') }} alt="Feature">
                                </a>
                            </li>
                            <li>
                                <a href={{ asset('img/features/feature-02.jpg') }} data-fancybox="gallery">
                                    <img src={{ asset('img/features/feature-02.jpg') }} alt="Feature">
                                </a>
                            </li>
                            <li>
                                <a href={{ asset('img/features/feature-03.jpg') }} data-fancybox="gallery">
                                    <img src={{ asset('img/features/feature-03.jpg') }} alt="Feature">
                                </a>
                            </li>
                            <li>
                                <a href={{ asset('img/features/feature-04.jpg') }} data-fancybox="gallery">
                                    <img src={{ asset('img/features/feature-04.jpg') }} alt="Feature">
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="clinic-services">
                        <span>Dental Fillings</span>
                        <span> Whitneing</span>
                    </div>
                </div>
            </div>
            <div class="doc-info-right">
                <div class="clini-infos">
                    <ul>
                        <li>
                            <div class="rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star"></i>
                                <span class="d-inline-block average-rating">(17)</span>
                            </div>
                        </li>
                        <li><i class="far fa-money-bill-alt"></i> ₹300 - ₹1000</li>
                    </ul>
                </div>
                <div class="clinic-booking">
                    <a class="view-pro-btn" href="{{ route($type . '.profile', $entity->id) }}">View Profile</a>
                    <a class="apt-btn" href="{{ route($type . '.profile', $entity->id) }}">Book Appointment</a>
                </div>
            </div>
        </div>
    </div>
</div>
