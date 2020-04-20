<?php $title = 'Fixtures'; ?>

<!DOCTYPE html>
<html lang="en">

<?php include_once '_head.php'; ?>

<body>

<div id="wrapper">

    <?php include_once '_nav.php'; ?>

    <div id="requestOverlay" class="request-overlay" style="display: none;"></div>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Fixtures</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Fixtures</h4>
                        <button class="btn btn-success" onclick="openFormModal('add')"><i
                                    class="fa fa-plus"></i></button>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Clubs</th>
                                <th>Date</th>
                                <th>Match Played</th>
                                <th>Score</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="fixturesTableBody">

                            </tbody>
                        </table>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->


<!-- Fixture Form Modal -->
<div class="modal fade" id="fixtureFormModal" tabindex="-1" role="dialog" aria-labelledby="fixtureFormModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fixtureFormModalTitle">Add Fixture</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="fixtureForm">
                    <input id="idInput" name="id" class="form-control" type="hidden">
                    <div class="form-group">
                        <label>Home Club</label>
                        <select id="homeInput" name="home_id" class="form-control">

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Away Club</label>
                        <select id="awayInput" name="away_id" class="form-control">

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input id="dateInput" name="match_date" class="form-control" type="datetime-local">
                    </div>
                    <h5>Please fill the following only if the match has been played</h5>
                    <div class="form-group">
                        <label>Match Played?</label>
                        <select id="playedInput" name="match_played" class="form-control">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Home Goals</label>
                        <input id="homeGoalsInput" name="goals_home" class="form-control" type="number">
                    </div>
                    <div class="form-group">
                        <label>Away Goals</label>
                        <input id="awayGoalsInput" name="goals_away" class="form-control" type="number">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<?php include_once '_scripts.php'; ?>

<script type="text/javascript">

    let selectedFixture = undefined;

    const fixtureTemplate = (fixture) => {
        return `
            <tr data-fixture="${encodeURIComponent(JSON.stringify((fixture)))}" onclick="setFixture(this)">
                <td>${fixture.home_name} VS ${fixture.away_name}</td>
                <td>${fixture.match_date}</td>
                <td>${+fixture.match_played === 1 ? 'Yes' : 'No'}</td>
                <td>${+fixture.match_played === 1 ? fixture.goals_home + ':' + fixture.goals_away : ''} </td>
                <td>
                    <button onclick="openFormModal('update')" class="btn btn-info"><i class="fa fa-pencil-square"></i></button>
                    <button onclick="deleteFixture('${fixture.id}')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        `
    };

    const setFixtures = () => {
        $('#requestOverlay').show();
        axios.get('http://localhost/DawsonsFc/api/fixture.php')
            .then(res => {
                $('#fixturesTableBody').empty();
                res.data.forEach(fixture => {
                    $('#fixturesTableBody').append(fixtureTemplate(fixture));
                });
                $('#requestOverlay').hide();
            })
            .catch(e => {
                $('#requestOverlay').hide();
                console.error(e);
                alert('Could not get fixtures');
            });
    };

    const setClubs = () => {
        axios.get('http://localhost/DawsonsFc/api/club.php')
            .then(res => {
                $('#homeInput').empty();
                $('#awayInput').empty();
                res.data.forEach(club => {
                    $('#homeInput').append(`
                        <option value="${club.id}">${club.name}</option>
                    `);
                    $('#awayInput').append(`
                        <option value="${club.id}">${club.name}</option>
                    `);
                });
            })
            .catch(e => {
                console.error(e);
                alert('Could not get stadia');
            });
    };

    const deleteFixture = (fixtureId) => {
        $('#requestOverlay').show();
        if (confirm('Are you sure you want to delete this fixture?')) {
            axios.delete(`http://localhost/DawsonsFc/api/fixture.php?id=${fixtureId}`)
                .then(res => {
                    $('#requestOverlay').hide();
                    setFixtures();
                })
                .catch(e => {
                    $('#requestOverlay').hide();
                    console.error(e);
                    alert('could not delete fixture');
                })
        }
    };

    const submitFixture = (data) => {
        $('#requestOverlay').show();
        axios.post(`http://localhost/DawsonsFc/api/fixture.php`, data)
            .then(res => {
                $('#fixtureFormModal').modal('hide');
                $('#requestOverlay').hide();
                setFixtures();
            })
            .catch(e => {
                $('#requestOverlay').hide();
                console.error(e);
                alert('could not update fixture');
            })
    };

    const openFormModal = (type) => {
        if (type === 'add') {
            $('#idInput').val('');
            $('#homeInput').val('');
            $('#awayInput').val('');
            $('#dateInput').val('');
            $('#playedInput').val('');
            $('#homeGoalsInput').val('');
            $('#awayGoalsInput').val('');
            $('#fixtureFormModalTitle').text('Add Fixture');
        }
        $('#fixtureFormModal').modal('show');
    };

    const setFixture = (obj) => {
        selectedFixture = JSON.parse(decodeURIComponent($(obj).data('fixture')));

        $('#idInput').val(selectedFixture.id);
        $('#homeInput').val(selectedFixture.home_id);
        $('#awayInput').val(selectedFixture.away_id);
        $('#dateInput').val(selectedFixture.custom_match_date);
        $('#playedInput').val(selectedFixture.match_played);
        $('#homeGoalsInput').val(selectedFixture.goals_home);
        $('#awayGoalsInput').val(selectedFixture.goals_away);
        $('#fixtureFormModalTitle').text('Edit Fixture Details');
    };

    $(document).ready(function () {
        // requireAdmin();

        setFixtures();
        setClubs();

        $('#fixtureForm').submit(e => {
            e.preventDefault();
            submitFixture(new FormData($('#fixtureForm')[0]));
        });
    });
</script>

</body>

</html>
