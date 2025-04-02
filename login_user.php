<?php
class Database {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO("sqlite:../fb_management.db");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->db;
    }
}

$db = new Database();
$conn = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['Email_Address'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT User_ID, Password FROM Users WHERE Email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['Password'])) {
            $_SESSION['user_id'] = $user['User_ID'];
            header("Location: ../teammanager/TeamManager.php");
            exit();
        }

        echo "Invalid email or password.";
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
}
?>