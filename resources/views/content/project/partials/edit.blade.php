@extends('layouts/contentNavbarLayout')

@section('title', trns('Edit Project'))

@section('content')
    <style>
        .project-form-card {
            background: linear-gradient(180deg, rgba(14, 22, 40, 0.96), rgba(9, 15, 28, 0.98));
            border: 1px solid rgba(84, 166, 255, 0.18);
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.32);
        }

        .project-form-card .form-label {
            color: #c9dcff;
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .project-form-card .form-control,
        .project-form-card .form-select {
            background: rgba(10, 18, 32, 0.92);
            border: 1px solid rgba(111, 166, 255, 0.2);
            border-radius: 12px;
            color: #f4f8ff;
            min-height: 48px;
        }

        .project-form-card textarea.form-control {
            min-height: 132px;
        }

        .project-form-card .form-control:focus,
        .project-form-card .form-select:focus {
            background: rgba(12, 22, 40, 0.98);
            border-color: #59b2ff;
            box-shadow: 0 0 0 0.24rem rgba(63, 159, 255, 0.18);
            color: #fff;
        }

        .project-form-card .form-control::placeholder {
            color: #7f94b8;
        }

        .project-form-card .form-control[type="file"] {
            padding-top: 0.7rem;
        }

        .project-form-card .text-muted-soft {
            color: #91a6c8;
        }

        .project-form-card .link-group {
            padding: 1rem;
            border: 1px solid rgba(111, 166, 255, 0.14);
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.02);
        }
    </style>

    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="{{ route($route . '.index') }}">{{ trns('Projects') }}</a> /
        </span> {{ trns('Edit Project') }}
    </h4>

    <div class="card project-form-card">
        <div class="card-body p-4 p-lg-5">
            <form action="{{ route($route . '.update', $obj->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @php
                    $selectedType = old('project_type', $obj->project_type ?? 'website');
                    $websiteUrl = old('website_url', $obj->website_url ?? $obj->url);
                @endphp

                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label" for="title">{{ trns('title') }}</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $obj->title) }}" placeholder="Project name" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="project_type">Project Type</label>
                        <select class="form-select" id="project_type" name="project_type">
                            <option value="website" {{ $selectedType === 'website' ? 'selected' : '' }}>Website</option>
                            <option value="mobile_app" {{ $selectedType === 'mobile_app' ? 'selected' : '' }}>Mobile App</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="category">{{ trns('category') }}</label>
                        <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $obj->category) }}" placeholder="marketing, saas, ecommerce..." required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="sort_order">{{ trns('sort_order') }}</label>
                        <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $obj->sort_order) }}" placeholder="0">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="partner_id">{{ trns('partner') }}</label>
                        <select class="form-select" id="partner_id" name="partner_id">
                            <option value="">{{ trns('select_partner') }}</option>
                            @foreach ($partners as $partner)
                                <option value="{{ $partner->id }}" {{ (old('partner_id') ?? $obj->partner_id) == $partner->id ? 'selected' : '' }}>
                                    {{ $partner->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="image">{{ trns('image') }}</label>
                        <input class="form-control" type="file" id="image" name="image">
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="description">{{ trns('description') }}</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Short project summary" required>{{ old('description', $obj->description) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="collaborator_ids">{{ trns('collaboration') }}</label>
                        <select class="form-select" id="collaborator_ids" name="collaborator_ids[]" multiple>
                            @foreach ($collaborations as $item)
                                <option value="{{ $item->id }}" {{ (collect(old('collaborator_ids'))->contains($item->id)) || $obj->collaborators->contains($item->id) ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted-soft d-block mt-2">For mobile apps, you can add both Google Play and App Store links.</small>
                    </div>

                    <div class="col-12">
                        <div class="link-group">
                            <div class="row g-4">
                                <div class="col-12 col-lg-4" id="website-link-wrapper">
                                    <label class="form-label" for="website_url">Website URL</label>
                                    <input type="url" class="form-control" id="website_url" name="website_url" value="{{ $websiteUrl }}" placeholder="https://example.com">
                                </div>

                                <div class="col-12 col-lg-4 mobile-link-field" id="google-play-wrapper">
                                    <label class="form-label" for="google_play_url">Google Play URL</label>
                                    <input type="url" class="form-control" id="google_play_url" name="google_play_url" value="{{ old('google_play_url', $obj->google_play_url) }}" placeholder="https://play.google.com/store/apps/details?id=...">
                                </div>

                                <div class="col-12 col-lg-4 mobile-link-field" id="app-store-wrapper">
                                    <label class="form-label" for="app_store_url">App Store URL</label>
                                    <input type="url" class="form-control" id="app_store_url" name="app_store_url" value="{{ old('app_store_url', $obj->app_store_url) }}" placeholder="https://apps.apple.com/...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2 mt-4">
                    <button type="submit" class="btn btn-primary px-4">{{ trns('update') }}</button>
                    <a href="{{ route($route . '.index') }}" class="btn btn-secondary">{{ trns('cancel') }}</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const typeSelect = document.getElementById('project_type');
            const mobileFields = document.querySelectorAll('.mobile-link-field');

            const toggleProjectLinks = () => {
                const isMobile = typeSelect.value === 'mobile_app';

                mobileFields.forEach((field) => {
                    field.style.display = isMobile ? '' : 'none';
                });
            };

            toggleProjectLinks();
            typeSelect.addEventListener('change', toggleProjectLinks);
        });
    </script>
@endsection
