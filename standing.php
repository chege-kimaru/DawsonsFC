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
                                <th class="th-o">P</th>
                                <th class="th-o">W</th>
                                <th class="th-o">L</th>
                                <th class="th-o">PTS</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td class="team-name">
                                    <img src="img/flag/flag-1.jpg" alt="">
                                    <span>Afghanis</span>
                                </td>
                                <td>22</td>
                                <td>2</td>
                                <td>5</td>
                                <td>72</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="team-name">
                                    <img src="img/flag/flag-2.jpg" alt="">
                                    <span>Australia</span>
                                </td>
                                <td>20</td>
                                <td>3</td>
                                <td>4</td>
                                <td>71</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td class="team-name">
                                    <img src="img/flag/flag-3.jpg" alt="">
                                    <span>Qatar</span>
                                </td>
                                <td>18</td>
                                <td>4</td>
                                <td>4</td>
                                <td>68</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td class="team-name">
                                    <img src="img/flag/flag-4.jpg" alt="">
                                    <span>Cambodia</span>
                                </td>
                                <td>17</td>
                                <td>2</td>
                                <td>7</td>
                                <td>64</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td class="team-name">
                                    <img src="img/flag/flag-5.jpg" alt="">
                                    <span>Uzbekistan</span>
                                </td>
                                <td>17</td>
                                <td>2</td>
                                <td>6</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td class="team-name">
                                    <img src="img/flag/flag-6.jpg" alt="">
                                    <span>Turkme</span>
                                </td>
                                <td>161</td>
                                <td>1</td>
                                <td>8</td>
                                <td>57</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td class="team-name">
                                    <img src="img/flag/flag-7.jpg" alt="">
                                    <span>Sri Lanka</span>
                                </td>
                                <td>15</td>
                                <td>4</td>
                                <td>8</td>
                                <td>52</td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td class="team-name">
                                    <img src="img/flag/flag-8.jpg" alt="">
                                    <span>Myanmar</span>
                                </td>
                                <td>14</td>
                                <td>3</td>
                                <td>7</td>
                                <td>48</td>
                            </tr>
                            </tbody>
                        </table>
                        <a href="#" class="p-all">View All</a>
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
    $(document).ready(() => {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");
    })
</script>
</body>
</html>