<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'];
    if($action == "join") { ?>
    <?php $template =  generateField(20,10); ?>
    <?php $template = addShip(2, 4, 4, 0, $template); ?>
    <?php $template = addShip(4, 2, 2, 1, $template); ?>
    <?php $template = addShip(5, 5, 8, 0, $template); ?>
    <?php $template = addShip(6, 6, 9, 0, $template); ?>
    <?php $template = addShip(8, 5, 9, 0, $template); ?>
    <?php $template = addShip(2, 6, 3, 1, $template); ?>
    <?php $template = addShip(2, 5, 1, 1, $template); ?>

    <style>
        .field {
            position: relative;
            margin: 0;
            padding: 0;
            width: 4vw;
        }
        .field img {
            display: block;
            width: 100%;
            height: 100%;
            border: 1px solid black;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Adjust opacity as needed */
            display: none;
        }
        .overlay img {
            display: block;
            width: 100%;
            height: 100%;
        }
    </style>
<div style="width:fit-content">
    <?php foreach ($template as $key => $value) { ?>
        <div style="display:flex; height:min-content !important;">
            <?php foreach ($value as $key2 => $value2) { ?>
                <div id="<?= $key."_".$key2?>" class="field" style="margin: 0px; padding: 0px; width: 4vw; position: relative;">
                    <img src="assets/water.png" width="100%" height="100%" style="border:0.5px solid black;">
                    <?php if ($value2["ships"] == 1) { ?>
                        <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgb(0,0,0,0) !important; display:block;">
                             <img src="assets/<?=$value2["img"]?>.png" alt="Overlay Image">
                         </div>
                        <?php if ($value2["hit"] == 1) { ?>
                            <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgb(0,0,0,0) !important; display:block;">
                                <img src="assets/bom1.png" alt="Overlay Image">
                            </div>
                        <?php }?>
                    <?php } ?>
                    <?php if ($value2["ships"] == 0) { ?>
                        <?php if ($value2["hit"] == 1) { ?>
                            <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: block; background-color: rgb(0,0,0,0) !important;">
                                <img src="assets/water-boom.png" alt="Overlay Image">
                            </div>
                        <?php }?>
                    <?php } ?>
                </div>
                <script>
                    var img<?= $key."_".$key2?> = document.getElementById("<?= $key."_".$key2?>").querySelector("img");
                    var overlay<?= $key."_".$key2?> = document.getElementById("<?= $key."_".$key2?>").querySelector(".overlay");

                    img<?= $key."_".$key2?>.addEventListener("click", function() {
                        overlay<?= $key."_".$key2?>.style.display = "block";
                    });
                </script>
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
    for ($i = 0; $i <= $xSize -1; $i++) {
        $x[$i] = ["ships" => 0, "hit" => 0];
    }
    for ($i = $ySize - 1; $i >= 0; $i--) {
        $field[] = $x;
    }

    return $field;
}

function addShip(int $size, int $x, int $y, int $isVertical, array $field): array {
    $step = 1;
    $origin = &$field[$y][$x];

    $origin["ships"] = 1;

    if($isVertical == 1) {

        $origin["img"] = "ship-y";
        if($size == 2) {
            $origin["img"] = "ship-end-n";
        }

        for ($i = 1; $i < $size; $i++) {
            if($i % 2 == 0) {
                $cord = &$field[$y - $step][$x];
                $step++;
            } else {
                $cord = &$field[$y + $step][$x];
            }
            $cord["ships"] = 1;
            $cord["img"] = "ship-y";

            if($i +2 >= $size) {
                if($size % 2 == 0) {
                    $cord["img"] = "ship-end-n";
                } else  {
                    $cord["img"] = "ship-end-s";
                }
            }
            if($i +1 >= $size) {
                if($size % 2 == 0) {
                    $cord["img"] = "ship-end-s";
                } else  {
                    $cord["img"] = "ship-end-n";
                }
            }
        }
    } else {
        $origin = $field[$y][$x];

        $origin["ships"] = 1;
        $origin["img"] = "ship-x";

        if($size == 2) {
            $origin["img"] = "ship-end-w";
        }
        for ($i = 1; $i < $size; $i++) {
            if($i % 2 == 0) {
                $cord = &$field[$y][$x - $step];
                $step++;
            } else {
                $cord = &$field[$y][$x + $step];
            }
            $cord["ships"] = 1;
            $cord["img"] = "ship-x";
            if($i +2 >= $size) {
                if($size % 2 == 0) {
                    $cord["img"] = "ship-end-w";
                } else  {
                    $cord["img"] = "ship-end-o";
                }
            }
            if($i +1 >= $size) {
                if($size % 2 == 0) {
                    $cord["img"] = "ship-end-o";
                } else  {
                    $cord["img"] = "ship-end-w";
                }
            }
        }
    }

    return $field;
}
?>