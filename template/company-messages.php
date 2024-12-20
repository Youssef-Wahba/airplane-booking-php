<?php
    require "../src/controllers/CompanyController.php";
    $company = CompanyController::getCompanyByAccountId($_COOKIE["account_id"]);
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Messages</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<body>

    <header>
        <div class="header-buttons">
            <a href="company-home.php">
                <button type="button">Home</button>
            </a>
            <a href="login.php?logout=true">
                <button type="button">Log out</button>
            </a>
        </div>
        <h1>Company Name</h1>
        <img src="../assets/egyptair-logo-1.png" alt="Company Logo" class="company-logo">
    </header>

    <section class="messages-section">
        <h3>Inbox</h3>
        <ul class="message-list">
            <li class="message-item" onclick="expandMessage(this)">
                <strong>Message 1</strong> - Some details
                <p style="display:none;">Expanded details for Message 1</p>
            </li>
            <li class="message-item" onclick="expandMessage(this)">
                <strong>Message 2</strong> - Some details
                <p style="display:none;">Expanded details for Message 2</p>
            </li>
            <!-- Add more messages as needed -->
        </ul>
    </section>

    <script>
        function goToHomePage() {
            // Redirect to the home page (replace 'home.html' with your actual home page)
            window.location.href = 'company-home.html';
        }
        function signOut() {
            // Redirect to the login page (replace 'login.html' with your actual login page)
            window.location.href = 'login.html';
        }

        function expandMessage(element) {
            var details = element.querySelector('p');
            details.style.display = details.style.display === 'none' ? 'block' : 'none';
        }
    </script>

</body>
</html>
