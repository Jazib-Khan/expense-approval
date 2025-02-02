<!DOCTYPE html>
<html>
    <head>
        <title>New Expense Submitted</title>
    </head>
    <body>
        <h2>New Expense Submitted</h2>
        <p>A new expense has been submitted by {{ $userEmail }}.</p>
        <p><strong>Description:</strong> {{ $description }}</p>
        <p><strong>Amount:</strong> {{ $amount }}</p>
        <p><strong>Category:</strong> {{ $category }}</p>
    </body>
</html>
