<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Digest Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
        }
        h1 {
            color: #007bff;
            text-align: center;
        }
        p {
            line-height: 1.6;
            margin-bottom: 20px;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        li {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        strong {
            color: #007bff;
        }
        footer {
            margin-top: 20px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daily Digest Email</h1>

        <p>I hope this email finds you well.</p>

        <p>As part of our commitment to keeping you informed and updated, we are pleased to present today's Daily Digest, featuring the top 10 posts from our platform.</p>

        <p>Below is a summary of the most engaging content:</p>

        <ul>
            @foreach($posts as $post)
                <li>
                    <strong>Likes Count:</strong> {{ $post->likes_count }}<br>
                    <strong>User Name:</strong> {{ $post->user->name }}
                </li>
            @endforeach
        </ul>

        <p>Please take a moment to review these posts, as they offer valuable insights and discussions within our community.</p>

        <p>Should you have any questions or require further information, please do not hesitate to reach out to us. Your feedback is always appreciated.</p>

        <p>Thank you for your continued support and engagement.</p>

        <footer>
            Best regards,<br>
            Trikl
        </footer>
    </div>
</body>
</html>
