<?php
/**
* Add after footer with include or with GP Elements
*/
?>
<div className="modal-default js-close-modal">
    <div className="modal-default__inner">
        <button className="modal-default__close js-close-modal" type="button"></button>
        <div className="modal-default__content">
            <div className="modal-default__video _yt">
                <div className="yt__player" id="player"></div>
            </div>
            <div className="modal-default__video _src" style="display:none;">
                <iframe width="100%" height="900" frameBorder="0" webkitallowfullscreen="webkitallowfullscreen"
                        mozallowfullscreen="mozallowfullscreen" allowFullScreen="allowfullscreen"></iframe>
            </div>
            <div className="modal-default__video _img" style="display:none;">
                <img src="<?= get_stylesheet_directory_uri() ?>//assets/images/placeholder-1080x720.png" alt="full image"/>
            </div>
        </div>
    </div>
</div>