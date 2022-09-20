<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome email</title>
    <!-- <link href="/css/hct.css" rel="stylesheet" /> -->
    <style>
        * {
            padding: 0;
            margin: 0;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            min-height: 90vh;
            position: relative;
            padding: 3em 0;
        }

        main {
            padding: 3rem 1rem;
        }

        .greeting {
            font-size: 1.4rem;
            line-height: 2;
            display: block;
            color: #333333;
        }

        .main-content p {
            color: #333333;
            line-height: 1.5;
            font-size: 10pt;
            margin-bottom: .5rem;
        }

        .main-content a {
            font-size: 10pt;
        }

        .footer-icons {
            margin: 1rem 0;
        }

        .footer-icons i {
            color: #4f0466;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border: 0.5px solid #4f0466;
        }

        .footer-icons img {
            width: 20px;
            height: 20px;
        }

        .call-to-action {
            display: block;
            padding: 1rem 2rem;
            margin: 1rem auto;
            width: 100%;
            max-width: 200px;
            background-color: #4f0466;
            border: 0;
            color: #fff;
            -webkit-transition: all 200ms linear;
            transition: all 200ms linear;
            cursor: pointer;
            text-align: center;
            text-decoration: none;

        }

        .call-to-action:hover {
            background: #290235;
        }

        footer {
            width: 100%;
            background-color: #f2f2f2;
            min-height: 50px;
            padding: 1rem;
            text-align: center;
        }

        footer .company {
            text-align: center;
        }

        footer .address {
            text-align: center;
        }

        footer .address p {
            font-size: 8pt;
            color: #333333;
            line-height: 1.5;
            text-align: center;
        }

        footer .address img {
            width: 10px;
            height: 10px;
        }

        footer h1 {
            color: #4f0466;
            font-size: 1.2rem;
            line-height: 2;
            text-align: center;
        }

        footer .copyright {
            text-align: center;
            font-size: 8pt;
            line-height: 2;
            color: #4f0466;
            display: block;
        }

        .header {
            background-color: #f2f2f2;
            border-bottom: 1px solid #4f0466;
        }

        .header img {
            max-width: 100px;
            display: block;
            margin: 0 auto;
        }

        /*# sourceMappingURL=hct.css.map */
    </style>
    <script src="https://kit.fontawesome.com/a6ac580632.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <header class="header">
            <div class="header-img-container">
                <img class="header-img" src="https://i.ibb.co/S7KFFjg/farmtrust-logo.png" alt="Farmer's Trust Logo">
            </div>
        </header>
        <main>
            <h2 class="greeting">Dear User,</h2>
            <div class="main-content">
                <p>We are please to inform you that your registration to Farmer's trust was successful</p>
                <p>Please click on the button below to verify your email</p>
                <a href="https://farmertrust.org" class="call-to-action">Verify</a>
                <p>
                    If you cannot click on the button above, please click the link below or copy to your browser's URL bar.
                </p>
                <a href="https://farmertrust.org">https://farmertrust.org</a>
            </div>
        </main>
        <footer>
            <h1 class="company">Farmer's trust</h1>
            <div class="address">
                <p><img src="https://i.ibb.co/vzzqwFc/maps-and-flags.png" /> 22 Ilorin Avenue, Central Business District, FCT, Nigeria</p>
                <p><img src="https://i.ibb.co/yB7xgV0/envelope-1.png" alt="" /> info@farmerstrust.org</p>
                <p><img src="https://i.ibb.co/JmLzz5f/phone-call-1.png" /> +234(0)80312345890</p>
            </div>
            <div class="footer-icons">
                <a href="#"><img src="https://i.ibb.co/qkn0FQn/facebook-1.png" alt="Facebook Icon" /></a>
                <a href="#"><img src="https://i.ibb.co/mzV17tz/twitter-1.png" alt="Twitter Icon" /></a>
                <a href="#"><img src="https://i.ibb.co/5kPGD6M/instagram-2.png" alt="instagram Icon" /></a>

            </div>
            <span class="copyright">&copy; 2022 all rights reserved. Farmer's Trust</span>
        </footer>
    </div>
</body>

</html>