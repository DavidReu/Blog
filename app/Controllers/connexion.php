<?php
$mail = "user@mail.com";
$mdp = "test";
if ($_POST["email"] == $mail && $_POST["mdp"] == $mdp) {
    header("Location:../Views/articleView.php");
} else { ?>
    <div class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Erreur de saisie</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>