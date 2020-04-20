<?php $active = 'home'; ?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Home</title>
    <?php include_once '_head.php' ?>
    <style>
        .hero-section {
            height: 400px;
        }
    </style>
</head>

<body>
<?php include_once '_header.php' ?>

<!-- Hero Section Begin -->
<section class="hero-section set-bg" data-setbg="img/hero/hero-1.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="hs-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="hs-text" id="comingUp">
                                    <h4>9TH SEPTEMBER 2020, 9:00AM</h4>
                                    <h2>TEAM A VS TEAM B</h2>
                                    <a href="#" class="primary-btn">Don't miss</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Match Section Begin -->
<section class="match-section set-bg" data-setbg="img/match/match-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="ms-content">
                    <h4>Next Match</h4>
                    <div id="scheduled">

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ms-content">
                    <h4>Recent Results</h4>
                    <div id="results"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Match Section End -->


<?php include_once '_footer.php' ?>

<?php include_once '_scripts.php' ?>

<script>

    const formatDate = (date) => {
        const d = new Date(date);
        return `${d.getDate()} ${d.toLocaleString('default', {month: 'long'})} ${d.getFullYear()} / ${d.getHours()}:${d.getMinutes()}`;
    };

    const setComingUpFixture = (fixture) => {
        $('#comingUp').empty().append(`
            <h4>${formatDate(fixture.match_date)}</h4>
            <h2>${fixture.home_name} VS ${fixture.away_name}</h2>
            <a href="#" class="primary-btn">Don't miss</a>
        `);
    };

    const setLatestResult = (fixture) => {
        $('#comingUp').empty().append(`
            <h4>${formatDate(fixture.match_date)}</h4>
            <h2>${fixture.home_name} VS ${fixture.away_name}</h2>
            <a href="#" class="primary-btn">${fixture.goals_home} : ${fixture.goals_away}</a>
        `);
    };

    const setNothing = () => {
        $('#comingUp').empty().append(`
            <h4>No Upcoming Games</h4>
            <a href="#" class="primary-btn">Tune in Later</a>
        `);
    };

    const addScheduledFixture = (fixture) => {
        const d = new Date(fixture.match_date);
        $('#scheduled').append(`
            <div class="mc-table">
                <table>
                    <tbody>
                    <tr>
                        <td class="left-team">
                            <img src="${'http://localhost/DawsonsFC/' + fixture.home_image}" alt="Home">
                            <h6>${fixture.home_name}</h6>
                        </td>
                        <td class="mt-content">
                            <div class="mc-op">${fixture.home_name} vs ${fixture.away_name}</div>
                            <h4>VS</h4>
                            <div class="mc-op">${formatDate(fixture.match_date)}</div>
                        </td>
                        <td class="right-team">
                            <img src="${'http://localhost/DawsonsFC/' + fixture.away_image}" alt="Home">
                            <h6>${fixture.away_name}</h6>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        `);
    };

    const addResultFixture = (fixture) => {
        $('#results').append(`
            <div class="mc-table">
                <table>
                    <tbody>
                    <tr>
                        <td class="left-team">
                            <img src="${'http://localhost/DawsonsFC/' + fixture.home_image}" alt="Home">
                            <h6>${fixture.home_name}</h6>
                        </td>
                        <td class="mt-content">
                            <div class="mc-op">${fixture.home_name} vs ${fixture.away_name}</div>
                            <h4>${fixture.goals_home} : ${fixture.goals_away}</h4>
                            <div class="mc-op">${formatDate(fixture.match_date)}</div>
                        </td>
                        <td class="right-team">
                            <img src="${'http://localhost/DawsonsFC/' + fixture.away_image}" alt="Home">
                            <h6>${fixture.away_name}</h6>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        `);
    };

    const getFixtures = () => {
        axios.get('http://localhost/DawsonsFc/api/fixture.php')
            .then(res => {
                $('#results').empty();
                $('#scheduled').empty();
                let comingUpSet = false;
                let latestResult = null;
                let resultsCount = 0;
                let scheduledCount = 0;
                res.data.forEach(fixture => {
                    if (!comingUpSet) {
                        if (fixture.match_date > new Date()) {
                            setComingUpFixture(fixture);
                            comingUpSet = true;
                        }
                    }
                    if (+fixture.match_played === 1 && resultsCount <= 5) {
                        latestResult = fixture;
                        addResultFixture(fixture);
                        resultsCount++;
                    }
                    if (+fixture.match_played === 0 && scheduledCount <= 5) {
                        addScheduledFixture(fixture);
                        scheduledCount++;
                    }
                });
                if (!comingUpSet && !latestResult) {
                    setNothing();
                } else if (latestResult) {
                    setLatestResult(latestResult);
                }
                $(".loader").fadeOut();
                $("#preloder").delay(200).fadeOut("slow");
            })
            .catch(e => {
                $(".loader").fadeOut();
                $("#preloder").delay(200).fadeOut("slow");
                console.error(e);
                alert('Could not get fixtures');
            });
    };

    $(document).ready(() => {
        getFixtures();
    });
</script>
</body>

</html>