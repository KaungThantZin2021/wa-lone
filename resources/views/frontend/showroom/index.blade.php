@extends('frontend.layouts.app')
@section('title', 'My Showroom')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"
                        class="text-decoration-none">{{ config('app.name') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profile') }}"
                        class="text-decoration-none">@lang('lang.profile')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Showroom</li>
                </ol>
            </nav>
        </div>
        <div class="row mb-5 tw-flex tw-justify-center animate__animated animate__fadeInDown">
            <div class="col-md-6">
                <div class="card bg-transparent border-0 tw-drop-shadow-xl">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                <input type="date" class="form-control" placeholder="Date Time" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="input-group mb-3">
                                <span class="input-group-text tw-text-green-500" id="basic-addon1"><i class="fas fa-envelope-open"></i></span>
                                <input type="date" class="form-control" placeholder="Date Time" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="infinite-scroll">
                    @foreach ($my_showrooms as $my_showroom)
                    <a href="{{ route('showroom.show', $my_showroom->id) }}" class="text-decoration-none">
                        <div class="card tw-relative {{ is_null($my_showroom->created_at) ? 'border-primary border-opacity-50' : 'border-0' }} tw-transition tw-ease-in-out tw-drop-shadow-xl hover:tw-drop-shadow-sm hover:tw-scale-95 tw-duration-300 mb-3">
                            @if (is_null($my_showroom->created_at))
                            <span class="tw-absolute tw-inline-flex tw-rounded-full tw-h-3 tw-w-3 bg-primary tw--top-1 tw--right-1"></span>
                            <span class="tw-absolute tw-inline-flex tw-rounded-full tw-h-3 tw-w-3 bg-primary tw--top-1 tw--right-1 tw-animate-ping"></span>
                            <span class="tw-absolute tw-inline-flex tw-rounded-full tw-h-5 tw-w-5 bg-primary tw--top-2 tw--right-2 bg-opacity-50 tw-animate-ping"></span>
                            @endif
                            <div class="card-body py-2 tw-relative">
                                <p class="mb-1 tw-text-base xs:tw-text-sm">{{ \Str::limit($my_showroom->name, 30) }}</p>
                            </div>
                            <div class="card-footer bg-white mx-3 px-0">
                                <div class="tw-flex tw-justify-between">
                                    <div>
                                        <p class="text-muted tw-text-sm mb-0"><i class="far fa-envelope"></i> {{ $my_showroom->created_at }} ({{ $my_showroom->created_at->diffForHumans() }})</p>
                                    </div>
                                    @if (!is_null($my_showroom->created_at))
                                    <div>
                                        <p class="tw-text-green-500 tw-text-sm mb-0"><i class="far fa-envelope-open"></i> {{ $my_showroom->created_at }} ({{ $my_showroom->created_at->diffForHumans() }})</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    {{ $my_showrooms->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

<script>
    $('ul.pagination').hide();

    $(() => {
        let loader = "{{ asset('images/scroll_loader.gif') }}";
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: `
                <div class="text-center">
                    <img class="text-center" src="${loader}" width="30px" alt="Loading..." />
                </div>
            `,
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
</script>

@endsection
