<footer>
    <div class=" footer-top">
        <div class="container" style="margin:auto;">

            <div style="background: #eee; margin-right:-1px;" class="hidden-sm hidden-md hidden-lg">
                <strong style="float: left; padding: 8px 15px 6px; color: #000; font-size: 26px; font-family: 'Conv_sacramento.regular';">Serious Datings</strong>
                <button type="button" class="navbar-toggle footer_btm" data-toggle="collapse" style="background: #000;">
                    <span class="icon-bar" style="background: #fff;"></span>
                    <span class="icon-bar" style="background: #fff;"></span>
                    <span class="icon-bar" style="background: #fff;"></span>
                </button>
            </div>
            <div class="footer-bottom footer_hid">
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul>
                                <li>
                                    <a href="{!! url() !!}">Home</a>
                                </li>
                                <li>
                                    <a href="{!! url() !!}/pages/about us">About</a>
                                </li>
                                <li>
                                    <a href="{!! url() !!}/pages/policy">Policy</a>
                                </li>

                                <li>
                                    <a href="{!! url() !!}/pages/Terms and condiitions">Terms and Conditions</a>
                                </li>
                                <li>
                                    <!-- <a href="#">Locations</a> -->
                                </li>
                                <li>
                                    <a href="{!! url() !!}/pages/news">News</a>
                                </li>
                                <li>
                                    <!-- <a href="#">Gallery </a> -->
                                </li>
                                <li>
                                    <a href="{!! url() !!}/blog">Blog </a>
                                </li>
                                <li>
                                    <a href="{!! url() !!}/contact">Contact Us</a>
                                </li>
                            </ul>
                            <div class="copyright">Copyright &copy; 2017, <a href="{{ url() }}">Serious Dating</a>. All Rights Reserved.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@if (Auth::check())
<nav class="container-fab"  style="display: none;"  onclick="register_popup('narayan-prusty', 'Narayan Prusty');"> 
    <span class="notify-badge" style="display: none;"></span>
    <a class="buttons-fab" tooltip="Messages" href="#" onclick="viewOrCreateChat('{{ Auth::user()->id }}')"></a>
</nav> 

<input type="hidden" id="myID" value="{{ Auth::user()->id }}">
<input type="hidden" id="myName" value="{{ Auth::user()->lastName}},{{ Auth::user()->firstName}}">
<input type="hidden" id="myPhoto" value="{{ Auth::user()->photo}}">
<input type="hidden" id="myIP" value="{{ Request::ip() }}">

@endif