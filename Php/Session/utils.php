<?php
function randstr(int $length = 8, string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces[] = $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

function doQuery($conn, $query, $vars, &...$_)
{
    $statement = mysqli_prepare($conn, $query);
    if (isset($vars) && isset($_)) {
        $statement->bind_param($vars, ...$_);
    }
    $statement->execute();
    $result = $statement->get_result();
    return $result;
}
