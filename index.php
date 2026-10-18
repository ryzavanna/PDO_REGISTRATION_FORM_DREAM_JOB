<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'core/models.php';
$applications = getAllApplications($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DBA Job Application System</title>
    <style>
        :root {
            --primary-pink: #d8a4a6;
            --primary-pink-hover: #c48b8e;
            --light-pink-bg: #fcf8f8;
            --card-bg: #ffffff;
            --text-dark: #4a3b3c;
            --text-muted: #7d6b6d;
            --border-color: #ebd7d8;
            --delete-red: #d9534f;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--light-pink-bg);
            color: var(--text-dark);
            margin: 0;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 1050px;
        }

        h2 {
            color: var(--text-dark);
            margin-bottom: 20px;
            font-weight: 600;
        }

        .card {
            background-color: var(--card-bg);
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            border: 1px solid var(--border-color);
            margin-bottom: 40px;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
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
            background-color: #faf7f7;
            color: var(--text-dark);
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--primary-pink);
            background-color: #fff;
        }

        .btn-submit {
            background-color: var(--primary-pink);
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background-color: var(--primary-pink-hover);
        }

        /* --- Fixed Table Structure --- */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            border: 1px solid var(--border-color);
            background-color: var(--card-bg);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th, td {
            padding: 12px 10px;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.88rem;
            color: var(--text-dark);
            vertical-align: middle;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        th {
            background-color: #f7eded;
            font-weight: 600;
            text-align: left;
        }

        /* Rebalanced Column Ratios */
        .col-id { width: 5%; }
        .col-name { width: 16%; }
        .col-email { width: 22%; }
        .col-engine { width: 11%; }
        .col-exp { width: 10%; }
        .col-cert { width: 12%; }
        .col-date { width: 11%; }
        .col-actions { width: 13%; text-align: center; } /* Increased width to accommodate action buttons cleanly */

        .action-links {
            display: inline-flex;
            gap: 6px;
            justify-content: center;
        }

        .action-links a {
            text-decoration: none;
            font-weight: 500;
            font-size: 0.8rem;
            padding: 5px 10px;
            border-radius: 4px;
            white-space: nowrap;
        }

        .link-edit {
            color: #7d6b6d;
            background-color: #f3e8e8;
        }

        .link-edit:hover {
            background-color: #ebd7d8;
        }

        .link-delete {
            color: var(--delete-red);
            background-color: #fde8e8;
        }

        .link-delete:hover {
            background-color: #fbd5d5;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Database Administrator Job Application</h2>

        <div class="card">
            <form action="core/handleForms.php" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" placeholder="e.g. Jane" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" placeholder="e.g. Doe" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="jane.doe@example.com" required>
                    </div>
                    <div class="form-group">
                        <label>Primary DB Engine</label>
                        <select name="primary_db_engine" required>
                            <option value="MySQL">MySQL</option>
                            <option value="PostgreSQL">PostgreSQL</option>
                            <option value="Oracle">Oracle</option>
                            <option value="SQL Server">SQL Server</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Years of Experience</label>
                        <input type="number" name="years_of_experience" min="0" placeholder="0" required>
                    </div>
                    <div class="form-group">
                        <label>Certifications</label>
                        <input type="text" name="certifications" placeholder="e.g. AWS Database, OCP">
                    </div>
                </div>

                <input type="submit" name="insertBtn" value="Submit Application" class="btn-submit">
            </form>
        </div>

        <h2>Submitted Applications</h2>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th class="col-id">ID</th>
                        <th class="col-name">Name</th>
                        <th class="col-email">Email</th>
                        <th class="col-engine">Engine</th>
                        <th class="col-exp">Experience</th>
                        <th class="col-cert">Certifications</th>
                        <th class="col-date">Applied On</th>
                        <th class="col-actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($applications)): ?>
                        <?php foreach ($applications as $row): ?>
                            <tr>
                                <td class="col-id"><?php echo $row['applicant_id']; ?></td>
                                <td class="col-name"><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
                                <td class="col-email"><?php echo htmlspecialchars($row['email']); ?></td>
                                <td class="col-engine"><?php echo htmlspecialchars($row['primary_db_engine']); ?></td>
                                <td class="col-exp"><?php echo htmlspecialchars($row['years_of_experience']); ?> yrs</td>
                                <td class="col-cert"><?php echo htmlspecialchars($row['certifications']); ?></td>
                                <td class="col-date"><?php echo date('Y-m-d', strtotime($row['date_applied'])); ?></td>
                                <td class="col-actions">
                                    <div class="action-links">
                                        <a href="edit.php?applicant_id=<?php echo $row['applicant_id']; ?>" class="link-edit">Edit</a>
                                        <a href="delete.php?applicant_id=<?php echo $row['applicant_id']; ?>" class="link-delete">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center; color: var(--text-muted);">No applications found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>