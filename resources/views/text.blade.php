<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Fiber Telecom</title>

    {{--Favicon--}}
    <link rel="icon" href="{{ asset('images/fiber_logo-updated.png') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!--google icon-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free/css/all.min.css')}}">
    {{-- Theme css --}}
    {{-- <link rel="stylesheet" href="{{ mix('css/theme.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/OverlayScrollbars.min.css')}}">
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    {{-- <link rel="stylesheet" href="{{ mix('css/custom.css') }}"> --}}
    <script src="https://kit.fontawesome.com/1d3f86284c.js" crossorigin="anonymous"></script>
    <title>New Internet Connection Registration Form</title>
</head>

<body>

    <h2>Communication (Pvt Ltd) - Internet Service</h2>

    <h3>Registration Form for New Internet Connection</h3>

    <form action="submit_form.php" method="post">

        <label for="valid_id">Do You Have Valid National Identity Card?</label>
        <input type="radio" id="valid_id_yes" name="valid_id" value="Yes">
        <label for="valid_id_yes">Yes</label>
        <input type="radio" id="valid_id_no" name="valid_id" value="No">
        <label for="valid_id_no">No</label><br>
        <label for="date">Date:</label>
        <input type="text" id="date" name="date"><br><br>

        <h4>Customer Information</h4>

        <label for="customer_name">Customer Name:</label>
        <input type="text" id="customer_name" name="customer_name"><br>
        <label for="cnic">CNIC No:</label>
        <input type="text" id="cnic" name="cnic"><br>
        <label for="mobile">Mobile No:</label>
        <input type="text" id="mobile" name="mobile"><br>
        <label for="address">Address:</label>
        <textarea id="address" name="address"></textarea><br>
        <label for="email">Email Address:</label>
        <input type="text" id="email" name="email"><br><br>

        <h4>Available Internet Packages</h4>

        <p>2MBSpeed, 3MBSpeed, 6MBSpeed, 10MBSpeed, 12MBSpeed, 16MBSpeed, 20MBSpeed, 30MBSpeed</p>
        <p>All Internet Packages Unlimited Data.</p>
        <p>All Internet Packages Inclusive Taxes.</p>

        <label for="shared_package">Shared Package:</label>
        <input type="text" id="shared_package" name="shared_package">
        <label for="devices_purchasing_company">Devices Purchasing - From Company:</label>
        <input type="radio" id="devices_purchasing_company" name="devices_purchasing" value="Company">
        <label for="devices_purchasing_external">External Purchasing:</label>
        <input type="radio" id="devices_purchasing_external" name="devices_purchasing" value="External"><br>
        <label for="package_price">Package PRs:</label>
        <input type="text" id="package_price" name="package_price"><br>
        <label for="installation_charges">Installation Charges:</label>
        <input type="text" id="installation_charges" name="installation_charges"><br>
        <label for="internal_devices_charges">Internal Devices Charges:</label>
        <input type="text" id="internal_devices_charges" name="internal_devices_charges"><br>
        <label for="security_charges">Security:</label>
        <input type="text" id="security_charges" name="security_charges"><br>
        <label for="total_payment">Total Payment:</label>
        <input type="text" id="total_payment" name="total_payment"><br><br>

        <h4>Sales Representative</h4>

        <label for="sales_representative">Sales Representative:</label>
        <input type="text" id="sales_representative" name="sales_representative"><br><br>

        <h4>Customer's Signature</h4>

        <h5>Term & Conditions</h5>
        <p>Please read the following terms and conditions carefully before signing the Customer Agreement Form between Connect Communication (Pvt Ltd) and the Customer:</p>
        <ul>
            <li>Rates and Charges as long as customer subscribes to the service, Customer agrees to pay in advance the applicable service rate for the service plan.</li>
            <li>If the customer breaks the devices, incurs water damage, or does not return the device, they will pay the full device payment.</li>
            <!-- Include other terms and conditions as per your requirement -->
        </ul>

        <label for="customer_signature">Customer's Signature:</label>
        <input type="text" id="customer_signature" name="customer_signature"><br><br>

        <input type="submit" value="Submit">
    </form>

</body>

</html>