@extends('layouts.master')

@section('css')
    <link href="{{ URL::asset('/assets/libs/admin-resources/admin-resources.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <style>
         .current {
            background: #f4f5f8 !important;
            border: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: transparent !important;
            color: #da5858 !important;
            border-color: transparent !important;
        }

        .dataTables_wrapper .dataTables_filter input:focus-visible {
            outline: none !important;
        }

        .dataTables_wrapper .dataTables_info {
            padding-top: 30px !important;
        }

        .dataTables_wrapper .dataTables_paginate {
            padding-top: 20px !important;
        }

        .dataTables_wrapper .dataTables_length {
            margin-bottom: 10px;
        }

        div.dataTables_wrapper div.dataTables_filter {
            margin-bottom: 12px;
        }
    </style>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Return Policy!
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Add Return Policy</h5>
                </div>
                <div class="card-body">
                    <form action="{{ isset($returnPolicy) ? route('admin.return-policy.update', $returnPolicy->id) : route('admin.return-policy.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(isset($returnPolicy))
                            @method('PUT')
                            <input type="hidden" name="return_policy_id" value="{{ $returnPolicy->id }}">
                        @endif
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($returnPolicy) ? $returnPolicy->name : old('name') }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea id="summernote" name="content" class="note-editable">{{ isset($returnPolicy) ? $returnPolicy->content : old('content') }}</textarea>
                            @error('content')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1" {{ isset($returnPolicy) && $returnPolicy->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ isset($returnPolicy) && $returnPolicy->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                            @if(isset($returnPolicy) && $returnPolicy->image)
                                <div>
                                    <img src="{{ asset('storage/' . $returnPolicy->image) }}" alt="Image" style="max-width: 100px; max-height: 100px;">
                                </div>
                            @endif
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div> --}}
                        <div class="mb-3">
                            <button class="btn btn-bg-color text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script>
        $(document).ready(function() {
            $('head').append(
                '<style>@import url("https://fonts.googleapis.com/css2?family=Figtree&display=swap");</style>');
            $('#summernote').summernote({
                placeholder: 'Enter your Return policy content here',
                tabsize: 2,
                height: 100,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript',
                        'subscript', 'clear'
                    ]],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']],
                ],
            });
            var targetColors = ['#00FF00', '#FFFF00'];
            var buttonsToChange = $('.note-color-btn').filter(function () {
                var currentColor = $(this).data('value');
                return targetColors.includes(currentColor);
            });

            var newColors = ['#fe8c3d', '#38b85e'];
            buttonsToChange.each(function (index) {
                var newColor = newColors[index];
                $(this).data('value', newColor);
                $(this).css('background-color', newColor);
                $(this).attr('title', newColor);
        });
         });
    </script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script src="{{ URL::asset('assets/js/pages/form-editor.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
