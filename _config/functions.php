<?php
$conn = mysqli_connect("localhost", "root", "", "tokobuku");

if(mysqli_connect_error()) {
    echo "Gagal terkoneksi : " .mysqli_error();
}

//pengaturan base_url
function base_url($url = null) {
    $base_url = "http://localhost/tokoBuku";
    if($url != null) {
        return $base_url."/".$url; 
    } else {
        return $base_url;
    }
}

// pengaturan query 
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

// pengaturan registrasi
function registrasi($data) {
    global $conn;
    $username = strtolower(stripcslashes($data["username"]));
    $email = ($data["email"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if(mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert('The username has been registered');
            </script>";
        return false;
    }

    if($password !== $password2) {
        echo "<script>
                alert('Password confirmation does not match!');
            </script>";
        return false;
    } 
    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO users VALUES ('', '$username', '$email', '$password')");

    return mysqli_affected_rows($conn);
}


// pengaturan tambah data buku
function tambah($data) {
    global $conn;
    $nama_tipe = htmlspecialchars($data["nama_tipe"]);
    $nama_buku = htmlspecialchars($data["nama_buku"]);
    $genre = htmlspecialchars($data["genre"]);
    $nama_au = htmlspecialchars($data["nama_au"]);
    $nama_pener = htmlspecialchars($data["nama_pener"]);
    $harga = htmlspecialchars($data["harga"]);
    $query = "INSERT INTO buku (id_buku, nama_tipe, nama_buku, genre, id_au, id_pener, harga) VALUES ('', '$nama_tipe', '$nama_buku', '$genre', '$nama_au', '$nama_pener', '$harga')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// pengaturan change data buku
function change($data) {
    global $conn;
    $id_buku = $data["id_buku"];
    $nama_tipe = htmlspecialchars($data["nama_tipe"]);
    $nama_buku = htmlspecialchars($data["nama_buku"]);
    $genre = htmlspecialchars($data["genre"]);
    $nama_au = htmlspecialchars($data["nama_au"]);
    $nama_pener = htmlspecialchars($data["nama_pener"]);
    $harga = htmlspecialchars($data["harga"]);

    $query = "UPDATE buku SET 
                nama_tipe = '$nama_tipe',
                nama_buku = '$nama_buku',
                genre = '$genre',
                id_au = '$nama_au',
                id_pener = '$nama_pener',
                harga = '$harga'
                WHERE id_buku = $id_buku
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// pengaturan delete data buku
function delete($id_buku) {
    global $conn;
    mysqli_query($conn, "DELETE FROM buku WHERE id_buku = $id_buku");

    return mysqli_affected_rows($conn);
} 

/* pengaturan pencarian data buku (code ini gagal)
function search($keyword) {
    $query = "SELECT * FROM buku 
                WHERE
                nama_tipe LIKE '%$keyword%' OR 
                nama_buku LIKE '%$keyword%' OR 
                genre LIKE '%$keyword%' OR 
                nama_au LIKE '%$keyword%' OR 
                nama_pener LIKE '%$keyword%' OR 
                harga LIKE '%$keyword%'
            ";
    return query($query);
} */

// pengaturan tambah data penulis
function tambahPenulis($data) {
    global $conn;
    $nama_au = htmlspecialchars($data["nama_au"]);
    $au_email = htmlspecialchars($data["au_email"]);
    $au_call = htmlspecialchars($data["au_call"]);
    $au_address = htmlspecialchars($data["au_address"]);
    $query = "INSERT INTO penulis VALUES ('', '$nama_au', '$au_email', '$au_call', '$au_address')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// pengaturan change data penulis
function changePenulis($data) {
    global $conn;
    $id_au = $data["id_au"];
    $nama_au = htmlspecialchars($data["nama_au"]);
    $au_email = htmlspecialchars($data["au_email"]);
    $au_call = htmlspecialchars($data["au_call"]);
    $au_address = htmlspecialchars($data["au_address"]);

    $query = "UPDATE buku SET 
                nama_au = '$nama_au',
                au_email = '$au_email',
                au_call = '$au_call',
                au_address = '$au_address'
                WHERE id_au = $id_au
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// pengaturan delete data penulis
function deletePenulis($id_au) {
    global $conn;
    mysqli_query($conn, "DELETE FROM penulis WHERE id_au = $id_au");

    return mysqli_affected_rows($conn);
}

/* pengaturan pencarian data penulis (code ini gagal)
function search_au($keyword_au) {
    $query = "SELECT * FROM penulis 
                WHERE
                nama_au LIKE '%$keyword_au%' OR 
                au_email LIKE '%$keyword_au%' OR 
                au_call LIKE '%$keyword_au%' OR 
                au_address LIKE '%$keyword_au%'
            ";
    return query($query);
}*/

// pengaturan tambah data penerbit
function tambahPenerbit($data) {
    global $conn;
    $nama_pener = htmlspecialchars($data["nama_pener"]);
    $email_pener = htmlspecialchars($data["email_pener"]);
    $pener_call = htmlspecialchars($data["pener_call"]);
    $pener_address = htmlspecialchars($data["pener_address"]);
    $query = "INSERT INTO penerbit VALUES ('', '$nama_pener', '$email_pener', '$pener_call', '$pener_address')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// pengaturan change data penerbit
function changePenerbit($data) {
    global $conn;
    $id_pener = $data["id_pener"];
    $nama_pener = htmlspecialchars($data["nama_pener"]);
    $email_pener = htmlspecialchars($data["email_pener"]);
    $pener_call = htmlspecialchars($data["pener_call"]);
    $pener_address = htmlspecialchars($data["pener_address"]);

    $query = "UPDATE buku SET 
                nama_pener = '$nama_pener',
                email_pener = '$email_pener',
                pener_call = '$pener_call',
                pener_address = '$pener_address'
                WHERE id_pener = $id_pener
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// pengaturan delete data penerbit
function deletePenerbit($id_pener) {
    global $conn;
    mysqli_query($conn, "DELETE FROM penerbit WHERE id_pener = $id_pener");

    return mysqli_affected_rows($conn);
}

/* pengaturan pencarian data penerbit (code ini gagal)
function search_pub($keyword_pub) {
    $query = "SELECT * FROM buku 
                WHERE
                nama_pener LIKE '%$keyword_pub%' OR 
                email_pener LIKE '%$keyword_pub%' OR 
                pener_call LIKE '%$keyword_pub%' OR 
                pener_address LIKE '%$keyword_pub%'
            ";
    return query($query);
} */
?>