@extends('auth.layouts.authentication')

@section('content')
    <div class="aiz-main-wrapper d-flex flex-column justify-content-center bg-white">
        <section class="bg-white overflow-hidden" style="min-height:100vh;">
            <div class="row no-gutters" style="min-height: 100vh;">
                <!-- Left Side Image-->
                <div class="col-xxl-6 col-lg-6">
                    <div class="h-100" style="max-height: 100vh">
                        <img src="{{ uploaded_asset(get_setting('customer_register_page_image')) }}" alt=""
                            class="img-fit h-100">
                    </div>
                </div>

                <!-- Right Side -->
                <div class="col-xxl-6 col-lg-6">
                    <div class="d-flex align-items-center right-content">
                        <div class="py-3 py-lg-4 px-3 px-xl-5 flex-grow-1">
                            <!-- Site Icon -->
                            <div class="size-48px mb-3 mx-auto mx-lg-0">
                                <img src="{{ uploaded_asset(get_setting('site_icon')) }}" alt="{{ translate('Site Icon') }}"
                                    class="img-fit h-100">
                            </div>

                            <!-- Titles -->
                            <div class="text-center text-lg-left">
                                <h1 class="fs-20 fs-md-24 fw-700 text-primary" style="text-transform: uppercase;">
                                    {{ translate('Create an account') }}</h1>
                            </div>

                            <!-- Register form -->
                            <div class="pt-3">
                                <div class="">
                                    <form id="reg-form" class="form-default" role="form"
                                        action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <!-- Name -->
                                        <div class="form-group">
                                            <label for="name"
                                                class="fs-12 fw-700 text-soft-dark">{{ translate('Full Name') }}</label>
                                            <input type="text"
                                                class="form-control rounded-0{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                value="{{ old('name') }}" placeholder="{{ translate('Full Name') }}"
                                                name="name">
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Email or Phone -->
                                        @if (addon_is_activated('otp_system'))
                                            <div class="form-group phone-form-group mb-1">
                                                <label for="phone"
                                                    class="fs-12 fw-700 text-soft-dark">{{ translate('Phone') }}</label>
                                                <input type="tel" id="phone-code"
                                                    class="form-control rounded-0{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                    value="{{ old('phone') }}" placeholder="" name="phone"
                                                    autocomplete="off">
                                            </div>

                                            <input type="hidden" name="country_code" value="">

                                            <div class="form-group email-form-group mb-1 d-none">
                                                <label for="email"
                                                    class="fs-12 fw-700 text-soft-dark">{{ translate('Email') }}</label>
                                                <input type="email"
                                                    class="form-control rounded-0 {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                    value="{{ old('email') }}" placeholder="{{ translate('Email') }}"
                                                    name="email" autocomplete="off">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group text-right">
                                                <button class="btn btn-link p-0 text-primary" type="button"
                                                    onclick="toggleEmailPhone(this)"><i>*{{ translate('Use Email Instead') }}</i></button>
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <label for="email"
                                                    class="fs-12 fw-700 text-soft-dark">{{ translate('Email') }}</label>
                                                <input type="email"
                                                    class="form-control rounded-0{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                    value="{{ old('email') }}" placeholder="{{ translate('Email') }}"
                                                    name="email">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @endif

                                        <!-- password -->
                                        <div class="form-group mb-0">
                                            <label for="password"
                                                class="fs-12 fw-700 text-soft-dark">{{ translate('Password') }}</label>
                                            <div class="position-relative">
                                                <input type="password"
                                                    class="form-control rounded-0{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                    placeholder="{{ translate('Password') }}" name="password">
                                                <i class="password-toggle las la-2x la-eye"></i>
                                            </div>
                                            <div class="text-right mt-1">
                                                <span
                                                    class="fs-12 fw-400 text-gray-dark">{{ translate('Password must contain at least 6 digits') }}</span>
                                            </div>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <!-- password Confirm -->
                                        <div class="form-group">
                                            <label for="password_confirmation"
                                                class="fs-12 fw-700 text-soft-dark">{{ translate('Confirm Password') }}</label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control rounded-0"
                                                    placeholder="{{ translate('Confirm Password') }}"
                                                    name="password_confirmation">
                                                <i class="password-toggle las la-2x la-eye"></i>
                                            </div>
                                        </div>


                                        <!-- Locations -->
                                        {{-- <div class="form-group">
                                                <label for="location" class="fs-12 fw-700 text-soft-dark">Location</label>
                                                <input type="text" class="form-control" id="location"
                                                    placeholder="Enter a location">
                                                <input type="hidden" name="latitude" id="latitude">
                                                <input type="hidden" name="longitude" id="longitude">
                                            </div> --}}

                                        <div id="map" style="height: 400px;" class='m-2'></div>


                                        <!-- Country -->
                                        <div class='form-group '>
                                            <label class='fs-12 fw-700 text-soft-dark'>{{ translate('Country') }}</label>
                                            <div class="position-relative">
                                                <select class="form-control aiz-selectpicker rounded-0"
                                                    data-live-search="true"
                                                    data-placeholder="{{ translate('Select your country') }}"
                                                    name="country_id" required>
                                                    <option value="">{{ translate('Select your country') }}
                                                    </option>
                                                    @foreach (get_active_countries() as $key => $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                </div>

                                <!-- State -->
                                <div class="form-group">
                                    <label class='fs-12 fw-700 text-soft-dark'>{{ translate('State') }}</label>
                                    <div class="position-relative">
                                        <select class="form-control mb-3 aiz-selectpicker rounded-0"
                                            data-live-search="true" name="state_id" required>

                                        </select>
                                    </div>
                                </div>

                                <!-- City -->
                                <div class="form-group">
                                    <label class='fs-12 fw-700 text-soft-dark'>{{ translate('City') }}</label>
                                    <div class="position-relative">
                                        <select class="form-control mb-3 aiz-selectpicker rounded-0"
                                            data-live-search="true" name="city_id" required>

                                        </select>
                                    </div>
                                </div>

                                @if (get_setting('google_map') == 1)
                                    <!-- Google Map -->
                                    <div class="form-group">
                                        <input id="searchInput" class="controls" type="text"
                                            placeholder="{{ translate('Enter a location') }}">
                                        <!-- <div id="map"></div> -->
                                        <ul id="geoData">
                                            <li style="display: none;">Full Address: <span id="location"></span></li>
                                            <li style="display: none;">Postal Code: <span id="postal_code"></span>
                                            </li>
                                            <li style="display: none;">Country: <span id="country"></span>
                                            </li>
                                            <li style="display: none;">Latitude: <span id="lat"
                                                    class='fs-12 fw-700 text-soft-dark'></span>
                                            </li>
                                            <li style="display: none;">Longitude: <span id="lon"
                                                    class='fs-12 fw-700 text-soft-dark'></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Longitude -->
                                    <div class="form-group">
                                        <label for="exampleInputuname"
                                            class='fs-12 fw-700 text-soft-dark'>{{ translate('Longitude') }}</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control mb-3 rounded-0" id="longitude"
                                                name="longitude" readonly="">
                                        </div>
                                    </div>
                                    <!-- Latitude -->
                                    <div class="form-group">
                                        <label for="exampleInputuname"
                                            class='fs-12 fw-700 text-soft-dark'>{{ translate('Latitude') }}</label>

                                        <div class="position-relative">
                                            <input type="text" class="form-control mb-3 rounded-0" id="latitude"
                                                name="latitude" readonly="" class='fs-12 fw-700 text-soft-dark'>
                                        </div>
                                    </div>
                                @endif

                                <!-- Postal code -->
                                <div class="form-group">
                                    <label class='fs-12 fw-700 text-soft-dark'>{{ translate('Postal code') }}</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control mb-3 rounded-0"
                                            placeholder="{{ translate('Your Postal Code') }}" name="postal_code"
                                            value="" required>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="form-group">
                                    <label class='fs-12 fw-700 text-soft-dark'>{{ translate('Phone') }}</label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control mb-3 rounded-0"
                                            placeholder="{{ translate('+880') }}" name="phone" value=""
                                            required>
                                    </div>
                                </div>
                                <!-- Recaptcha -->
                                @if (get_setting('google_recaptcha') == 1)
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}">
                                        </div>
                                    </div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="invalid-feedback" role="alert" style="display: block;">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                    @endif
                                @endif

                                <!-- Terms and Conditions -->
                                <div class="mb-3">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" name="checkbox_example_1" required>
                                        <span class="">{{ translate('By signing up you agree to our ') }}
                                            <a href="{{ route('terms') }}"
                                                class="fw-500">{{ translate('terms and conditions.') }}</a></span>
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <div class="mb-4 mt-4">
                                    <button type="submit"
                                        class="btn btn-primary btn-block fw-600 rounded-0">{{ translate('Create Account') }}</button>
                                </div>
                                </form>

                                <!-- Social Login -->
                                @if (get_setting('google_login') == 1 ||
                                        get_setting('facebook_login') == 1 ||
                                        get_setting('twitter_login') == 1 ||
                                        get_setting('apple_login') == 1)
                                    <div class="text-center mb-3">
                                        <span class="bg-white fs-12 text-gray">{{ translate('Or Join With') }}</span>
                                    </div>
                                    <ul class="list-inline social colored text-center mb-4">
                                        @if (get_setting('facebook_login') == 1)
                                            <li class="list-inline-item">
                                                <a href="{{ route('social.login', ['provider' => 'facebook']) }}"
                                                    class="facebook">
                                                    <i class="lab la-facebook-f"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (get_setting('google_login') == 1)
                                            <li class="list-inline-item">
                                                <a href="{{ route('social.login', ['provider' => 'google']) }}"
                                                    class="google">
                                                    <i class="lab la-google"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (get_setting('twitter_login') == 1)
                                            <li class="list-inline-item">
                                                <a href="{{ route('social.login', ['provider' => 'twitter']) }}"
                                                    class="twitter">
                                                    <i class="lab la-twitter"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if (get_setting('apple_login') == 1)
                                            <li class="list-inline-item">
                                                <a href="{{ route('social.login', ['provider' => 'apple']) }}"
                                                    class="apple">
                                                    <i class="lab la-apple"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                            </div>

                            <!-- Log In -->
                            <p class="fs-12 text-gray mb-0">
                                {{ translate('Already have an account?') }}
                                <a href="{{ route('user.login') }}"
                                    class="ml-2 fs-14 fw-700 animate-underline-primary">{{ translate('Log In') }}</a>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Go Back -->
                <div class="mt-3 mr-4 mr-md-0">
                    <a href="{{ url()->previous() }}" class="ml-auto fs-14 fw-700 d-flex align-items-center text-primary"
                        style="max-width: fit-content;">
                        <i class="las la-arrow-left fs-20 mr-1"></i>
                        {{ translate('Back to Previous Page') }}
                    </a>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection

@section('script')
    @if (get_setting('google_recaptcha') == 1)
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

    <script type="text/javascript">
        @if (get_setting('google_recaptcha') == 1)
            // making the CAPTCHA  a required field for form submission
            $(document).ready(function() {
                $("#reg-form").on("submit", function(evt) {
                    var response = grecaptcha.getResponse();
                    if (response.length == 0) {

                        alert("please verify you are human!");
                        evt.preventDefault();
                        return false;
                    }

                    $("#reg-form").submit();
                });
            });
        @endif
    </script>

    <script>
        //lOCATION
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -34.397,
                    lng: 150.644
                },
                zoom: 8
            });

            var input = document.getElementById('location');
            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.bindTo('bounds', map);

            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });

            autocomplete.addListener('place_changed', function() {
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                // Set latitude and longitude values
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();

                // Update hidden input fields
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;
            });
        }
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMxaJblkLSkT-va8n5q0QlmbygJn9G7yc&libraries=places&callback=initMap"
        async defer></script>

    @if (get_setting('google_map') == 1)
        @include('frontend.' . get_setting('homepage_select') . '.partials.google_map')
    @endif
@endsection
