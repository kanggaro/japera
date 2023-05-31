<?php

$conn = mysqli_connect("localhost", "root", "", "japera");

// $id = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username' AND password = '$password'");

function query($query) {
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function registrasi($data){
    global $conn;

    $name = stripslashes($data['name']);
    $username = stripslashes($data['username']);
    $address = stripslashes($data['address']);
    $email = stripslashes($data['email']);
    $telepon = $data['telepon'];
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    //cek username
    $result = mysqli_query($conn, "SELECT username FROM pelanggan WHERE username = '$username'");

    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('Username sudah terdaftar');
                </script>";

        return false;
    }

    if($password !== $password2){
        echo "<script>
                alert('Konfirmasi password salah');
                </script>";
        
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //add new user to db
    mysqli_query($conn, "INSERT INTO pelanggan VALUES('', '$username', '$password', '$name', '$address', '$email','$telepon', 12121)");

    return mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;

    $id = $data["id"];
    $name = htmlspecialchars($data["name"]);
    $address = htmlspecialchars($data["address"]);
    $email = htmlspecialchars($data["email"]);
    $telepon = htmlspecialchars($data["telepon"]);

    $query = "UPDATE users SET
                name = '$name',
                address = '$address',
                email = '$email',
                telepon = '$telepon',
            WHERE id = '$id'";
            
    mysqli_query($conn, $query);

    return mysqli_query($conn, $query);    
}

?>