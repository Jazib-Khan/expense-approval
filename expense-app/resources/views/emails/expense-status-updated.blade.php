<!DOCTYPE html>
<html>
    <head>
        <title>Expense Request {{ ucfirst($status) }}</title>
    </head>
    <body>
        <h2>Expense Request {{ ucfirst($status) }}</h2>
        <p>Your expense request with the following details has been <strong>{{ $status }}</strong>:</p>
        <p><strong>Description:</strong> {{ $description }}</p>
        <p><strong>Amount:</strong> {{ $amount }}</p>
        <p><strong>Category:</strong> {{ $category }}</p>
    </body>
</html>
