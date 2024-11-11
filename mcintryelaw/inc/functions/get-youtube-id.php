<?php
/**
* Description: Returns YouTube ID when passed a URL
*
* Example usage:
* $url = 'https://www.youtube.com/embed/dQw4w9WgXcQ';
* $youtube_id = get_youtube_id_from_url($url);
* echo 'YouTube ID: ' . $youtube_id;
*
*/

function get_youtube_id_from_url($url) {
    // Check if the URL has an embed code with the video ID
    if ($url) {
        // Extract the src attribute if it's an embed HTML
        preg_match('/src="(.+?)"/', $url, $matches_url);
        $src = isset($matches_url[1]) ? $matches_url[1] : $url; // Use original URL if no src found

        // Extract the YouTube ID from different URL formats
        if (preg_match('/embed\/([a-zA-Z0-9_-]+)/', $src, $matches_id)) {
            return $matches_id[1];
        } elseif (preg_match('/v=([a-zA-Z0-9_-]+)/', $src, $matches_id)) {
            return $matches_id[1];
        } elseif (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $src, $matches_id)) {
            return $matches_id[1];
        }
    }
    return ""; // Return empty string if no ID is found
}
?>