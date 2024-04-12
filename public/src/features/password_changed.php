<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://unpkg.com/mvp.css"> 
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Password Changed Successfully</title>
</head>
<body>
<h2>Password Changed Successfully</h2>
<p>You have successfully changed your password. Redirecting to login page...</p>
<script>
// Redirect to login page after 3 seconds
setTimeout(function() {
    window.location.href = "../../form/login.php";
}, 3000); // 3 seconds
</script>
</body>
</html>
