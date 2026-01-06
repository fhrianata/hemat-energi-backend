<?php

require_once 'koneksi.php';

$data = json_decode(file_get_contents('php://input'));
try {
    if (!empty($data->email) && !empty($data->password)) {
        $query = "SELECT * FROM tb_user WHERE email = ? AND password = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$data->email, $data->password]);

        //Mengambil data ke table user
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo json_encode(
                [
                    "success" => true,
                    "message" => "Login Berhasil",
                    "data" => $user
                ]
            );
        }else{
            echo json_encode(
                [
                    "success" => false,
                    "message" => "Login Gagal"
                ]
                );
        }
    } else {
        echo json_encode(
            [
                "success" => false,
                "message" => "Data Tidak Lengkap"
            ]
        );
    }
} catch (PDOException $e) {
    echo json_encode(
        [
            "success" => false,
            "message" => "Error" . $e->getMessage()
        ]
    );
}
