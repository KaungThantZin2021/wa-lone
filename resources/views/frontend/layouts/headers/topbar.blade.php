<div class="topbar">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-4 col-12">
                <div class="top-left">
                    <ul class="menu-top-link">
                        {{-- <li>
                            <div class="select-position">
                                <select id="select4">
                                    <option value="0" selected>$ USD</option>
                                    <option value="1">€ EURO</option>
                                    <option value="2">$ CAD</option>
                                    <option value="3">₹ INR</option>
                                    <option value="4">¥ CNY</option>
                                    <option value="5">৳ BDT</option>
                                </select>
                            </div>
                        </li> --}}
                        <li>
                            <div class="select-position">
                                <select id="select5">
                                    <option value="0" selected>English</option>
                                    <option value="1">မြန်မာ</option>
                                </select>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="top-middle">
                    <ul class="useful-links">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about-us.html">About Us</a></li>
                        <li><a href="contact.html">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="top-end">
                    @if (auth()->check())
                    <div class="user">
                        <i class="lni lni-user"></i>
                        {{ auth()->user()->name }}


                    </div>
                    @else
                    <ul class="user-login">
                        <li>
                            <a class="btn btn-sm btn-outline-light py-1" href="{{ route('login') }}">Sign In</a>
                        </li>
                        <li>
                            @if (Route::has('register'))
                            <a class="btn btn-sm btn-outline-light py-1" href="{{ route('register') }}">Register</a>
                            @endif
                        </li>
                    </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>