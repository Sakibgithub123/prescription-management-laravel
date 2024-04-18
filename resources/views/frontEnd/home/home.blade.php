@extends('frontEnd.master');
@section('title')
Medilab-Home
@endsection
@section('content')
<style>
    .animation {
        /* height: 50px; */
        overflow: hidden;
        position: absolute;
        width: 100%;
    }

    .animation .p {
        font-size: 3em;
        /* color: limegreen; */
        /* position: absolute; */
        width: 100%;
        height: 100%;
        /* margin: 0; */
        line-height: 50px;
        /* text-align: center; */
        /* Starting position */
        -moz-transform: translateX(100%);
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
        /* Apply animation to this element */
        -moz-animation: animation 35s linear infinite;
        -webkit-animation: animation 35s linear infinite;
        animation: animation 35s linear infinite;
    }

    /* Move it (define the animation) */
    @-moz-keyframes animation {
        0% {
            -moz-transform: translateX(100%);
        }

        100% {
            -moz-transform: translateX(-100%);
        }
    }

    @-webkit-keyframes animation {
        0% {
            -webkit-transform: translateX(100%);
        }

        100% {
            -webkit-transform: translateX(-100%);
        }
    }

    @keyframes animation {
        0% {
            -moz-transform: translateX(100%);
            /* Firefox bug fix */
            -webkit-transform: translateX(100%);
            /* Firefox bug fix */
            transform: translateX(100%);
        }

        100% {
            -moz-transform: translateX(-100%);
            /* Firefox bug fix */
            -webkit-transform: translateX(-100%);
            /* Firefox bug fix */
            transform: translateX(-100%);
        }
    }
</style>
<div id="hero">
    <div class=" top-0 py-1 my-5 animation">
        @foreach($notices as $notice)
        @if($notice->status==='Active')
        <h2 class="p"><span class="text-warning pl-5">Notice: </span><span>{{$notice->notice}}</span></h2>
        @endif
        @endforeach
    </div>
        <div class="container pt-5 ">
            <h1 >Welcome to Medilab</h1>
            <h2 >We are a team of talented doctors dedicated to providing the best service.</h2>
        </div>
        <div id="main ">
            <div id="why-us" class="why-us pt-5">
                <div class="container">

                    <div class="row">
                        <div class="col-lg-4 d-flex align-items-stretch">
                            <div class="content">
                                <h3>Why Choose Medilab?</h3>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                                    Asperiores dolores sed et. Tenetur quia eos. Autem tempore quibusdam vel necessitatibus optio ad corporis.
                                </p>
                                <div class="text-center">
                                    <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 d-flex align-items-stretch">
                            <div class="icon-boxes d-flex flex-column justify-content-center">
                                <div class="row">
                                    <div class="col-xl-4 d-flex align-items-stretch">
                                        <div class="icon-box mt-4 mt-xl-0">
                                            <i class="bx bx-receipt"></i>
                                            <h4>Corporis voluptates sit</h4>
                                            <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 d-flex align-items-stretch">
                                        <div class="icon-box mt-4 mt-xl-0">
                                            <i class="bx bx-cube-alt"></i>
                                            <h4>Ullamco laboris ladore pan</h4>
                                            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 d-flex align-items-stretch">
                                        <div class="icon-box mt-4 mt-xl-0">
                                            <i class="bx bx-images"></i>
                                            <h4>Labore consequatur</h4>
                                            <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End .content-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

@endsection