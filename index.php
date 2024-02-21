<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<body style="font-size: 3em;">

    <?php $template = [1 => [], 2 => [], 3 => [], 4 => [], 4 =>[], 5 => [], 6 => [], 7 => [], 8 =>[], 9 => []];

    foreach ($template as $key => &$value) {
        $temp = [ 1 =>["ships" => 0, "hit" => 0], 2 =>[ "ships" => 0, "hit" => 1], 3 =>[ "ships" => 0, "hit" => 0], 4 =>[ "ships" => 0, "hit" => 0], 5 =>[ "ships" => 0, "hit" => 0], 6 => [ "ships" => 0, "hit" => 0], 7 => [ "ships" => 0, "hit" => 0]];
        $value = $temp;
    } ?>

    <?php $template = addShip(3, 4, 4, 0, $template); ?>
    <?php $template = addShip(3, 2, 2, 1, $template); ?>
    <div style="width:fit-content">
        <?php foreach ($template as $key => $value) { ?>
            <div style="display:flex; height:min-content !important;">
                <?php foreach ($value as $key2 => $value2) { ?>
                    <div style="height: 50px;">
                        <?php if ($value2["ships"] == 1) { ?>
                            <?php if ($value2["hit"] == 0) { ?>
                                <img src="ship.png">
                            <?php } else {?>
                                <img src="ship-destroyed.png">
                            <?php } ?>
                        <?php } ?>
                        <?php if ($value2["ships"] == 0) { ?>
                            <?php if ($value2["hit"] == 0) { ?>
                                <img src="water.png">
                            <?php } else {?>
                                <img src="water-hit.png">
                            <?php } ?>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <?php

    function generateField(int $xSize, int $ySize): array {
        $array = [];
        for ($i= $xSize; $i < ; $i++) { 
            # code...
        }test



        return
    }

    function addShip(int $size, int $x, int $y, int $isVertical, array $field): array {
        $step = 1;
        $origin = &$field[$x][$y];
        $origin["ships"] = 1;
        if($isVertical == 1) {


            for ($i = 1; $i < $size; $i++) {
                if($i % 2 == 0) {
                    $cord = &$field[$x - $step][$y];
                    $step++;
                } else {
                    $cord = &$field[$x + $step][$y];
                }
                $cord["ships"] = 1;
            }
        } else {
            $origin = $field[$x][$y];

            $origin["ships"] = 1;

            for ($i = 1; $i < $size; $i++) {
                if($i % 2 == 0) {
                    $cord = &$field[$x][$y - $step];
                    $step++;
                } else {
                    $cord = &$field[$x][$y + $step];
                }
                $cord["ships"] = 1;
            }
        }

        return $field;
    }

    ?>
</body>
</html>
