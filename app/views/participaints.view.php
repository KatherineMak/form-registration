<?php require('partials/head.php'); ?>

    <div class="card col-8 participaint-card">
        <div class="card-body">

            <h3 class="card-title">All Members</h3>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Photo</th>
                    <th scope="col">First and last name</th>
                    <th scope="col">Report Subject</th>
                    <th scope="col">Email</th>
                </tr>
                </thead>
                <tbody>
                <?php ?>
                <?php foreach ($participaints as $participaint) :?>
                    <tr>
                        <td>
                            <img src="../public/images/<?=$participaint->photo?>" alt="Photo of the participant" height="50" width="50">
                        </td>
                        <td> <?= $participaint->firstname.' '.$participaint->lastname; ?></td>
                        <td> <?= $participaint->reportSubject; ?></td>
                        <td><a href="mailto:<?= $participaint->email; ?>"> <?= $participaint->email; ?> </a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

<?php require('partials/footer.php'); ?>