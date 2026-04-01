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
        }

        button {
            width: 100%;
            padding: 10px;
            background: #4facfe;
            color: white;
            border: none;
        }

        .success { color: green; text-align: center; }
        .error { color: red; text-align: center; }
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

        // TEMP: comment this if you don't have customers table
        $result = $conn->query("SELECT balance FROM customers WHERE customer_id = '$cid'");

        if ($result && $result->num_rows > 0) {

            $row = $result->fetch_assoc();
            $balance = $row['balance'];

            if ($amount <= ($balance * 5)) {

                $sql = "INSERT INTO loans (customer_id, amount) VALUES ('$cid', '$amount')";

                if ($conn->query($sql)) {
                    echo "<p class='success'>Loan Applied Successfully!</p>";
                } else {
                    echo "<p class='error'>Error: " . $conn->error . "</p>";
                }

            } else {
                echo "<p class='error'>Loan exceeds allowed limit!</p>";
            }

        } else {
            echo "<p class='error'>Customer not found!</p>";
        }
    }
    ?>

</div>

</body>
</html>
