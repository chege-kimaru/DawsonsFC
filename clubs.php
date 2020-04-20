<?php $active = 'clubs'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Schedule</title>
    <?php include_once '_head.php' ?>

    <style>
        .clubs {
            margin-top: 2rem;
        }
    </style>
</head>

<body>
<?php include_once '_header.php' ?>
<div class="container clubs">
    <div class="row" id="clubs">

    </div>
</div>

<?php include_once '_footer.php' ?>

<?php include_once '_scripts.php' ?>

<script>

    const getClubs = () => {
        axios.get('http://localhost/DawsonsFc/api/club.php')
            .then(res => {
                $('#clubs').empty();
                res.data.forEach(club => {
                    $('#clubs').append(`
                        <div class="col-sm-4 col-lg-3">
                            <div class="news-item">
                                <div class="ni-pic">
                                    <img src="${'http://localhost/DawsonsFC/' + club.image}" alt="Home">
                                </div>
                                <div class="ni-text">
                                    <h5><a href="club.php?id=${club.id}">${club.name}</a></h5>
                                    <p style="font-size: 0.7em">${club.location}</p>
                                </div>
                            </div>
                        </div>
                    `);
                });
                $(".loader").fadeOut();
                $("#preloder").delay(200).fadeOut("slow");
            })
            .catch(e => {
                $(".loader").fadeOut();
                $("#preloder").delay(200).fadeOut("slow");
                console.error(e);
                alert('Could not get clubs');
            });
    };

    $(document).ready(() => {
        getClubs();
    });
</script>
</body>
</html>