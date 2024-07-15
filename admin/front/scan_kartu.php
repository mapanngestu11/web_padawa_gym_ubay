<html>

<head>
    <title>Scan Kartu</title>
    <link rel="shortcut icon" href="assets/favicon1.ico">
    <link rel="stylesheet" href="css/style-login.css ">
</head>

<body style="font-family:tahoma; font-size:8pt;">
    <div>
        <center>
            <div style="padding-top: 50px;">
                <span style="font-size: 60px;"><b>PANDAWA GYM</b></span>
            </div>
            <div style="padding-top: 50px;">
                <h3 id="blink">Please Scan Tag to Display ID or User Data</h3>
            </div>
            <form action="detail_member.php" method="POST">
                <input type="text" name="id_kartu"><br></br>
                <!-- <input type="submit" class="button" value="Login"> -->
            </form>
    </div>
    </center>

    <script>
        var blink = document.getElementById('blink');
        setInterval(function() {
            blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
        }, 750);
    </script>

</body>

</html>