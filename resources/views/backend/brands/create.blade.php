@extends('backend.layouts.master')

@section('content')


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Create  a Brand</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="iconify "
                                                                                                data-icon="uil-home-alt"
                                                                                                data-inline="false"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="{{route("brands.index")}}">All
                                            Brands </a></li>
                                    <li class="breadcrumb-item active"><a href="{{route("brands.create")}}">
                                            Brands </a></li>

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
                                <form action="{{route("brands.store")}}" method="post">
                                    @csrf

                                    <h4 class="card-title">Create Brand</h4>
                                {{--                                <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to each--}}
                                {{--                                    textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>--}}

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">Title</label>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <input class="form-control" placeholder="title" name="title" type="text"
                                               value="{{old('title')}}" id="example-text-input">
                                    </div>

{{--                                    <div class="mb-3 row">--}}
{{--                                        <label for="example-text-input" class="col-md-2 col-form-label">Slug</label>--}}
{{--                                        <div class="col-lg-12 col-md-12 col-sm-12">--}}
{{--                                            <input class="form-control" placeholder="slug" name="slug" type="text"--}}
{{--                                                   value="{{old('slug')}}" id="example-text-input">--}}
{{--                                        </div>--}}
                                </div>
                                    <div class="mb-3 row ">
                                        <label for="photo" class="col-lg-2 col-sm-2 col-md-2 col-form-label"><h2>Photo</h2></label>
                                        <input id="thumbnail" class="" type="file" name="photo" value="{{old("photo")}}">
                                        <div id="holder" style="margin-top:15px;max-height:300px;">
                                        </div>
                                    </div>
{{--                                <div class="mb-3 row">--}}
{{--                                    <label for="description" class="col-md-2 col-form-label">Description of--}}
{{--                                        banner</label>--}}
{{--                                    <div class="col-md-12 col-lg-12 col-sm-12">--}}
{{--                                        <textarea id="description" class="form-control" name="description" type="text"--}}
{{--                                                  placeholder="Write a description of the banner"--}}
{{--                                                  value="{{old('description')}}" id="example-search-input"> </textarea>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="mb-3 row">--}}

{{--                                    <label class="col-md-2 col-form-label">Banner type</label>--}}
{{--                                    <div class="col-md-10">--}}
{{--                                        <select name="conditions" class="form-select show-tick">--}}
{{--                                            <option value="banner" {{old('conditions')=='banner' ? 'selected': ''}}>--}}
{{--                                                Banner--}}
{{--                                            </option>--}}
{{--                                            <option value="promo"{{old('conditions')=='promo' ? 'selected': ''}}>--}}
{{--                                                Promotional Banner--}}
{{--                                            </option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="mb-3 row">

                                    <label class="col-md-2 col-form-label">Status</label>
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
{{--        const inputElement = document.querySelector('input[id="thumbnail"]');--}}

{{--        // Create a FilePond instance--}}
{{--        const pond = FilePond.create(inputElement);--}}

{{--        FilePond.setOptions({--}}
{{--            server:{--}}
{{--                url:{{'/upload'}},--}}
{{--                headers:{--}}
{{--                    'X-CSRF-TOKEN':'{{csrf_token()}}'--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}

{{--    </script>--}}





{{--@endsection--}}
