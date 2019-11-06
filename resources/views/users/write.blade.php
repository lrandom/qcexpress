@extends('layouts.app')

@section('article')
<div class="post-detail" style="margin-top: 150px;">
    <div class="container">
        {!! $content_write !!}
    </div>
</div>
@endsection