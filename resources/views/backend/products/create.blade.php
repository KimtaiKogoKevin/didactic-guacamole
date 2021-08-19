@extends('backend.layouts.master')

@section('content')


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Create a Product</h4>

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
                                <form action="{{route("products.store")}}" method="post">
                                    @csrf

                                    <h4 class="card-title">Create Products</h4>
                                {{--                                <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to each--}}
                                {{--                                    textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>--}}

                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-md-2 col-form-label">Title</label>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <input class="form-control" placeholder="title" name="title" type="text"
                                               value="{{old('title')}}" id="example-text-input">
                                    </div>
                                </div>
                                    <div class="mb-3 row">
                                        <label for="summary" class="col-md-2 col-form-label"> Short Summary of
                                            products</label>
                                        <div class="col-md-12 col-lg-12 col-sm-12">
                                        <textarea id="summary" class="form-control" name="summary" type="text"
                                                  placeholder="Write a summary of the product description"
                                                  value="{{old('summary')}}" id="example-search-input"> </textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="description" class="col-md-2 col-form-label">Description of
                                            products</label>
                                        <div class="col-md-12 col-lg-12 col-sm-12">
                                        <textarea id="description" class="form-control" name="description" type="text"
                                                  placeholder="Write a description of the banner"
                                                  value="{{old('description')}}" id="example-search-input"> </textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-md-2 col-form-label">Price</label>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <input  type="number" class="form-control" placeholder="Price" name="price" step="any"
                                                   value="{{old('price')}}" id="example-text-input">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-md-2 col-form-label">Discount</label>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <input type="number" class="form-control" placeholder="Discount" name="discount" step="any"
                                                   value="{{old('discount')}}" max="100" min="0" mid="example-text-input">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-md-2 col-form-label">Stock</label>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <input class="form-control" placeholder="stock" name="stock" type="number"
                                                   value="{{old('stock')}}" id="example-text-input">
                                        </div>
                                    </div>




                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-md-2 col-form-label">Photo</label>

                                        <span class="input-group-btn">
                                              <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                               <i class="fa fa-picture-o"></i> Choose
                                              </a>
                                          </span>
                                        <input id="thumbnail" class="thumbnail" type="text" name="photo" value="{{old('photo')}}">
                                    </div>

                                    <div class="mb-3 row">

                                        <label class="col-md-2 col-form-label"> Brands</label>
                                        <div class="col-md-10">
                                            <select   name="brand_id" class="form-select show-tick">
                                                <option value="">Brands</option>
                                                @foreach(\App\Models\Brand::get() as $brand)
                                                <option value="{{$brand->id}}">{{$brand->title}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">

                                        <label class="col-md-2 col-form-label"> Category</label>
                                        <div class="col-md-10">
                                            <select id="cat_id" name="cat_id" class="form-select show-tick">
                                                <option value="">Parent Categories</option>
                                                @foreach(\App\Models\Category::where('is_parent',1)->orderby('id','DESC')->get() as $cats)
                                                    <option value="{{$cats->id}}">{{$cats->title}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row d-none" id="child_cat_div">
                                        <label class="col-md-2 col-form-label ">  Child Category</label>
                                        <div class="col-md-10">
                                            <select id="child_cat_id" name="child_cat_id" class="form-select show-tick">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">

                                        <label class="col-md-2 col-form-label"> Product Condition</label>
                                        <div class="col-md-10">
                                            <select name="conditions" class="form-select show-tick">
                                                <option value="">Conditions</option>
                                                    <option value="new">{{old('conditions')=='new' ? 'selected' : ''}}New</option>
                                                    <option value="new">{{old('conditions')=='popular' ? 'selected' : ''}}Popular</option>
                                                    <option value="new">{{old('conditions')=='most_searched' ? 'selected' : ''}}Most Searched</option>
                                            </select>
                                        </div>
                                    </div>




                                    <div class="mb-3 row">

                                    <label class="col-md-2 col-form-label">Products Size</label>
                                    <div class="col-md-10">
                                        <select name="size" class="form-select show-tick">
                                            <option value="S" {{old('size')=='S' ? 'selected': ''}}>
                                                small
                                            </option>
                                            <option value="M"{{old('size')=='M' ? 'selected': ''}}>
                                                medium
                                            </option>
                                            <option value="L"{{old('size')=='L' ? 'selected': ''}}>
                                                Large
                                            </option>
                                            <option value="XL"{{old('size')=='XL' ? 'selected': ''}}>
                                                Extra Large
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                    <div class="mb-3 row">

                                        <label class="col-md-2 col-form-label">Vendor</label>
                                        <div class="col-md-10">
                                            <select name="role" class="form-select show-tick">
                                                <option value="">Vendors</option>
                                                @foreach(\App\Models\User::where('role','vendor')->get() as $vendor)
                                                    <option value="{{$vendor->id}}">{{$vendor->name}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
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

    <script>
        $('#cat_id').change(function (e) {
            e.preventDefault();
            var cat_id = $(this).val()
            //alert(is_checked);
            if (cat_id != null) {
                $.ajax({
                    url: "/admin/category/" + cat_id + "/child",
                    type: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        cat_id: cat_id,
                    },
                    success: function (response) {
                         //console.log(response.data)
                        var html_option = "<option value=''>Child Category </option>";

                        if (response.status) {
                            $('#child_cat_div').removeClass('d-none');
                            $.each(response.data, function(id,title) {
                                html_option += "<option value='"+id+"'>"+title+"</option>"
                            });
                        } else {
                            //alert('No Child Category Found!')
                            $('#child_cat_div').addClass('d-none');


                        }
                        $('#child_cat_id').html(html_option);

                    }

                });


            }
        });

    </script>

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
{{--                url:{{url('/upload')}},--}}
{{--                headers:{--}}
{{--                    'X-CSRF-TOKEN':'{{csrf_token()}}'--}}
{{--                }--}}
{{--            }--}}
{{--        });--}}

{{--    </script>--}}





{{--@endsection--}}
