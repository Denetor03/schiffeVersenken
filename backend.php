<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'];
    if($action == "join") { ?>
    <?php $template =  generateField(10,10); ?>
    <?php $template = addShip(3, 4, 4, 0, $template); ?>
    <?php $template = addShip(3, 2, 2, 1, $template); ?>

        <div style="width:fit-content">
        <?php foreach ($template as $key => $value) { ?>
            <div style="display:flex; height:min-content !important;">
                <?php foreach ($value as $key2 => $value2) { ?>
                    <div id="<?= $key."-".$key2?>" class="field" style="margin:  0px; padding: 0px; width:3vw;">
                        <img src="assets/water.png" width="100%" height="100%" style="border:1px solid black;">
                    </div>
                    <!--/*  <?php if ($value2["ships"] == 1) { ?>
                        <?php if ($value2["hit"] == 0) { ?>
                            <img src="assets/ship.png">
                        <?php } else {?>
                            <img src="ship-destroyed.png">
                        <?php } ?>
                    <?php } ?>
                    <?php if ($value2["ships"] == 0) { ?>
                        <?php if ($value2["hit"] == 0) { ?>
                            <img src="assets/water.png">
                        <?php } else {?>
                            <img src="water-hit.png">
                        <?php } ?>
                    <?php } ?>-->

                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <?php 
    }


} else {
    http_response_code(405);
    echo "Method Not Allowed";
}

function generateField(int $xSize, int $ySize): array {
    $field = [];
    $x = [];
    for ($i = $xSize - 1; $i >= 0; $i--) {
        $x[$i] = ["ships" => 0, "hit" => 1];
    }
    for ($i = $ySize - 1; $i >= 0; $i--) {
        $field[] = $x;
    }

    return $field;
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