<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Field Overview | Field Owner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <section class="col-1">
        <?php include 'Sidebar.php'; ?>
    </section>


    <section class="col-11">
        <div class="bg-image h-100" style="background-color: #f5f7fa;">
            <div class="mask d-flex align-items-center h-100">
            <div class="container">
                <div class="row justify-content-center">
                <div class="col">
                    <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative;">

                        <?php
                            // Connect to the SQLite database
                            $db = new SQLite3(filename: '../fb_managment_system.db');

                            // Query to get data from a table
                            $query = 'SELECT Field_name, Field_Capacity, Address_Line1 || ", " || City || ", " || Country || ", " || Postcode as "Address", GLT, VAR, View_Screens, Press_Box, Chg_Hour FROM Field WHERE FieldOwner_ID="FEO002"'; // Replace 'your_table' with the name of your table
                            $result = $db->query($query);

                            if (!$result) {
                                echo "Error fetching data.";
                            } else {
                                // Start the HTML table
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



                        
                            <!-- <tbody>
                                <tr>
                                    <td>New Trafford</td>
                                    <td>74000</td>
                                    <td>TestData 1</td>
                                    <td>YES</td>
                                    <td>YES</td>
                                    <td>0</td>
                                    <td>YES</td>
                                    <td>450</td>
                                </tr>
                                <tr>
                                    <td>Sandygate</td>
                                    <td>700</td>
                                    <td>TestData 2</td>
                                    <td>NO</td>
                                    <td>NO</td>
                                    <td>0</td>
                                    <td>NO</td>
                                    <td>110</td>
                                </tr>
                            </tbody> -->
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

</body>
</html>