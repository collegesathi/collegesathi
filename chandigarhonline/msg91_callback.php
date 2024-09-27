<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo __line__;
    // Get the mobile number from POST data
     echo $phoneNumber = '91'.$_POST['mobile'] ?? '9905898212';

    if (empty($phoneNumber)) {
        http_response_code(400);
        echo json_encode(['error' => 'Please enter a mobile number.']);
        exit;
    }

    // API URL and Key
    $apiUrl = 'https://control.msg91.com/api/v5/otp';
    $apiKey = '398466AqfN6xUoBa648c4dafP1'; // Replace with your actual API key
    $templateId = '648c4d76d6fc0563463856e5'; // Replace with your template ID

    // Prepare the payload
    $payload = [
        'mobile' => $phoneNumber,
        'template_id' => $templateId,
        'realTimeResponse' => 1
    ];

    // Initialize cURL
    $ch = curl_init($apiUrl . '?template_id=' . $templateId . '&authkey=' . $apiKey);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    // Execute cURL request
    $response = curl_exec($ch);
    print_r($response);
   echo  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Return response based on status code
    if ($httpCode >= 200 && $httpCode < 300) {
        echo json_encode(['message' => 'SMS sent successfully!']);
    } else {
        http_response_code($httpCode);
        echo json_encode(['error' => 'Failed to send SMS. Status: ' . $httpCode]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed.']);
}
?>
