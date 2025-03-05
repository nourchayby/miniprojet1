<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <style>
        th {
            background-color: #f2f2f2;
        }
        .search {
            float: right;  
        }
        .pagination {
            float: right;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <td><h2 class="h2">Product Management</h2></td>
                <td colspan="2">
                    <form method="GET" action="" class="search">
                        <input type="text" placeholder="Search" name="search" />
                        <input type="submit" value="Search" />
                    </form>
                </td>
                <td colspan="1">
                    <a href="create.php" class="btn btn-success">Create New</a>
                </td>
            </tr>
            <tr>
                <th>no</th>
                <th>name</th>
                <th>details</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "miniprojet1";  
            $connection = new mysqli($servername, $username, $password, $database);
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }
            $search = "";
            if (!empty($_GET["search"])) {
                $search = $_GET["search"];
                $sql = "SELECT * FROM  product WHERE name LIKE '%" . $search . "%'";
            } else {
                $sql = "SELECT * FROM product";
            }
            $result = $connection->query($sql);
            if (!$result) {
                die("Invalid query: " . $connection->error);
            }

            // Pagination
            $currentPage = 1;
            if (!empty($_GET['page'])) {
                $currentPage = intval($_GET['page']);
            }
            $productperpage = 10; 
            $offset = ($currentPage - 1) * $productperpage; 
            $sqlPaginated = $sql . " LIMIT $productperpage OFFSET $offset";
            $resultPaginated = $connection->query($sqlPaginated);
            while ($row = $resultPaginated->fetch_assoc()) {
                echo "
                <tr>
                    <td>{$row['no']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['details']}</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/miniprojet1/edit.php?no={$row['no']}'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/miniprojet1/delete.php?no={$row['no']}'>Delete</a>
                    </td>
                </tr>
                ";
            }
            ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <nav>
        <ul class="pagination">
            <?php
            if ($currentPage > 1) {
                if ($currentPage == 2) {
                    echo '<li class="page-item"><a class="page-link" href="create.php">Précédent</a></li>';
                } elseif ($currentPage == 3) {
                    echo '<li class="page-item"><a class="page-link" href="create.php">Précédent</a></li>';
                }
            } else {
                echo '<li class="page-item disabled"><a class="page-link" href="#">Précédent</a></li>';
            }
            for ($i = 1; $i <= 3; $i++) {
                if ($i == $currentPage) {
                    echo '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
                } else {
                    if ($i == 1) {
                        echo '<li class="page-item"><a class="page-link" href="index.php" >' . $i . '</a></li>';
                    } elseif ($i == 2) {
                        echo '<li class="page-item"><a class="page-link" href="create.php">' . $i . '</a></li>';
                    } elseif ($i == 3) {
                        echo '<li class="page-item"><a class="page-link" href="create.php" >' . $i . '</a></li>';
                    }
                }
            }
            if ($currentPage < 3) {
                if ($currentPage == 1) {
                    echo '<li class="page-item"><a class="page-link" href="create.php">Suivant</a></li>';
                } elseif ($currentPage == 2) {
                    echo '<li class="page-item"><a class="page-link" href="edit.php">Suivant</a></li>';
                }
            } else {
                echo '<li class="page-item disabled"><a class="page-link" href="#">Suivant</a></li>';
            }
            ?>
        </ul>
    </nav>
</body>
</html>