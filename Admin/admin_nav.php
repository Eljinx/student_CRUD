<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    *,::before,::after{
        box-sizing: border-box;
    }

    a{
        text-decoration: none;
    }

    .sidebar{
        width: 300px;
        height: 100vh;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .nav-item{
        padding: 10px 0;
    }

    .nav-item:hover{
        color: #ffffff;
        text-decoration: none;
        background-color: rgb(95, 99, 95);
        border-left: 5px solid #158920;
    }
    .nav-link{
        color: #fff;
    }

    .nav-link:hover{
        color: #fff;
    }

    .header {
        color: #fff;
        height: 100px;
        text-align: center;
        padding: 10px;
        margin-bottom: 1rem;
    }
</style>

    <aside class="col-md-3 col-lg-2 bg-dark sidebar">
        <div class="header">
            <h3><i class="bi bi-people-fill"></i></h3>
            <h6>Student Management</h6>
            <h3><strong>ADMIN PANEL</strong></h3>
        </div>
        <div class="content mt-5">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="./admin_dashboard.php">
                        <i class="bi bi-person me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./admin_studentList.php">
                        <i class="bi bi-person me-2"></i>
                        Manage Students
                    </a>
                </li>
            </ul>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="./admin_createAccount.php">
                        <i class="bi bi-person-plus me-2"></i>
                        Create Admin Account
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="logout-button">
                        <i class="bi bi-box-arrow-left me-2"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </aside>

<!-- Bootstrap JavaScript Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="../jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Magdagdag ng event listener sa logout button
        $('#logout-button').on('click', function() {
            // Gumawa ng AJAX request para tawagan ang logout.php
            $.ajax({
                type: 'POST',
                url: '../logout.php',
                success: function() {
                    // Kapag matagumpay ang logout, i-redirect ang user sa index.php
                    window.location.href = '../index.php';
                },
                error: function() {
                    // Magpakita ng error message kung hindi matagumpay ang request
                    alert('Logout failed. Please try again.');
                }
            });
        });
    });

</script>



