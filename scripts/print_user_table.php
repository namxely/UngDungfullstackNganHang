<?php
    require_once "connect.php";

    $search = isset($_GET["search"]) ? $_GET["search"] : "";
    $sql = "SELECT * FROM user";
    if (!empty($search)) 
    {
        $columns = array
        (
            "account_id",
            "first_name",
            "last_name",
            "password",
            "address",
            "PESEL",
            "email",
            "balance",
            "phone_number",
            "date_opened",
            "role_id",
            "account_number"
        );
        $conditions = array();
        foreach ($columns as $column) 
        {
            $conditions[] = "$column LIKE '$search'";
        }
        $sql .= " WHERE " . implode(" OR ", $conditions);
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            echo <<< DATA
                <tr>
                    <td>{$row["account_id"]}</td>
                    <td>{$row["first_name"]}</td>
                    <td>{$row["last_name"]}</td>
                    <td>{$row["password"]}</td>
                    <td>{$row["address"]}</td>
                    <td>{$row["PESEL"]}</td>
                    <td>{$row["email"]}</td>
                    <td>{$row["balance"]}</td>
                    <td>{$row["phone_number"]}</td>
                    <td>{$row["date_opened"]}</td>
                    <td>{$row["role_id"]}</td>
                    <td>{$row["account_number"]}</td>
                    <td>
                        <a href="edit_user_page.php?account_id={$row["account_id"]}">Edit</a>
                        <a href="../../scripts/delete_user.php?account_id={$row["account_id"]}">Delete</a>
                    </td>
                </tr>
            DATA;
        }
    }else{
        echo "No matching data";
    }

    $conn->close();
?>