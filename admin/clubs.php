<?php include_once '_session.php'; $title = 'Clubs'; ?>

<!DOCTYPE html>
<html lang="en">

<?php include_once '_head.php'; ?>

<body>
<script src="js/auth.js"></script>

<div id="wrapper">

    <?php include_once '_nav.php'; ?>

    <div id="requestOverlay" class="request-overlay" style="display: none;"></div>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Clubs</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Clubs</h4>
                        <button class="btn btn-success" onclick="openFormModal('add')"><i
                                    class="fa fa-plus"></i></button>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="clubsTable">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Coach</th>
                                <th>Year</th>
                                <th>Stadium</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="clubsTableBody">

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


<!-- Club Form Modal -->
<div class="modal fade" id="clubFormModal" tabindex="-1" role="dialog" aria-labelledby="clubFormModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="clubFormModalTitle">Add Club</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="clubForm">
                    <input id="idInput" name="id" class="form-control" type="hidden">
                    <div class="form-group">
                        <label>Name</label>
                        <input id="nameInput" name="name" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input id="locationInput" name="location" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Coach</label>
                        <input id="coachInput" name="coach" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Year Established</label>
                        <input id="yearInput" name="year" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Home Stadium</label>
                        <select class="form-control" name="stadium_id" id="stadiumInput">

                        </select>
                    </div>
                    <div class="form-group">
                        <label>About Club</label>
                        <textarea id="aboutInput" name="about" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input id="imageInput" name="image" class="form-control" type="file">
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

    let selectedClub = undefined;

    const clubTemplate = (club) => `
        <tr data-club="${encodeURIComponent(JSON.stringify((club)))}" onclick="setClub(this)">
            <td><img style="width: 70px;" src="${'http://localhost/DawsonsFC/' + club.image}" alt="Club"></td>
            <td>${club.name}</td>
            <td>${club.location}</td>
            <td>${club.coach}</td>
            <td>${club.year}</td>
            <td>${club.stadium_name}</td>
            <td>
                <button onclick="openFormModal('update')" class="btn btn-info"><i class="fa fa-pencil-square"></i></button>
                <button onclick="deleteClub('${club.id}')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                <button onclick="viewClub('${club.id}', '${club.name}')" class="btn btn-success"><i class="fa fa-arrow-right"></i></button>
            </td>
        </tr>
    `;

    const setClubs = () => {
        $('#requestOverlay').show();
        axios.get('http://localhost/DawsonsFc/api/club.php')
            .then(res => {
                $('#clubsTableBody').empty();
                res.data.forEach(club => {
                    $('#clubsTableBody').append(clubTemplate(club));
                });
                $('#requestOverlay').hide();
            })
            .catch(e => {
                $('#requestOverlay').hide();
                console.error(e);
                alert('Could not get clubs');
            });
    };

    const setStadiums = () => {
        axios.get('http://localhost/DawsonsFc/api/stadium.php')
            .then(res => {
                $('#stadiumInput').empty();
                res.data.forEach(stadium => {
                    $('#stadiumInput').append(`
                        <option value="${stadium.id}">${stadium.name}</option>
                    `);
                });
            })
            .catch(e => {
                console.error(e);
                alert('Could not get stadia');
            });
    };

    const viewClub = (clubId, clubName) => {
        location.href = `club.php?id=${clubId}&club=${clubName}`;
    };

    const submitClub = (data) => {
        $('#requestOverlay').show();
        axios.post('http://localhost/DawsonsFc/api/club.php', data)
            .then(res => {
                $('#clubFormModal').modal('hide');
                $('#requestOverlay').hide();
                setClubs();
            })
            .catch(e => {
                $('#clubFormModal').modal('hide');
                $('#requestOverlay').hide();
                console.error(e);
                alert('could not update club');
            })
    };

    const deleteClub = (clubId) => {
        $('#requestOverlay').show();
        if (confirm('Are you sure you want to delete this club?')) {
            axios.delete(`http://localhost/DawsonsFc/api/club.php?id=${clubId}`)
                .then(res => {
                    $('#requestOverlay').hide();
                    setClubs();
                })
                .catch(e => {
                    $('#requestOverlay').hide();
                    console.error(e);
                    alert('could not delete club');
                })
        }
    };

    const openFormModal = (type) => {
        if (type === 'add') {
            $('#idInput').val('');
            $('#nameInput').val('');
            $('#locationInput').val('');
            $('#coachInput').val('');
            $('#yearInput').val('');
            $('#stadiumInput').val('');
            $('#aboutInput').text('');
            $('#clubFormModalTitle').text('Add Club');
        }
        $('#clubFormModal').modal('show');
    };

    const setClub = (obj) => {
        selectedClub = JSON.parse(decodeURIComponent($(obj).data('club')));
        console.log(selectedClub);
        $('#idInput').val(selectedClub.id);
        $('#nameInput').val(selectedClub.name);
        $('#locationInput').val(selectedClub.location);
        $('#coachInput').val(selectedClub.coach);
        $('#yearInput').val(selectedClub.year);
        $('#stadiumInput').val(selectedClub.stadium_id);
        $('#aboutInput').text(selectedClub.about);
        $('#clubFormModalTitle').text('Edit Club Details');
    };

    $(document).ready(function () {
        // requireAdmin();

        setClubs();
        setStadiums();

        $('#clubForm').submit(e => {
            e.preventDefault();
            submitClub(new FormData($('#clubForm')[0]));
        });
    });
</script>

</body>

</html>
