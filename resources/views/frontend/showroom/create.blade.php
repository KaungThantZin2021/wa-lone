@extends('frontend.layouts.app')
@section('title', 'Create a Showroom')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"
                            class="text-decoration-none">{{ config('app.name') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profile') }}"
                        class="text-decoration-none">@lang('lang.profile')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('my-showroom') }}"
                            class="text-decoration-none">My Showroom</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create a Showroom</li>
                </ol>
            </nav>
        </div>
        <div class="row mb-5 tw-flex tw-justify-center animate__animated animate__fadeInDown">
            <div class="col-md-4 col-sm-12">
                <form method="post" action="{{ route('showroom.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card border border-0 tw-drop-shadow-xl mb-3">
                        <div class="card-header">
                            Create a showroom
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="name" id="" class="form-control" placeholder="showroom name" aria-describedby="helpId">
                            </div>
                            <div class="mb-3">
                                <label for="basic-url" class="form-label">Slug</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon3">https://walone.net/</span>
                                    <input type="text" name="slug" class="form-control" placeholder="your-showroom-name" id="basic-url" aria-describedby="basic-addon3">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Phone</label>
                                <input type="number" name="phone" id="" class="form-control" placeholder="showroom phone number" aria-describedby="helpId">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Email</label>
                                <input type="email" name="email" id="" class="form-control" placeholder="showroom email" aria-describedby="helpId">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Bio</label>
                                <textarea class="form-control" name="bio" placeholder="describe about your showroom" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Profile</label>
                                <input type="file" class="form-control" name="profile_photo" id="" placeholder="" aria-describedby="fileHelpId">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Cover</label>
                                <input type="file" class="form-control" name="cover_photo" id="" placeholder="" aria-describedby="fileHelpId">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Type</label>
                                <select class="form-select" name="type" id="">
                                    <option value="">Select one</option>
                                    <option value="">Bicycle</option>
                                    <option value="">Motor Cycle</option>
                                    <option value="">Car</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Address</label>
                                <textarea class="form-control" name="address" placeholder="your showroom address" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Township</label>
                                <select class="form-select" name="township" id="">
                                    <option value="">Select one</option>
                                    <option value="">New Delhi</option>
                                    <option value="">Istanbul</option>
                                    <option value="">Jakarta</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Region</label>
                                <select class="form-select" name="region" id="">
                                    <option value="">Select one</option>
                                    <option value="">New Delhi</option>
                                    <option value="">Istanbul</option>
                                    <option value="">Jakarta</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="tw-grid tw-grid-cols-2 tw-gap-2">
                                <a href="" class="btn btn-secondary"><i class="fas fa-times-circle"></i> Cancel</a>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> Confirm</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(() => {
        // var blogsArea = $('.blogs-area');
        // $.post('blog/see-more').done(function (res,dd) {
        //     if (res.result == 1) {

        //         console.log(res);

        //         var blogs = res.data.map(function (each) {
        //             return `<div class="col-md-4">
        //                         <a href="${each.detail_url}" class="text-decoration-none text-dark">
        //                             <div class="card border border-0 tw-transition tw-ease-in-out tw-drop-shadow-xl hover:tw-drop-shadow-sm hover:tw-scale-95 tw-duration-300 mb-3">
        //                                 <div class="tw-relative">
        //                                     <img src="${each.thumbnail_path}" class="card-img tw-h-64 xl:tw-h-44 lg:tw-h-44 md:tw-h-44 sm:tw-h-44 xs:tw-h-52 tw-object-cover" alt="...">
        //                                     <span class="tw-absolute tw-top-2 tw-right-2 text-light tw-text-sm bg-primary bg-opacity-50 tw-rounded px-1">${each.date}</span>
        //                                     <h5 class="card-title tw-absolute tw-bottom-0 tw-left-0 m-2 tw-break-all text-light bg-primary bg-opacity-50 tw-leading-normal tw-rounded p-2">${each.title}</h5>
        //                                 </div>
        //                             </div>
        //                         </a>
        //                     </div>`;
        //         });


        //         blogsArea.append(blogs);
        //     }
        // })
        // .fail(function (error) {
        //     console.log(error);
        // });

        // $('.township').select2({
        //     placeholder: '--- Choose Type ---',
        //     theme: 'bootstrap4',
        //     allowClear: true
        // });
    });
</script>
@endsection
