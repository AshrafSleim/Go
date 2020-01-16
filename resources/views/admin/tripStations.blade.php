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
                    <th>Time</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($stations as $station)
                    <tr>
                        <th class="rowStyle">{{$station->station->name}}</th>
                        <th class="rowStyle">{{$station->time}}</th>
                        <th class="rowStyle" style="display:block"><button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModaldelete-{{$station->id}}"><i class="fa fa-trash"></i> Delete</button></th>
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
                    {{$stations->links()}}
                </div>

            </div>


        </div>
        @foreach($stations as $station)
            <div class="modal fade bs-example-modal-sm" id="myModaldelete-{{$station->id}}" role="dialog" aria-labelledby="mySmallModalLabel" >
                <div class="modal-dialog modal-sm "  >

                    <!-- Modal content-->
                    <div class="modal-content "style="text-align: center;">

                        <br>
                        <h4 class="deleteModel">Are you sure you want to delete this</h4>
                        <form method="POST" id="myformdelete" action="{{route('deleteTripStation', $station->id)}}">
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
                    <h4 class="modal-title">Add New Trip Station</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" id="myforminsert" action="{{route('addNewTripStation',$id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="station">All Stations</label>
                            <select name="station"  class="form-control border-r" required>
                                <option value="">Stations</option>
                                @foreach($allStations as $allStation)
                                    <option value="{{$allStation->id}}">{{$allStation->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start_time">All Stations</label>
                            <input type="time" class="form-control" id="start_time" name="start_time"  value="" required>

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
