<?php
$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;
$s = (isset($_GET['s'])) ? $_GET['s'] : '';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PhoneBook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="row p-3">

        <div class="col-12 col-sm-12 col-md-3">
            <div class="mb-3 mt-3">
                <div>
                    <h1 class="mb-3">Phone Book</h1>
                </div>
            </div>

            <form class="row mt-2 mb-3" action="">
                <span class="col-9 mt-3">
                    <input type="text" name="s" class="form-control" placeholder="search names">
                </span>
                <span class="col-3 mt-3">
                    <button type="submit" class="btn btn-primary">Click</button>
                </span>
            </form>

            <form class="row row-cols-1 g-2" method="POST" action="#">
                <div class="col">
                    <label for="FirstName" class="form-label">FirstName:</label>
                    <input type="text" name="fname" class="form-control" id="FirstName">
                </div>
                <div class="col">
                    <label for="LastName" class="form-label">LastName:</label>
                    <input type="text" name="lname" class="form-control" id="LastName">
                </div>
                <div class="col">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
                <div class="col">
                    <label for="Number" class="form-label">PhoneNumber:</label>
                    <input type="text" name="number" class="form-control" id="Number">
                </div>
                <div class="col">
                    <button type="submit" name="submit" class="btn btn-success" id="btn">Add to list</button>
                </div>
            </form>
        </div>






        <div class="col-12 col-sm-12 col-md-9">
            <div class="mb-3 mt-3">

                <span>
                    <div>
                        <a class="btn btn-secondary"
                            href="<?= ($_ENV['HOST'] . '?page=' . 1 . '&s=' . $s) ?>"
                            aria-label="First">
                            <span aria-hidden="true">FIRST</span>
                        </a>

                        <a class="btn btn-danger"
                            href="<?= ($page > 1) ? ($_ENV['HOST'] . '?page=' . $page - 1 . '&s=' . $s) : ($_ENV['HOST'] . '?page=' . 1 . '&s=' . $s) ?>"
                            aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>

                        <button type="button" class="btn btn-warning"><?php echo $page ?></button>

                        <a class="btn btn-success"
                            href="<?= ($_ENV['HOST'] . '?page=' . $page + 1 . '&s=' . $s) ?>"
                            aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>

                        <a class="btn btn-secondary"
                            href="<?= ($_ENV['HOST'] . '?page=' . floor($N / $M) + 1) . '&s=' . $s ?>"
                            aria-label="LAST">
                            <span aria-hidden="true">LAST</span>
                        </a>
                    </div>
                </span>

                <?php if (isset($s)) : ?>
                    <h2>Search Results for <span class="text-warning"><?= $s ?></span> :</h2>
                <?php endif ?>

            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col">#</th>
                            <th scope="col">FirstName</th>
                            <th scope="col">LastName</th>
                            <th scope="col">Number</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contacts as $contact) : ?>
                            <tr>
                                <th scope="row"><?= $contact['id'] ?></th>
                                <td><?= $contact['first_name'] ?></td>
                                <td><?= $contact['last_name'] ?></td>
                                <td><?= $contact['number'] ?></td>
                                <td><?= $contact['email'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>