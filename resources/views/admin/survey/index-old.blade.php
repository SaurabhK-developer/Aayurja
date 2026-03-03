@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@section('content')


<div class="card" >
    <div class="card-header">
	Survey
    </div>

    <div class="card-body" style="overflow-x: scroll;">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('status') }}
        </div>
        @elseif(session('failed'))
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('failed') }}
        </div>
        @endif

        <table class="table">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Name</th>
		      <th scope="col">Email</th>
		      <th scope="col">Mobile</th>
		      <th scope="col">Age</th>
		      <th scope="col">Gender</th>
		      <th scope="col">Address</th>
		      <th scope="col">Profession</th>
		      <th scope="col">Family Members</th>
		      <th scope="col">Routine</th>
		      <th scope="col">Consume Source</th>
		      <th scope="col">Reason</th>
		      <th scope="col">Lifestyle</th>
		      <th scope="col">Activity</th>
		      <th scope="col">Exotic Food</th>
		      <th scope="col">Interested In Purchase</th>
		      <th scope="col">Expenditure</th>
		      <th scope="col">Reference</th>
			  <th>Date</th>
		      <!-- <th scope="col">Action</th> -->
		    </tr>
		  </thead>
		  <tbody>
			@if(count($surveys) > 0)
				@foreach($surveys as $key => $survey)
				<tr>
					<td>{{$key+1}}</td>
					<td>{{$survey->user_name}}</td>
					<td>{{$survey->user_email}}</td>
					<td>{{$survey->user_mobile}}</td>
					<td>{{$survey->user_age}}</td>
					<td>{{$survey->user_gender}}</td>
					<td>{{$survey->user_address}}</td>
					<td>{{$survey->user_profession}}</td>
					<td>{{$survey->family_members}}</td>
					<td>{{$survey->routine}}</td>
					<td>{{$survey->consume_source}}</td>
					<td>{{$survey->reason}}</td>
					<td>{{$survey->lifestyle}}</td>
					<td>{{$survey->activity}}</td>
					<td>{{$survey->exotic_food}}</td>
					<td>
						<?php
							$dataString = $survey->interested_in_purchase;
							// Decode the JSON string into a PHP array
							$dataArray = json_decode($dataString, true);
						?>
						@if(count($dataArray) > 0)
							@foreach($dataArray as $singleElement)
								<span class="badge badge-primary">{{$singleElement}}</span><br>
							@endforeach
						@endif
					</td>
					<td>{{$survey->expenditure}}</td>
					<td>{{$survey->reference}}</td>
					<?php
						$date = $survey->created_at->format('y-m-d');
						$dates= date('d F, Y', strtotime($date)); 
					?>
					<td>{{$dates}}</td>
					
					<!-- <td>
						<a class="btn btn-xs btn-info" href="{{ route('admin.survey.edit', $survey->id) }}">
										{{ trans('global.edit') }}
						</a>
					</td> -->
				</tr>
				@endforeach
			@endif
		    
		  </tbody>
		</table>
        {!! $surveys->links() !!}
    </div>
</div>

 
@endsection
