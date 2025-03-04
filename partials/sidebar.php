<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #000; color: #fff;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../dashboard/index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-school"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Registrar System</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="../dashboard/index.php">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Students -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#studentMenu"
            aria-expanded="true" aria-controls="studentMenu">
            <i class="fas fa-user-graduate"></i>
            <span>Students</span>
        </a>
        <div id="studentMenu" class="collapse" aria-labelledby="studentHeading" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-white" href="../students/view.php">Student List</a>
                <a class="collapse-item text-white" href="../students/enrollment.php">Enrollment</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Faculty -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#facultyMenu"
            aria-expanded="true" aria-controls="facultyMenu">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Faculty</span>
        </a>
        <div id="facultyMenu" class="collapse" aria-labelledby="facultyHeading" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-white" href="../faculty/view.php">Faculty List</a>
                <a class="collapse-item text-white" href="../faculty/assignments.php">Class Assignments</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Courses & Subjects -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#courseMenu"
            aria-expanded="true" aria-controls="courseMenu">
            <i class="fas fa-book-open"></i>
            <span>Courses & Subjects</span>
        </a>
        <div id="courseMenu" class="collapse" aria-labelledby="courseHeading" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-white" href="../courses/view.php">Course List</a>
                <a class="collapse-item text-white" href="../subjects/view.php">Subject List</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Document Requests -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#documentMenu"
            aria-expanded="true" aria-controls="documentMenu">
            <i class="fas fa-file-alt"></i>
            <span>Document Requests</span>
        </a>
        <div id="documentMenu" class="collapse" aria-labelledby="documentHeading" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-white" href="../documents/view.php">Request List</a>
                <a class="collapse-item text-white" href="../documents/status.php">Track Requests</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Reports -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reportMenu"
            aria-expanded="true" aria-controls="reportMenu">
            <i class="fas fa-chart-line"></i>
            <span>Reports</span>
        </a>
        <div id="reportMenu" class="collapse" aria-labelledby="reportHeading" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-white" href="../reports/academic.php">Academic Reports</a>
                <a class="collapse-item text-white" href="../reports/enrollment.php">Enrollment Reports</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Settings -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#settingsMenu"
            aria-expanded="true" aria-controls="settingsMenu">
            <i class="fas fa-cogs"></i>
            <span>Settings</span>
        </a>
        <div id="settingsMenu" class="collapse" aria-labelledby="settingsHeading" data-parent="#accordionSidebar">
            <div class="bg-dark py-2 collapse-inner rounded">
                <a class="collapse-item text-white" href="../settings/profile.php">Profile</a>
                <a class="collapse-item text-white" href="../settings/system.php">System Settings</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
