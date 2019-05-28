@extends('admin.layouts.master')
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group pull-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li>
                            <a href="{{ route('admin.index') }}">Ask-me</a>
                        </li>
                        <li class="active">
                            Users
                        </li>
                    </ol>
                </div>
                <h4 class="page-title"> User Statistical</h4>
            </div>
        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-8">
                        <form>
                            <div class="form-group search-box">
                                <input type="text" id="search-input" class="form-control product-search" placeholder="Search here...">
                                <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    {{--<div class="col-sm-4">--}}
                        {{--<a href="#custom-modal" class="btn btn-success btn-rounded btn-md waves-effect waves-light m-b-30" data-animation="fadein" data-plugin="custommodal"--}}
                           {{--data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-add"></i> Add New Agent</a>--}}
                    {{--</div>--}}
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mails m-0 table table-actions-bar">
                        <thead>
                        <tr>
                            <th style="width: 70px;">
                                <div class="btn-group dropdown m-l-10">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"><i class="caret"></i></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                            </th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Questions</th>
                            <th>Blogs</th>
                            <th>Comments</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($newUsers as $user)
                        <tr>
                            <td>

                                <img src="{{ asset('/avatar/users/'.$user->avatar) }}" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                            </td>

                            <td>
                                {{ $user->name }}
                            </td>

                            <td>
                                <a href="#">{{$user->email}}</a>
                            </td>

                            <td>
                                {{ $user->userQuestions->count() }}
                            </td>
                            <td>
                                {{ $user->userBlogs->count() }}
                            </td>
                            <td>
                                {{ $user->userComments->count() }}
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> <!-- end table responsive -->
            </div> <!-- end card-box -->

            <div class="text-right">
                {{ $newUsers->render('admin.elements.pagination') }}
            </div>

        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
