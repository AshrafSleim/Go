@extends('admin.index')
@section('title', 'All buses')
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
    <form id="search_form" action="" method="get" >
        <div class="box-body">
            <input type="hidden" name="filter" value="1">
            <div class="row">
                <div class="col-md-2 col-sm-6 col-xs-12 lft padding-bb">
                    <div class="form-group nw-pd">
                        <button type="button"  class="btn btn-info border-r" data-toggle="modal" style="background-color: #4b646f" data-target="#myModalinsert">Add New Bus</button>
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12 lft padding-bb">
                    <div class="form-group nw-pd">
                        <input name="number" type="text" class="form-control border-r"
                               placeholder="Search By number" value="{{isset($_GET['number']) ?$_GET['number'] : ''}}">
                    </div>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-12 lft padding-bb">
                    <div class=" nw-pd col-md-1 col-md-offset-6">
                        <button  class="btn btn-primary border-r"  style="background-color: #4b646f" onclick="applySearch({{route('AllBuses')}})">Search</button>

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
                <th>Number</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            @foreach($buses as $bus)
                <tr>
                    <th class="rowStyle">{{$bus->number}}</th>
                    <th class="rowStyle" style=""><button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModaldelete-{{$bus->id}}"><i class="fa fa-trash"></i> Delete</button> <a href="{{route('AllDriverOfBus',$bus->id)}}" style="background-color: #26b1b0" class="btn btn-xs btn-info" ><i class="fa fa-eye"></i> Show drivers</a></th>
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
                {{$buses->links()}}
            </div>

        </div>


    </div>
    @foreach($buses as $bus)
        <div class="modal fade bs-example-modal-sm" id="myModaldelete-{{$bus->id}}" role="dialog" aria-labelledby="mySmallModalLabel" >
            <div class="modal-dialog modal-sm "  >

                <!-- Modal content-->
                <div class="modal-content "style="text-align: center;">

                    <br>
                    <h4 class="deleteModel">Are you sure you want to delete this</h4>
                    <form method="POST" id="myformdelete" action="{{route('deleteBus', $bus->id)}}">
                        @csrf

                        <button type="submit" class="btn btn-default btn-danger deleteButton">Delete</button>
                        <button type="button" class="btn btn-default btn-info deleteButton" style="background-color: #4b646f" data-dismiss="modal">Close</button>
                    </form>
                    <br>


                </div>

            </div>
        </div>
        @endforeach

        <div class="modal fade" id="myModalinsert" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add New Bus</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="myforminsert" action="{{route('addBus')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Bus number</label>
                                <input type="text" class="form-control" name="number" id="number" >
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
