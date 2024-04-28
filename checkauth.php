<?php
@ob_start();
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // $query = mysqli_prepare($conn, "SELECT * FROM authoriser WHERE username=?" . " AND password=?");
    // mysqli_stmt_bind_param($query, 'ss', $user, $pass);
    // mysqli_stmt_execute($query);
    // $result = mysqli_stmt_get_result($query);
    // $numrows = mysqli_num_rows($result);

    $url = "http://localhost:5000/authoriserById?username=" . $user;
    $response = file_get_contents($url);
    if ($response !== false) {
        $json = json_decode($response);
        $dbusername = $json->username;
        $dbpassword = $json->password;
        if ($user == $dbusername && $pass == $dbpassword) {
            session_start();
            $_SESSION['sess_user'] = $user;
            $_SESSION['authid'] = $authoriser;
            /* Redirect browser */
            header("Location: authcheck.php");
            exit;
        }
    } else {

        echo "<script>alert('Invalid Login Credentials');
       </script>";
        exit;
    }

} else {
    echo "<script>alert('All fields are required!');
       window.location.href='authorizer.php';</script>";
    exit;
}

ob_flush();