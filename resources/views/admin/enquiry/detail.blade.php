<div class="align-center">
	<div class="row">
		<div class="col-md-2">
			<label>Enquiry#:</label>
			<p>{{$data->id}}</p>
		</div>
		<div class="col-md-4">
			<label>Name:</label>
			<p>{{$data->fullname}}</p>
		</div>
		<div class="col-md-4">
			<label>Email</label>
			<p>{{$data->email}}</p>
		</div>
		<div class="col-md-2">
			<label>Is User</label>
			<p>{{$data->is_user == '0' ? 'NO' : 'YES'}}</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<label>Category</label>
			<p>{{$data->category}}</p>
		</div>
		<div class="col-md-4">
			<label>Status</label>
			<p>
				@switch($data->status)
                    @case('1')
                            <label class="badge badge-primary">Pending</label>
                        @break

                    @case('2')
                            <label class="badge badge-success">Replied</label>
                        @break
                @endswitch
			</p>
		</div>
		<div class="col-md-4">
			<label>Created at</label>
			<p>{{date('d-M-Y | H:i A', strtotime($data->created_at))}}</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<label>Description</label>
			<p>{{$data->description}}</p>

			<hr>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<form method="post" action="{{URL::to('/admin/equiries/reply')}}">
				{{csrf_field()}}
				<input type="hidden" name="enq_id" value="{{base64_encode($data->id)}}">
				<textarea class="form-control" name="reply_text" rows="5" placeholder="Type your reply here.." required></textarea>
				<br>
				<button class="btn btn-success pull-right">&nbsp;&nbsp;&nbsp;Reply&nbsp;&nbsp;&nbsp;</button>
			</form>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<h6>Reply history:</h6>
		</div>
		@foreach($data->replys as $val)
			<div class="col-md-12 replyitem">
				<p>{{$val->reply_text}}</p>
				<label class="pull-right">{{date('d-M-Y | h:i a', strtotime($val->created_at))}}</label>
			</div>
		@endforeach
	</div>

</div>