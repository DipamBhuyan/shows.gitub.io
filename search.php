<?php
// Establish a database connection

$servername = "sql105.infinityfree.com";
$username = "if0_39277762";
$password = "tau0ROCdr3E";
$dbname = "if0_39277762_show_record";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle live search query
    if (isset($_GET['search_query'])) {
        $searchQuery = $_GET['search_query'];
    
        // Prepare and execute the SQL query
        $sql = "SELECT * FROM shows WHERE name LIKE :searchQuery OR category LIKE :searchQuery OR completeness LIKE :searchQuery OR date LIKE :searchQuery ";
        $stmt = $conn->prepare($sql);
        $searchParam = '%' . $searchQuery . '%';
        $stmt->bindParam(':searchQuery', $searchParam, PDO::PARAM_STR);
        $stmt->execute();
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if (count($result) > 0) {
            $i=1;
            echo '<tr class="w3-theme-l3">
                    <th>SL No</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Completed/Not Completed</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>';
            foreach ($result as $row) {
                echo '<tr>
                        <td>' . $i . '</td>
                        <td>' . $row['name'] . '</td>
                        <td>' . $row['category'] . '</td>
                        <td>' . $row['completeness'] . '</td>
                        <td>' . $row['date'] . '</td>
                        <td>
                            <div class="w3-row">
                                
                            </div>
                        </td>
                    </tr>';
                $i++;
            }
        } else {
            echo '<tr><td colspan="6">No results found.</td></tr>';
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Close the database connection
$conn = null;
?>
