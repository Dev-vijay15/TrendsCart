<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            min-height: 100vh;
            background: #f9f9f9;
            font-family: 'Roboto', Arial, sans-serif;
            color: #333;
        }

        h1 {
            font-size: 8rem;
            margin: 0;
            color: #ff6b6b;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        }

        p {
            font-size: 1.2rem;
            margin: 1rem 0;
            color: #555;
        }

        a {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            color: #fff;
            background: #007bff;
            border-radius: 4px;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        a:hover {
            background: #0056b3;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .illustration {
            max-width: 400px;
            width: 100%;
            margin-bottom: 2rem;
        }

        .button-container {
            display: flex;
            gap: 20px;
            /* Space between the buttons */
            margin-top: 1.5rem;
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 5rem;
            }

            p {
                font-size: 1rem;
            }

            .button-container {
                flex-direction: column;
                /* Stack buttons on smaller screens */
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <svg class="illustration" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="200" height="200">
        <circle cx="32" cy="32" r="30" fill="#f2f2f2" stroke="#e0e0e0" stroke-width="4"></circle>
        <text x="50%" y="50%" fill="#ff6b6b" font-size="14" text-anchor="middle" dominant-baseline="middle">
            404
        </text>
    </svg>
    <p>Oops! The page you are looking for doesn’t exist or has been moved.</p>
    <div class="button-container">
        <a href="javascript:history.back()">Go Back</a>
        <a href=" {{ url('/home') }}"> Go Home Page</a>

    </div>
</body>

</html>
