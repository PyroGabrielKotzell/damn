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

function doQuery($query, $conn)
{
    $result = mysqli_query($conn, $query);
    if (false === $result) {
        exit("Errore: impossibile eseguire la query. " . mysqli_error($conn));
    }
    return $result;
}