<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Certificate of Completion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 800px;
            height: 600px;
            margin: 50px auto;
            border: 10px solid #000;
            position: relative;
            background-color: #fff;
        }

        .header {
            text-align: center;
            padding: 20px 0;
            background-color: #f2f2f2;
        }

        .title {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .subtitle {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .content {
            padding: 50px;
            line-height: 1.5;
        }

        .signature {
            position: absolute;
            bottom: 50px;
            right: 50px;
        }

        .name {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 class="title">Certificate of Completion</h1>
            <h2 class="subtitle">This certificate is awarded to</h2>
            <h3 class="name">{{$student->name}}</h3>
        </div>
        <div class="content">
            <p>Congratulations on successfully completing the course <strong style="color: red;">{{$event->name}}</strong> . Your dedication and hard work have paid off, and we are proud to present you with this certificate.</p>
            <p>We hope that this certificate will serve as a testament to your skills and abilities, and that it will open doors to new opportunities and experiences. We wish you all the best in your future endeavors.</p>
            <p>Check in at: {{$check_in_at}}</p>
            </p>
        </div>
    </div>
</body>

</html>