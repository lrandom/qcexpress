@extends('layouts.admin')
@section('header',__('main.posts_categories'))
@section('small_header',__('main.add'))
@section('content')

@if(session('notify'))
  <div class="alert alert-success">
    {{session('notify')}}
  </div>
@endif

<div class="box box-primary">
        <!-- form start -->
        <form role="form" method="POST">
          @csrf
          <div class="box-body">
            <div class="form-group">
              <label>{{__('main.name')}}*</label>
              <input type="text" class="form-control" name="name" value="{{old('name')}}">
                @if ($errors->has('name'))
                    <div class="alert alert-danger">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{__('main.add')}}</button>
          </div>
        </form>
      </div>
@endsection