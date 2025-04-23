<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Field/Owner</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include ("sidebar2.php");
    ?>
    <div> <h2 class="centered_header">Add New Field</h2></div>

    <div class="main">
        <form action="AdminCreateFieldRecord.php" method="post">
            <input type="text" id="field_id" name="field_id" placeholder="Field ID (EG: FLD006)" required>
            <input type="text" id="fieldName" name="fieldName" placeholder="Field Name" required>
            <input type="text" id="fieldOwner_ID" name="fieldOwner_ID" placeholder="Field Owner ID (EG: FE0006)" required>
            <input type="number" id="capacity" name="capacity" placeholder="Field Capacity" required>
            <input type="text" id="addressLine1" name="addressLine1" placeholder="Address Line 1" required>
            <input type="text" id="city" name="city" placeholder="City" required>
            <input type="text" id="country" name="country" placeholder="Country" required>
            <input type="text" id="postcode" name="postcode" placeholder="Postcode" required>
            <input type="text" id="glt" name="glt" placeholder="GLT" required>
            <input type="text" id="var" name="var" placeholder="VAR" required>
            <input type="number" id="viewScreens" name="viewScreens" placeholder="View Screens" required>
            <input type="text" id="pressBox" name="pressBox" placeholder="Press Box" required>
            <input type="number" id="chgHour" name="chgHour" min="50.0" max="1000" step="0.01" placeholder="Charge Per Hour (Min:50 Max:1000)" required>

            <button type="submit">Add Field</button>
        </form>
    </div>
</body>
</html>