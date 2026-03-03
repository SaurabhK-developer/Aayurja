@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        Edit Tracking Code
    </div>
    <div class="card-body">
        <form action="{{ route('admin.tracking.update', $trackingCode->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                {!! Form::label('TrackingCode', 'Tracking Code (GA, GSC, Hotjar etc.)', ['class' => 'control-label']) !!}
                {!! Form::textarea('TrackingCode', $trackingCode->TrackingCode, ['class' => 'form-control', 'placeholder' => 'Enter your tracking code here...']) !!}
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
