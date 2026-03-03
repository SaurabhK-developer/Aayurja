@extends('layouts.admin')

@section('content')
   
    
    

     <h3 class="page-title">Seo</h3>
    

    <div class="card">
    <div class="card-header">
     Seo
    </div>

    <div class="card-body">
        {!! Form::model($altimage, ['method' => 'PUT', 'route' => ['admin.altimage.update', $altimage->id]]) !!}
             <div class="form-group">
                    {!! Form::label('url', 'Url'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('url', old('url'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                   
              
            </div>
            
               
            
                <div class="form-group">
                    {!! Form::label('tagname', 'Alt Tag'.'*', ['class' => 'control-label']) !!}
                    {!! Form::text('tagname', old('tagname'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                   
                </div>
           
             

           
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
            
         </form>


    </div>
</div>
@stop
