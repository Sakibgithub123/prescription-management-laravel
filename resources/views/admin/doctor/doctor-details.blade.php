@extends('admin.master');
@section('content')
<style>
    .text-muted{
        font-size: 16px;
    }
</style>

<div class="content">
<h4 class="page-title text-center py-2" style="background-color:#007bff; color:#003366; font-weight: 900;">{{$doctordetails->name}}</h4>
    <div class="row">
        <div class="col-sm-7 col-6">
            <!-- <h4 class="page-title">{{$doctordetails->name}}'s Profile</h4> -->
            <h4 class="focus-label text-primary">{{$doctordetails->name}}'s Profile</h4>
        </div>
    </div>
    <div class="card-box profile-header">
        <div class="row">
            <div class="col-md-12">
                <div class="profile-view">
                    <div class="profile-img-wrap">
                        <div class="profile-img">
                            <a>
                                @if(!$doctordetails->profile_image)
                                <img class="avatar" src="{{asset('superAdmin')}}/assets/img/doctor-03.jpg" alt="{{$doctordetails->name}}">
                                @else
                                <img class="avatar" src="{{asset('storage/images/'.$doctordetails->profile_image)}}" alt="{{$doctordetails->name}}">
                                @endif
                            </a>
                        </div>
                    </div>
                    <div class="profile-basic">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="profile-info-left">
                                    <h3 class="user-name m-t-0 mb-0">{{$doctordetails->name}}</h3>
                                    <small class="text-muted">{{$doctordetails->specialist}}</small>
                                    <div class="staff-id">Employee ID : DR-000{{$doctordetails->id}}</div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <ul class="personal-info">
                                    <li>
                                        <span class="title font-weight-bold">Phone:</span>
                                        <span class="text underline"><u><a class="link-info" href="tel:{{$doctordetails->phone}}">{{$doctordetails->phone}}</a></u></span>
                                    </li>
                                    <li>
                                        <span class="title font-weight-bold">Email:</span>
                                        <span class="text underline"><u><a class="link-info" href="mailto:{{$doctordetails->email}}">{{$doctordetails->email}}</a></u></span>
                                    </li>
                                    <li>
                                        <!-- <span class="title font-weight-bold">Birthday:</span>
                                        <span class="text text-muted">{{$doctordetails->birthday}}</span> -->
                                    </li>
                                    <li>
                                        <span class="title font-weight-bold">Address:</span>
                                        <span class="text text-muted">{{$doctordetails->address}}</span>
                                    </li>
                                    <li>
                                        <span class="title font-weight-bold">Gender:</span>
                                        <span class="text text-muted ">{{$doctordetails->gender}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-tabs">
        <ul class="nav nav-tabs nav-tabs-bottom">
            <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#edu-cont" data-toggle="tab">Education</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane show active" id="about-cont">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box mb-0">
                            <h3 class="card-title">Experience</h3>
                            <div class="experience-box">
                                <ul class="experience-list">
                                    <li>
                                        <div class="experience-user">
                                            <div class="before-circle"></div>
                                        </div>
                                        <div class="experience-content">
                                            <div class="timeline-content">
                                                <a  class="name">Experienced In</a>
                                                <span class="time text-muted" style="font-size: 16px;">{{$doctordetails->specialist}}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="experience-user">
                                            <div class="before-circle"></div>
                                        </div>
                                        <div class="experience-content">
                                            <div class="timeline-content">
                                                <a  class="name">Seating Day</a>
                                                <span class="time text-muted" style="font-size: 16px;">Every {{$doctordetails->seating_day}}</span>
                                                <span class="time text-muted" style="font-size: 16px;">{{$doctordetails->whenyouseat}}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- <li>
                                        <div class="experience-user">
                                            <div class="before-circle"></div>
                                        </div>
                                        <div class="experience-content">
                                            <div class="timeline-content">
                                                <a  class="name">Friday Seating Time</a>
                                                <span class="time text-muted" style="font-size: 16px;">{{$doctordetails->friday_seating_time}}</span>
                                            </div>
                                        </div>
                                    </li> -->
                                    <li>
                                        <div class="experience-user">
                                            <div class="before-circle"></div>
                                        </div>
                                        <div class="experience-content">
                                            <div class="timeline-content">
                                                <a  class="name">Visit Fee</a>
                                                <span class="time text-muted" style="font-size: 16px;">{{$doctordetails->visit_fee}} Tk</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="edu-cont">
            <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <h3 class="card-title">Education Informations</h3>
                            <div class="experience-box">
                                <ul class="experience-list">
                                    <li>
                                        <div class="experience-user">
                                            <div class="before-circle"></div>
                                        </div>
                                        <div class="experience-content">
                                            <div class="timeline-content">
                                                <a  class="name">{{$doctordetails->education_informations}}</a>
                                                <div class="text-muted" style="font-size: 16px;">{{$doctordetails->qualification}}</div>
                                                <!-- <span class="time">2001 - 2003</span> -->
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="experience-user">
                                            <div class="before-circle"></div>
                                        </div>
                                        <div class="experience-content">
                                            <div class="timeline-content">
                                                <a  class="name">Institute</a>
                                                <span class="time text-muted" style="font-size: 16px;">{{$doctordetails->friday_seating_time}}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- <li>
                                        <div class="experience-user">
                                            <div class="before-circle"></div>
                                        </div>
                                        <div class="experience-content">
                                            <div class="timeline-content">
                                                <a href="#/" class="name">International College of Medical Science (PG)</a>
                                                <div>MD - Obstetrics & Gynaecology</div>
                                                <span class="time">1997 - 2001</span>
                                            </div>
                                        </div>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="tab-pane" id="bottom-tab3">
                Tab content 3
            </div> -->
        </div>
    </div>
</div>

@endsection