@extends('backend.layouts.master')

@section('content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12">


                        @include('backend.layouts.notifications')
                    </div>
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Products</h4>


                            <div class="page-title-right">
                                <ol class="breadcrumb m-0 ">
                                    <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active"> <a href="{{route('products.index')}}">Products</a></li>
                                </ol>

                                <p> Total Products : {{\App\Models\Product::count()}}</p>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Create a  new Banner</h4>
                                <a class="btn  btn-outline-secondary" href="{{route('products.create')}}"> <i class="fas fa-plus-circle"> Create Products</i></a>

                                <p class="card-title-desc">List of my Products.</p>

                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>Title</th>
                                                <th>Photo</th>
                                                <th>Price </th>
                                                <th> Discount</th>
                                                <th>Offer_Price</th>
                                                <th> Size</th>

                                                <th>Condition</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>


                                            <tbody>
                                            @foreach( $products as $product_items )
                                                <tr>
                                                    <td>{{$product_items->id}}</td>
                                                    <td>{{$product_items->title}}</td>
                                                    <td><img src="{{$product_items->photo}}" style="height: 120px; width:90px" class="img-thumbnail" alt="Banner Image"></td>
                                                    <td>
                                                        <span>KSH</span> {{number_format($product_items->price)}}
                                                    </td>
                                                    <td>
                                                       {{number_format($product_items->discount)}}%
                                                    </td>
                                                    <td>
                                                        <span>KSH</span> {{number_format($product_items->offer_price)}}
                                                    </td>
                                                    <td>
                                                        {{--                                            {{dd($banner_item->conditions)}}--}}
                                                        @if($product_items->size=="S")

                                                            <h6>  <span class="badge badge-success " style="font-size: 12px; position:center" >{{$product_items->size}}</span></h6>
                                                        @elseif($product_items->size=="M")

                                                            <span class="badge badge-primary " style="font-size: 12px; position: center" >{{$product_items->size}}</span>

                                                        @elseif($product_items->size=="L")

                                                            <span class="badge badge-warning" style="font-size: 12px; position: center" >{{$product_items->size}}</span>

                                                            @else
                                                            <span class="badge badge-info" style="font-size: 12px; position: center" >{{$product_items->size}}</span>


                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{--                                            {{dd($banner_item->conditions)}}--}}
                                                        @if($product_items->conditions=="new")

                                                            <h6>  <span class="badge badge-success" style="font-size: 12px; position:center" >{{$product_items->conditions}}</span></h6>
                                                        @elseif($product_items->conditions=="popular")

                                                            <span class="badge badge-primary" style="font-size: 12px; position: center" >{{$product_items->conditions}}</span>

                                                        @else

                                                            <span class="badge badge-warning" style="font-size: 12px; position: center" >{{$product_items->conditions}}</span>




                                                        @endif
                                                    </td>
                                                    <td>  <!-- Default switch -->
                                                        <div class="row">
                                                            <div class="col-md-4 col-lg-4 col-sm-4">
                                                                <input type="checkbox" class="input-lg"  name="toogle" value="{{$product_items->id}}"  data-toggle="switchbutton"  data-onlabel="Active"  {{$product_items->status=="active" ? 'checked' : ''}} data-offlabel="Inactive" style="width:100px; height: 90px" data-onstyle="success" data-offstyle="danger">

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#productID{{$product_items->id}}"  data-toggle="tooltip" title="view" class=" float-left btn btn-xl btn-outline-secondary" data-placement="bottom"> <i class="fas fa-eye"> </i> </a>
                                                        <a href="{{route('products.edit',$product_items->id)}}"  data-toggle="tooltip" title="edit" class=" float-left btn btn-xl btn-outline-info" data-placement="bottom"> <i class="fas fa-edit"> </i> </a>

                                                        <form action = "{{route('products.destroy',$product_items->id)}}" class="float-left" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="" data-toggle="tooltip" title="delete" data-id="{{$product_items->id}}" class=" dltBtn btn btn-xl btn-outline-danger" data-placement="bottom"> <i class="fas fa-trash-alt"> </i> </a>

                                                        </form>

                                                    </td>



                                                    <!-- Modal -->
                                                    <div class="modal fade" id="productID{{$product_items->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            @php

                                                            $product = \App\Models\Product::where('id',$product_items->id)->first();

                                                            @endphp
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">{{\Illuminate\Support\Str::upper($product_items->title)}}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <strong>Summary of product:</strong>

                                                                    <p>
                                                                        {!! html_entity_decode($product_items->summary) !!}
                                                                    </p>
                                                                    <strong>Description of product:</strong>

                                                                    <p>
                                                                        {!! html_entity_decode($product_items->description) !!}
                                                                    </p>

                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <strong>Price:</strong>
                                                                            <p> <span>KSH</span> {{number_format($product_items->price,2)}}</p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <strong>Offer_Price:</strong>
                                                                            <p> <span>KSH</span> {{number_format($product_items->offer_price,2)}}</p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <strong>Discount:</strong>
                                                                            <p>  {{number_format($product_items->Discount,2)}}%</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <strong>Category:</strong>
                                                                            <p> {{\App\Models\Category::where('id',$product_items->cat_id)->value('title')}}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong>Child Category:</strong>
                                                                            <p> {{\App\Models\Category::where('id',$product_items->child_cat_id)->value('title')}}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <strong>Brand:</strong>
                                                                            <p> {{\App\Models\Brand::where('id',$product_items->brand_id)->value('title')}}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong>Size:</strong>
                                                                            <p class="badge badge-success">{{$product_items->size}}</p>

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <strong>Condition:</strong>
                                                                            <p class="badge badge-info"> {{$product_items->conditions}}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong>status:</strong>
                                                                            <p class="badge badge-primary">{{$product_items->status}}</p>

                                                                        </div>
                                                                    </div>








                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                                </tr>
                                            @endforeach


                                            </tbody>
                                            <tfoot>
                                            {{--                                    <tr>--}}
                                            {{--                                        <th>Name</th>--}}
                                            {{--                                        <th>Position</th>--}}
                                            {{--                                        <th>Office</th>--}}
                                            {{--                                        <th>Age</th>--}}
                                            {{--                                        <th>Start date</th>--}}
                                            {{--                                        <th>Salary</th>--}}
                                            {{--                                    </tr>--}}
                                            </tfoot>

                                        </table>

                                        {{$products->links()}}



                                    </div>


                            </div>

                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->



            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> © CBF limited </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block"> Crafted with  by <a href="https://cbf.co.ke/" target="_blank" class="text-reset">Kevin Kogo</a> </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
    </script>
    <!-- end main content-->


@endsection

@section('scripts')

    <script>


    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dltBtn').click(function (e) {
           var form = (this).closest('form');
           var dataID = $(this).data('id');
           e.preventDefault();
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your  file is safe!");
                    }
                });

        });

        $('input[name=toogle]').change(function () {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            //alert(id);

            $.ajax({
                url:"{{route('product.status')}}",
                type:"POST",
                data:{
                    _token:'{{csrf_token()}}',
                    mode:mode,
                    id:id,
                },
                success:function(response){
                    // console.log(response.Status);
                    if(response.Status){
                        alert(response.msg);
                    }
                    else {
                        alert("Failed Please Try Again");
                    }


                }
            })



        });
    </script>
@endsection
