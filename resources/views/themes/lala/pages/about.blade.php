@extends('themes.lala.layouts.app', [
    'title' => $page->seo_title ?? $page->title,
    'seoDescription' => $page->seo_description,
    'seoKeyWords' => $page->seo_text_keys,
    'sidebar' => false,
    ])

@section('content')

    <div class="card">
        <div class="card-body">
{{--            <h5 class="card-title text-center">{{$page->title}}</h5>--}}
            <p class="card-text">
                <img src="{{$page->thumb()}}" class="rounded-circle mx-auto d-block" alt="{{$page->title}}" width="300">
                {!! $page->content !!}
            </p>
        </div>
    </div>
    @if(!empty($page->custom_fields['education']))
        <h3 class="text-center my-3">Education</h3>

        <div class="card">
            <div class="card-body">
                {!! $page->custom_fields['education'] ?? ''!!}
            </div>
        </div>
    @endif


    @if(!empty($page->custom_fields['jobs']))

        <h3 class="text-center my-3">Jobs</h3>

        <div class="list-group my-3">
            @foreach($page->custom_fields['jobs'] as $job)

                <a href="#" class="list-group-item list-group-item-action p-lg-4">
                    <div class="d-lg-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{$job['company']}}</h5>
                        <small class="text-body-secondary">
                            {{$job['start_date']}} - {{$job['end_date'] ?? 'Now'}} ({{$job['period'] ?? ''}})
                        </small>
                    </div>
                    <p class="mb-1">{{$job['position']}}</p>
                    <small class="text-body-secondary">{!! $job['description'] !!}</small>

                    @foreach($job['technologies'] as $key => $tech)
                        <span class="badge bg-secondary">{{$tech}}</span>
                    @endforeach
                </a>
            @endforeach

        </div>
    @endif

@endsection
