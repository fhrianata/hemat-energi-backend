<?php

require_once 'koneksi.php';

$data = json_decode(file_get_contents('php://input'));
try {
    if (!empty($data->id))
    {
        $query = "DELETE FROM tb_user WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$data->id]);
        echo json_encode(
            [
                "success" => true,
                "message" => "Data Berhasil Dihapus",
            ]
        );
    } else {
        echo json_encode(
            [
                "success" => false,
                "message" => "Data Kosong ID tidak boleh kosong",
            ]
        );
    }
} catch (PDOException $e) {
    echo json_encode(
        [
            "success" => false,
            "message" => "Error : " . $e->getMessage()
        ]
    );
}
