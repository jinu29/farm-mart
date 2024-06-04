<style>
    .user {
        padding: 15px;
        border-radius: 15px;
        border: 1px solid black;
    }

    .user-details {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .user-details h4 {
        font-size: 16px;
        font-weight: 600;
    }

    .buttons {
        margin-top: 15px;
    }

    .call {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 15px;
        background-color: #34C759;
        color: white;
    }
</style>

<div class="sticky-top z-3 row gutters-10">
    @php
        $photos = [];
    @endphp
    @if ($detailedProduct->photos != null)
        @php
            $photos = explode(',', $detailedProduct->photos);
        @endphp
    @endif
    <!-- Gallery Images -->
    <div class="col-12">
        <div class="aiz-carousel product-gallery arrow-inactive-transparent arrow-lg-none"
            data-nav-for='.product-gallery-thumb' data-fade='true' data-auto-height='true' data-arrows='true'>
            @if ($detailedProduct->digital == 0)
                @foreach ($detailedProduct->stocks as $key => $stock)
                    @if ($stock->image != null)
                        <div class="carousel-box img-zoom rounded-0">
                            <img class="img-fluid h-auto lazyload mx-auto"
                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                data-src="{{ uploaded_asset($stock->image) }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                        </div>
                    @endif
                @endforeach
            @endif

            @foreach ($photos as $key => $photo)
                <div class="carousel-box img-zoom rounded-0">
                    <img class="img-fluid h-auto lazyload mx-auto"
                        src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ uploaded_asset($photo) }}"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>
            @endforeach

        </div>
    </div>
    <!-- Thumbnail Images -->
    <div class="col-12 mt-3 d-none d-lg-block">
        <div class="aiz-carousel half-outside-arrow product-gallery-thumb" data-items='7' data-nav-for='.product-gallery'
            data-focus-select='true' data-arrows='true' data-vertical='false' data-auto-height='true'>

            @if ($detailedProduct->digital == 0)
                @foreach ($detailedProduct->stocks as $key => $stock)
                    @if ($stock->image != null)
                        <div class="carousel-box c-pointer rounded-0" data-variation="{{ $stock->variant }}">
                            <img class="lazyload mw-100 size-60px mx-auto border p-1"
                                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                data-src="{{ uploaded_asset($stock->image) }}"
                                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                        </div>
                    @endif
                @endforeach
            @endif

            @foreach ($photos as $key => $photo)
                <div class="carousel-box c-pointer rounded-0">
                    <img class="lazyload mw-100 size-60px mx-auto border p-1"
                        src="{{ static_asset('assets/img/placeholder.jpg') }}" data-src="{{ uploaded_asset($photo) }}"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                </div>
            @endforeach

        </div>
    </div>

    <div class="col-12">
        <div class="user">
            <div class="user-details">
                <img src="/public/assets/img/user.png" alt="user" class="user-image">
                <h4 class="user-name mb-0">Janarthanan</h4>
            </div>
            <div class="buttons d-flex" style="gap: 15px;">
                @if (get_setting('conversation_system') == 1)
                    <div class="">
                        <button class="btn btn-sm rounded-4" style="background-color: #4379EE; color:white;"
                            onclick="show_chat_modal()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                class="mr-2 has-transition">
                                <g id="Group_23918" data-name="Group 23918" transform="translate(1053.151 256.688)">
                                    <path id="Path_3012" data-name="Path 3012"
                                        d="M134.849,88.312h-8a2,2,0,0,0-2,2v5a2,2,0,0,0,2,2v3l2.4-3h5.6a2,2,0,0,0,2-2v-5a2,2,0,0,0-2-2m1,7a1,1,0,0,1-1,1h-8a1,1,0,0,1-1-1v-5a1,1,0,0,1,1-1h8a1,1,0,0,1,1,1Z"
                                        transform="translate(-1178 -341)" fill="{{ get_setting('secondary_base_color', '#ffc519') }}" />
                                    <path id="Path_3013" data-name="Path 3013"
                                        d="M134.849,81.312h8a1,1,0,0,1,1,1v5a1,1,0,0,1-1,1h-.5a.5.5,0,0,0,0,1h.5a2,2,0,0,0,2-2v-5a2,2,0,0,0-2-2h-8a2,2,0,0,0-2,2v.5a.5.5,0,0,0,1,0v-.5a1,1,0,0,1,1-1"
                                        transform="translate(-1182 -337)" fill="{{ get_setting('secondary_base_color', '#ffc519') }}" />
                                    <path id="Path_3014" data-name="Path 3014"
                                        d="M131.349,93.312h5a.5.5,0,0,1,0,1h-5a.5.5,0,0,1,0-1"
                                        transform="translate(-1181 -343.5)" fill="{{ get_setting('secondary_base_color', '#ffc519') }}" />
                                    <path id="Path_3015" data-name="Path 3015"
                                        d="M131.349,99.312h5a.5.5,0,1,1,0,1h-5a.5.5,0,1,1,0-1"
                                        transform="translate(-1181 -346.5)" fill="{{ get_setting('secondary_base_color', '#ffc519') }}" />
                                </g>
                            </svg>
    
                            {{ translate('Message Seller') }}
                        </button>
                    </div>
                @endif
                <a href="#" class="call rounded-4">
                    <i class="fa-solid fa-phone"></i>
                    <p class="mb-0">Call Seller</p>
                </a>
            </div>
        </div>
    </div>
</div>
