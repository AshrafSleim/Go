@extends('admin.index')
@section('title', 'All Reports')
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

        <div class="box table-responsive "style="border: none;">


            <table  class="table table-striped table-hover table-bordered " >
                <thead style="background: #26b1b0">
                <tr style="color: white!important;">
                    <th>Trip Name</th>
                    <th>Trip Driver</th>
                    <th>Trip Bus</th>
                    <th>Reports</th>
                    <th>Rate</th>
                </tr>
                </thead>

                <tbody>
                @foreach($reports as $report)
                    <tr>
                        <th class="rowStyle">{{$report->trip->name}}</th>
                        <th class="rowStyle">{{$report->trip->user->name}}</th>
                        <th class="rowStyle">{{$report->trip->bus->number}}</th>
                        <th class="rowStyle">{{$report->report}}</th>
                        <th class="rowStyle">{{$report->rate}}</th>
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
                    {{$reports->links()}}
                </div>

            </div>


        </div>

    </div>
@endsection
