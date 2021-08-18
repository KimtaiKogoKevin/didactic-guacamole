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
                            <h4 class="mb-0">Categories</h4>


                            <div class="page-title-right">
                                <ol class="breadcrumb m-0 ">
                                    <li class="breadcrumb-item"><a href="{{route('admin')}}"><i class="fas fa-home"></i></a></li>
                                    <li class="breadcrumb-item active"> <a href="{{route('categories.index')}}">Categories</a></li>
                                </ol>

                                <p> Total Categories : {{\App\Models\Category::count()}}</p>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Create a  new category</h4>
                                <a class="btn  btn-outline-secondary" href="{{route('categories.create')}}"> <i class="fas fa-plus-circle"> Create Category</i></a>

                                <p class="card-title-desc">List of my categories.</p>

                                <div class="table-responsive">
                                    <table id="datatable2" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Title</th>
                                            <th>Photo</th>
                                            <th>Is Parent</th>
                                            <th>Parents</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @foreach( $categories as $category_item )
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$category_item->title}}</td>


                                                <td><img src="{{$category_item->photo}}" style="height: 120px; width:90px" class="" alt="Banner Image"></td>
{{--                                                {{dd($categories)}}--}}
                                                <td>{{($category_item->is_parent)===1 ? 'Yes' : 'No'}}</td>
                                                <td>{{\App\Models\Category::where('id',$category_item->parent_id)->value('title')}}</td>


                                                <td>  <!-- Default switch -->
                                                    <div class="row">
                                                        <div class="col-md-4 col-lg-2">
                                                            <input type="checkbox"  name="toogle" value="{{$category_item->id}}"  data-toggle="switchbutton"  data-onlabel="Active"  {{$category_item->status=="active" ? 'checked' : ''}} data-offlabel="Inactive" style="width:90px; height: 90px" data-onstyle="success" data-offstyle="danger">

                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{route('categories.edit',$category_item->id)}}"  data-toggle="tooltip" title="edit" class=" float-left btn btn-xl btn-outline-info" data-placement="bottom"> <i class="fas fa-edit"> </i> </a>
                                                    <form action = "{{route('categories.destroy',$category_item->id)}}" class="float-left" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="" data-toggle="tooltip" title="delete" data-id="{{$category_item->id}}" class=" dltBtn btn btn-xl btn-outline-danger" data-placement="bottom"> <i class="fas fa-trash-alt"> </i> </a>

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
                                   {{$categories->links()}}
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
                        <div class="text-sm-end d-none d-sm-block"> Property of<i class="mdi mdi-heart text-danger"></i> by <a href="https://cbf.co.ke/" target="_blank" class="text-reset">Joseah Kogo</a> </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script>
        $(document).ready(function() {
            $('#datatable2').DataTable();
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
                        swal("Your imaginary file is safe!");
                    }
                });

        });

        $('input[name=toogle]').change(function () {
            var mode = $(this).prop('checked');
            var id = $(this).val();
            //alert(id);

            $.ajax({
                url:"{{route('categories.status')}}",
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
