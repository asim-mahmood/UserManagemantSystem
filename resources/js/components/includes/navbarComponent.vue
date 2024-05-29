<template >
    <div>
        <nav class="main-header navbar navbar-expand navbar-light text-sm nav-shadow ml-0" style="margin-left: 0rem !important;">
            <a href="#" class="">
                <span class="">
                    <img src="/images/fiber_logo-updated.png" alt="Flag" class="image-logo-width">
                </span>
            </a>
        <!-- Left navbar links -->
            <!-- <ul class="navbar-nav">
                <li class="nav-item">

                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul> -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <div class="nav-link px-0" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" style="cursor: pointer">
                        <div class="user-panel user d-flex align-items-center">
                            <div class="">
                                <i class="material-symbols-outlined">account_circle</i>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-menu user-panel-dropdown">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-key mr-2"></i> Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="/admin/logout" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <div class="nav-link px-0" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" style="cursor: pointer">
                        <div class="user-panel user d-flex align-items-center">
                            <div class="">
                                <i class="material-symbols-outlined">notifications</i>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <div class="nav-link px-0" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false" style="cursor: pointer">
                        <div class="user-panel user d-flex align-items-center">
                            <div class="">
                                <i class="material-symbols-outlined">settings</i>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars text-white"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>
<script>
    export default {
        name:'navbar-component'
    }
</script>
<style scoped>
    .user {
        display: inline-block; /* Ensures that the element is treated as a block, but lays out as an inline-level element */
        overflow: hidden; /* Prevents content from overflowing */
        border-radius: 50%;
        width: 38px;
        height: 35px;
        padding: 8px;
        transition: background-color 0.6s, box-shadow 0.6s; /* Adding transition for smooth effect */
        color: white !important;
    }

    .user:hover {
        background-color: #97defa; /* Set your desired background color on hover */
        box-shadow: rgba(0, 0, 0, 0.15) 2.4px 2.4px 3.2px; /* Add a little shadow on hover */
        transition: background-color 0.6s, box-shadow 0.6s ease-in-out;
        color:#3f3f3f !important;
    }

    .user i {
        font-size: 24px;
        padding-top: 7px;
        /* color: #495057 !important; */
    }
    .nav-shadow {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background-color: #ffa327;/* Adjust the values as needed */
    }
    .rounded-pill{
        border-radius: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .search-button{
        position: relative;
        left: -32px;
        padding: 1px 33px;
    }
    .image-logo-width{
        width: 10vw !important;
    }
</style>

