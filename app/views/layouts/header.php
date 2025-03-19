<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <h1>My Website</h1>
        <nav>
            <ul>
                <li><a href="/">Home</li>
                <li><a href="/user">Users</a></li>
                <?php if (isset($_SESSION['user_name'])) { ?>
                    <li><a href="/auth/logout">Logout</a></li>
                <?php } else { ?>
                    <li><a href="/auth/login">Login</a></li>
                <?php } ?>
            </ul>
        </nav>
    </header>
    <main>
       