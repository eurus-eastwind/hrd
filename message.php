<?php
if(isset($_SESSION["message"]))
{
    ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert" > <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Hello!</strong> <?= $_SESSION["message"]; ?>
        </div>
    <?php
    unset($_SESSION["message"]);
}
?>