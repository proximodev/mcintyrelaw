<?php
/**
 * Get the best available YouTube thumbnail for a given video ID.
 *
 * This function checks for the highest quality thumbnail available,
 * starting from 'maxresdefault' and falling back to lower resolutions if needed.
 *
 * @param string $video_id The YouTube video ID (e.g., 'dQw4w9WgXcQ').
 * @return string|false The URL of the best available thumbnail, or false if none found.
 *
 * Usage:
 * $thumbnail_url = get_youtube_thumbnail($youtube_id);
 */

function get_youtube_thumbnail($video_id) {
    $qualities = ['maxresdefault', 'sddefault', 'hqdefault', 'mqdefault', 'default'];

    foreach ($qualities as $quality) {
        $thumbnail_url = "https://img.youtube.com/vi/{$video_id}/{$quality}.jpg";
        if (remote_file_exists($thumbnail_url)) {
            return $thumbnail_url;
        }
    }
    return false;
}

/**
 * Check if a remote file exists by sending a HEAD request.
 *
 * @param string $url The URL of the file to check.
 * @return bool True if the file exists (HTTP 200), false otherwise.
 */
function remote_file_exists($url) {
    $headers = @get_headers($url);
    return is_array($headers) && strpos($headers[0], '200') !== false;
}
