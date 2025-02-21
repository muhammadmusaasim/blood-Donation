<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Blood</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Blood Request Form</h2>
        <form action="submit_blood_request.php" method="POST">
            <div class="mb-3">
                <label for="blood_group" class="form-label">Blood Group</label>
                <select id="blood_group" name="blood_group" class="form-select" required>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="required_date" class="form-label">Required Date</label>
                <input type="date" id="required_date" name="required_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="comments" class="form-label">Additional Comments (optional)</label>
                <textarea id="comments" name="comments" class="form-control" rows="3"></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Request Blood</button>
            </div>
        </form>
    </div>

    <!-- Optional: Add JavaScript for form validation if needed -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
