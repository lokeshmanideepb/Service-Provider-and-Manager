<?php include 'dbconn.php'; ?>
<?php
$errors = array();
// receive all input values from the form
$id = mysqli_real_escape_string($conn, $_POST['Id']);
$fname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lname = mysqli_real_escape_string($conn, $_POST['lastname']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$area = mysqli_real_escape_string($conn, $_POST['locality']);
$location = mysqli_real_escape_string($conn, $_POST['city']);
$request = mysqli_real_escape_string($conn, $_POST['selser']);
$dateofreq = mysqli_real_escape_string($conn, date("Y-m-d"));
$aflag = 0;
$transflag = 0;

// form validation: ensure that the form is correctly filled
if (empty($fname)) {
    array_push($errors, "Firstname is required");
}
if (empty($lname)) {
    array_push($errors, "Lastname is required");
}
if (empty($phone)) {
    array_push($errors, "Phone Number is required");
}
if (empty($request)) {
    array_push($errors, "Service is required");
}
if (empty($location)) {
    array_push($errors, "Location is required");
}
if (empty($email)) {
    array_push($errors, "Email is required");
}
if (empty($area)) {
    array_push($errors, "Locality/Area is required");
}


if (count($errors) == 0) {
    // $query = "SELECT * FROM authoriser where location='" . $location . "' and request='" . $request . "'";
    // $result = mysqli_query($conn, $query);
    // $numrows = mysqli_num_rows($result);
    // if ($numrows == 1) {
    //     $row = mysqli_fetch_array($result);
    //     $authid = $row[0];
    // }
    // $query = mysqli_prepare($conn, "INSERT INTO customer (id,firstname,lastname,phone,email,area,city) VALUES (?,?,?,?,?,?,?)");
    // mysqli_stmt_bind_param($query, 'sssssss', $id, $fname, $lname, $phone, $email, $area, $location);


    // $query1 = mysqli_prepare($conn, "INSERT INTO service (id,request,dateofreq,authid,aflag,transflag) VALUES (?,?,?,?,?,?)");
    // mysqli_stmt_bind_param($query1, 'sssssi', $id, $request, $dateofreq, $authid, $aflag, $transflag);

    // if (mysqli_stmt_execute($query) && mysqli_stmt_execute($query1)) {
    //     mysqli_stmt_close($query);
    //     mysqli_stmt_close($query1);

    //     $to = $email;
    //     $subject = "Service Booking";
    //     $txt = "Your booking is currently under process.You will receive an email with the details of worker once the worker is assigned.Kindly contact him for the further progress.Thank you for using our application";
    //     $headers = "From: lokeshmanideep14@gmail.com" . "\r\n";
    //     mail($to, $subject, $txt, $headers);

    //     echo "<script>alert('Booked successfully');
    //    window.location.href='index.php';</script>";

    // } else {
    //     echo "<script>alert('Booking Failed');
    //    window.location.href='customer.php';</script>";
    // }
    $url = 'http://localhost:5000/request';
    $data = [
        "id" => $id,
        "firstname" => $fname,
        "lastname" => $lname,
        "phone" => $phone,
        "email" => $email,
        "area" => $area,
        "city" => $location,
        "request" => $request,
        "dateofreq" => $dateofreq
    ];
    // use key 'http' even if you send the request to https://...
    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/json',
            'content' => json_encode($data),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === false) {

        echo "<script>alert('Booking Failed')";
        //   window.location.href='customer.php';</script>";
    } else {
        echo "<script>alert('Booked successfully');
       window.location.href='index.php';</script>";
    }

} else {
    echo "<script>alert('One or More Details are left empty');
       window.location.href='customer.php';</script>";
}
mysqli_close($conn);

?>