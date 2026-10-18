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
    <title>Edit Application</title>
    <style>
        :root {
            --primary-pink: #d8a4a6;
            --primary-pink-hover: #c48b8e;
            --light-pink-bg: #fcf8f8;
            --card-bg: #ffffff;
            --text-dark: #4a3b3c;
            --text-muted: #7d6b6d;
            --border-color: #ebd7d8;
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
            max-width: 500px;
        }

        h2 {
            font-weight: 600;
            margin-bottom: 20px;
        }

        .card {
            background-color: var(--card-bg);
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            border: 1px solid var(--border-color);
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        label {
            font-size: 0.9rem;
            margin-bottom: 6px;
            color: var(--text-muted);
            font-weight: 500;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 0.95rem;
            box-sizing: border-box;
            background-color: #faf7f7;
            color: var(--text-dark);
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--primary-pink);
            background-color: #fff;
        }

        .btn-group {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
        }

        .btn-submit {
            background-color: var(--primary-pink);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-submit:hover {
            background-color: var(--primary-pink-hover);
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
        <h2>Edit Application</h2>

        <div class="card">
            <form action="core/handleForms.php" method="POST">
                <input type="hidden" name="applicant_id" value="<?php echo $applicant['applicant_id']; ?>">

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" value="<?php echo htmlspecialchars($applicant['first_name']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" value="<?php echo htmlspecialchars($applicant['last_name']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($applicant['email']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Primary DB Engine</label>
                    <select name="primary_db_engine" required>
                        <option value="MySQL" <?php echo ($applicant['primary_db_engine'] == 'MySQL') ? 'selected' : ''; ?>>MySQL</option>
                        <option value="PostgreSQL" <?php echo ($applicant['primary_db_engine'] == 'PostgreSQL') ? 'selected' : ''; ?>>PostgreSQL</option>
                        <option value="Oracle" <?php echo ($applicant['primary_db_engine'] == 'Oracle') ? 'selected' : ''; ?>>Oracle</option>
                        <option value="SQL Server" <?php echo ($applicant['primary_db_engine'] == 'SQL Server') ? 'selected' : ''; ?>>SQL Server</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Years of Experience</label>
                    <input type="number" name="years_of_experience" value="<?php echo htmlspecialchars($applicant['years_of_experience']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Certifications</label>
                    <input type="text" name="certifications" value="<?php echo htmlspecialchars($applicant['certifications']); ?>">
                </div>

                <div class="btn-group">
                    <input type="submit" name="updateBtn" value="Save Changes" class="btn-submit">
                    <a href="index.php" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>