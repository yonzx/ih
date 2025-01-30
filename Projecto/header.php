<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<style>
    /* Light Mode Styles */
    body.light-mode {
        background-color: #f8f9fa;
        color: #212529;
    }

    /* Dark Mode Styles */
    body.dark-mode {
        background-color: #343a40;
        color: #ffffff;
    }

    .logo {
        width: 120px;
        height: 120px;
    }

    .logout {
        color: white;
    }

    .logout:hover {
        color: red;
    }

    /* Layout */
    .wrapper {
        display: flex;
        width: 100%;
        min-height: 100vh;
        align-items: stretch;
    }

    #sidebar {
        width: 250px;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        z-index: 999;
        min-width: 250px;
        max-width: 250px;
        background: #343a40;
        color: #fff;
        transition: all 0.3s;
    }

    #sidebar .sidebar-header {
        padding: 20px;
        background: #2c3136;
    }

    #sidebar .sidebar-header img {
        max-width: 100%;
        height: auto;
    }

    #sidebar ul.components {
        padding: 20px 0;
    }

    #sidebar ul p {
        color: #fff;
        padding: 10px;
    }

    #sidebar ul li a {
        padding: 10px 20px;
        font-size: 1.1em;
        display: block;
        color: #fff;
        text-decoration: none;
    }

    #sidebar ul li a:hover {
        background: #2c3136;
    }

    #sidebar ul li.active > a {
        background: #2c3136;
    }

    #sidebar ul ul a {
        font-size: 0.9em !important;
        padding-left: 40px !important;
    }

    #content {
        width: calc(100% - 250px);
        margin-left: 250px;
        min-height: 100vh;
        flex: 1;
        overflow-y: auto;
    }

    /* Dark mode toggle button */
    #darkModeToggle, #themeToggle {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        padding: 0;
    }

    /* Navigation styles */
    .nav-link {
        padding: 10px 15px;
        transition: all 0.3s;
    }

    .nav-link:hover,
    .nav-link.active {
        background-color: #0d6efd;
        border-radius: 4px;
    }

    /* Accordion customization */
    .accordion-button:not(.collapsed) {
        background-color: transparent;
        box-shadow: none;
    }

    .accordion-button:focus {
        box-shadow: none;
    }

    /* Search box */
    .search-box {
        width: 300px;
    }

    .page-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    /* Content Styles */
    html, body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
    }

    .btn-fixed {
        width: 90px; /* Fixed width to make both Edit and Save buttons the same size */
    }

    .input-hidden {
        display: none;
    }
</style>