@extends('layouts.user')

@section('header',__('main.account'))
@section('small_header',__('main.update_account'))

@section('content')

<div class="row">
  <div class="col-md-12">
      @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
        <br/>
      @endif
      
    <div class="box box-info">

      <form role="form" method="POST" enctype="multipart/form-data" class="form-horizontal">
        @csrf

        <div class="box-body">

          <div class="form-group">
            <label for="fullname" class="col-sm-2 control-label"><label>{{__('main.avatar')}}</label></label>
            <div class="col-sm-10">
              <div>
                <img src="{{asset($obj->avatar)}}" style="width:120px;height:80px;"/>
              </div>
              <br>
              <input type="file" name="avatar">
            </div>
          </div>

          <br>

          <div class="form-group">
            <label for="fullname" class="col-sm-2 control-label">{{__('main.fullname')}}</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{$obj->fullname}}" name="fullname" id="fullname" 
              placeholder="{{__('main.fullname')}}">
              @error('fullname')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group">
            <label for="phone" class="col-sm-2 control-label">{{__('main.phone')}}</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" value="{{$obj->phone}}"
               name="phone" id="phone" placeholder="{{__('main.phone')}}">
              @error('phone')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group">
            <label for="address" class="col-sm-2 control-label">{{__('main.address')}}</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{$obj->address}}" name="address" id="address" 
              placeholder="{{__('main.address')}}">
              @error('address')
                <div class="error">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <br>

          <div class="form-group">
            <label class="col-sm-2"></label>
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">{{__('main.update')}}</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>



  {{-- <div class="col-md-12">
    <div class="box box-info col-sm-12">

      <div class="box-header with-border row">
        <h3 class="box-title">{{__('main.ship_address')}}</h3>
      </div>
      
      <br><br> --}}
{{-- 
      @if ($address != null)
        @foreach ($address as $item)
          <div class="row">
            <div class="col-sm-9">
              <p><b>Địa chỉ: {{$item->address}}</b></p>
              <p><b>Sđt: {{$item->phone}}</b></p>
              <p><i>{{$item->provinces_name}} - {{$item->cities_name}}</i></p>
            </div>
            <div class="col-sm-3 text-right">
              @if ($item->is_default == 1)
                <a class="btn btn-success btn-sm" href="{{asset('users/default_address/'.$item->id)}}">{{__('main.default')}}</a>
              @endif
              @if ($item->is_default == 0)
                <a class="btn btn-warning btn-sm" href="{{asset('users/default_address/'.$item->id)}}">{{__('main.set_default')}}</a>
              @endif
              <a class="btn btn-danger btn-sm" href="{{asset('users/delete_address/'.$item->id)}}"><i class="fa fa-trash"></i></a>
              <button class="btn btn-edit btn-primary btn-sm" data-toggle="modal" data-target="#editAddressModal" data-id="{{$item->id}}"><i class="fa fa-pencil"></i></button>
            </div>
          </div>
          <hr>
        @endforeach
      @endif --}}
          
      {{-- <div class="row form-add-address col-sm-12">
        <button class="btn btn-success btn-add-address" data-toggle="modal" data-target="#addAddressModal">{{__('main.add_ship_address')}}</button>
      </div>
      <br><br><br>
    </div>
  </div> --}}


  <div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        @if (count($address) >= 5)
          <div class="modal-body">
            <p>Chỉ tối đa được 5 địa chỉ nhận hàng, nếu nhiều hơn 5 địa chỉ nhận hàng vui lòng chỉ sửa hoặc xoá các địa chỉ trước.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        @endif
        @if (count($address) < 5)
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">{{__('main.add_ship_address')}}</h4>
          </div>
          <div class="modal-body">
            
              <form role="form" action="add_address" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="box-body">
                  <div class="form-group">
                    <label for="phone" class="col-sm-4 control-label">{{__('main.provinces')}}</label>
                    <div class="col-sm-8">
                      <select class="form-control provinces" name="province_id" id="province_id">
                        @foreach ($provinces as $item)
                          <option value="{{$item->matp}}">{{$item->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
  
                  <div class="form-group">
                    <label for="fullname" class="col-sm-4 control-label">{{__('main.cities')}}</label>
                    <div class="col-sm-8">
                      <select class="form-control cities" name="city_id" id="city_id">
                        @foreach ($cities as $item)
                          <option value="{{$item->maqh}}">{{$item->name}}</option>    
                        @endforeach
                      </select>
                    </div>
                  </div>
        
                  <div class="form-group">
                    <label for="address" class="col-sm-4 control-label">{{__('main.address_detail')}}</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" value="" name="address" id="address" required="" placeholder="{{__('main.address')}}">
                      @error('address_detail')
                        <div class="error">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
  
                  <div class="form-group">
                    <label for="address" class="col-sm-4 control-label">{{__('main.phone')}}</label>
                    <div class="col-sm-8">
                      <input type="tel" class="form-control" value="" name="phone" id="phone" required="" placeholder="{{__('main.phone')}}">
                      @error('phone')
                        <div class="error">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
        
                  <br>
        
                  <div class="form-group">
                    <label class="col-sm-4"></label>
                    <div class="col-sm-8">
                      <button type="button" class="btn btn-default" data-dismiss="modal">{{__('main.cancel')}}</button>
                      <button type="submit" class="btn btn-primary">{{__('main.add')}}</button>
                    </div>
                  </div>
                </div>
              </form>
  
          </div>
        @endif
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


  <div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">{{__('main.update_ship_address')}}</h4>
        </div>
        <div class="modal-body">
            <form role="form" action="edit_address" method="POST" enctype="multipart/form-data" class="form-horizontal">
              @csrf
              <input class="id-address" type="hidden" name="id_address" value="">
              <div class="box-body">
                <div class="form-group">
                  <label for="phone" class="col-sm-4 control-label">{{__('main.provinces')}}</label>
                  <div class="col-sm-8">
                    <select class="form-control provinces" name="province_id" id="province_id"></select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="fullname" class="col-sm-4 control-label">{{__('main.cities')}}</label>
                  <div class="col-sm-8">
                    <select class="form-control cities" name="city_id" id="city_id"></select>
                  </div>
                </div>
      
                <div class="form-group">
                  <label for="address" class="col-sm-4 control-label">{{__('main.address_detail')}}</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control address" value="" name="address" id="address" required="" placeholder="{{__('main.address')}}">
                    @error('address_detail')
                      <div class="error">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="form-group">
                  <label for="address" class="col-sm-4 control-label">{{__('main.phone')}}</label>
                  <div class="col-sm-8">
                    <input type="tel" class="form-control phone" value="" name="phone" id="phone" required placeholder="{{__('main.phone')}}">
                    @error('phone')
                      <div class="error">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <br>
      
                <div class="form-group">
                  <label class="col-sm-4"></label>
                  <div class="col-sm-8">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('main.cancel')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('main.save_change')}}</button>
                  </div>
                </div>
              </div>
            </form>

        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->



