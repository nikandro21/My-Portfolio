<?php
// Mengatur header untuk menerima JSON
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['name'], $data['email'], $data['message'])) {
    $name = htmlspecialchars($data['name']);
    $email = htmlspecialchars($data['email']);
    $message = htmlspecialchars($data['message']);

    $to = "nikky.alesandro@gmail.com"; // Ganti dengan email kamu
    $subject = "Pesan dari $name";
    $body = "Nama: $name\nEmail: $email\n\nPesan:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "Pesan berhasil dikirim!";
    } else {
        http_response_code(500);
        echo "Gagal mengirim pesan.";
    }
} else {
    http_response_code(400);
    echo "Data tidak lengkap.";
}
