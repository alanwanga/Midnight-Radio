
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body bgcolor="#404040">
<?

popnext();

// Use fopen function to open a file
$file = fopen("queue", "r");
$linenum=0;
// Calculate total line number
while (!feof($file)) {
    fgets($file);
    $linenum++;
}
fclose($file);
$file = fopen("queue", "r");
// Read the file line by line until the end
$i=0;

while ($i<$linenum-1) {
    $value = fgets($file);
    //print "The value of this line is " . $value . "<br>";
    $data = explode("@", $value);
    echo "$data[0]";
    echo "$data[1]";
    $i++;
}
fclose($file);





function  popnext()
{
    // Use fopen function to open a file
    $file = fopen("queue", "r");
    $linenum = 0;
    // Calculate total line number
    while (!feof($file)) {
        fgets($file);
        $linenum++;
    }
    fclose($file);
    $file = fopen("queue", "r+");
    fgets($file);
    if($linenum < 3)
    {
        $next = "EOF";
        $value = "";
    }
    else
    {
        $next = fgets($file);
        $value = $next;
        for ($i = 1; $i < $linenum - 1; $i++) {
            $value = $value.fgets($file);
        }
        fclose($file);
    }
    $file = fopen("queue", "w");
    fwrite($file, $value);
    fclose($file);
}

?>
</body>
</html>