</div>

    <script type="text/javascript">

      var users_url = "{{URL::to('api/users/')}}";

      $('.provinces').change(function(){
        var id =  $(this).children("option:selected").val();
        $.ajax({
          url : users_url +'/get_cities/'+ id,
          type : "post",
          success : function (result){
            console.log(result);
            html_tmp = '';
            result.forEach(elm => {
              html_tmp += "<option value="+elm['maqh']+">"+elm['name']+"</option>"; 
            });
            $('.cities').html(html_tmp);
          }
        });
      });

      $('.btn-edit').click(function(){
        var id =  $(this).data("id");

        console.log('');
        $.ajax({
          url : users_url +'/get_address/'+ id,
          type : "post",
          success : function (result){
            console.log(result);

            html_provinces = '';
            result['obj_provinces'].forEach(elm => {
              var checked = null;
              if(elm['matp'] == result['obj_address']['province_id']){
                checked = 'selected';
              };
              html_provinces += "<option "+checked+" value="+elm['matp']+">"+elm['name']+"</option>"; 
            });
            $('.provinces').html(html_provinces);
            
            html_cities = '';
            result['obj_cities'].forEach(elm => {
              var checked = null;
              if(elm['maqh'] == result['obj_address']['city_id']){
                checked = 'selected';
              };
              html_cities += "<option " +checked+ " value="+elm['maqh']+">"+elm['name']+"</option>"; 
            });
            $('.cities').html(html_cities);

            $('.address').val(result['obj_address']['address']);

            $('.phone').val(result['obj_address']['phone']);

            $('.id-address').val(id);
          }
        });
      });

    </script>

@endsection
