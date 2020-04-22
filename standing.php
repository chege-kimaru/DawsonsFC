<?php $active = 'standing'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once '_head.php' ?>
    <title>Standings</title>

    <style>
        .ranking {
            margin-top: 2rem;
        }
    </style>
</head>
<body>
<?php include_once '_header.php' ?>

<div class="ranking">
    <!-- Latest Section Begin -->
    <section class="latest-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h3>Club <span>Ranking</span></h3>
                    </div>
                    <div class="points-table">
                        <table>
                            <thead>
                            <tr>
                                <th class="th-o">Pos</th>
                                <th>Team</th>
                                <th class="th-o">M</th>
                                <th class="th-o">W</th>
                                <th class="th-o">L</th>
                                <th class="th-o">D</th>
                                <th class="th-o">GD</th>
                                <th class="th-o">PTS</th>
                            </tr>
                            </thead>
                            <tbody id="standings">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Section End -->
</div>

<?php include_once '_footer.php' ?>

<?php include_once '_scripts.php' ?>

<script>
    const standings = [];

    const generateStandings = (clubs, fixtures) => {
        clubs.forEach(club => {
            const standing = {club};
            const clubFixtures = fixtures.filter(fixture => {
                return +fixture.match_played === 1 && (fixture.home_id === club.id || fixture.away_id === club.id);
            });
            let matches = 0, draws = 0, wins = 0, loses = 0, gd = 0, points = 0;
            clubFixtures.forEach(f => {
                if (f.home_id === club.id) {
                    if (+f.goals_home > +f.goals_away) {
                        wins++;
                        gd += (+f.goals_home - +f.goals_away);
                        points += 3;
                    } else if (+f.goals_home < +f.goals_away) {
                        loses++;
                        gd += (+f.goals_home - +f.goals_away);
                    } else {
                        draws++;
                        points += 1;
                    }
                } else {
                    if (+f.goals_home > +f.goals_away) {
                        loses++;
                        gd += (+f.goals_home - +f.goals_away);
                    } else if (+f.goals_home < +f.goals_away) {
                        wins++;
                        gd += (+f.goals_home - +f.goals_away);
                        points += 3;
                    } else {
                        draws++;
                        points += 1;
                    }
                }
                matches++;
            });
            standing.matches = matches;
            standing.draws = draws;
            standing.wins = wins;
            standing.loses = loses;
            standing.gd = gd;
            standing.points = points;
            standings.push(standing);
        });
        standings.sort((a, b) => {
           if(a.points === b.points) return b.gd - a.gd;
           return b.points - a.points;
        });
    };

    const displayStandings = () => {
        $('#standings').empty();
        let i = 0;
        standings.forEach(standing => {
            i++;
            $('#standings').append(`
                <tr>
                    <td>${i}</td>
                    <td class="team-name">
                        <img src="http://localhost/DawsonsFC/${standing.club.image}" alt="">
                        <span>${standing.club.name}</span>
                    </td>
                    <td>${standing.matches}</td>
                    <td>${standing.wins}</td>
                    <td>${standing.loses}</td>
                    <td>${standing.draws}</td>
                    <td>${standing.gd}</td>
                    <td>${standing.points}</td>
                </tr>
            `);
        });
    };

    const getData = async () => {
        try {
            let res = await axios.get('http://localhost/DawsonsFc/api/fixture.php');
            const fixtures = res.data;

            res = await axios.get('http://localhost/DawsonsFc/api/club.php');
            const clubs = res.data;

            generateStandings(clubs, fixtures);
            displayStandings();

            $(".loader").fadeOut();
            $("#preloder").delay(200).fadeOut("slow");
        } catch (error) {
            $(".loader").fadeOut();
            $("#preloder").delay(200).fadeOut("slow");
            console.error(error);
            alert('Could not get fixtures');
        }
    };

    $(document).ready(() => {
        getData();
    });
</script>
</body>
</html>