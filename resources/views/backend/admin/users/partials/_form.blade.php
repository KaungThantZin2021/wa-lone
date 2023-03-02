
@include('backend.layouts.flash')
@if ($form_type != 'change-password')
<div class="form-group">
    {!! Form::label('name', 'Name <span class="text-danger">*</span>', [], false) !!}
    {!! Form::text('name', null, ['class' => 'form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500', 'placeholder' => 'name']) !!}
</div>
<div class="form-group">
    {!! Form::label('phone', 'Phone') !!}
    {!! Form::number('phone', null, ['class' => 'form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500', 'placeholder' => 'phone']) !!}
</div>
<div class="form-group">
    {!! Form::label('email', 'Email <span class="text-danger">*</span>', [], false) !!}
    {!! Form::email('email', null, ['class' => 'form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500', 'placeholder' => 'email']) !!}
</div>
@endif
@if ($form_type == 'create' || $form_type == 'change-password')
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('password', 'Password' . ($form_type == 'change-password' ? ' (New) ' : ' ') . '<span class="text-danger">*</span>', [], false) !!}
            {!! Form::password('password', ['class' => 'form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500', 'placeholder' => 'password']) !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {!! Form::label('confirm_password', 'Confirm Password' . ($form_type == 'change-password' ? ' (New) ' : ' ') . '<span class="text-danger">*</span>', [], false) !!}
            {!! Form::password('confirm_password', ['class' => 'form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500', 'placeholder' => 'confirm password']) !!}
        </div>
    </div>
</div>
@endif
@if ($form_type != 'change-password')
<div class="form-group">
    <label for="">Gender</label><br>
    <div class="form-check form-check-inline">
        <div class="custom-control custom-radio">
            {!! Form::radio('gender', 'male', true, ['class' => 'custom-control-input', 'id' => 'male']); !!}
            {!! Form::label('male', 'Male', ['class' => 'custom-control-label']) !!}
        </div>
    </div>
    <div class="form-check form-check-inline">
        <div class="custom-control custom-radio">
            {!! Form::radio('gender', 'female', false, ['class' => 'custom-control-input', 'id' => 'female']); !!}
            {!! Form::label('female', 'Female', ['class' => 'custom-control-label']) !!}
        </div>
    </div>
    <div class="form-check form-check-inline">
        <div class="custom-control custom-radio">
            {!! Form::radio('gender', 'other', false, ['class' => 'custom-control-input', 'id' => 'other']); !!}
            {!! Form::label('other', 'Other', ['class' => 'custom-control-label']) !!}
        </div>
    </div>
</div>
<div class="form-group">
    {!! Form::label('dob', 'Date of Birth') !!}
    {!! Form::text('dob', null, ['class' => 'form-control dark:tw-text-gray-300 dark:tw-placeholder-gray-500 dark:tw-bg-slate-700 dark:focus:tw-border-gray-500', 'placeholder' => 'YYYY-MM-DD']) !!}
</div>
@endif

@if ($form_type != 'change-password')
<div class="form-group">
    {!! Form::label('profile_photo', 'Profile Photo') !!}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Upload</span>
        </div>
        <div class="custom-file">
            <input type="file" name="profile_photo" class="custom-file-input" id="profilePhotoInput">
            <label class="custom-file-label tw-bg-slate-900" for="profilePhotoInput">Choose file</label>
        </div>
    </div>

    <img src="" id="profilePhoto" class="tw-w-24"/>
</div>

<div class="form-group">
    {!! Form::label('cover_photo', 'Cover Photo') !!}
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Upload</span>
        </div>
        <div class="custom-file">
            <input type="file" name="cover_photo" class="custom-file-input" id="coverPhotoInput">
            <label class="custom-file-label tw-bg-slate-900" for="coverPhotoInput">Choose file</label>
        </div>
    </div>

    <img src="" id="coverPhoto" class="tw-w-24"/>
</div>
@endif

<button class="btn btn-primary">Submit</button>
<a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Cancel</a>

{{-- @section('script')
<script>
    $(() => {
        $('input[name="dob"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            maxYear: parseInt(moment().format('YYYY'),10),
            locale: {
                format: 'YYYY-MM-DD'
            },
            drops: 'up'
        });
    });
</script>
@endsection --}}
