<template>
    <div>
        <div class="container-fluid">
            <div class="row no-gutters pt-3">
                <div v-for="(userStat, index) in userStats" :key="index"
                    class="p-2 col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="pr-2">
                        <div :class="['bg-white', 'p-2', userStat.color, 'primary-border']">
                            <a :href="generateHref(userStat.cardType)">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="logo-body">
                                        <i :class="[userStat.icon, 'dashboard-icon']"></i>
                                    </div>
                                    <div class="text-center">
                                        <p class="mb-0">{{ userStat.label }}</p>
                                        <h2 :class="userStat.textcolor">{{ userStat.count ?? 0 }}</h2>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
export default {
    name: "admin-dashboard",
    props: ['total_count', 'active_count', 'in_active_count', 'pending_bill_count', 'expired_count', 'expiring_count', 'paid_count', 'new_count', 'totalEmployee', 'inactiveEmployee', 'inactiveEmployee'],
    data() {
        return {
            crud_loading: false,
            loading: false,
            notes: '',
            progressValue: 0,
            userStats: [
                {
                    icon: 'fa-solid fa-users',
                    label: 'Total Users',
                    textcolor: 'text-info',
                    count: this.total_count,
                    cardType: ''
                },
                {
                    icon: 'fa-solid fa-user-check',
                    label: 'Active Users',
                    textcolor: 'text-success',
                    count: this.active_count,
                    cardType: 'active'
                },
                {
                    icon: 'fa-solid fa-user-slash',
                    label: 'In Active Users',
                    textcolor: 'text-danger',
                    count: this.in_active_count,
                    cardType: 'inactive'
                },
                {
                    icon: 'fa-solid fa-person-circle-exclamation',
                    label: 'Pending Bill',
                    textcolor: 'text-warning',
                    count: this.pending_bill_count,
                    cardType: 'pending'
                },
                {
                    icon: 'fa-solid fa-user-xmark',
                    label: 'Expired Users',
                    textcolor: 'text-danger',
                    count: this.expired_count,
                    cardType: 'expired'
                },
                {
                    icon: 'fa-solid fa-user-clock',
                    label: 'Expiring Tomorrow',
                    textcolor: 'text-warning',
                    count: this.expiring_count,
                    cardType: 'expiring'
                },
                {
                    icon: 'fa-solid fa-user-check',
                    label: 'Paid',
                    textcolor: 'text-success',
                    count: this.paid_count,
                    cardType: 'paid'
                },
                {
                    icon: 'fa-solid fa-user-plus',
                    label: 'New Users',
                    textcolor: 'text-success',
                    count: this.new_count,
                    cardType: 'new'
                },
                // {
                //     icon: 'fa-solid fa-user-tie',
                //     label: 'Total Employees',
                //     textcolor: 'text-info',
                //     count: this.totalEmployee,
                //     cardType: 'total'
                // },
                // {
                //     icon: 'fa-solid fa-user-tie',
                //     label: 'Active Employees',
                //     textcolor: 'text-success',
                //     count: this.inactiveEmployee,
                //     cardType: 'active'
                // },
                // {
                //     icon: 'fa-solid fa-user-tie',
                //     label: 'InActive Employees',
                //     textcolor: 'text-danger',
                //     count: this.inactiveEmployee,
                //     cardType: 'active'
                // },
                // Add more objects as needed
            ],
        }
    },
    methods: {
        generateHref(cardType) {
            return `/admin/real_users/${cardType}`;
        },
    },
    computed: {
        getChartData() {
            const value = 100; // Replace this with your actual value
            const percentage = (value / 100) * 100;

            return {
                datasets: [{
                    data: [percentage, 100 - percentage],
                    backgroundColor: ['#41B883', 'rgba(255,255,255,0)'], // White color for the remaining part of the doughnut
                    borderHeight: 9,
                }],
            };
        }
    }
}
</script>

<style scoped>
.primary-border {
    border-left: 4px solid #FFA327 !important;
    box-shadow: rgba(0, 0, 0, 0.164) 1px 1px 4px;
}

.header-color {
    background-color: lightblue;
}

.logo-body {
    /* background-color: #fff0dd; */
    background-color: #20a0c7;
    box-shadow: rgba(0, 0, 0, 0.385) 1px 1px 2px;
    height: 60px;
    width: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.logo-body .dashboard-icon {
    color: white;
    font-size: 1.5rem;
}
</style>
