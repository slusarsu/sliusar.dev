@extends('template.layouts.app')

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{route('post-search')}}">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2" name="s" value="{{$phrase}}">
                    <button type="submit" class="btn btn-outline-secondary" id="button-addon2">Search</button>
                </div>
            </form>

        </div>
    </div>

    <x-posts :posts="$posts"/>

@endsection
