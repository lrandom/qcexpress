@extends('layouts.admin')
@section('header',__('main.posts_categories'))
@section('small_header',__('main.edit'))
@section('content')

@if(session('notify'))
  <div class="alert alert-success">
    {{session('notify')}}
  </div>
@endif

<div class="box box-primary">
        <!-- form start -->
        <form role="form" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" value="{{$obj->id}}">

          <div class="box-body">

            <div class="form-group">
              <label>{{__('main.picture')}}</label>
              <div>
                <img style="width: 120px; height: 80px;" src="{{asset($obj->thumb)}}" alt="">
              </div>
              <br>
              <input type="file" name="thumb">
            </div>
  
            <br>

            <div class="form-group">
              <label>{{__('main.post_categories')}}*</label>
              <select class="form-control" name="id_categories">
                @foreach($post_categories as $p)
                  <option
                    @if($obj->id_categories == $p->id)
                    {{'selected'}}
                    @elseif(old('id_categories') == $p->id)
                    selected="selected"
                    @endif
                    value="{{$p->id}}">{{$p->name}}
                  </option>
                @endforeach
              </select>
              @if ($errors->has('id_categories'))
                <div class="alert alert-danger">
                  {{ $errors->first('id_categories') }}
                </div>
              @endif
            </div>

            <div class="form-group">
              <label>{{__('main.title')}}*</label>
              <input type="text" class="form-control" name="title" value="{{$obj->title}}">
              @if ($errors->has('title'))
                <div class="alert alert-danger">
                  {{ $errors->first('title') }}
                </div>
              @endif
            </div>

            <div class="form-group">
              <label>{{__('main.contents')}}*</label>
              <textarea class="form-control" name="contents" >{{$obj->contents}}</textarea>
              @if ($errors->has('contents'))
                <div class="alert alert-danger">
                  {{ $errors->first('contents') }}
                </div>
              @endif
            </div>

            <div class="form-group">
              <label>{{__('main.description')}}*</label>
              <input type="text" class="form-control" name="description" value="{{$obj->description}}">
              @if ($errors->has('description'))
                <div class="alert alert-danger">
                  {{ $errors->first('description') }}
                </div>
              @endif
            </div>

            <div class="form-group">
              <label>{{__('main.keyword')}}*</label>
              <input type="text" class="form-control" name="keyword" value="{{$obj->keyword}}">
              @if ($errors->has('keyword'))
                <div class="alert alert-danger">
                  {{ $errors->first('keyword') }}
                </div>
              @endif
            </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{__('main.save_change')}}</button>
          </div>
          </div>
        </form>
      </div>
@endsection