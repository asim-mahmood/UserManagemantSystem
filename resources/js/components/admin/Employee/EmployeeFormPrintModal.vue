<template>
    <div class="modal fade" id="employeePrintFormModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-target=".bd-example-modal-lg" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog mt-0 modal-xl">
            <div class="modal-content">
                <div class="modal-header">        
                    <h5>New Employee Contract Form</h5>            
                    <div class="">                       
                        <button type="button" 
                            class="close" 
                            data-dismiss="modal" 
                            aria-label="Close"
                            @click="$emit('close-modal')"
                        ><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body p-3">
                    <form id="myForm">
                        <div id="printForm">
                            <div class="d-flex justify-content-between">
                                <div class="" style="max-width: 200px; ">              
                                    <img src="/images/connect_logo.png" alt="Connect" style="max-width: 100%; height: auto; "> 
                                    <p class="text-right">Communication (Pvt Ltd)</p>                 
                                </div>
                                <div class="" style="max-width: 200px; ">
                                    <img src="/images/fiber_logo-updated.png" alt="Fiber Telecom" style="max-width: 100%; height: auto; ">
                                    <p class="text-right">Internet Service</p>  
                                </div>
                            </div>
                            <hr style=" border: 2px solid">
                            <div class="row no-gutters border-bottom border-secondary pt-2">
                                <div class="col-4">
                                    <p class="font-weight-bold">Employee Name:</p>
                                </div>
                                <div class="col-8">
                                    <p> {{ employee_data.name }}</p>
                                </div>
                            </div>
                            <div class="row no-gutters border-bottom border-secondary pt-2">
                                <div class="col-4">
                                    <p class="font-weight-bold">Father Name:</p>
                                </div>
                                <div class="col-8">
                                    <p> {{ employee_data.father_name }}</p>
                                </div>
                            </div>
                            <div class="row no-gutters border-bottom border-secondary pt-2">
                                <div class="col-4">
                                    <p class="font-weight-bold">CNIC No:</p>
                                </div>
                                <div class="col-8">
                                    <p> {{ employee_data.cnic}}</p>
                                </div>
                            </div>
                            <div class="row no-gutters border-bottom border-secondary pt-2">
                                <div class="col-4">
                                    <p class="font-weight-bold">Email</p>
                                </div>
                                <div class="col-8">
                                    <p> {{ employee_data.email}}</p>
                                </div>
                            </div>
                            <div class="row no-gutters border-bottom border-secondary pt-2">
                                <div class="col-4">
                                    <p class="font-weight-bold">Mobile No(s):</p>
                                </div>
                                <div class="col-8">
                                    <p> {{ employee_data.mobile_number}} - {{ employee_data.mobile_number2}}</p>
                                </div>
                            </div>
                            <div class="row no-gutters border-bottom border-secondary pt-2">
                                <div class="col-4">
                                    <p class="font-weight-bold">Designation:</p>
                                </div>
                                <div class="col-8">
                                    <p> {{ employee_data.post}}</p>
                                </div>
                            </div>
                            <div class="row no-gutters border-bottom border-secondary pt-2">
                                <div class="col-4">
                                    <p class="font-weight-bold">Joining Date:</p>
                                </div>
                                <div class="col-8">
                                    <p>{{ employee_data.joining_date}}</p>
                                </div>
                            </div>
                            <div class="row no-gutters border-bottom border-secondary pt-2">
                                <div class="col-4">
                                    <p class="font-weight-bold">Reference:</p>
                                </div>
                                <div class="col-8">
                                    <p>{{ employee_data.reference}}</p>
                                </div>
                            </div>
                            <div class="row no-gutters border-bottom border-secondary pt-2">
                                <div class="col-4">
                                    <p class="font-weight-bold">Salary:</p>
                                </div>
                                <div class="col-8">
                                    <p>{{ employee_data.salary}}</p>
                                </div>
                            </div>
                            <div class="row no-gutters border-bottom border-secondary pt-2">
                                <div class="col-4">
                                    <p class="font-weight-bold">Address:</p>
                                </div>
                                <div class="col-8">
                                    <p>{{ employee_data.address}}</p>
                                </div>
                            </div>
                            <div class="row no-gutters" style="margin-top: 30rem;">
                                <div class="col-12 text-right border-bottom">
                                    <p class="font-weight-bold">Employee Signature</p>
                                </div>
                            </div>
                        </div>
                        <div class="text-right p-2 border-top">
                            <button type="button" class="btn btn-outline-info mr-3 px-5" @click="printEmployeeForm">Print
                             </button>
                            <button type="button" class="btn btn-outline-danger px-5" data-dismiss="modal" @click="$emit('close-modal')"> CLOSE</button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment';
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
export default {
    name: 'employees-print-form-modal',
    props: ['employee_data'],
    components: { DatePicker },
    data() {
        return {                     
            loading: false,
            modalContent: ''           
        }
    },
    methods: {       
        printEmployeeForm() {
            const formToPrint = document.getElementById('printForm'); // Replace 'printForm' with your actual form ID
            // Create a new window
            const printWindow = window.open('', '_blank');
            // Get the HTML content of the form
            const formHTML = formToPrint.outerHTML;
            // Include Bootstrap stylesheet in the new window
            const bootstrapLink = '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">';
            // Include print styles for Bootstrap
            const printStyles = '<style type="text/css">@media print{body{visibility:visible!important}.print-section{display:block!important}.d-print-none{display:none!important}}</style>';
            // Write the form HTML, Bootstrap stylesheet, and print styles to the new window
            printWindow.document.write(`
                <html>
                <head>
                    <title>Print Form</title>
                    ${bootstrapLink}
                    ${printStyles}
                </head>
                <body>${formHTML}</body>
                </html>
            `);
            // Close the document for writing
            printWindow.document.close();
            // Introduce a small delay before printing
            setTimeout(() => {
                // Print the new window
                printWindow.print();
            }, 500); // Adjust the delay as needed
        }  
    },   
}
</script>
<style scoped>
        .custom-header {
            position: relative;
            display: flex;
            align-items: center;
        }

        .custom-header::before,
        .custom-header::after {
            content: "";
            flex: 1;
            height: 1px; /* Adjust the height of the line as needed */
            background-color: rgba(128, 128, 128, 0.708); /* Adjust the color of the line as needed */
            margin: 0px 10px; /* Adjust the spacing between the line and text as needed */
        }
</style>
