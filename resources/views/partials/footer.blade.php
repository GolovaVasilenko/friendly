<footer id="footer">
    <div class="system-container">
        <div class="footer-content">
            <div class="footer-items-root">
                <div class="footer-item">
                    <div class="header-box"><h3>{{ $footer_blocks[0]->title }}</h3></div>
                    <div class="site-description">
                        {!! $footer_blocks[0]->text !!}
                    </div>
                </div>
                <div class="footer-item">
                    <div class="header-box"><h3>{{ $footer_blocks[1]->title }}</h3></div>
                    <div class="footer-list">
                        {!! $footer_blocks[1]->text !!}
                        {!! $footer_blocks[2]->text !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-container">
        <div class="system-container">
            <div class="footer-info">
                <div class="copy-site">Copyright © 2020</div>
                <div class="info-builder-site">Designed, Coded & <a href="https://webix.solutions/" target="_blank">Developed by WEBiX</a> Solutions, 2020</div>
            </div>
        </div>
    </div>
</footer>
<div id="myOverlay" class="search-overlay">
    <span class="closebtn" onclick="closeSearch()" title="დახურვა">×</span>
    <div class="overlay-content">
        <form action="{{ route('search_query') }}" method="post">
            @csrf
            <input type="text" placeholder="საძიებო სტყვა + Enter ..." name="search">
        </form>
    </div>
</div>
