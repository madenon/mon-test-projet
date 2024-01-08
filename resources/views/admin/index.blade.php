@extends('admin.template')

@section('admin-content')
<div class="content-wrapper" style="min-height: 527px;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">

            <div class="row my-3">
                <div class="col-lg-3 col-6">
                
                    <svg width="100" height="100" xmlns="http://www.w3.org/2000/svg" class="block mx-auto">
                        <!-- Draw the outer circle (donut) -->
                        <circle cx="50" cy="50" r="40" fill="#f2ca80" stroke="#d29b56" stroke-width="20"/>

                        <!-- Draw horizontal and vertical lines to divide the donut into four equal parts -->
                        <line x1="0" y1="50" x2="20" y2="50" stroke="#333" stroke-width="2" transform="rotate(45 50 50)"/>
                        <line x1="80" y1="50" x2="100" y2="50" stroke="#333" stroke-width="2" transform="rotate(45 50 50)"/>
                        <line x1="50" y1="0" x2="50" y2="20" stroke="#333" stroke-width="2" transform="rotate(45 50 50)"/>
                        <line x1="50" y1="80" x2="50" y2="100" stroke="#333" stroke-width="2" transform="rotate(45 50 50)"/>
                        
                        <text x="50" y="20" fill="#333" text-anchor="middle" transform="rotate(0 50 50)">All time</text>
                        <text x="50" y="20" fill="#333" text-anchor="middle" transform="rotate(90 50 50)">Today</text>
                        <text x="50" y="20" fill="#333" text-anchor="middle" transform="rotate(180 50 50)">Week</text>
                        <text x="50" y="20" fill="#333" text-anchor="middle" transform="rotate(270 50 50)">Month</text>
                        
                        <polygon points="50,20 45,30 55,30" fill="#333"/>


                    </svg>
                </div>
                <div class="col-lg-3 col-6 text-white">
                    <div class="small-box bg-info rounded-2 ">
                        <div class="flex justify-between items-center m-2">
                            <div class="inner">
                                <h3>{{count($users)}}</h3>
                                <p>Users</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users fa-3x"></i>
                            </div>
                        </div>
                        <div class="flex justify-center border-t-2">
                            <a href="#" class="small-box-footer no-underline text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 text-white">
                    <div class="small-box bg-warning rounded-2 ">
                        <div class="flex justify-between items-center m-2">
                            <div class="inner">
                                <h3>{{count($offers)}}</h3>
                                <p>Offers</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users fa-3x"></i>
                            </div>
                        </div>
                        <div class="flex justify-center border-t-2">
                            <a href="#" class="small-box-footer no-underline text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success text-white rounded-2 ">
                        <div class="flex justify-between items-center m-2">
                            <div class="inner">
                                <h3>{{count($transactions)}}</h3>
                                <p>Transactions</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users fa-3x"></i>
                            </div>
                        </div>
                        <div class="flex justify-center border-t-2">
                            <a href="#" class="small-box-footer no-underline text-white">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="row my-3">
            </div>


        </div>
    </section>

</div>



@endsection
