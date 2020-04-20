<?php $active = 'schedule'; ?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Schedule</title>
    <?php include_once '_head.php' ?>
    <style>

    </style>
</head>

<body>
<?php include_once '_header.php' ?>

<div class="container">
    <!-- Schedule Section Begin -->
    <section class="schedule-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 left-blog-pad">
                    <div class="schedule-text">
                        <h4 class="st-title">DawsonsFC 2020</h4>
                        <div class="st-table">
                            <table>
                                <tbody id="scheduled">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Schedule Section End -->
</div>

<?php include_once '_footer.php' ?>

<?php include_once '_scripts.php' ?>

<script>

    const formatDate = (date) => {
        const d = new Date(date);
        return `${d.getDate()} ${d.toLocaleString('default', {month: 'long'})} ${d.getFullYear()} / ${d.getHours()}:${d.getMinutes()}`;
    };

    const addScheduledFixture = (fixture) => {
        $('#scheduled').append(`
            <tr>
                <td class="left-team">
                    <img src="${'http://localhost/DawsonsFC/' + fixture.home_image}" alt="Home">
                    <h4>${fixture.home_name}</h4>
                </td>
                <td class="st-option">
                    <div class="so-text">${fixture.stadium_name}, ${fixture.stadium_location}</div>
                    <h4>VS</h4>
                    <div class="so-text">${formatDate(fixture.match_date)}</div>
                </td>
                <td class="right-team">
                    <img src="${'http://localhost/DawsonsFC/' + fixture.away_image}" alt="Home">
                    <h4>${fixture.away_name}</h4>
                </td>
            </tr>
        `);
    };

    const getFixtures = () => {
        axios.get('http://localhost/DawsonsFc/api/fixture.php')
            .then(res => {
                $('#scheduled').empty();
                res.data.forEach(fixture => {
                    if (+fixture.match_played === 0) {
                        addScheduledFixture(fixture);
                    }
                });
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