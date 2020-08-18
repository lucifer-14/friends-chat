<?php
if (isset($_GET['page'])) {
    $pageno = $_GET['page'];
}

#admin offset
$offset = ($pageno - 1) * $limit;

#user offset
$offset_u = ($pageno - 1) * $limit_u;

//common pager
function getPager(string $query, bool $isAdmin = true, string $searchQuery = ''): void
{
    if ($isAdmin)
        getAdminPager($query);
    else
        getUserPager($query, $searchQuery);
}

//user pager
//can paginate with search value
function getUserPager(string $query, string $searchQuery = '')
{
    global $conn, $pageno, $limit_u;
    $rowResult = mysqli_query($conn, $query);
    $totalrow = mysqli_num_rows($rowResult);
    $totalPage = ceil($totalrow / $limit_u);
    $next = $pageno < $totalPage ? $pageno + 1 : $pageno;
    $prev = $pageno >= 2  ? $pageno - 1 : $pageno;

    echo "<a class='genric-btn primary-border circle ml-1' href='?page=$prev$searchQuery'>&lt;&lt;</a>";

    for ($i = 1; $i <= $totalPage; $i++) {
        $cssClass = $pageno == $i ? "genric-btn primary-border ml-1 circle primary-active" :
            "genric-btn primary-border circle ml-1";
        echo "<a class='$cssClass' href='?page=$i$searchQuery'>$i</a>";
    }

    echo "<a class='genric-btn primary-border circle ml-1' href='?page=$next$searchQuery'>&gt;&gt;</a>";
}

//admin pager
function getAdminPager(string $query)
{
    global $conn, $pageno, $limit;
    $rowResult = mysqli_query($conn, $query);
    $totalrow = mysqli_num_rows($rowResult);
    $totalPage = ceil($totalrow / $limit);
    $next = $pageno < $totalPage ? $pageno + 1 : $pageno;
    $prev = $pageno >= 2  ? $pageno - 1 : $pageno;

    echo "<li class='page-item'>
            <a href='?page=$prev' class='page-link'>&lt;&lt;</a>
         </li>";

    for ($i = 1; $i <= $totalPage; $i++) {
        $cssClass = $pageno == $i ? "page-item active" : "page-item";
        echo "<li class='$cssClass'>
                <a href='?page=$i' class='page-link'>$i</a>
            </li>";
    }

    echo "<li class='page-item'>
            <a href='?page=$next' class='page-link'>&gt;&gt;</a>
           </li>";
}
