<?php 
$from_fb 			= isset($_GET['from_fb']) ? $_GET['from_fb'] : NULL; 
$source           	= isset($_GET['source']) ? $_GET['source'] : NULL; 
$source_campaign 	= isset($_GET['source_campaign']) ? $_GET['source_campaign'] : NULL; 
$source_medium  	= isset($_GET['source_medium']) ? $_GET['source_medium'] : NULL;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Form</title>
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Job Application Form</h1>
        <form action="send_email.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="job_role">Job Role:</label>
                <select id="job_role" name="job_role" required>
                    <option value="" disabled selected>Select a job role</option>
                    <option value="Business Development Executive">Business Development Executive</option>
                    <option value="Counceller">Counceller</option>
                </select>
            </div>
            <div class="form-group">
                <label for="experience">Experience in Years:</label>
                <select id="experience" name="experience" required>
                    <option value="" disabled selected>Select years of experience</option>
                    <?php for ($i = 0; $i <= 30; $i++): ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="message">Cover Letter:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="resume">Resume (PDF, DOC, DOCX):</label>
                <input type="file" id="resume" name="resume" accept=".pdf, .doc, .docx" required>
            </div>
            <div class="form-group">
                <button type="submit">Submit Application</button>
            </div>
        </form>
    </div>
</body>
</html>
