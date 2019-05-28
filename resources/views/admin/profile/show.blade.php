@extends('admin.layouts.master')
@section('page_title')
    Profile
@endsection
@section('page_header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection
@section('content')
    <div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="text-center card-box">
                        <div class="member-card">
                            <div class="thumb-xl member-thumb m-b-10 center-block">
                                <img src="{{ asset('/avatar/admins/'.$admin->avatar) }}" class="img-circle img-thumbnail" alt="profile-image">
                                <i class="mdi mdi-star-circle member-star text-success" title="verified user"></i>
                            </div>

                            <div class="">
                                <h4 class="m-b-5">{{ $admin->name }}</h4>
                            </div>

                            <button type="button" class="btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light" id="edit-button">Edit</button>

                            <p class="text-muted font-13 m-t-20">
                                {{ $admin->description }}
                            </p>

                            <hr/>

                            <div class="text-left">
                                <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">{{ $admin->name }}</span></p>

                                <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">{{ $admin->email }}</span></p>

                                <p class="text-muted font-13"><strong>Address :</strong> <span class="m-l-15">{{ $admin->address }}</span></p>
                            </div>

                            <ul class="social-links list-inline m-t-30">
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a>
                                </li>
                            </ul>

                        </div>

                    </div> <!-- end card-box -->

                </div> <!-- end col -->

                <div class="col-md-8 col-lg-9">

                    <hr/>

                    <div class="row">
                        <div class="col-md-8 col-sm-6 edit-form" style="display: none">
                            <h4 class="header-title m-t-0">Edit Form</h4>
                            <p class="text-muted font-13 m-b-10">
                                Here's our form that help you to update your information!
                            </p>

                            <div class="p-20">
                                <form action="#" data-parsley-validate novalidate class="form-edit">
                                    <input type="hidden" value="{{ $admin->id }}" id="id">
                                    <div class="form-group">
                                        <label for="userName">User Name<span class="text-danger">*</span></label>
                                        <input type="text" name="nick" parsley-trigger="change" required
                                               value="{{$admin->name}}" class="form-control" id="name" style="color: #00aff0">
                                    </div>
                                    <div class="form-group">
                                        <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                                        <input type="email" name="email" parsley-trigger="change" required
                                               value="{{$admin->email}}" class="form-control" id="email" style="color: #00aff0">
                                    </div>
                                    <div class="form-group">
                                        <label >Address</label>
                                        <input name="address"
                                               value="{{$admin->address}}" id="address" class="form-control" style="color: #00aff0">
                                    </div>
                                    <div class="form-group">
                                        <label >Description</label>
                                        <input name="description"
                                               value="{{$admin->description}}" id="description" class="form-control" style="color: #00aff0">
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <input id="remember-1" type="checkbox" name="checkboxPassword">
                                            <label for="remember-1"> Change password </label>
                                        </div>
                                    </div>
                                    <div id="password-form" style="display: none">
                                        <div class="form-group">
                                            <label for="pass1">New Password<span class="text-danger">*</span></label>
                                            <input id="pass1" type="password" placeholder="Password"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="passWord2">Confirm Password <span class="text-danger">*</span></label>
                                            <input data-parsley-equalto="#pass1" type="password"
                                                   placeholder="Password" class="form-control" id="passWord2">
                                        </div>
                                    </div>

                                    <div class="form-group text-right m-b-0">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">
                                            Update
                                        </button>
                                        <button type="reset" class="btn btn-default waves-effect m-l-5">
                                            Cancel
                                        </button>
                                    </div>

                                </form>
                            </div>
                    </div> <!-- end row -->
                </div>
                <!-- end col -->

            </div>
        </div>
    </div>
    </div>
    <!-- End row -->
@endsection
    @section ('page_scripts')
        @parent
        <!-- toastr notifications -->
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script type="text/javascript" src="{{ asset('/zircos/plugins/parsleyjs/parsley.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#edit-button').on('click', function () {
                    $(".edit-form").show();
                });

                $('input[type=checkbox]').click(function () {
                    $("#password-form").toggle();

                });

                $(".form-edit").submit(function () {
                    var name = $('#name').val();
                    var email = $('#email').val();
                    var address = $('#address').val();
                    var description = $('#description').val();
                    var id = $('#id').val();
                    $.ajax({
                        type: 'post',
                        url: "{{ route('admin.profile.update') }}",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'id':id,
                            'name': name,
                            'email': email,
                            'address': address,
                            'description':description,
                        },
                        success: function(data) {
                            toastr.success('Update Profile Successful!', 'Success Alert', {timeOut: 5000});
                        },
                        error(data) {
                            console.log(data);
                        }
                    });
                });
            });
        </script>
@endsection
