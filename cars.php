<?php

class Cars
{
    private $conn;
    private $has_image;

    public $sort;
    public $order;
    public $fuzzy;
    public $limit;
    public $search;
    public $return;

    public static function instance($db)
    {
        static $instance = null;

        if($instance === null)
        {
            $instance = new Cars($db);
        } 
            
        return $instance;
    }

    public function __construct(mysqli $db)
    {
        $this->conn = $db;
    }
    
    public function get_cars()
    {
        $query = $this->get_query();
        $results = $this->execute_query($query);

        return $results;
    }

    private function execute_query($query)
    {
        try {
            $stmt = $this->conn->prepare($query);

            if (isset($this->search)) {
                $values = array_values($this->search);
                $this->sanitize_values($values);
                $this->bind_params($stmt, $values);
            }

            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                return [];
            }

            $results = [];

            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }

            if ($this->has_image) {
                foreach ($results as &$row) {
                    $row["image"] = $this->get_image($row["make"], $row["model"]);
                }
            }

            return $results;
        } catch (Exception $e) {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(array("status" => "error", "timestamp" => time(), "data" => "Failed to execute query"));
            exit;
        }
    }

    private function bind_params(mysqli_stmt &$stmt, array $values)
    {
        $types = "";
        $params = [];
        
        foreach ($values as $value) {
            $types .= "s";
            $params[] = "%$value%";
        }
        
        $bind_names[] = $types;

        for ($i=0; $i<count($params); $i++) {
            $bind_name = "bind" . $i;
            $$bind_name = $params[$i];
            $bind_names[] = &$$bind_name;
        }

        call_user_func_array(array($stmt, "bind_param"), $bind_names);
    }

    private function get_query()
    {
        try {
            $this->has_image = false;

            $query = "SELECT ";

            if ($this->return == "*") {
                $query .= "*";
                $this->has_image = true;
            } else {
                if (in_array("image", $this->return)) {
                    $this->has_image = true;
                    $this->return = array_filter($this->return, function ($value) {
                        return $value != "image";
                    });
                }

                $query .= implode(",", $this->return);
            }

            $query .= " FROM cars WHERE 1=1 ";

            if (isset($this->search)) {
                if ($this->fuzzy == false) {
                    foreach ($this->search as $column => $value) {
                        $query .= "AND $column = ? ";
                    }
                } else {
                    $query .= "AND (";
                    foreach ($this->search as $column => $value) {
                        $query .= "$column LIKE ? AND ";
                    }
                    $query = rtrim($query, "AND ");
                    $query .= ") ";
                }
            }

            $query .= "ORDER BY $this->sort $this->order ";

            $query .= "LIMIT $this->limit ";

            return $query;
        } catch (Exception $e) {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(array("status" => "error", "timestamp" => time(), "data" => "Failed to create query"));
            exit;
        }
    }

    public function rate_car($id, $apikey, $rating)
    {
        if (!$this->car_exists($id)) {
            $this->insert_car($id);
        }

        if ($this->has_rated($id, $apikey)) {
            return;
        }
        else {
            $this->add_rated($id, $apikey);
        }
        
        $query1 = "UPDATE rates SET num_rates = num_rates + 1 WHERE id = ?";
        $query2 = "UPDATE rates SET total_rates = total_rates + $rating WHERE id = ?";
        $query3 = "UPDATE rates SET rating = total_rates / num_rates WHERE id = ?";
        
        $stmt1 = $this->conn->prepare($query1);
        $stmt1->bind_param("s", $id);
        $stmt1->execute();
        
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bind_param("s", $id);
        $stmt2->execute();
        
        $stmt3 = $this->conn->prepare($query3);
        $stmt3->bind_param("s", $id);
        $stmt3->execute();
        
        $stmt1->close();
        $stmt2->close();
        $stmt3->close();
    }

    private function has_rated($id, $apikey)
    {
        $query = "SELECT * FROM users_rated WHERE id = ? AND apikey = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $id, $apikey);
        $stmt->execute();

        $result = $stmt->get_result();

        $num_rows = $result->num_rows;

        $stmt->close();

        return $num_rows == 1;
    }

    private function add_rated($id, $apikey)
    {
        $query = "INSERT INTO users_rated (id, apikey) VALUES (?, ?)";
 
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $id, $apikey);
        $stmt->execute();
        $stmt->close();
    }

    private function insert_car($id)
    {
        $query = "INSERT INTO rates (id) VALUES (?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->close();
    }

    private function car_exists($id)
    {
        $query = "SELECT id FROM rates WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        $num_rows = $result->num_rows;
        
        $stmt->close();

        return $num_rows == 1;
    }

    private function get_image($make, $model)
    {
        $url = "https://wheatley.cs.up.ac.za/api/getimage?" . http_build_query([
            "brand" => $make,
            "model" => $model,
        ]);

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        if (curl_error($curl)) {
            throw new Exception("Failed to fetch car image: " . curl_error($curl));
        }

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($status !== 200) {
            throw new Exception("Failed to fetch car image: HTTP status $status");
        }

        curl_close($curl);

        return $response;
    }

    private function sanitize_values(array &$values)
    {
        foreach ($values as &$value) {
            $value = htmlspecialchars($value, ENT_QUOTES, "UTF-8");
        }
    }
}

?>