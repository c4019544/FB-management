<?php
echo"hello"
?>
<?php
        $db = new SQLite3('C:\Users\jamie\OneDrive\Documents\xampp\htdocs\FB-management\fb_managment_system.db');
        $query = "SELECT COUNT (*) as total_users FROM Users";
        $result = $db->querySingle($query, true);
        
        if ($result) {
            echo "Total Users: " . $result['total_users'];
        } else {
            echo "error";
        }
        $db->close();
        ?>