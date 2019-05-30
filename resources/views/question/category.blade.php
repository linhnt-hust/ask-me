@extends('layouts.master')
@section('title')
    All Categories
@endsection
@section('page_header')
    <style>
        h2.form-search {
            float: right;
            display: inline-grid;
        }

        form.form-search input[type=text] {
            padding: 10px;
            font-size: 17px;
            border: 1px solid grey;
            float: left;
            width: 80%;
            background: #f1f1f1;
        }

        form.form-search button {
            float: left;
            width: 10%;
            padding: 10px;
            background: #2196F3;
            color: white;
            font-size: 17px;
            border: 1px solid grey;
            border-left: none;
            cursor: pointer;
        }

        form.form-search button:hover {
            background: #0b7dda;
        }

        form.form-search::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
@endsection
@section('content')
    <div class="breadcrumbs">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>All Categories</h1>
                </div>
                <div class="col-md-12">
                    <div class="crumbs">
                        <a href="{{ route('home') }}">Home</a>
                        <span class="crumbs-span">/</span>
                        <span class="current">All Categories</span>
                    </div>
                </div>
            </div><!-- End row -->
        </section><!-- End container -->
    </div><!-- End breadcrumbs -->
    <section class="container main-content">
        <div class="row">
            <div class="col-md-9">
                <div class="page-content page-shortcode">
                    <div class="boxedtitle page-title">
                        <h2>All Categories ({{$categories->total()}})

                                <form class="form-search" style="margin:auto;" action="{{route('category.search')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="text" name="search" id="search_input" value="Search here ..." onfocus="if(this.value=='Search here ...')this.value='';" onblur="if(this.value=='')this.value='Search here ...';">
                                    <button type="submit" class="search-submit"></button>
                                </form>
                        </h2>
                    </div>
                    <div class="accordion toggle-accordion">
                        @foreach ($categories as $category)
                        <h4 class="accordion-title" ><a href="" style="background-color: #5cd08d">{{ $category->name_category }}</a></h4>
                        <div class="accordion-inner">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravida odio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequat.
                            <a href="{{route('question.category.detail', $category->id)}}" class="button small color" style=" float: right; margin-top: 10px">See more</a>
                        </div>
                            <br>
                        @endforeach
                    </div>
                </div><!-- End page-content -->

                {{ $categories->render('partials.pagination') }}

            </div><!-- End main -->

            @include('layouts.asside_bar')

        </div><!-- End row -->
    </section><!-- End container -->
@endsection
@section('page_scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function(){
            $('.search-submit').on('click', function(event){
                event.preventDefault();
                var search = $('#search_input').val();
                $.ajax({
                    type: 'post',
                    url: "{{ route('category.search') }}",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'search': search,
                    },
                    success: function(data) {
                        $('.toggle-accordion').html(data);
                    },
                    error(data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endsection
