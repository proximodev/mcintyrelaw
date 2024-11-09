<section class="modal-default js-close-modal">
    <div class="modal-default__inner">
        <button class="modal-default__close js-close-modal" type="button"></button>
        <div class="modal-default__content">
            <div class="modal-default__video _yt">
                <div class="yt__player" id="player"></div>
            </div>
            <div class="modal-default__video _src" style="display:none;">
                <iframe width="100%" height="900" frameborder="0" webkitallowfullscreen="webkitallowfullscreen" mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen"></iframe>
            </div>
            <div class="modal-default__video _img" style="display:none;"><img src="src" alt="full image"/></div>
        </div>
    </div>
    <script>
        var tag = document.createElement('script');
        tag.src = 'https://www.youtube.com/iframe_api';
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        var player;
        var userId;
        function onYouTubeIframeAPIReady(videoId) {
            player = new YT.Player('player', {
                height: '900',
                width: '100%',
                videoId: videoId,
                playerVars: {
                    modestbranding: 1,
                    showinfo: 0,
                    fs: 0,
                },
                events: {
                    'onReady': onPlayerReady
                }
            });
        }
        function handler(videoId) {
            if (userId === videoId) {
                player.playVideo()
            } else {
                player.loadVideoById(videoId)
                userId = videoId
            }
        }
        function stopVideo() {
            player.pauseVideo()
        }
        function onPlayerReady(event) {
            event.target.playVideo()
        }
    </script>
</section>