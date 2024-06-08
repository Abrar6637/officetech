@extends('layouts.master')
@section('title')
    @lang('Slider')
@endsection
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
            Slider !
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Slider</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('store.slider') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Slider Description</h4>
                            </div>
                            <div class="card-body">
                                <textarea id="summernote" name="description" class="note-editable">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="example-text-input" class="form-label">Product Sku</label>
                            <input class="form-control @error('product_sku') is-invalid @enderror" type="text"
                                value="{{ old('product_sku') }}" name="product_sku" id="example-text-input">
                        </div>
                        @if (session('error'))
                            <p class="text-danger">{{ session('error') }}</p>
                        @endif
                        @error('product_sku')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Product Image</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="formFile"
                                name="image">
                        </div>
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <div class="mb-3">
                            <label for="prints" class="form-label">Prints</label>
                            <input class="form-control @error('prints') is-invalid @enderror" type="number"
                                value="{{ old('prints') }}" name="prints" id="prints">
                            @error('prints')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="contract_years" class="form-label">How Many Contract Years</label>
                            <input class="form-control @error('contract_years') is-invalid @enderror" type="number"
                                value="{{ old('contract_years') }}" name="contract_years" id="contract_years">
                            @error('contract_years')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status Status</label>
                            <select class="form-select" name="status">
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
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
    <script>
        $(document).ready(function() {
            $('head').append(
                '<style>@import url("https://fonts.googleapis.com/css2?family=Figtree&display=swap");</style>');
            $('textarea#summernote').summernote({
                placeholder: 'Here To add slider details',
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

            // Log the changes
            console.log('Changed color of selected buttons to ' + newColors.join(', '));

        });
    </script>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script src="{{ URL::asset('assets/js/pages/form-editor.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
