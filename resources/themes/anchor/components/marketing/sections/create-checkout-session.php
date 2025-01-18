<?php
require 'vendor/autoload.php';

// Load environment variables if .env file exists
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

\Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

// Handling GET requests
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['billing'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing billing parameter']);
        exit;
    }

    $billing = $_GET['billing'];
    try {
        // Create a Checkout Session
        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price' => $price_id,
                    'quantity' => 1,
                ],
            ],
            'mode' => 'subscription',
            'success_url' => 'https://yourwebsite.com/success', // Replace with your success URL
            'cancel_url' => 'https://yourwebsite.com/cancel',   // Replace with your cancel URL
        ]);

        // Redirect user to Stripe's checkout page
        header('Location: ' . $checkout_session->url);
        exit;

        // Redirect the user to Stripe’s hosted checkout page
        header('Location: ' . $checkout_session->url);
    } catch (\Stripe\Exception\ApiErrorException $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
}
?>
