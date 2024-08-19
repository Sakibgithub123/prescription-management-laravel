@extends('frontEnd.master');
@section('title')
MediCareOPS-Home
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
    <!-- <div class="container pt-5 "> -->
    <div class="text-center px-5 pt-5 ">
        <h1>Welcome to MediCareOPS</h1>
        <h2>We are a team of talented doctors dedicated to providing the best service.</h2>
    </div>
    <div id="main ">
        <div id="why-us" class="why-us pt-5">
            <!-- <div class="container"> -->
            <div class="p-5">

                <div class="row">
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="content text-center">
                            <h3>Why Choose MediCareOPS?</h3>
                            <p class="text-justify">
                                Choose MediCareOPS for its comprehensive lab management, customizable workflows, robust quality control, seamless integration with systems and advanced data security. They ensure efficient, reliable and safe laboratory operations.
                            </p>
                            <!-- <div class="text-center">
                                Medilab
                                <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-8 d-flex align-items-stretch">
                        <div class="icon-boxes d-flex flex-column justify-content-center">
                            <div class="row">
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0 text-center">
                                        <i class="bx bx-receipt"></i>
                                        <h4 class="border-bottom border-4 border-primary pb-2">All in One Lab Management</h4>
                                        <p class="text-justify">MediCareOPS helps manage all parts of running a lab, from when a patient arrives to when their test results are ready.</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0 text-center">
                                        <i class="bx bx-cube-alt"></i>
                                        <h4 class="border-bottom border-4 border-primary pb-2">Flexible Workflow Tools</h4>
                                        <p class="text-justify">MediCareOPS offers tools that can be set up to handle different lab tasks, such as ordering tests, collecting samples, and managing test results.</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0 text-center">
                                        <i class="bx bx-images"></i>
                                        <h4 class="border-bottom border-4 border-primary pb-2">Comprehensive Reporting</h4>
                                        <p class="text-justify">MediCareOPS can generate detailed reports on all data within the system.</p>
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