@if($show == true)
    <div class="signin-header">
        <div class="row align-items-center">
            <div class="col-xl-4 col-sm-6">
                <a href="/" class="site-logo"><img src="{{asset('frontend/assets/images/logo/logo.png')}}" alt="logo"></a>
            </div>
            <div class="col-md-2 d-lg-block d-none">
                <a href="{{$backBtnUrl}}" class="back-btn"><i class="far fa-angle-left"></i></a>
            </div>
            <div class="col-xl-6 col-lg-4 col-sm-6">
                <div class="singin-header-btn">
                    <p>{{$heading}}</p>
                    <a href="{{$action}}" class="sign-up-btn axil-btn btn-bg-secondary">{{$actionPageName}}</a>
                </div>
            </div>
        </div>
    </div>
@endif
