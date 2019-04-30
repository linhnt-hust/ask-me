@extends('admin.layouts.master')
@section('page_title')
    Admin Dashboard
@endsection
@section('content')
                <div class="row text-center">

                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="card-box widget-box-one">
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-600 font-secondary text-overflow">Statistics</p>
                                <h2 class="text-danger"><span data-plugin="counterup">34578</span></h2>
                                <p class="text-muted m-0"><b>Last:</b> 30.4k</p>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="card-box widget-box-one">
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-600 font-secondary text-overflow">User Today</p>
                                <h2 class="text-dark"><span data-plugin="counterup">895</span> </h2>
                                <p class="text-muted m-0"><b>Last:</b> 1250</p>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="card-box widget-box-one">
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-600 font-secondary text-overflow">User This Month</p>
                                <h2 class="text-success"><span data-plugin="counterup">52410</span></h2>
                                <p class="text-muted m-0"><b>Last:</b> 40.33k</p>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="card-box widget-box-one">
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-600 font-secondary text-overflow">Request Per Minute</p>
                                <h2 class="text-warning"><span data-plugin="counterup">652</span> </h2>
                                <p class="text-muted m-0"><b>Last:</b> 956</p>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="card-box widget-box-one">
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-600 font-secondary text-overflow">Total Users</p>
                                <h2 class="text-primary"><span data-plugin="counterup">3245</span> </h2>
                                <p class="text-muted m-0"><b>Last:</b> 20k</p>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <div class="card-box widget-box-one">
                            <div class="wigdet-one-content">
                                <p class="m-0 text-uppercase font-600 font-secondary text-overflow">New Downloads</p>
                                <h2 class="text-danger"><span data-plugin="counterup">78541</span> </h2>
                                <p class="text-muted m-0"><b>Last:</b> 50k</p>
                            </div>
                        </div>
                    </div><!-- end col -->

                </div>
                <!-- end row -->



                <div class="row">
                    <div class="col-lg-4">
                        <div class="card-box">

                            <h4 class="header-title m-t-0">Daily Sales</h4>

                            <div class="widget-chart text-center">
                                <div id="morris-donut-example" style="height: 245px;"></div>
                                <ul class="list-inline chart-detail-list m-b-0">
                                    <li>
                                        <h5 class="text-danger"><i class="fa fa-circle m-r-5"></i>Series A</h5>
                                    </li>
                                    <li>
                                        <h5 class="text-success"><i class="fa fa-circle m-r-5"></i>Series B</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-4">
                        <div class="card-box">

                            <h4 class="header-title m-t-0">Statistics</h4>
                            <div id="morris-bar-example" style="height: 280px;"></div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-lg-4">
                        <div class="card-box">

                            <h4 class="header-title m-t-0">Total Revenue</h4>
                            <div id="morris-line-example" style="height: 280px;"></div>
                        </div>
                    </div><!-- end col -->

                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-box">
                            <h4 class="header-title m-t-0 m-b-30">Recent Users</h4>

                            <div class="table-responsive">
                                <table class="table table table-hover m-0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>User Name</th>
                                            <th>Phone</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>
                                                <img src="{{ asset('/zircos/images/users/avatar-1.jpg')}}" alt="user" class="thumb-sm img-circle" />
                                            </th>
                                            <td>
                                                <h5 class="m-0">Louis Hansen</h5>
                                                <p class="m-0 text-muted font-13"><small>Web designer</small></p>
                                            </td>
                                            <td>+12 3456 789</td>
                                            <td>USA</td>
                                            <td>07/08/2016</td>
                                        </tr>

                                        <tr>
                                            <th>
                                                <img src="{{ asset('/zircos/images/users/avatar-2.jpg')}}" alt="user" class="thumb-sm img-circle" />
                                            </th>
                                            <td>
                                                <h5 class="m-0">Craig Hause</h5>
                                                <p class="m-0 text-muted font-13"><small>Programmer</small></p>
                                            </td>
                                            <td>+89 345 6789</td>
                                            <td>Canada</td>
                                            <td>29/07/2016</td>
                                        </tr>

                                        <tr>
                                            <th>
                                                <img src="{{ asset('/zircos/images/users/avatar-3.jpg')}}" alt="user" class="thumb-sm img-circle" />
                                            </th>
                                            <td>
                                                <h5 class="m-0">Edward Grimes</h5>
                                                <p class="m-0 text-muted font-13"><small>Founder</small></p>
                                            </td>
                                            <td>+12 29856 256</td>
                                            <td>Brazil</td>
                                            <td>22/07/2016</td>
                                        </tr>

                                        <tr>
                                            <th>
                                                <img src="{{ asset('/zircos/images/users/avatar-4.jpg')}}" alt="user" class="thumb-sm img-circle" />
                                            </th>
                                            <td>
                                                <h5 class="m-0">Bret Weaver</h5>
                                                <p class="m-0 text-muted font-13"><small>Web designer</small></p>
                                            </td>
                                            <td>+00 567 890</td>
                                            <td>USA</td>
                                            <td>20/07/2016</td>
                                        </tr>

                                        <tr>
                                            <th>
                                                <img src="{{ asset('/zircos/images/users/avatar-5.jpg')}}" alt="user" class="thumb-sm img-circle" />
                                            </th>
                                            <td>
                                                <h5 class="m-0">Mark</h5>
                                                <p class="m-0 text-muted font-13"><small>Web design</small></p>
                                            </td>
                                            <td>+91 123 456</td>
                                            <td>India</td>
                                            <td>07/07/2016</td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div> <!-- table-responsive -->
                        </div> <!-- end card -->
                    </div>
                    <!-- end col -->

                    <div class="col-lg-6">
                        <div class="card-box">
                            <h4 class="header-title m-t-0 m-b-30">New Users</h4>
                            <div class="table-responsive">
                                <table class="table table table-hover m-0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>Country</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $newUsers as $newUser)
                                        <tr>
                                            <th>
                                                <span class="avatar-sm-box bg-success">R</span>
                                            </th>
                                            <td>
                                                <h5 class="m-0"> {{ $newUser-> name }}</h5>
                                                <p class="m-0 text-muted font-13"><small> {{ $newUser->website }}</small></p>
                                            </td>
                                            <td> {{ $newUser->email }}</td>
                                            <td>{{ $newUser->country }}</td>
                                            <td>{{ $newUser->created_at->format('d/m/y - h:m') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div> <!-- table-responsive -->
                        </div> <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
@endsection
