<?php
require_once 'core/models.php';
$applicant = getApplicationByID($pdo, $_GET['applicant_id']);
if (!$applicant) {
    die("Record not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Application</title>
    <style>
        :root {
            --light-pink-bg: #fcf8f8;
            --card-bg: #ffffff;
            --text-dark: #4a3b3c;
            --text-muted: #7d6b6d;
            --border-color: #ebd7d8;
            --delete-red: #d9534f;
            --delete-red-hover: #c9302c;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--light-pink-bg);
            color: var(--text-dark);
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 450px;
        }

        h2 {
            font-weight: 600;
            color: var(--delete-red);
            margin-bottom: 20px;
        }

        .card {
            background-color: var(--card-bg);
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            border: 1px solid var(--border-color);
        }

        .info-row {
            margin-bottom: 12px;
            font-size: 0.95rem;
        }

        .info-label {
            font-weight: 600;
            color: var(--text-muted);
        }

        .btn-group {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 25px;
        }

        .btn-delete {
            background-color: var(--delete-red);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-delete:hover {
            background-color: var(--delete-red-hover);
        }

        .btn-cancel {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .btn-cancel:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Delete Application?</h2>

        <div class="card">
            <p style="margin-top: 0; margin-bottom: 20px; color: var(--text-muted);">Are you sure you want to permanently delete this application record?</p>

            <div class="info-row">
                <span class="info-label">Name:</span> 
                <?php echo htmlspecialchars($applicant['first_name'] . ' ' . $applicant['last_name']); ?>
            </div>

            <div class="info-row">
                <span class="info-label">Email:</span> 
                <?php echo htmlspecialchars($applicant['email']); ?>
            </div>

            <div class="info-row">
                <span class="info-label">Engine:</span> 
                <?php echo htmlspecialchars($applicant['primary_db_engine']); ?>
            </div>

            <form action="core/handleForms.php" method="POST">
                <input type="hidden" name="applicant_id" value="<?php echo $applicant['applicant_id']; ?>">
                
                <div class="btn-group">
                    <input type="submit" name="deleteBtn" value="Yes, Delete" class="btn-delete">
                    <a href="index.php" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>