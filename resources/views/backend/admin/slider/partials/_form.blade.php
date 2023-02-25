
@include('backend.layouts.flash')
<div class="form-group">
    {!! Form::label('title', 'Title', [], false) !!}
    {!! Form::text('title', null, ['class' => 'form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500', 'placeholder' => 'Title']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500', 'placeholder' => 'Description']) !!}
</div>

<div class="form-group">
    {!! Form::label('type', 'Type <span class="text-danger">*</span>', [], false) !!}
    {!! Form::select('type',
        [
            'bicycle' => 'Bicycle',
            'motor_cycle' => 'Motor Cycle',
            'car' => 'Car'
        ]
    , null, ['class' => 'form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500', 'placeholder' => 'Type']) !!}
</div>

<div class="form-group">
    {!! Form::label('slider_image', 'Slider Image <span class="text-danger">*</span>', [], false) !!}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Upload</span>
        </div>
        <div class="custom-file">
            <input type="file" name="slider_image" class="custom-file-input slider-image" id="sliderImageInput">
            <label class="custom-file-label tw-bg-slate-900" for="sliderImageInput">Choose file</label>
        </div>
    </div>

    <img src="" id="sliderImage" class="tw-w-24"/>
</div>

<button class="btn btn-primary">Submit</button>
<a href="{{ route('admin.slider.index') }}" class="btn btn-secondary">Cancel</a>

@section('script')
<script>
    $(() => {
        $('.slider-image').change(function (event) {
            $('#sliderImage').attr('src', URL.createObjectURL(event.target.files[0]))
        });
    });
</script>
@endsection
