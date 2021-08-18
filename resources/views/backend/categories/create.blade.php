@extends('backend.layouts.master')

@section('content')


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Create Category</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="iconify "
                                                                                                data-icon="uil-home-alt"
                                                                                                data-inline="false"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="{{route("categories.index")}}">All
                                            Categories </a></li>
                                    <li class="breadcrumb-item active"><a href="{{route("categories.create")}}">
                                            Categories </a></li>

                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>
                                            {{$error}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                    </div>
                    <div class="col-12">


                            @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route("categories.store")}}" method="post">
                                    @csrf

                                    <h4 class="card-title">Create New Category</h4>
                                {{--                                <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to each--}}
                                {{--                                    textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>--}}

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label"><h2>Title</h2></label>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <input class="form-control" placeholder="title" name="title" type="text"
                                               value="{{old('title')}}" id="example-text-input">
                                    </div>
                                </div>
                                <div class="mb-3 row ">
                                    <label for="photo" class="col-lg-2 col-sm-2 col-md-2 col-form-label"><h2>Photo</h2></label>
                                    <input id="thumbnail" class="" type="file" name="photo" value="{{old("photo")}}">
                                    <div id="holder" style="margin-top:15px;max-height:300px;">

                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="description" class="col-md-2 col-form-label"><h2>Summary </h2></label>
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <textarea id="description" class="form-control" name="summary" type="text"
                                                  placeholder="Write a description of the banner"
                                                  value="{{old('summary')}}" id="example-search-input"> </textarea>
                                    </div>
                                </div>


                                    <div class="mb-3 row">

                                 <div class="col-lg-12 col-md-12 col-sm-12">
                                     <div class="from-group">
                                         <label for="is_parent"><h2>Is_parent :</h2> </label>
                                         <input  id="is_parent" type="checkbox" name="is_parent"   value="1" checked>Yes
                                     </div>
                                 </div>
                                </div>

                                    <div class="mb-3 row">

                                        <div class="col-md-12 col-lg-12 col-sm-12 d-none" id="parent_cat_div">
                                            <label><h2>--Parent Category--</h2></label>

                                            <select name="parent_id" class="form-select show-tick">
                                                <option value="" >Parent Category</option>
                                                @foreach($parent_cats as $cats)

                                                    <option value="{{$cats->id}} {{old('parent_id'==$cats->id ? 'selected': '')}}">{{$cats->title}}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                     </div>
                                    <div class="mb-3 row">
                                        <label class="col-md-2 col-form-label"><h2>Status</h2></label>
                                        <div class="col-md-12 col-lg-12">
                                            <select name="status" class="form-select show-tick">
                                                <option value="active" {{old('status')=='active' ? 'checked': ''}}>Active
                                                </option>
                                                <option value="inactive"{{old('status')=='inactive' ? 'checked': ''}}>
                                                    Inactive
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <button type = "submit" class="btn btn-primary" > Submit</button>
                                        <butoon type = "submit" class = " btn btn-outlined-secondary"> Cancel</butoon>
                                    </div>
                                </form>
                            </div>
                            </div>

                            </div>
                        </div>

                    <!-- end col -->


                <!-- end row -->
            </div>
        </div>
    </div>

@endsection

{{--@section("scripts")--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('#description').summernote();--}}

{{--        });--}}

{{--    </script>--}}


{{--    <script>--}}
{{--        $('#is_parent').change(function (e) {--}}
{{--           e.preventDefault();--}}
{{--           var is_checked = $('#is_parent').prop('checked')--}}
{{--            //alert(is_checked);--}}
{{--            if (is_checked){--}}
{{--                $('#parent_cat_div').addClass('d-none');--}}
{{--                $('#parent_cat_div').val('');--}}
{{--            }--}}
{{--            else{--}}
{{--                $('#parent_cat_div').removeClass('d-none');--}}


{{--            }--}}
{{--        })--}}

{{--    </script>--}}

{{--    <script>--}}
{{--        const inputElement = document.querySelector('input[id="thumbnail2"]');--}}

{{--        // Create a FilePond instance--}}
{{--        const pond = FilePond.create(inputElement);--}}

{{--        FilePond.setOptions({--}}
{{--            server: {--}}
{{--            url: '{{url('/upload')}}',--}}
{{--            headers:{--}}
{{--                'X-CSRF-TOKEN': '{{csrf_token()}}'--}}
{{--              }--}}
{{--            }--}}
{{--        });--}}

{{--    </script>--}}




{{--@endsection--}}
