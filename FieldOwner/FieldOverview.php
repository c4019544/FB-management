<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Field Overview | Field Owner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
=======
<<<<<<<< HEAD:Admin/UserManagement.php
    <title>User Management | Admin</title>
========
    <title>Field Overview | Field Owner</title>
>>>>>>>> jamie:FieldOwner/FieldOverview.php
>>>>>>> jamie
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
<<<<<<< HEAD

    <?php include 'Sidebar.php'; ?>

=======
    <?php include 'Sidebar.php'; ?>
>>>>>>> jamie
    <div class="content">
        <header>
            <h1>Field Overview</h1>
        </header>
<<<<<<< HEAD


        <section class="col">
            <div class="bg-image h-100" style="background-color: #f5f7fa;">
                <div class="mask d-flex align-items-center h-100">
                <div class="container">
                    <div class="row justify-content-center">
                    <div class="col">
                        <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive table-scroll field-table" data-mdb-perfect-scrollbar="true" style="position: relative;">

                            <?php
                                session_start();

                                if (!isset($_SESSION['email'])) {
                                    header("Location: index.php");
                                    exit();
                                }

                                $email = $_SESSION['email'];

                                $db = new SQLite3('../fb_managment_system.db');

                                $stmt = $db->prepare('
                                    SELECT Field_name, Field_Capacity, 
                                        Address_Line1 || ", " || City || ", " || Country || ", " || Postcode as Address, 
                                        GLT, VAR, View_Screens, Press_Box, Chg_Hour
                                    FROM Field
                                    INNER JOIN Users ON Field.FieldOwner_ID = Users.User_ID
                                    WHERE Users.Email_Address = :email
                                ');

                                $stmt->bindValue(':email', $email, SQLITE3_TEXT);
                                $result = $stmt->execute();

                                

                                if (!$result) {
                                    echo "Error fetching data.";
                                } else {
                                    
                                    echo "<table class='table table-striped mb-0'>
                                <thead style='background-color: #002d72;'>
                                    <tr>
                                        <th scope='col'>Field Name</th>
                                        <th scope='col'>Capacity</th>
                                        <th scope='col'>Address</th>
                                        <th scope='col'>GLT</th>
                                        <th scope='col'>VAR</th>
                                        <th scope='col'>View Screens</th>
                                        <th scope='col'>Press Box</th>
                                        <th scope='col'>Chg per Hour</th>
                                    </tr>
                                </thead>";

                                    // Loop through the query result and display the data in table rows
                                    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                                        echo "<tr>
                                                <td>" . htmlspecialchars($row['Field_name']) . "</td>
                                                <td>" . htmlspecialchars($row['Field_Capacity']) . "</td>
                                                <td>" . htmlspecialchars($row['Address']) . "</td>
                                                <td>" . htmlspecialchars($row['GLT']) . "</td>
                                                <td>" . htmlspecialchars($row['VAR']) . "</td>
                                                <td>" . htmlspecialchars($row['View_Screens']) . "</td>
                                                <td>" . htmlspecialchars($row['Press_Box']) . "</td>
                                                <td>" . htmlspecialchars($row['Chg_Hour']) . "</td>
                                            </tr>";
                                    }

                                    // End the table
                                    echo "</table>";
                                }

                                // Close the database connection
                                $db->close();
                            ?>


                            </table>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </div>

    

</body>
</html>

<style>
/* .field-table{
    margin:600px 100px;
} */
</style>
=======
    </div>
</body>
</html>
>>>>>>> jamie
