@extends('admin.index')
@section('title', 'New Trip')
@section('style')
    <style>
        .btn{
            border: none;
        }
    </style>
@endsection
@section('content')
    <br>
    <div class="form-content">
        <form action="{{route('saveNewTrip')}}"  method="post" class="mb-3 pb-2" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">trip Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="start_station">trip start station</label>
                    <select name="start_station"  class="form-control">
                        @foreach($stations as $station)
                            <option value="{{$station->id}}"{{old('start_station') == $station->id ? 'selected' : ''}}>{{$station->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label for="end_station">trip end station</label>
                    <select name="end_station"  class="form-control">
                        @foreach($stations as $station)
                            <option value="{{$station->id}}"{{old('end_station') == $station->id ? 'selected' : ''}}>{{$station->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">

                <div class="form-group col-sm-6">
                    <label for="start_date">start date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date"  value="{{old('start_date')}}" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="start_time">start time</label>
                    <input type="time" class="form-control" id="start_time" name="start_time"  value="{{old('start_time')}}" required>
                </div>
                <div class="form-group col-sm-6">
                    <label for=" end_time">end time</label>
                    <input type="time" class="form-control" id="end_time" name="end_time"  value="{{old('end_time')}}" required>
                </div>

            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="bus">Bus</label>
                    <select name="bus"  class="form-control"  id="bus" required>
                        <option value="">Select your bus</option>
                    @foreach($buses as $bus)
                            <option value="{{$bus->id}}"{{old('bus') == $bus->id ? 'selected' : ''}}>{{$bus->number}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label for="driver">driver</label>
                    <select name="driver" id="driver" class="form-control"required>

                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="cost">trip cost</label>
                <input type="text" class="form-control" id="cost" name="cost" value="{{old('cost')}}" required>
            </div>
            <br/>
            <div class="row ">
                <div class="form-group col-md-12 ">
                    <button type="submit" class="btn btn-primary" style="background-color: #26b1b0">Save</button >
                    <a href="#" class="btn btn-info" style="background-color: #4b646f">Cancel</a>
                </div>
            </div>
        </form>

    </div>
@endsection


@section('script')
    <script>

            $('#bus').on('change',function(){
                var bus_id = jQuery(this).val();
                console.log(bus_id)
                $('#driver').empty();
                $.ajax({
                    url:"{{url('/')}}/admin/dropdownlist/getDriver/"+bus_id,
                    dataType:'json',
                    type:'get',
                    data:{bus_id:bus_id},
                    success:function (data) {
                        console.log(data)
                        $.each(data, function(index,user){
                            $('#driver').append('<option value="'+user.id+'">'+user.name+'</option>')
                        });
                    },
                    error:function()
                    {
                        // alert('try again');
                    }

                });
            });
    </script>
@endsection
