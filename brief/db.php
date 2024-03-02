<?php
session_start();
require 'constant.php';


function checkFieldsAndWhere($where, $fields=null)
{
    if(is_array($fields)){
        $resultStr['fields'] = implode(', ', $fields);
    }else {
        $resultStr['fields'] = $fields;
    }

    if (is_array($where) and !empty($where)) {
        $whereParts = [];
        foreach ($where as $key => $value) {
            $whereParts[] = "{$key} = ? ";
        }
        $resultStr['where'] = "WHERE " . implode(' AND ', $whereParts);
        $resultStr['values'] = array_values($where);
    } else
        if (is_string($where) and strlen($where) > 0) {
            $resultStr['where'] = "WHERE " . $where;
        }
    return $resultStr;
}

function Select($table, $fields = '*', $join = null, $where = null, $orderBy = null, $offset = null, $limit = null, $having = null, $group = null)
{
    $selectStr = checkFieldsAndWhere($where, $fields);
    if(empty($selectStr['where'])){
        $sql = "SELECT {$selectStr['fields']} FROM {$table} {$join}";
    }else{
        $sql = "SELECT {$selectStr['fields']} FROM {$table} {$join} {$selectStr['where']}";

    }

    // ORDER
    if (is_array($orderBy)) {
        $orderByParts = [];
        foreach ($orderBy as $key => $value) {
            $orderByParts[] = "{$key} {$value}";
        }
        $sql .= ' ORDER BY ' . implode(', ', $orderByParts);
    } elseif (is_string($orderBy)) {
        $sql .= ' ORDER BY ' . $orderBy;
    }

    // LIMIT
    if (!empty($limit)) {
        if (!empty($offset)) {
            $sql .= " LIMIT {$offset}, {$limit} ";
        } else {
            $sql .= " LIMIT {$limit} ";
        }
    }

    if (!empty($having)) {
        $sql .= " HAVING {$having} ";
    }
    if (!empty($group)) {
        $sql .= " GROUP BY {$group} ";
    }

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    if (!empty($selectStr['values'])) {
        $types = str_repeat('s', count($selectStr['values'])); // Assuming all parameters are strings
        $stmt->bind_param($types, ...$selectStr['values']);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $data = array();
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

    return $data;
}

function Insert($table, $fields = null)
{
    if (is_array($fields)) {
        $fieldNames = implode(', ', array_keys($fields));
        $placeholders = implode(', ', array_fill(0, count($fields), '?'));

        $sql = "INSERT INTO {$table} ({$fieldNames}) VALUES ({$placeholders})";
        $values = array_values($fields);

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        // Bind parameters
        $types = str_repeat('s', count($values)); // Assuming all values are strings, adjust if needed
        $stmt->bind_param($types, ...$values);

        print_r($values);
        // Execute statement
        $stmt->execute();

        // Get last inserted ID
        $lastInsertedId = $stmt->insert_id;

        // Close statement and connection
        $stmt->close();
        $conn->close();

        return $lastInsertedId;
    } else {
        // Handle case when $fields is not an array
        return false;
    }
}

function Delete($table, $where = null)
{
    $selectStr = checkFieldsAndWhere($where);

    $sql = "DELETE FROM {$table} {$selectStr['where']}";

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    if ($where !== null) {
        // Bind parameters
        $types = str_repeat('s', count($selectStr['values'])); // Assuming all values are strings, adjust if needed
        $stmt->bind_param($types, ...$selectStr['values']);
    }

    // Execute statement
    $stmt->execute();

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

function Update($table, $fields, $where = null)
{
    $resultArr = [];
    $fieldStr = '';
    $whereStr = '';

    // Build SET part of the query
    if (is_array($fields) && !empty($fields)) {
        $fieldParts = [];
        foreach ($fields as $key => $value) {
            $fieldParts[] = "{$key} = ?";
            $resultArr[] = $value;
        }
        $fieldStr = "SET " . implode(', ', $fieldParts);
    } elseif (is_string($fields) && strlen($fields) > 0) {
        $fieldStr = "SET " . $fields;
    }

    // Build WHERE part of the query
    if (is_array($where) && !empty($where)) {
        $whereParts = [];
        foreach ($where as $key => $value) {
            $whereParts[] = "{$key} = ?";
            $resultArr[] = $value;
        }
        $whereStr = "WHERE " . implode(' AND ', $whereParts);
    } elseif (is_string($where) && strlen($where) > 0) {
        $whereStr = "WHERE " . $where;
    }

    try {
        // Construct the SQL query
        $sql = "UPDATE {$table} {$fieldStr}";
        if (!empty($whereStr)) {
            $sql .= " {$whereStr}";
        }

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        // Bind parameters
        if (!empty($resultArr)) {
            $types = str_repeat('s', count($resultArr)); // Assuming all parameters are strings
            $stmt->bind_param($types, ...$resultArr);
        }

        // Execute statement
        $success = $stmt->execute();

        // Check execution result
        if (!$success) {
            throw new Exception("Execution failed: " . $stmt->error);
           
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
        return true;
    } catch (Exception $e) {
        print_r( $e);
        // Log or handle the exception appropriately
        return false;
    }
}