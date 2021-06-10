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