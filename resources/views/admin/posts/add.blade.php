@extends('layouts.admin')
@section('header',__('main.posts'))
@section('small_header',__('main.add'))
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
          <div class="box-body">

            <div class="form-group">
              <label>{{__('main.thumb')}}</label>
              <input type="file" name="thumb">
            </div>

            <br>

            <div class="form-group">
              <label>{{__('main.post_categories')}}*</label>
              <select class="form-control" name="id_categories">
                <option value="">Choose post categories</option>
                @foreach($post_categories as $p)
                  <option  @if( old('id_categories') == $p->id) selected="selected" @endif value="{{$p->id}}">{{$p->name}}</option>
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
                <input type="text" class="form-control" name="title" value="{{old('title')}}">
              @if ($errors->has('title'))
                <div class="alert alert-danger">
                  {{ $errors->first('title') }}
                </div>
              @endif
              </div>

              <div class="form-group">
                <label>{{__('main.contents')}}*</label>
                <textarea class="form-control tyni-edit" name="contents" >{{old('contents')}}</textarea>
                @if ($errors->has('contents'))
                  <div class="alert alert-danger">
                    {{ $errors->first('contents') }}
                  </div>
                @endif
              </div>

              <div class="form-group">
                <label>{{__('main.description')}}*</label>
                <input type="text" class="form-control" name="description" value="{{old('description')}}">
                @if ($errors->has('description'))
                  <div class="alert alert-danger">
                    {{ $errors->first('description') }}
                  </div>
                @endif
              </div>

              <div class="form-group">
                <label>{{__('main.keyword')}}*</label>
                <input type="text" class="form-control" name="keyword" value="{{old('keyword')}}">
                @if ($errors->has('keyword'))
                  <div class="alert alert-danger">
                    {{ $errors->first('keyword') }}
                  </div>
                @endif
              </div>

          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">{{__('main.add')}}</button>
          </div>
          </div>
        </form>
      </div>
@endsection