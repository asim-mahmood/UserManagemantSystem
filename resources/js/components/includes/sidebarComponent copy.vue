<template >
    <div>
        <aside class="main-sidebar admin-panel-sidebar sidebar-no-expand border-0 sidebar-custom-spacing" style="background-color: rgb(9 70 88); margin-top: 3.5rem;">
            <div class="sidebar mt-0">
                <!-- <a href="#" class=" pl-3 pt-1 logo" >
                    <span class="">
                        <img src="/images/fiber_logo-updated.png" alt="Flag" class="image-logo-width">
                    </span>
                </a> -->
                <nav class=" mt-2">
                    <ul class="nav nav-sidebar flex-column nav-compact nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
                        <li :class="{ 'selected': isSelected('/admin/dashboard') }" class="border-bottom rounded-0 shadow">
                            <a class="p-2 text-white nav-link active" href="/admin/dashboard">
                            <i class="nav-icon fa fa-home text-md icon nav-item pr-2"></i>Dashboard
                            </a>
                        </li>
                        <li :class="{ 'selected': isSelected('/admin/real_users') }" class="border-bottom rounded-0 shadow">
                            <a class="pl-2 text-white nav-link " href="/admin/real_users">
                            <i class="fa-solid fa-person-circle-plus text-lg nav-icon nav-item pr-2"></i>Users
                            </a>
                        </li>
                        <li :class="{ 'selected': isSelected('/admin/packages') }" class="border-bottom rounded-0 shadow">
                            <a class="pl-2 text-white nav-link " href="/admin/packages">
                            <i class="fa-regular fa-rectangle-list text-md nav-icon nav-item pr-2"></i>Packages
                            </a>
                        </li>
                        <li :class="{ 'selected': isSelected('/admin/inventories') }" class="border-bottom rounded-0 shadow">
                            <a class="pl-2 text-white nav-link " href="/admin/inventories">
                            <i class="fa-solid fa-layer-group text-md nav-icon nav-item pr-2"></i>Inventory
                            </a>
                        </li>
                        <li :class="{ 'selected': isSelected('/admin/employees') }" class="border-bottom rounded-0 shadow">
                            <a class="pl-2 text-white nav-link " href="/admin/employees">
                            <i class="fa-solid fa-user-tie text-md nav-icon nav-item pr-2"></i>Employees
                            </a>
                        </li>
                        <li :class="{ 'selected': isSelected('/admin/complaints') }" class="border-bottom rounded-0 shadow">
                            <a class="pl-2 text-white nav-link " href="/admin/complaints">
                            <i class="fa-solid fa-clipboard-list nav-icon nav-item pr-2"></i>Complaints
                            </a>
                        </li>
                        <li class="rounded-0 shadow" :class="{ 'selected': isSelected('#') }">
                            <button class="btn btn-link pl-2 text-white nav-link " @click="toggleSubMenu"><i class="fa-solid fa-cash-register pr-2"></i>Management <i class="fa-solid fa-caret-down pl-3"></i></button>
                            <ul class="collapse nav nav-sidebar flex-column dropdown-custom" :class="{ 'show': isSubMenuOpen }">
                                    <li :class="{ 'selected': isSelected('/admin/heads') }" class="border-bottom border-top rounded-0 shadow">
                                    <a class="pl-4 text-white nav-link " href="/admin/heads">
                                        <i class="fa-solid fa-book nav-icon nav-item pr-2"></i>Heads
                                    </a>
                                </li>
                                <li :class="{ 'selected': isSelected('/admin/accounts') }" class="border-bottom rounded-0 shadow">
                                    <a class="pl-4 text-white nav-link " href="/admin/accounts">
                                        <i class="fa-solid fa-sack-dollar nav-icon nav-item pr-2"></i>Accounts
                                    </a>
                                </li>
                                <li :class="{ 'selected': isSelected('/admin/ledgers') }" class="border-bottom rounded-0 shadow">
                                    <a class="pl-4 text-white nav-link " href="/admin/ledgers">
                                        <i class="fa-solid fa-file-invoice nav-icon nav-item pr-2"></i>Ledger
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
    </div>
</template>
<script>
export default {
    name:'sidebar-component',
    data() {
        return {
            isSubMenuOpen: false,
            selectedIndex: 0,
            showSubmenu: false 
        }
    },
    created() {
        const isSubMenuOpen = localStorage.getItem('isSubMenuOpen');
        this.isSubMenuOpen = isSubMenuOpen === 'true';
    },
    methods: {
        isSelected(route) {
        return window.location.pathname === route;
    },
    toggleSubMenu() {
      this.isSubMenuOpen = !this.isSubMenuOpen;
      localStorage.setItem('isSubMenuOpen', this.isSubMenuOpen);
    }
  }
}
</script>
<style scoped>
.selected {
    background-color: white; 
    color: white !important;
    opacity: 0.6;
}
@keyframes dropdownAnimation {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Apply the animation to the dropdown menu */
.dropdown-custom {
  animation: dropdownAnimation 0.5s ease-in-out;
}
.selected .nav-link {
  color: #0a4658 !important;
}
.admin-panel-sidebar {
    background-color:#f1f1f177; 
    box-shadow: rgba(0, 0, 0, 0.13) 2.4px 2.4px 3.2px;
}
.image-logo-width{
    width: 10vw !important;
}
.nav-link {

  position: relative;
  z-index: 1;
}

.nav-link:hover {
  color: rgb(0, 217, 255) !important;
}

.selected::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  color: #0a4658;
  z-index: -1;
  margin:0.5rem ;
}
.sidebar-collapse .main-sidebar .logo {
    display: none; /* Optional: Hide the brand/logo when collapsed */
  }

</style>
