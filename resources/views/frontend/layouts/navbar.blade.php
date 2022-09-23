<div class="row border-bottom border-1 py-2 bg-light">
    <div class="col-md-4">
        <div class="m-0 p-2">
            <h3 class="text-primary text-center text-nowrap">
                <a href="" class="text-decoration-none">{{ config('app.name') }}</a>
            </h3>
        </div>
    </div>

    <div class="col-md-5">
        <div class="m-0 p-2">
            <div class="input-group">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">All Categoies</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item border border-top-0 border-bottom-0 border-end-0 border-3 border-primary bg-light" href="#"><i class="fas fa-bars"></i> All Categories</a></li>                       
                    <hr class="dropdown-divider">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-bicycle"></i> Bicycles</a></li>                       
                    <hr class="dropdown-divider">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-motorcycle"></i> Motor Bikes</a></li>                       
                    <hr class="dropdown-divider">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-car"></i> Cars</a></li>                       
                    <hr class="dropdown-divider">
                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
                <input type="text" class="form-control" placeholder="Search with filter"
                    aria-label="Text input with 2 dropdown buttons">
                <button class="btn btn-primary">
                    <i class="fas fa-search"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="m-0 p-2 text-center">
            <a href="" class="btn btn-sm btn-outline-primary align-middle rounded me-2"><i
                class="fas fa-bell"></i></a>
            <a href="" class="btn btn-sm btn-outline-primary align-middle rounded me-2"><i
                    class="fas fa-heart"></i></a>
            <a href="" class="btn btn-sm btn-outline-primary align-middle rounded me-2"><i
                    class="fas fa-shopping-cart"></i></a>
            <a href="" class="btn btn-sm btn-outline-primary align-middle rounded"><i
                class="fas fa-user"></i></a>
        </div>
    </div>
</div>

<div class="row border-bottom border-1 py-1 bg-light">
    <div class="col-md-2"></div>
    <div class="col-md-8 col-sm-12">
        <div class="m-0 p-2 d-flex justify-content-evenly">
            <a href="/" class="text-decoration-none {{ Request::is('/') ? 'text-primary' : 'text-dark' }}">@lang('lang.home')</a>
            <a href="" class="text-decoration-none text-dark">@lang('lang.products')</a>
            <a href="" class="text-decoration-none text-dark">@lang('lang.shops')</a>
            <a href="" class="text-decoration-none text-dark">@lang('lang.accessories')</a>
            <a href="" class="text-decoration-none text-dark">@lang('lang.blogs')</a>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>