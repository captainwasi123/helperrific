<div class="join-pop-head">
    <h3> Premium Account </h3>
    <p style="padding: 0 11px;">
    	@if(Auth::user()->type == '1')
    		Free employer accounts are limited to 5 profile views a month. Get premium to view unlimited profiles.
    	@elseif(Auth::user()->type == '3')
    		With premium accounts, potential employers will be able to see the helpers affiliated with your agency. You will also be able to promote your best helpers and get the most views from potential employers.
    	@endif
    </p>
    <hr class="m-t-0 m-b-0">

 </div>
 <div id="premium_content">
    <form id="premium_formm" action="{{route('premium.subscribe')}}">
       @csrf
       <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
             @php $s=1; @endphp
             @foreach($data->detail as $val)
                <div class="col-md-12 ">
                   <input type="radio" name="account_type" value="{{$val->id}}" class="premium_radio" id="accout_type{{$s}}" {{$s==1 ? "checked" : ""}}>
                   <label for="accout_type{{$s}}" class="premium_label">
                      <span>{{$val->currency}} {{number_format($val->price, 2)}}</span>
                      @if($val->duration == '0')
                         <i>/ lifetime</i>
                      @else
                         <i>/ {{$val->duration}} &nbsp;{{$val->duration > 1 ? 'months' : 'month'}}</i>
                      @endif
                   </label>
                </div>
                @php $s++; @endphp
             @endforeach
          </div>
          <div class="col-md-2"></div>
       </div>
       <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
             <br>
             <button class="premium_btn">Unlock premium features</button>
          </div>
          <div class="col-md-2"></div>
       </div>
    </form>
 </div>
 <div>
    <a href="javascript:void(0)" class="skip_btn" data-dismiss="modal" aria-label="Close">Skip ></a>
 </div>