<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            
            </div>
        </div>
    </div>

    <div class="controls">
        <input type="text" id="name">
        <button class="btn" id="join-btn">join</button>
    </div>
    <div class="d-flex justify-content-center w-100">
        <div id="playing-field">
        </div>
    </div>
    <div>
        Select Ship
        <button class="btn place-ship-btn">ship size 3</button>
<!-- 
        <div class="container d-flex draggable-container" id="draggableContainer1">
            <img src="assets/ship2.png" class="img-fluid" style="width:3vw;">
            <img src="assets/shipx.png" class="img-fluid" style="width:3vw;">
            <img src="assets/ship1.png" class="img-fluid" style="width:3vw;">
        </div>

        <div class="container d-flex draggable-container" id="draggableContainer2">
            <img src="assets/ship2.png" class="img-fluid" style="width:3vw;">
            <img src="assets/shipx.png" class="img-fluid" style="width:3vw;">
            <img src="assets/shipx.png" class="img-fluid" style="width:3vw;">
            <img src="assets/shipx.png" class="img-fluid" style="width:3vw;">
            <img src="assets/ship1.png" class="img-fluid" style="width:3vw;">
        </div>

        <div class="container d-flex flex-column align-items-center draggable-container" id="draggableContainer3">
                <img src="assets/ship4.png" class="img-fluid" style="width:3vw;">
                <img src="assets/ship.png" class="img-fluid" style="width:3vw;">
                <img src="assets/ship.png" class="img-fluid" style="width:3vw;">
                <img src="assets/ship.png" class="img-fluid" style="width:3vw;">
                <img src="assets/ship3.png" class="img-fluid" style="width:3vw;">
        </div> -->

    </div>

    <script>
    $(document).ready(function() {
        $('#join-btn').click(function() {
            $.ajax({
                url: 'backend.php',
                type: 'POST',
                data: {
                    action: "join",
                    name: $("#name").val(),
                },
                success: function(res) {
                    $(".controls").hide();
                    $("#playing-field").html(res);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });


        // let active = false;
        // let currentX;
        // let currentY;
        // let initialX;
        // let initialY;
        // let xOffset = 0;
        // let yOffset = 0;
        // let activeContainer = null;
        
        // $('.draggable-container').on('mousedown', function(e) {
        //     activeContainer = $(this);
        //     active = true;
        //     initialX = e.clientX - xOffset;
        //     initialY = e.clientY - yOffset;
        //     activeContainer.css('cursor', 'grabbing');
        // });

        // $(document).on('mouseup', function() {
        //     active = false;
        //     activeContainer.css('cursor', 'grab');
        //     activeContainer = null;
        // });

        // $(document).on('mousemove', function(e) {
        //     if (active && activeContainer !== null) {
        //         e.preventDefault();
        //         currentX = e.clientX - initialX;
        //         currentY = e.clientY - initialY;
        //         xOffset = currentX;
        //         yOffset = currentY;
        //         setTranslate(currentX, currentY, activeContainer);
        //     }
        // });

        // function setTranslate(xPos, yPos, $element) {
        //     $element.css('transform', 'translate3d(' + xPos + 'px, ' + yPos + 'px, 0)');
        // }
    });
</script>
</body>
</html>