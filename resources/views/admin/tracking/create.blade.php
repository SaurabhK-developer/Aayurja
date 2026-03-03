@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        Add Tracking Code
    </div>
    <div class="card-body">
        <form action="{{ route('admin.tracking.store') }}" method="POST">
            @csrf
            <div class="form-group">
                {!! Form::label('TrackingCode', 'Tracking Code (GA, GSC, Hotjar etc.)'.'*', ['class' => 'control-label']) !!}
                {!! Form::textarea('TrackingCode', old('TrackingCode'), ['class' => 'form-control', 'placeholder' => 'Enter your tracking code here...', 'required' => 'required']) !!}
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
