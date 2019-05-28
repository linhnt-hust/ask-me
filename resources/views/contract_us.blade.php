@extends('layouts.master')
@section('title')
    Contract us
@endsection
@section('page_header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection
@section('content')
    <div class="breadcrumbs">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Contact Us</h1>
                </div>
                <div class="col-md-12">
                    <div class="crumbs">
                        <a href="{{ route('home') }}">Home</a>
                        <span class="crumbs-span">/</span>
                        <span class="current">Contact Us</span>
                    </div>
                </div>
            </div><!-- End row -->
        </section><!-- End container -->
    </div><!-- End breadcrumbs -->
    <section class="container main-content page-full-width">
        <div class="row">
            <div class="contact-us">
                <div class="col-md-12">


                    <div class="page-content">
                        <iframe height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.677656292384!2d105.84127411471484!3d21.005554586011016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac76ccab6dd7%3A0x55e92a5b07a97d03!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBCw6FjaCBraG9hIEjDoCBO4buZaQ!5e0!3m2!1svi!2s!4v1559034050286!5m2!1svi!2s" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div><!-- End page-content -->
                </div>
                <div class="col-md-7">
                    <div class="page-content">
                        <h2>Say hello !</h2>
                        <p>Your feedback will be shared with our product delivery teams, and taken into consideration for future development.</p>
                        <form class="form-style form-style-3 form-style-5 form-js" action="{{ route('feedback') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-inputs clearfix">
                                <p>
                                    <label for="name" class="required">Name<span>*</span></label>
                                    @if (Auth::user() != null)
                                        <input type="text" class="required-item" value="{{ $user->name }}" name="name" id="name" aria-required="true">
                                    @else
                                        <input type="text" class="required-item" value="" name="name" id="name" aria-required="true">
                                    @endif
                                </p>
                                <p>
                                    <label for="mail" class="required">E-Mail<span>*</span></label>
                                    @if (Auth::user() != null)
                                        <input type="email" class="required-item" id="mail" name="email" value="{{$user->email }}" aria-required="true">
                                    @else
                                        <input type="email" class="required-item" id="mail" name="email" value="" aria-required="true">
                                    @endif
                                </p>
                            </div>
                            <div class="form-textarea">
                                <p>
                                    <label for="message" class="required">Your feedback<span>*</span></label>
                                    <textarea id="message" class="required-item" name="feedback" aria-required="true" cols="58" rows="7"></textarea>
                                </p>
                            </div>
                            <p class="form-submit">
                                <input name="submit" type="submit" value="Send" class="submit button small color">
                            </p>
                        </form>
                    </div><!-- End page-content -->
                </div><!-- End col-md-6 -->
                <div class="col-md-5">
                    <div class="page-content">
                        <h2>About Us</h2>
                        <p>Ask-me’s mission is to share and grow the world’s knowledge. We want to bring together people with different perspectives so they can understand each other better, and to empower everyone to share their knowledge for the benefit of the rest of the world. With Ask-me you can find your best answer to your question.</p>
                        <div class="widget widget_contact">
                            <ul>
                                <li><i class="icon-map-marker"></i>Address :<p>Số 1 Đại Cồ Việt, Hai Bà Trưng, Hà Nội</p></li>
                                <li><i class="icon-phone"></i>Phone number :<p>(+84)834921996</p></li>
                                <li><i class="icon-envelope-alt"></i>E-mail :<p>linhnt.dev.hust@gmail.com</p></li>
                                <li>
                                    <i class="icon-share"></i>Social links :
                                    <p>
                                        <a href="https://www.facebook.com/tuanlinh.nguyen.313" original-title="Facebook" class="tooltip-n">
											<span class="icon_i">
												<span class="icon_square" icon_size="25" span_bg="#3b5997" span_hover="#2f3239">
													<i i_color="#FFF" class="social_icon-facebook"></i>
												</span>
											</span>
                                        </a>
                                        <a href="#" original-title="Twitter" class="tooltip-n">
											<span class="icon_i">
												<span class="icon_square" icon_size="25" span_bg="#00baf0" span_hover="#2f3239">
													<i i_color="#FFF" class="social_icon-twitter"></i>
												</span>
											</span>
                                        </a>
                                        <a original-title="Youtube" class="tooltip-n" href="#">
											<span class="icon_i">
												<span class="icon_square" icon_size="25" span_bg="#cc291f" span_hover="#2f3239">
													<i i_color="#FFF" class="social_icon-youtube"></i>
												</span>
											</span>
                                        </a>
                                        <a href="#" original-title="Linkedin" class="tooltip-n">
											<span class="icon_i">
												<span class="icon_square" icon_size="25" span_bg="#006599" span_hover="#2f3239">
													<i i_color="#FFF" class="social_icon-linkedin"></i>
												</span>
											</span>
                                        </a>
                                        <a href="#" original-title="Google plus" class="tooltip-n">
											<span class="icon_i">
												<span class="icon_square" icon_size="25" span_bg="#ca2c24" span_hover="#2f3239">
													<i i_color="#FFF" class="social_icon-gplus"></i>
												</span>
											</span>
                                        </a>
                                        <a original-title="RSS" class="tooltip-n" href="#">
											<span class="icon_i">
												<span class="icon_square" icon_size="25" span_bg="#F18425" span_hover="#2f3239">
													<i i_color="#FFF" class="icon-rss"></i>
												</span>
											</span>
                                        </a>
                                        <a original-title="Instagram" class="tooltip-n" href="#">
											<span class="icon_i">
												<span class="icon_square" icon_size="25" span_bg="#306096" span_hover="#2f3239">
													<i i_color="#FFF" class="social_icon-instagram"></i>
												</span>
											</span>
                                        </a>
                                        <a original-title="Dribbble" class="tooltip-n" href="#">
											<span class="icon_i">
												<span class="icon_square" icon_size="25" span_bg="#e64281" span_hover="#2f3239">
													<i i_color="#FFF" class="social_icon-dribbble"></i>
												</span>
											</span>
                                        </a>
                                        <a original-title="Pinterest" class="tooltip-n" href="#">
											<span class="icon_i">
												<span class="icon_square" icon_size="25" span_bg="#c7151a" span_hover="#2f3239">
													<i i_color="#FFF" class="icon-pinterest"></i>
												</span>
											</span>
                                        </a>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div><!-- End page-content -->
                </div><!-- End col-md-6 -->
            </div><!-- End contact-us -->
        </div><!-- End row -->
    </section><!-- End container -->
@endsection
@section('page_scripts')
    @parent
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".form-js").submit(function () {
                var thisform = jQuery(this);
                jQuery('.required-error',thisform).remove();
                var name	= jQuery("#name").val();
                var mail	= jQuery("#mail").val();
                var message	= jQuery("#message").val();
                var data = {'name':name,'mail':mail,'message':message};
                if (name == "") {
                    $("#name").after('<span class="form-description required-error">Please fill the required field.</span>');
                }else {
                    $("#name").parent().find('.required-error').remove();
                }
                if (mail == "") {
                    $("#mail").after('<span class="form-description required-error">Please fill the required field.</span>');
                }else {
                    $("#mail").parent().find('.required-error').remove();
                }
                if (message == "") {
                    $("#message").after('<span class="form-description required-error">Please fill the required field.</span>');
                }else {
                    $("#message").parent().find('.required-error').remove();
                }

                if (name != "" && mail != "" && message != "") {
                    $.ajax({
                        type: 'post',
                        url: "{{ route('feedback') }}",
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'name': name,
                            'email': mail,
                            'feedback': message,
                        },
                        success: function(data) {
                            toastr.success('Thank you for your feedback!', 'Success Alert', {timeOut: 5000});
                            // thisform.prepend("<div class='alert-message success'><i class='icon-ok'></i><p><span>Thank you "+name+"!</span><br> We'll be in touch real soon .</p></div>");
                            $("#name").val("");
                            $("#mail").val("");
                            $("#message").val("");
                        },
                        error(data) {
                            console.log(data);
                        }
                    });
                }
                return false;
            });
        });
    </script>
@endsection
