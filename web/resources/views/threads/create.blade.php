@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a New Thread</div>

                    <div class="card-body">
                        <form action="/threads" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="channel_id">Choose a Channel</label>
                                <select name="channel_id" id="channel_id" class="form-control">
                                    <option value="">Choose One...</option>
                                    @foreach ($channels as $channel)
                                        <option value="{{$channel->id}}" {{old('channel_id') == $channel->id ? 'selected' : ''}}>
                                            {{$channel->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title: </label>
                                <input type="text" name="title" id="title" placeholder="title" class="form-control" value="{{old('title')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="body">Body: </label>
                                    <editor name="body"></editor>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Publish</button>
                            </div>

                        </form>
                        @if (count($errors))
                            <ul class="alert alert-danger">
                               @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                               @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
