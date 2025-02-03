<?php
/**
* Description: Gets the video title from YouTube video
*
* Example usage:
* $videoId = "dQw4w9WgXcQ"; // Example YouTube video ID
* echo getYoutubeVideoTitle(youTubeID);
*
*/

function getYoutubeVideoTitle($videoId) {
    // Validate the video ID (should be 11 characters)
    if (!preg_match('/^[a-zA-Z0-9_-]{11}$/', $videoId)) {
        return "Invalid YouTube Video ID";
    }

    // YouTube oEmbed API URL
    $apiUrl = "https://www.youtube.com/oembed?url=https://www.youtube.com/watch?v={$videoId}&format=json";
    $response = @file_get_contents($apiUrl);

    // Check if response is valid
    if ($response === false) {
        return "Failed to fetch video details";
    }

    // Decode JSON response
    $data = json_decode($response, true);

    // Check if title exists
    return isset($data['title']) ? $data['title'] : "Title not found";
}
