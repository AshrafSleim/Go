@extends('admin.index')
@section('title', 'New Driver')
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
        <form action="{{route('adminAddDriverPost')}}"  method="post" class="mb-3 pb-2" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Driver Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
            </div>
            <div class="form-group">
                <label for="email">Driver email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}" required>
            </div>
            <div class="form-group">
                <label for="phone">Driver phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}" required>
            </div>
            <div class="form-group">
                <label for="password">Driver password</label>
                <input type="password" class="form-control" id="password" name="password"  required>
            </div>



            <br/>
            <div class="row ">
                <div class="form-group col-md-12 ">
                    <button type="submit" class="btn btn-primary" style="background-color: #26b1b0">Save</button >
                    <a href="{{route('adminUser.index')}}" class="btn btn-info" style="background-color: #4b646f">Cancel</a>
                </div>
            </div>
        </form>

    </div>
@endsection
