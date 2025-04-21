<?php
header('Content-Type: application/json');
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entry_date = filter_input(INPUT_POST, 'entry_date', FILTER_SANITIZE_STRING);
    $entry_text = filter_input(INPUT_POST, 'entry_text', FILTER_SANITIZE_STRING);
    $mood = filter_input(INPUT_POST, 'mood', FILTER_VALIDATE_INT, [
        'options' => ['min_range' => 1, 'max_range' => 5]
    ]);

    if (!$entry_date || !$entry_text || !$mood) {
        echo json_encode([
            'success' => false,
            'message' => 'Please fill all fields correctly.'
        ]);
        exit;
    }

    $stmt = $conn->prepare("SELECT id FROM gratitude_entries WHERE entry_date = ?");
    $stmt->bind_param("s", $entry_date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'You already have an entry for this date.'
        ]);
        exit;
    }
    $stmt = $conn->prepare("INSERT INTO gratitude_entries (entry_date, entry_text, mood) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $entry_date, $entry_text, $mood);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Gratitude entry saved successfully!'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Failed to save entry. Please try again.'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
}
?>