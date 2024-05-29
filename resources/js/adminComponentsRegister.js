import Vue from 'vue';

Vue.component('navbar-component', require('./components/includes/navbarComponent.vue').default);
Vue.component('sidebar-component', require('./components/includes/sidebarComponent.vue').default);
Vue.component('pagination-component', require('./components/includes/PaginationComponent.vue').default);
Vue.component('customer-notes', require('./components/CustomerNotes.vue').default);
Vue.component('doughnut-chart', require('./components/admin/Charts/Doughnut.vue').default);
Vue.component('circular-progress', require('./components/admin/Charts/CircularProgress.vue').default);

Vue.component('admin-dashboard', require('./components/admin/AdminDashboard.vue').default);

//User Modals and Listing 
Vue.component('users-component', require('./components/admin/UsersComponent.vue').default);
Vue.component('real-users-component', require('./components/admin/Users/RealUsersComponent.vue').default);
Vue.component('add-users-modal', require('./components/admin/Users/AddUserModal.vue').default);
Vue.component('billing-history-modal', require('./components/admin/Users/BIllingHistoryModal.vue').default);
Vue.component('update-bill-modal', require('./components/admin/Users/UpdateBillModal.vue').default);
Vue.component('contact-form-print', require('./components/admin/Users/ContactFormPrint.vue').default);

Vue.component('packages-list', require('./components/admin/Packages/PackagesList.vue').default);
Vue.component('package-modal', require('./components/admin/Packages/PackageModal.vue').default);
Vue.component('toggle-button', require('./components/admin/GlobalComponents/ActiveInactiveToggleComponent.vue').default);
// Vue.component('real-user-data-modal', require('./components/admin/Users/Real_User_Data_Modal.vue').default);

//Inventory 
Vue.component('inventory-list', require('./components/admin/Inventory/InventoryList.vue').default);
Vue.component('inventory-modal', require('./components/admin/Inventory/InventoryModal.vue').default);

//Employees 
Vue.component('employees-list', require('./components/admin/Employee/EmployeeComponent.vue').default);
Vue.component('employees-modal', require('./components/admin/Employee/EmployeeModal.vue').default);
Vue.component('employees-print-form-modal', require('./components/admin/Employee/EmployeeFormPrintModal.vue').default);

//Franchise 
Vue.component('franchise-list', require('./components/admin/Franchises/FranchiseList.vue').default);
Vue.component('franchise-modal', require('./components/admin/Franchises/FranchiseModel.vue').default);

//Complaints 
Vue.component('complaints-list', require('./components/admin/complaints/ComplaintsListing.vue').default);
Vue.component('complaints-modal', require('./components/admin/Complaints/ComplaintsModal.vue').default);
Vue.component('billing-history', require('./components/admin/BillingHistory/BillingHistoryList.vue').default);

//Accounting 
Vue.component('accounts-list', require('./components/admin/Accounting/Accounts/AccountsList.vue').default);
Vue.component('add-account-modal', require('./components/admin/Accounting/Accounts/AddAccountModal.vue').default);
Vue.component('ledgers-listing', require('./components/admin/Accounting/Transactions/LedgersList.vue').default);
Vue.component('heads-listing', require('./components/admin/Accounting/Heads/HeadsList.vue').default);
Vue.component('add-head-modal', require('./components/admin/Accounting/Heads/AddHeadModal.vue').default);
Vue.component('transaction-modal', require('./components/admin/Accounting/Transactions/AddTransactionModal.vue').default);
Vue.component('ledger-report', require('./components/admin/Accounting/Transactions/LedgerReport.vue').default);
Vue.component('transactions-list', require('./components/admin/Accounting/Transactions/TransactionsList.vue').default);
Vue.component('transaction-modal', require('./components/admin/Accounting/Transactions/AddTransactionModal.vue').default);