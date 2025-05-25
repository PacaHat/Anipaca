<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/_config.php');

session_start();

//error_reporting(E_ALL);
//ini_set('display_errors', 0);

header('Content-Type: application/json');

// Get anime ID from query parameter

$animeId = $_GET['animeId'] ?? null;


if (!$animeId) {
    echo json_encode([
        'success' => false,
        'error' => 'Anime ID is required'
    ]);
    exit;
}

// Get user ID from cookie
$userId = $_COOKIE['userID'] ?? null;

if (!$userId) {
    echo json_encode([
        'success' => false,
        'error' => 'User ID is required'
    ]);
    exit;
}

// Check database connection
if (!$conn || $conn->connect_error) {
    error_log("Database connection failed: " . ($conn ? $conn->connect_error : 'Connection object is null'));
    echo json_encode([
        'success' => false,
        'error' => 'Database connection failed'
    ]);
    exit;
}

try {
    // Query database to get watched episodes for this anime and user
    $sql = "SELECT episodes_watched FROM watched_episode WHERE anime_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode([
            'success' => false,
            'error' => 'Failed to prepare the SQL query'
        ]);
        exit;
    }

    $stmt->bind_param('si', $animeId, $userId);

    if (!$stmt->execute()) {
        echo json_encode([
            'success' => false,
            'error' => 'Failed to execute query: ' . $stmt->error
        ]);
        exit;
    }

    $result = $stmt->get_result();
    $watchedEpisodes = [];
    while ($row = $result->fetch_assoc()) {
        // Assuming episodes_watched is stored as a comma-separated list
        $episodes = explode(',', $row['episodes_watched']);
        foreach ($episodes as $episode) {
            // Add episode to the watched list
            $watchedEpisodes[] = (int)$episode;
        }
    }

    echo json_encode([
        'success' => true,
        'watchedEpisodes' => $watchedEpisodes
    ]);

} catch (Exception $e) {
    error_log("Watch history error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'error' => 'Error retrieving watch history: ' . $e->getMessage()
    ]);
}