<?php $active = 'clubs'; ?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Home</title>
    <?php include_once '_head.php' ?>
</head>

<body>
<?php include_once '_header.php' ?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bs-text">
                    <h2 class="clubName"></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Club Section Begin -->
<section class="club-section spad">
    <div class="container">
        <div class="club-content">
            <div class="row">
                <div class="col-lg-5">
                    <div class="cc-pic">
                        <img class="clubImage" src="img/club-logo.png" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="cc-text">
                        <div class="ct-title">
                            <h3 class="clubName"></h3>
                            <p class="clubAbout"></p>
                        </div>
                        <div class="ct-widget">
                            <ul>
                                <li>
                                    <h5>Established</h5>
                                    <p>Since <span class="clubYear"></span></p>
                                </li>
                                <li>
                                    <h5>Coach</h5>
                                    <p class="clubCoach"></p>
                                </li>
                                <li>
                                    <h5>Location</h5>
                                    <p class="clubLocation"></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="club-tab-list">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Players</a>
                        </li>
                    </ul><!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="club-tab-content" id="players">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Club Section End -->

<?php include_once '_footer.php' ?>

<?php include_once '_scripts.php' ?>

<script>
    const getPlayers = () => {
        axios.get('http://localhost/DawsonsFc/api/player.php?club_id=<?php echo $_GET['id'] ?>')
            .then(res => {
                $('#players').empty();
                res.data.forEach(player => {
                    $('#players').append(`
                        <div class="ct-item">
                            <div class="ci-text">
                                <img src="${'http://localhost/DawsonsFC/' + player.image}" alt="Player">
                                <h5>${player.player_number}. ${player.name}</h5>
                                <p>${player.dob}</p>
                            </div>
                            <div class="ci-name">${player.position}</div>
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
                alert('Could not get players');
            });
    };

    const getClubDetails = () => {
        axios.get('http://localhost/DawsonsFc/api/club.php?id=<?php echo $_GET['id'] ?>')
            .then(res => {
                $('.clubName').text(res.data.name);
                $('.clubAbout').text(res.data.about);
                $('.clubYear').text(res.data.year);
                $('.clubCoach').text(res.data.coach);
                $('.clubLocation').text(res.data.location);
                $('.clubImage').attr('src', `http://localhost/DawsonsFC/${res.data.image}`);
                $('#preloder').hide();
            })
            .catch(e => {
                console.error(e);
                alert('Could not get clubs');
            });
    };

    $(document).ready(() => {
        getPlayers();
        getClubDetails();
    });
</script>

</body>

</html>