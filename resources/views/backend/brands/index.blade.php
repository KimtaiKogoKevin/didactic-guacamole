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
                            <h4 class="mb-0">Brands</h4>


                            <div class="page-title-right">
                                <ol class="breadcrumb m-0 ">
                                    <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active"> <a href="{{route('brands.index')}}">Brands</a></li>
                                </ol>

                                <p> Total Brands : {{\App\Models\Brand::count()}}</p>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Create a  new Brand</h4>
                                <a class="btn  btn-outline-secondary" href="{{route('brands.create')}}"> <i class="fas fa-plus-circle"> Create a Brand</i></a>

                                <p class="card-title-desc">List of Brands.</p>

                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>S.N</th>
                                                <th>Title</th>
                                                <th>Slug</th>
                                                <th>Photo</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>


                                            <tbody>
                                            @foreach( $brands as $brand )
                                                <tr>
                                                    <td>{{$brand->id}}</td>
                                                    <td>{{$brand->title}}</td>
                                                    <td>{{$brand->slug}}</td>

                                                    {{--                                                    <td >--}}
{{--                                                        {!! html_entity_decode($brand->Description)!!}--}}

{{--                                                    </td>--}}

                                                    <td><img src="{{$brand->photo}}" style="height: 120px; width:90px" class="img-thumbnail" alt="Banner Image"></td>
{{--                                                    <td>--}}
{{--                                                        --}}{{--                                            {{dd($banner_item->conditions)}}--}}
{{--                                                        @if($banner_item->conditions=="banner")--}}

{{--                                                            <h6>  <span class="label label-success" style="font-size: 12px; position:center" >{{$banner_item->conditions}}</span></h6>--}}
{{--                                                        @else--}}

{{--                                                            <span class="label label-primary" style="font-size: 12px; position: center" >{{$banner_item->conditions}}</span>--}}


{{--                                                        @endif--}}
{{--                                                    </td>--}}


                                                    <td>  <!-- Default switch -->
                                                        <div class="row">
                                                            <div class="col-md-4 col-lg-2">
                                                                <input type="checkbox"  name="toogle" value="{{$brand->id}}"  data-toggle="switchbutton"  data-onlabel="Active"  {{$brand->status=="active" ? 'checked' : ''}} data-offlabel="Inactive" style="width:90px; height: 90px" data-onstyle="success" data-offstyle="danger">

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('brands.edit',$brand->id)}}"  data-toggle="tooltip" title="edit" class=" float-left btn btn-xl btn-outline-info" data-placement="bottom"> <i class="fas fa-edit"> </i> </a>
                                                        <form action = "{{route('brands.destroy',$brand->id)}}" class="float-left" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <a href="" data-toggle="tooltip" title="delete" data-id="{{$brand->id}}" class=" dltBtn btn btn-xl btn-outline-danger" data-placement="bottom"> <i class="fas fa-trash-alt"> </i> </a>

                                                        </form>

                                                    </td>



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

                                        {{$brands->links()}}



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
                text: "Once deleted, you will not be able to recover this  file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                        swal("Poof! Your  file has been deleted!", {
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
                url:"{{route('brand.status')}}",
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
