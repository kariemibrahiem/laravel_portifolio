@extends('layouts/contentNavbarLayout')

@section('title', trns('Create Admin'))

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="{{ route($route . '.index') }}">{{ trns('Users') }}</a> /
        </span> {{ trns('Create Admin') }}
    </h4>

    <div class="card">
        <div class="card-body">
            <form action="{{ route($route . '.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row m-3">

                    <div class="col-5">
                        <label class="form-label" for="name">{{ trns('name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                            required>
                    </div>

                    <div class="col-5">
                        <label class="form-label" for="link">{{ trns('link') }}</label>
                        <input type="text" class="form-control" id="link" name="link" value="{{ old('link') }}"
                            required>
                    </div>

                    <div class="col-5">
                        <label class="form-label" for="description">{{ trns('description') }}</label>
                        <textarea type="text" class="form-control" id="description" name="description" value="{{ old('description') }}"
                            required></textarea>
                    </div>

                    <div class="col-5">
                        <label class="form-label" for="status">{{ trns('status') }}</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>{{ trns('active') }}
                            </option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                {{ trns('inactive') }}</option>
                        </select>
                    </div>

                    <div class="col-5">
                        <label class="form-label" for="collaboration">{{ trns('collaboration') }}</label>
                        <select class="form-control" id="collaborator_ids" name="collaborator_ids[]" required multiple>
                            <option value="active" multiple>{{ trns('select_collaboration') }}</option>
                            @foreach ($collaborations as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('collaborator_ids') && in_array($item->id, old('collaborator_ids')) ? 'selected' : '' }}>
                                    {{ trns($item->name) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-5">
                        <label class="form-label" for="image">{{ trns('image') }}</label>
                        <input class="form-control" type="file" id="image" name="image">
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">{{ trns('create') }}</button>
                <a href="{{ route($route . '.index') }}" class="btn btn-secondary">{{ trns('cancel') }}</a>
            </form>
        </div>
    </div>
@endsection
