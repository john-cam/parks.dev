<?php

function pageNumber($db, $itemsPerPage) {

    $query = "SELECT count(*) FROM national_parks";
    $statement = $db->query($query);

    $total = $statement->fetchColumn();
    $totalPages = ceil($total / $itemsPerPage);

    $data['total'] = $totalPages;

    $data = [];
    $data['page'] = isset($_GET['page']) ? $_GET['page'] : 1;

    if(isset($_GET['next'])) {
        if($data['page'] < $totalPages && is_numeric($data['page']))
        {
            $data['page']++;
        }
        else
        {
            $data['page'] = $totalPages;
        }
    }
    else if(isset($_GET['previous']))
    {
        if($data['page'] >= 2)
        {
            $data['page']--;
        }
        else
        {
            $data['page'] = 1;
        }
    }
    return $data;
}
extract(pageNumber($db, $itemsPerPage));