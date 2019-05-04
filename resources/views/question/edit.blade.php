@extends('layouts.master')
@section('title')
    Edit Question
@endsection
@section('content')
<div class="breadcrumbs">
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Edit Question</h1>
            </div>
            <div class="col-md-12">
                <div class="crumbs">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="crumbs-span">/</span>
                    <a href="#">Pages</a>
                    <span class="crumbs-span">/</span>
                    <span class="current">Edit Question</span>
                </div>
            </div>
        </div><!-- End row -->
    </section><!-- End container -->
</div><!-- End breadcrumbs -->

<section class="container main-content">
    <div class="row">
        <div class="col-md-9">

            @if ($message = Session::get('error'))
                <div class="alert-message error">
                    <i class="icon-flag"></i>
                    <p><span>success message</span><br>
                        {{$message}}</p>
                </div>
            @endif

            <div class="page-content ask-question">
                <div class="boxedtitle page-title"><h2>Edit Question</h2></div>
                                
                <div class="form-style form-style-3" id="question-submit">
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="userId" value="{{ $user->id }}">
                        <div class="form-inputs clearfix">
                            <p>
                                <label class="required">Question Title<span>*</span></label>
                                <input type="text" id="question-title" name="title" placeholder="{{$question->title}}">
                            </p>
                            <p>
                                <label>Tags</label>
                                <input type="text" class="input" name="question_tags" id="question_tags" data-seperator="," name="tags">
                            </p>
                            <p>
                                <label class="required">Category<span>*</span></label>
                                <span class="styled-select">
                                    <select name="category">
                                        <option value=""> {{ $question->category->name_category }}</option>
                                        @foreach( $categories as $category)
                                            <option value="{{$category->id}}"> {{ $category->name_category }}</option>
                                        @endforeach
                                    </select>
                                </span>
                            </p>
                            <p class="question_poll_p">
                                <label for="question_poll">Poll</label>
                                <input type="checkbox" id="question_poll" value="1" name="question_poll" >
                                <span class="question_poll">This question is a poll ?</span>
                                <span class="poll-description">If you want to be doing a poll click here .</span>
                            </p>
                            <div class="clearfix"></div>
                            <div class="poll_options">
                                <p class="form-submit add_poll">
                                    <button id="add_poll" type="button" class="button color small submit"><i class="icon-plus"></i>Add Field</button>
                                </p>
                                <ul id="question_poll_item">
                                    <li id="poll_li_1">
                                        <div class="poll-li">
                                            <p><input id="ask[1][title]" class="ask" name="ask[1][title]" value="" type="text"></p>
                                            <input id="ask[1][value]" name="ask[1][value]" value="" type="hidden">
                                            <input id="ask[1][id]" name="ask[1][id]" value="1" type="hidden">
                                            <div class="del-poll-li"><i class="icon-remove"></i></div>
                                            <div class="move-poll-li"><i class="icon-fullscreen"></i></div>
                                        </div>
                                    </li>
                                </ul>
                                <script> var nextli = 2;</script>
                                <div class="clearfix"></div>
                            </div>
                            
                            <label>Attachment</label>
                            <div class="fileinputs">
                                <input type="file" class="file">
                                <div class="fakefile">
                                    <button type="button" class="button small margin_0">Select file</button>
                                    <span><i class="icon-arrow-up"></i>Browse</span>
                                </div>
                            </div>
                            
                        </div>
                        <div id="form-textarea">
                            <p>
                                <label class="required">Details<span>*</span></label>
                                <textarea id="question-details" aria-required="true" cols="58" rows="8" name="details">{{ $question->details}}</textarea>
                                <span class="form-description">Type the description thoroughly and in detail .</span>
                            </p>
                        </div>
                        <p class="form-submit">
                            <input type="submit" id="publish-question" value="Save your question" class="button color small submit">
                        </p>
                    </form>
                </div>
            </div><!-- End page-content -->
        </div><!-- End main -->

        @include('layouts.asside_bar')

		</div><!-- End row -->
	</section><!-- End container -->
@endsection
