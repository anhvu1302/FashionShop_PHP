<?php

    function connectDatabase()
    {
        $server = "localhost";
        $database = "fashionshop";
        $username = "root";
        $password = "";
        $connection = null;

        try
        {
            $connection = new PDO("mysql: host=$server; dbname=$database", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(Exception $exception)
        {
            echo "Connection Error: " . $connection->errorCode();
        }

        return $connection;
    }

    function showLineBreak($string)
    {
        return str_replace("\n", "'\n'", $string);
    }

    function generateRating($rating) 
    {
        $html = '<div class="stars">';

        for ($index = 1; $index <= $rating; $index = $index + 1) $html = $html . '<i class="fas fa-star"></i>';

        for ($index= $rating + 1; $index <= 5; $index = $index + 1) $html = $html . '<i class="far fa-star"></i>';
    
        $html = $html . '<span> (0)</span></div>';
        return $html;
    }

    
    function generatePrice($class, $price, $discount)
    {
        ?>

            <div class="<?php echo $class ?>">
                <div class="price"><?php echo number_format($price - $price * $discount / 100, 0, ',', '.') ?> VNĐ</div>
                <div class="cut"><?php echo number_format($price, 0, ',', '.') ?> VNĐ</div>
                <div class="offer"><?php echo $discount ?>%</div>
            </div>

        <?php
    }

    function generateColor($selected, $id, $color)
    {
        if($selected) $border = "3px solid #EB4D4B";
        else $border = "1px solid #000000";

        switch($color)
        {
            case 'đen':
                $background = '#000000';
                break;
            case 'trắng':
                $background = '#ffffff';
                break;
            case 'xanh tím than':
                $background = '#330066';
                break;
            case 'đỏ':
                $background = '#FF0000';
                break;
            case 'kem':
                $background = '#FFF8DC';
                break;
            case 'be':
                $background = '#F5F5DC';
                break;
            case 'nau':
                $background = '#8B4513';
                break;
            case 'green':
                $background = '#008000';
                break;
            case 'trangxam':
                $background = '#C0C0C0';
                break;
            case 'greyblue':
                $background = '#778899';
                break;
            case 'xanh':
                $background = '#0000FF';
                break;
            case 'tim':
                $background = '#800080';
                break;
            default:
                $background = '#ffffff';
                break;
        }

        ?>

            <a class="circle" style="background-color: <?php echo $background ?>; border: <?php echo $border ?>" href="details.php?id=<?php echo $id ?>&color=<?php echo $color ?>"></a>
        
        <?php
    }


?>