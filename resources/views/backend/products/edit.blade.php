@extends('backend.layouts.master')

@section('content')


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Edit Products</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="iconify "
                                                                                                data-icon="uil-home-alt"
                                                                                                data-inline="false"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="{{route("products.index")}}">All
                                            Products </a></li>
                                    <li class="breadcrumb-item active"><a href="{{route("products.create")}}">
                                            Products </a></li>

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
                                <form action="{{route("products.update",$products->id)}}" method="post">
                                    @csrf
                                    @method("patch")
                                    <h4 class="card-title">Edit Products</h4>
                                    {{--                                <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to each--}}
                                    {{--                                    textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>--}}

                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-md-2 col-form-label">Title</label>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <input class="form-control" placeholder="title" name="title" type="text"
                                                   value="{{$products->Title}}" id="example-text-input">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-md-2 col-form-label">Photo</label>

                                        <span class="input-group-btn">
                                              <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                               <i class="fa fa-picture-o"></i> Choose
                                              </a>
                                          </span>
                                        <input id="thumbnail" class="thumbnail" type="text" name="photo" value="{{$products->photo}}">
                                    </div>
                                    <img id="holder" src="{{$products->photo}}" style="margin-top:15px;max-height:100px;">
                                    <div class="mb-3 row">
                                        <label for="description" class="col-md-2 col-form-label">Description of
                                            banner</label>
                                        <div class="col-md-10">

                                            <textarea id="description" class="form-control" name="description" type="text"
                                                  placeholder="Write a description of the banner"
                                                  value=" {{$products->Description}}" id="example-search-input"> {{$products->Description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">

                                        <label class="col-md-2 col-form-label">Banner type</label>
                                        <div class="col-md-10">
                                            <select name="conditions" class="form-select show-tick">
                                                <option value="banner" {{$products->conditions=='banner' ? 'selected': ''}}>
                                                    Banner
                                                </option>
                                                <option value="promo"{{$products->conditions=='promo' ? 'selected': ''}}>
                                                    Promotional Banner
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <button type = "submit" class="btn btn-primary" > Submit</button>
                                        <butoon type = "submit" class = "btn btn-outlined-secondary"> Cancel</butoon>
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
