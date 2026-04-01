<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>MoneyPal - Apply Loan</title>

    <style>
        body {
            font-family: Arial;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 300px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #4facfe;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #007bff;
        }

        .success {
            color: green;
            text-align: center;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Apply Loan</h2>

    <form method="POST">
        <input type="number" name="customer_id" placeholder="Customer ID" required>
        <input type="number" name="amount" placeholder="Loan Amount" required>
        <button type="submit">Apply</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cid = $_POST['customer_id'];
        $amount = $_POST['amount'];

        $sql = "INSERT INTO loans (customer_id, amount) VALUES ('$cid', '$amount')";

        if ($conn->query($sql)) {
            echo "<p class='success'>Loan Applied Successfully!</p>";
        } else {
            echo "<p class='error'>Error: " . $conn->error . "</p>";
        }
    }
    ?>
</div>

</body>
</html>