@extends('layouts.admin')

@section('content')
   
     <h3 class="page-title">Seo</h3>
    

    <div class="card">
    <div class="card-header">
     Seo
    </div>

    <div class="card-body">
        {!! Form::model($seo, ['method' => 'PUT', 'route' => ['admin.seos.update', $seo->id], 'enctype' => 'multipart/form-data']) !!}
        
        <div class="form-group">
                {!! Form::label('url', 'Url'.'*', ['class' => 'control-label']) !!}
                {!! Form::text('url', old('url', $seo->url), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta_title', 'Meta Title'.'*', ['class' => 'control-label']) !!}
                {!! Form::text('meta_title', old('meta_title', $seo->meta_title), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('keywords', 'Meta Keywords'.'*', ['class' => 'control-label']) !!}
                {!! Form::text('keywords', old('keywords', $seo->keywords), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('alt_tag', 'Alt Tag'.'*', ['class' => 'control-label']) !!}
                {!! Form::text('alt_tag', old('alt_tag', $seo->alt_tag), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Meta Description'.'*', ['class' => 'control-label']) !!}
                {!! Form::text('description', old('description', $seo->description), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('canonical_tag', 'Canonical Tag'.'*', ['class' => 'control-label']) !!}
                {!! Form::text('canonical_tag', old('canonical_tag', $seo->canonical_tag), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('robots_tag', 'Robots Tag', ['class' => 'control-label']) !!}
                {!! Form::text('robots_tag', old('robots_tag', $seo->robots_tag), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta_twitter', 'Meta Twitter', ['class' => 'control-label']) !!}
                {!! Form::text('meta_twitter', old('meta_twitter', $seo->meta_twitter), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta_twitter_card', 'Meta Twitter Card', ['class' => 'control-label']) !!}
                {!! Form::text('meta_twitter_card', old('meta_twitter_card', $seo->meta_twitter_card), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta_twitter_site', 'Meta Twitter Site', ['class' => 'control-label']) !!}
                {!! Form::text('meta_twitter_site', old('meta_twitter_site', $seo->meta_twitter_site), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta_twitter_title', 'Meta Twitter Title', ['class' => 'control-label']) !!}
                {!! Form::text('meta_twitter_title', old('meta_twitter_title', $seo->meta_twitter_title), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('meta_twitter_description', 'Meta Twitter Description', ['class' => 'control-label']) !!}
                {!! Form::text('meta_twitter_description', old('meta_twitter_description', $seo->meta_twitter_description), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('og_title', 'OG TITLE', ['class' => 'control-label']) !!}
                {!! Form::text('og_title', old('og_title', $seo->og_title), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('og_site_name', 'OG SITE NAME', ['class' => 'control-label']) !!}
                {!! Form::text('og_site_name', old('og_site_name', $seo->og_site_name), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('og_description', 'OG DESCRIPTION', ['class' => 'control-label']) !!}
                {!! Form::text('og_description', old('og_description', $seo->og_description), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('og_image_url', 'OG IMAGE URL', ['class' => 'control-label']) !!}
                {!! Form::text('og_image_url', old('og_image_url', $seo->og_image_url), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('og_url', 'OG URL', ['class' => 'control-label']) !!}
                {!! Form::text('og_url', old('og_url', $seo->og_url), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('og_type', 'OG TYPE', ['class' => 'control-label']) !!}
                {!! Form::text('og_type', old('og_type', $seo->og_type), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('og_tags', 'OG Tags', ['class' => 'control-label']) !!}
                {!! Form::text('og_tags', old('og_tags', $seo->og_tags), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('product_schema', 'Product schema', ['class' => 'control-label']) !!}
                {!! Form::textarea('product_schema', old('product_schema', $seo->product_schema), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('faq_schema', 'Faq schema', ['class' => 'control-label']) !!}
                {!! Form::textarea('faq_schema', old('faq_schema', $seo->faq_schema), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('review_schema', 'Review schema', ['class' => 'control-label']) !!}
                {!! Form::textarea('review_schema', old('review_schema', $seo->review_schema), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('article_schema', 'Article schema', ['class' => 'control-label']) !!}
                {!! Form::textarea('article_schema', old('article_schema', $seo->article_schema), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('local_schema', 'Local Schema', ['class' => 'control-label']) !!}
                {!! Form::textarea('local_schema', old('local_schema', $seo->local_schema), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('video_schema', 'Video Schema', ['class' => 'control-label']) !!}
                {!! Form::textarea('video_schema', old('video_schema', $seo->video_schema), ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>

           
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
            
         </form>


    </div>
</div>

@stop
