@if (count($list_ship_address)<=0)
<p>Bạn không có địa chỉ nào trong sổ địa chỉ, vui lòng thêm 
  <a href="{{url('users/account')}}" target="_blank" class="btn-close-add-modal">tại đây</a>
</p>  
<script>
  $('.btn-close-add-modal').click(function(){
    $('#addAddressModal').modal('hide');
  })
</script>  
@else
       
              @foreach ( $list_ship_address as $row )
              <div class="box box-primary box-ship-address box-ship-address-{{$row->id}}">
                  <div class="box-body" style="">
            
                      <p style="margin: 0" class="name name-view">{{Auth::user()->fullname}}</p>
                      <p style="margin: 0" class="address address-view">Địa chỉ: {{$row->address}}</p>
                      <p style="margin: 0" class="phone phone-view">Sđt: {{$row->phone}}</p>
                      <br>
                   
                      <button type="button" class="pull-left btn btn-primary btn-success btn-xs btn-choose-address btn-choose-address-{{$row->id}}" data-id="{{$row->id}}">Giao đến địa chỉ này</button>
                      @if ($row->is_default==1)
                      <span class="label label-primary pull-right">Mặc định</span>
                      @endif
                  </div>
              </div>
              @endforeach
              @endif