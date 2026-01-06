<?php
require_once 'koneksi.php';

$data = json_decode(file_get_contents('php://input'));
try {

    if (
        !empty($data->email) && !empty($data->nama) && !empty($data->no_hp)
        && !empty($data->password) && !empty($data->alamat)
    ) {
        $query = "INSERT INTO tb_user (email, nama, no_hp, password, alamat)
             VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            $data->email,
            $data->nama,
            $data->no_hp,
            $data->password,
            $data->alamat
        ]);

        echo json_encode(
            [
                "success" => true,
                "message" => "Data Berhasil Disimpan",
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
