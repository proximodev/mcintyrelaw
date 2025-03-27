<?php
/**
 * Display a featured video using an embed from CBS Sports.
 *
 * This function generates an iframe to embed a video from CBS Sports 
 * using the provided video ID.
 *
 * Usage:
 * echo get_make_your_case_video_embed('123456789');
 *
 * @param string|null $videoID The unique video ID for embedding.
 * @return string The HTML output containing the embedded video.
 */
function get_make_your_case_video_embed( $videoID = null ) {
    // Ensure the video ID is sanitized
    $videoID = esc_attr( $videoID );

    // Initialize the HTML output
    $html = '';

    // Only generate the embed if a valid video ID is provided
    if ( $videoID !== null ) {
        $html .= '<iframe src="https://embed.cbssports.com/player/embed?args=player_id%3Dplayer1716406660490014609789013%26resizable%3Dtrue%26autoplay%3Dfalse%26silent%3Dfalse%26log_window%3Dtrue%26env%3Dprod%26js%3Djs%252Fmedia%252Fvideo%252Fplayer%252Fembed%252Fsidearm.js%26css%3Dcss%252Fmedia%252Fvideo%252Fplayer%252Fembed%252Fsidearm.css%26source%3Dsidearm%26partner%3Dsidearm%26partner_m%3Dsidearm_m%26uvpc%3Dhttps%253A%252F%252Fwww.cbssports.com%252Fdata%252Fvideo%252Fplayer%252FgetConfig%253Fcfg%253Duvp_sa%2526ver%253Dprod%26uvpc_m%3Dhttps%253A%252F%252Fwww.cbssports.com%252Fdata%252Fvideo%252Fplayer%252FgetConfig%253Fcfg%253Duvp_sa_m%2526ver%253Dprod%26utag%3Dsidearm%26scode%3Dokla%26ids%3D';
        $html .= $videoID;
        $html .= '" name="player1716406660490014609789013" frameborder="no" allowfullscreen="yes" marginheight="0" marginwidth="0" style="width: 100%; height: 100%;" data-gtm-yt-inspected-12="true"></iframe>';
    }

    return $html;
}
?>