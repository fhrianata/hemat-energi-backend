<?php

require_once 'koneksi.php';

$data = json_decode(file_get_contents('php://input'));
try {
    if (
        !empty($data->email) && !empty($data->nama) && !empty($data->no_hp)
        && !empty($data->password) && !empty($data->alamat) && !empty($data->id)
    ) {

        $query = "UPDATE tb_user SET email = ?, nama = ?, no_hp = ?, password = ?, alamat = ?
        WHERE id = ?";

        $stmt = $pdo->prepare($query);
        $stmt->execute([
            $data->email,
            $data->nama,
            $data->no_hp,
            $data->password,
            $data->alamat,
            $data->id
        ]);

        echo json_encode(
            [
                "success" => true,
                "message" => "Data Berhasil Diupdate",
                "data" => $data
            ]
        );
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
            "message" => "Error : " . $e->getMessage()
        ]
    );
}
