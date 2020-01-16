@extends('admin.index')
@section('title', 'BusDriver')
@section('style')
    <style>
        .rowStyle{
            font-weight: normal;
        }
        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover{
            background-color: #26b1b0 ;
            border: none;
        }
        .btn{
            border: none;
        }
        .form-group {
            margin-bottom: 10px;
        }

    </style>
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12 p-l-0 p-r-0 btn-addnew" style="float: left; padding-bottom: 10px;">
                <button type="button"  class="btn btn-info border-r" data-toggle="modal" style="background-color: #4b646f" data-target="#myModalinsert">Add New Driver</button>
            </div>
        </div>
        <br>
        <div class="box table-responsive "style="border: none;">


            <table  class="table table-striped table-hover table-bordered " >
                <thead style="background: #26b1b0">
                <tr style="color: white!important;">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone.NO</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($drivers as $driver)
                    <tr>
                        <th class="rowStyle">{{$driver->user->name}}</th>
                        <th class="rowStyle">{{$driver->user->email}}</th>
                        <th class="rowStyle">{{$driver->user->phone}}</th>
                        <th class="rowStyle" style="display:block"><button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModaldelete-{{$driver->id}}"><i class="fa fa-trash"></i> Delete</button></th>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>


        <div class="box-body">
            <input type="hidden" name="filter" value="1">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12 p-l-0 p-r-0" style="float: left; padding:0;padding-left: 6px;">
                 </div>
                <div class="col-md-4 col-sm-6 col-xs-12 p-l-0 p-r-0 " style="float: right;margin-top: -20px;padding-right: 6px;">
                    {{$drivers->links()}}
                </div>

            </div>


        </div>
        @foreach($drivers as $driver)
            <div class="modal fade bs-example-modal-sm" id="myModaldelete-{{$driver->id}}" role="dialog" aria-labelledby="mySmallModalLabel" >
                <div class="modal-dialog modal-sm "  >

                    <!-- Modal content-->
                    <div class="modal-content "style="text-align: center;">

                        <br>
                        <h4 class="deleteModel">Are you sure you want to delete this</h4>
                        <form method="POST" id="myformdelete" action="{{route('deleteBusDriver', $driver->id)}}">
                            @csrf

                            <button type="submit" class="btn btn-default btn-danger deleteButton">Delete</button>
                            <button type="button" class="btn btn-default btn-info deleteButton" style="background-color: #4b646f" data-dismiss="modal">Close</button>
                        </form>
                        <br>


                    </div>

                </div>
            </div>
        @endforeach
    </div>


    <div class="modal fade" id="myModalinsert" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Bus Driver</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" id="myforminsert" action="{{route('addBusDriver',$id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="driver">All Driver</label>
                            <select name="driver"  class="form-control border-r" required>
                                <option value="">Drivers</option>
                                @foreach($allDrivers as $allDriver)
                                    <option value="{{$allDriver->id}}">{{$allDriver->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" style="background-color: #26b1b0" class="btn btn-default btn-primary">Add</button>
                            <button type="button" class="btn btn-default btn-info" style="background-color: #4b646f" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>


@endsection
