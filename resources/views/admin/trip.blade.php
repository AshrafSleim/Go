@extends('admin.index')
@section('title', 'Tripe')
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
        <form id="search_form" action="" method="get" >
            <div class="box-body">
                <input type="hidden" name="filter" value="1">
                <div class="row">
                    <div class="col-md-2 col-sm-6 col-xs-12 lft padding-bb">
                        <div class="form-group nw-pd">
                            <a  class="btn btn-info" style="background-color: #4b646f" href="{{route('addNewTrip')}}" >Add New Driver</a>
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6 col-xs-12 lft padding-bb">
                        <div class="form-group nw-pd">
                            <input name="name" type="text" class="form-control border-r"
                                   placeholder="Search By Name" value="{{isset($_GET['name']) ?$_GET['name'] : ''}}">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 lft padding-bb">
                        <div class="form-group nw-pd">
                            <input name="date" type="date" class="form-control border-r"
                                   placeholder="Search By date" value="{{isset($_GET['date']) ?$_GET['date'] : ''}}">
                        </div>
                    </div>

                    <div class="col-md-2 col-sm-6 col-xs-12 lft padding-bb">
                        <div class=" nw-pd col-md-1 col-md-offset-6">
                            <button  class="btn btn-primary border-r"  style="background-color: #4b646f" onclick="applySearch({{route('AllTrips')}})">Search</button>

                        </div>
                    </div>

                </div>
                <div class="row">


                </div>



            </div>

        </form>

        <div class="box table-responsive "style="border: none;">


            <table  class="table table-striped table-hover table-bordered " >
                <thead style="background: #26b1b0">
                <tr style="color: white!important;">
                    <th>Name</th>
                    <th>start station</th>
                    <th>end station</th>
                    <th>start date</th>
                    <th>no.bus</th>
                    <th>driver</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($trips as $trip)
                    <tr>
                        <th class="rowStyle">{{$trip->name}}</th>
                        <th class="rowStyle">{{$trip->startStation->name}}</th>
                        <th class="rowStyle">{{$trip->endStation->name}}</th>
                        <th class="rowStyle">{{$trip->start_date}}</th>
                        <th class="rowStyle">{{$trip->bus->number}}</th>
                        <th class="rowStyle">{{$trip->user->name}}</th>
                        <th class="rowStyle" style="display:block"><button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModaldelete-{{$trip->id}}"><i class="fa fa-trash"></i> Delete</button> <a href="{{route('allStationOfTrip',$trip->id)}}" style="background-color: #26b1b0" class="btn btn-xs btn-info" ><i class="fa fa-eye"></i> All Stations</a></th>
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
                            {{$trips->links()}}
                        </div>

                    </div>


            </div>
        @foreach($trips as $trip)
            <div class="modal fade bs-example-modal-sm" id="myModaldelete-{{$trip->id}}" role="dialog" aria-labelledby="mySmallModalLabel" >
                <div class="modal-dialog modal-sm "  >

                    <!-- Modal content-->
                    <div class="modal-content "style="text-align: center;">

                        <br>
                        <h4 class="deleteModel">Are you sure you want to delete this</h4>
                            <form method="POST" id="myformdelete" action="{{route('deleteTrip', $trip->id)}}">
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
@endsection
