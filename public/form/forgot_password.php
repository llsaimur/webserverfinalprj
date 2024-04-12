<link rel="stylesheet" href="https://unpkg.com/mvp.css"> 
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap" rel="stylesheet"> 
<style>

        body {
        background-image: url('https://static.vecteezy.com/system/resources/previews/001/895/648/non_2x/question-mark-on-chalkboard-background-vector.jpg');
        background-repeat: repeat;
        background-attachment: fixed; 
        background-size: 100%;
        font-family: 'Caveat Brush',cursive;
        background-color:#c1b8b6;
        }

        div {
        background-color :#c1b8b6;
        }

        .caveat-brush-regular {
        font-family: "Caveat Brush", cursive;
        font-weight: 400;
        font-style: normal;
        }


        .center {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: auto;
        width: 35%;
        border: 3px solid #ffffff;
        padding: 10px;
        text-align: center;
        }

</style>
<div class="center">
<form id="passwordChangeForm" action="../src/features/change_password.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <!-- <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName" required><br><br>

    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName" required><br><br> -->

    <label for="newPassword">New Password:</label>
    <input type="password" id="newPassword" name="newPassword" ><br><br>

    <label for="confirmNewPassword">Confirm New Password:</label>
    <input type="password" id="confirmNewPassword" name="confirmNewPassword" ><br><br>

    <input type="submit" value="Edit" name="edit">
    <input type="submit" value="Cancel" name="cancel">
    
</form>
</div>
