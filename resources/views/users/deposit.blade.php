@extends('layouts.user')
@section('content')
@section('header',__('main.finance'))
@section('small_header',__('main.deposit'))
<script>
   $(document).ready(function () {
     $('select[name="transfer_method"]').on('change',function(){
       let val = $(this).val();
       console.log(val);
       if(val==2){
         $('.form-group-banks').removeClass('hide').addClass('show');
       }else{
        $('.form-group-banks').removeClass('show').addClass('hide');
       }
     })
     $.datetimepicker.setLocale('vi');
     $('input[name="transaction_time"]').datetimepicker({
       format:'d-m-Y H:i'
     });
   });
</script>

<style>
    .show{
      display: block;
    }

    .hide{
      display: none;
    }
</style>
<div class="row">
<div class="col-md-8 col-xs-12">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
        <!-- Horizontal Form -->
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Chuyển khoản</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" action="{{URL::to('users/finance/deposit')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-3 col-xs-12 control-label">{{__('main.picture')}}<span class="asterisk">*</span></label>
                <div class="col-sm-9 col-xs-12">
                  <input type="file" name="photo">

                  @error('photo')
                    <div class="error">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 col-xs-12 control-label">{{__('main.amount')}}<span class="asterisk">*</span></label>
                <div class="col-sm-9 col-xs-12">
                  <input type="number" name="amount" class="form-control" placeholder="{{__('main.amount')}}" value="{{ old('amount') }}">
               
                  @error('amount')
                    <div class="error">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-3 col-xs-12 control-label">{{__('main.method')}}<span class="asterisk">*</span></label>
                <div class="col-sm-9 col-xs-12">
                    <select class="form-control" name="transfer_method">
                        <option value="">{{__('main.method')}}</option>
                        <option value="1" <?php if(old('transfer_method')==1){echo 'selected';} ?>>{{__('main.cash')}}</option>
                        <option value="2" <?php if(old('transfer_method')==2){echo 'selected';} ?>>{{__('main.transfer_via_bank')}}</option>
                    </select>

                    @error('transfer_method')
                       <div class="error">{{ $message }}</div>
                    @enderror
                </div>
              </div>

              <div class="form-group form-group-banks <?php if(old('transfer_method')==1 || old('transfer_method')==null){echo 'hide';}else{ echo 'show';} ?>">
                    <label class="col-sm-3 col-xs-12 control-label">{{__('main.banks')}}<span class="asterisk">*</span></label>
                    <div class="col-sm-9 col-xs-12" >
                     <div style="display:flex;align-items:flex-start">
                        @foreach ($banks as $r)
                          <span style="margin-left:10px">
                            <img style="width:150px" src="{{asset($r->logo)}}"/>
                            <br>
                            <label style="margin-top:10px">{{$r->name}}</label>
                            <br>
                            <input type="radio" name="bank" value="{{$r->id}}" <?php if(old('bank')==$r->id){echo 'checked';} ?>/>
                          </span>
                        @endforeach
                     </div>
                      @error('bank')
                      <div class="error">{{ $message }}</div>
                      @enderror
                    </div>
              </div>
    
              <div class="form-group">
                <label class="col-sm-3 col-xs-12 control-label">{{__('main.entry')}}</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="text" name="entry" class="form-control" placeholder="{{__('main.entry')}}" value="{{old('entry')}}">
                </div>
              </div>

              <div class="form-group">
                    <label class="col-sm-3 col-xs-12 control-label">{{__('main.transaction_time')}}<span class="asterisk">*</span></label>
                    <div class="col-sm-9 col-xs-12">
                    <input type="text" name="transaction_time" class="form-control" placeholder="{{__('main.transaction_time')}}" value="{{ old('transaction_time') }}">
                    @error('transaction_time')
                      <div class="error">{{ $message }}</div>
                    @enderror
                    </div>
              </div>

              <div class="form-group">
                    <label class="col-sm-3 col-xs-12 control-label">{{__('main.content')}}<span class="asterisk">*</span></label>
                    <div class="col-sm-9 col-xs-12">
                        <textarea name="content" style="height:250px" class="form-control" placeholder="{{__('main.content')}}">{{old('content')}}</textarea>
                        @error('content')
                      <div class="error">{{ $message }}</div>
                    @enderror
                      </div>
              </div>

              <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-9 col-xs-12">
                      <button class="btn btn-primary">{{__('main.update')}}</button>
                      <button class="btn btn-default">{{__('main.reset')}}</button>
                  </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
</div>


<div class="col-md-4 col-xs-12">
    <div class="box box-danger col-md-6 col-xs-12">
      <div class="box-header with-border row">
        <h3 class="box-title">Thông tin ngân hàng</h3>
      </div>

        <div style="margin-top:10px">
              {{-- @foreach ($banks as $r)

                   <div> @php
                     echo htmlspecialchars_decode($r->detail);  @endphp
                    </div>
                    <hr>
               
              @endforeach
        --}}
        </div>
    </div>
  </div>
      </div>
@endsection