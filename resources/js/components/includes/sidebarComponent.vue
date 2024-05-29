<template>
    <div>
        <aside class="main-sidebar admin-panel-sidebar elevation-4">
            <div class="sidebar mt-0">
                <nav class=" mt-2">
                    <ul class="nav nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <li :class="{ 'selected': isSelected('/admin/dashboard') }"
                            class="border-bottom rounded-0 shadow nav-item menu-open">
                            <a class="text-white nav-link active pl-2" href="/admin/dashboard">
                                <i class="nav-icon fa fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li :class="{ 'selected': isSelected('/admin/real_users') }"
                            class="border-bottom rounded-0 shadow">
                            <a class=" text-white nav-link " href="/admin/real_users">
                                <i class="fa-solid fa-person-circle-plus nav-icon"></i>
                                <p class="pl-2">Users</p>
                            </a>
                        </li>
                        <li :class="{ 'selected': isSelected('/admin/packages') }"
                            class="border-bottom rounded-0 shadow">
                            <a class="text-white nav-link " href="/admin/packages">
                                <i class="fa-regular fa-rectangle-list nav-icon"></i>
                                <p class="pl-2">Packages</p>
                            </a>
                        </li>
                        <li :class="{ 'selected': isSelected('/admin/inventories') }"
                            class="border-bottom rounded-0 shadow">
                            <a class="text-white nav-link " href="/admin/inventories">
                                <i class="fa-solid fa-layer-group nav-icon"></i>
                                <p class="pl-2">Inventory</p>
                            </a>
                        </li>
                        <li :class="{ 'selected': isSelected('/admin/employees') }"
                            class="border-bottom rounded-0 shadow">
                            <a class="text-white nav-link " href="/admin/employees">
                                <i class="fa-solid fa-user-tie nav-icon"></i>
                                <p class="pl-2">Employees</p>
                            </a>
                        </li>
                        <li :class="{ 'selected': isSelected('/admin/complaints') }"
                            class="border-bottom rounded-0 shadow">
                            <a class="text-white nav-link " href="/admin/complaints">
                                <i class="fa-solid fa-clipboard-list nav-icon"></i>
                                <p class="pl-2">Complaints</p>
                            </a>
                        </li>
                        <li :class="{ 'selected': isSelected('/admin/billing_history') }"
                            class="border-bottom rounded-0 shadow">
                            <a class="text-white nav-link " href="/admin/billing_history">
                                <i class="fa-solid fa-clipboard-list nav-icon"></i>
                                <p class="pl-2">Billing History</p>
                            </a>
                        </li>
                        <li :class="{ 'selected': isSelected('/admin/franchises') }"
                            class="border-bottom rounded-0 shadow">
                            <a class="text-white nav-link " href="/admin/franchises">
                                <i class="fa-solid fa-store nav-icon"></i>
                                <p class="pl-2">Franchises</p>
                            </a>
                        </li>
                        <li class="rounded-0 shadow" :class="{ 'selected': isSelected('#') }">
                            <a class="text-white nav-link" href="#" @click="toggleSubMenu">
                                <i class="fa-solid fa-cash-register nav-icon"></i>
                                <p class="pl-2">Management</p>
                                <i class="fa-solid fa-arrow-down pl-5 ml-5"></i>
                            </a>
                            <ul class="collapse nav nav-sidebar flex-column dropdown-custom"
                                :class="{ 'show': isSubMenuOpen }">
                                <li :class="{ 'selected': isSelected('/admin/heads') }"
                                    class="border-bottom border-top rounded-0 shadow">
                                    <a class="pl-4 text-white nav-link " href="/admin/heads">
                                        <i class="fa-solid fa-book nav-icon text-xs"></i>
                                        <p class="pl-2">Heads</p>
                                    </a>
                                </li>
                                <li :class="{ 'selected': isSelected('/admin/accounts') }"
                                    class="border-bottom rounded-0 shadow">
                                    <a class="pl-4 text-white nav-link " href="/admin/accounts">
                                        <i class="fa-solid fa-sack-dollar nav-icon text-xs"></i>
                                        <p class="pl-2">Accounts</p>
                                    </a>
                                </li>
                                <li :class="{ 'selected': isSelected('/admin/transactions') }"
                                    class="border-bottom rounded-0 shadow">
                                    <a class="pl-4 text-white nav-link " href="/admin/transactions">
                                        <i class="fa-solid fa-file-invoice nav-icon text-xs"></i>
                                        <p class="pl-2">Ledger</p>
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
    name: 'sidebar-component',
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

.dropdown-custom {
    animation: dropdownAnimation 0.5s ease-in-out;

}

.selected .nav-link {
    color: #0a4658 !important;
}

.admin-panel-sidebar {
    background-color: rgb(9 70 88);
    margin-top: 3.5rem;
    box-shadow: rgba(0, 0, 0, 0.13) 2.4px 2.4px 3.2px;
}

.image-logo-width {
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
    margin: 0.5rem;
}

.sidebar-collapse li {
    text-align: start;
    justify-content: center;
}
</style>
