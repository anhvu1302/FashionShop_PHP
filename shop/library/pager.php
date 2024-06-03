<?php

    function findStart($limit)
    {
        if((!isset($_GET['page']))  || ($_GET['page']=="1"))
        {
            $start = 0;
            $_GET['page'] = 1 ;
        }
        else
        {
            $start = ($_GET['page'] - 1) * $limit;
        }
        return $start;
    }

    function findPageNumber($count, $limit)  
    {
        $page_number = (($count % $limit)== 0) ? $count / $limit : floor($count / $limit) + 1;
        return $page_number;
    }

    function printPageListType($current_page, $page_number, $type)
    {
        if($current_page - 1 > 0)
        {
            ?><a class="buttons prev-button" style="text-decoration: none" href="display.php?type=<?php echo $type ?>&page=1">Trang Đầu</a><?php
            ?><a class="buttons prev-button" style="text-decoration: none" href="display.php?type=<?php echo $type ?>&page=<?php echo $current_page - 1 ?>"><<</a><?php
        }
        
        $first = max($current_page - 2, 1);
        $last = min($current_page + 2, $page_number);
        
        for($index = $first; $index <= $last; $index = $index + 1)
        {
            if($index == $current_page)
            {
                ?><span class="buttons active"><?php echo $index ?></span><?php
            }
            else
            {
                ?><a class="buttons" style="text-decoration: none" href="display.php?type=<?php echo $type ?>&page=<?php echo $index ?>"><?php echo $index ?></a><?php
            }
        }
        
        if($current_page + 1 <= $page_number)
        {
            ?><a class="buttons next-button" style="text-decoration: none" href="display.php?type=<?php echo $type ?>&page=<?php echo $current_page + 1 ?>">>></a><?php
            ?><a class="buttons next-button" style="text-decoration: none" href="display.php?type=<?php echo $type ?>&page=<?php echo $page_number ?>">Trang Cuối</a><?php
        }
    }

    function printPageListSearch($current_page, $page_number, $search)
    {
        if($current_page - 1 > 0)
        {
            ?><a class="buttons prev-button" style="text-decoration: none" href="display.php?search=<?php echo $search?>&page=1">Trang Đầu</a><?php
            ?><a class="buttons prev-button" style="text-decoration: none" href="display.php?search=<?php echo $search?>&page=<?php echo $current_page - 1 ?>"><<</a><?php
        }
        
        $first = max($current_page - 2, 1);
        $last = min($current_page + 2, $page_number);
        
        for($index = $first; $index <= $last; $index = $index + 1)
        {
            if($index == $current_page)
            {
                ?><span class="buttons active"><?php echo $index ?></span><?php
            }
            else
            {
                ?><a class="buttons" style="text-decoration: none" href="display.php?search=<?php echo $search?>&page=<?php echo $index ?>"><?php echo $index ?></a><?php
            }
        }
        
        if($current_page + 1 <= $page_number)
        {
            ?><a class="buttons next-button" style="text-decoration: none" href="display.php?search=<?php echo $search?>&page=<?php echo $current_page + 1 ?>">>></a><?php
            ?><a class="buttons next-button" style="text-decoration: none" href="display.php?search=<?php echo $search?>&page=<?php echo $page_number ?>">Trang Cuối</a><?php
        }
    }

?>