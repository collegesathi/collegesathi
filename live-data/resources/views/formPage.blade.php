<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Application Form</title>
    {{ HTML::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'bootstrap.min.css') }}
    {{ HTML::style(WEBSITE_CSS_URL . 'style.css') }}
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
        }

        .left-section {
            margin-left: 128px;
            width: 39%;
            background-color: azure;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .right-section {
            width: 50%;
            background-color: antiquewhite;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .left-section h2 {
            text-align: center;
            background: #d3d3d340;
            box-shadow: 5px 15px 30px rgb(27 34 47 / 8%);    
            padding: 27px 5px;
            border-radius: 24px;
            border: 2px solid;
            font-size: 22px;
            color: red;
            margin-bottom: 10px;
        }

        .left-section ul {
            background: lightgoldenrodyellow;
            border-radius: 27px;
            border: 2px solid;
            list-style: none;
            margin-top: 20px;
            text-align: center;
        }

        .left-section ul li {
            margin-left: -30px;
            margin-bottom: 10px;
            color: black;
        }

        .logos-container {
            margin-top: 20px;
            overflow: hidden; /* Hide overflow */
            height: 100px; /* Set a height to contain the logos */
        }

        .logos {
            display: flex;
            animation: slide 20s linear infinite; /* Continuous sliding */
        }

        .logos img {
            width: 100px;
            margin: 10px;
        }

        @keyframes slide {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%); /* Slide 50% to allow seamless effect */
            }
        }

        /* Below logos image */
        .below-logo-img {
            margin-top: 30px; /* Spacing between logos and image */
            display: flex;
            justify-content: center;
        }

        .below-logo-img img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Right Section - Form */
        .right-section h2 {
            font-size: 24px;
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .right-section p {
            text-align: center;
            color: #28a745;
            margin-bottom: 20px;
        }

        form label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 13px;
        }

        .phone-input {
            display: flex;
            align-items: center;
        }

        .phone-input select {
            width: 70px;
            margin-right: 10px;
        }

        button {
            margin-top: 32px;
            width: 100%;
            padding: 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .footer-note {
            margin-top: 20px;
            /* font-size: 12px; */
            text-align: center;
            color: #666;
        }

        @media (max-width: 991px) {
            .left-section {
                display: none;
            }
            .right-section {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Left Section -->
    <div class="left-section">
        <h2>India's leading universities on a single platform within two minutes.</h2>
        <div class="logos-container">
            <div class="logos">
                <!-- Add your logos here, use img tags to fill the space -->
                <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt="Logo 1">
                <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo12.jpg" alt="Logo 2">
                <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo2.jpg" alt="Logo 3">
                <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt="Logo 4">
                <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo13.jpg" alt="Logo 5">
                <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo9.jpg" alt="Logo 6">
                <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo1.jpg" alt="Logo 7">
                <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo2.jpg" alt="Logo 8">
                <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt="Logo 9">
                <!-- Duplicate logos for seamless sliding -->
                <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo5.jpg" alt="Logo 1">
                <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo6.jpg" alt="Logo 2">
                <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt="Logo 3">
                <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo1.jpg" alt="Logo 4">
                <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo3.jpg" alt="Logo 5">
                <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt="Logo 6">
                <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt="Logo 7">
                <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo2.jpg" alt="Logo 8">
                <img src="{{ WEBSITE_IMG_URL }}Online-Education-logo4.jpg" alt="Logo 9">
            </div>
        </div>
        <ul>
          
            
            <li>👉 Timely updates</li>
            <li>👉 24*7 assistance</li>
            <li>👉 Experienced experts</li>
            <li>👉 Unbiased guidance</li>
            <li>👉 100% post admission support</li>
            <li>👉 No Cost emi options available</li>
            <li>👉 100+ Online approved universities</li>       
        </ul>

        <!-- Image below logos -->
        <div class="below-logo-img">
            <img src="https://www.collegesathi.com/images/step-img.gif" alt="Promo Image">
        </div>
    </div>

    <!-- Right Section - Form -->
    <div class="right-section">
        <div class="header">
            <h2>Apply from 100+ Online Approved Universities</h2>
            <p><strong>No-Cost EMI From ₹4,999</strong></p>
        </div>
        <div class="bg-light d-flex fs-11 align-items-center justify-content-center gap-2 mt-0 flex-wrap py-3 shadow-sm rounded" style="background: #f9f9f9; border: 1px solid #ddd;">
                        <img src="https://www.collegesathi.com/images/expertimages-01.svg" alt="Team image" style="width: 50px; height: auto;" class="rounded-circle">
                        <span class="fw-bold fs-12 text-dark">Consult with our Collegesathi experts.</span>
                        <span class="text-warning"><i class="fas fa-handshake"></i></span>
                    </div>

        <!-- Form for submission -->
        <form id="applyForm" action="{{ route('submitForm') }}" method="POST">
            @csrf
            <label for="fullName">Full Name*</label>
            <input type="text" id="fullName" name="fullName" required>

            <label for="gender">Gender*</label>
            <select id="gender" name="gender" required>
                <option value="1">Male</option>
                <option value="2">Female</option>
                <option value="3">Other</option>
            </select>

            <label for="email">Email*</label>
            <input type="email" id="email" name="email" required>

            <label for="mobileNumber">Mobile Number*</label>
            <div class="phone-input">
                <select id="countryCode">
                    <option value="+91">+91</option>
                </select>
                <input type="tel" id="mobileNumber" name="mobileNumber" placeholder="Enter your mobile number" required>
            </div>

            <label for="dob">Date of Birth*</label>
            <input type="date" id="dob" name="dob" required>
            <input id="country" name="country" type="hidden" value="101">
            <label for="state">State*</label>
            <select id="state" name="state">
                <option value="" disabled selected>Select your state</option>
                <option value="4023">Andaman and Nicobar Islands</option>
                        <option value="4017">Andhra Pradesh</option>
                        <option value="4024">Arunachal Pradesh</option>
                        <option value="4027">Assam</option>
                        <option value="4037">Bihar</option>
                        <option value="4031">Chandigarh</option>
                        <option value="4040">Chhattisgarh</option>
                        <option value="4033">Dadra and Nagar Haveli and Daman and Diu</option>
                        <option value="4021">Delhi</option>
                        <option value="4009">Goa</option>
                        <option value="4030">Gujarat</option>
                        <option value="4007">Haryana</option>
                        <option value="4020">Himachal Pradesh</option>
                        <option value="4029">Jammu and Kashmir</option>
                        <option value="4025">Jharkhand</option>
                        <option value="4026">Karnataka</option>
                        <option value="4028">Kerala</option>
                        <option value="4852">Ladakh</option>
                        <option value="4019">Lakshadweep</option>
                        <option value="4039">Madhya Pradesh</option>
                        <option value="4008">Maharashtra</option>
                        <option value="4010">Manipur</option>
                        <option value="4006">Meghalaya</option>
                        <option value="4036">Mizoram</option>
                        <option value="4018">Nagaland</option>
                        <option value="4013">Odisha</option>
                        <option value="4011">Puducherry</option>
                        <option value="4015">Punjab</option>
                        <option value="4014">Rajasthan</option>
                        <option value="4034">Sikkim</option>
                        <option value="4035">Tamil Nadu</option>
                        <option value="4012">Telangana</option>
                        <option value="4038">Tripura</option>
                        <option value="4022">Uttar Pradesh</option>
                        <option value="4016">Uttarakhand</option>
                        <option value="4853">West Bengal</option>
                <!-- Add state options here -->
            </select>

            <label for="city">City*</label>
            <input type="text" id="city" name="city" required>

            <!-- <label for="specialization">Specialization*</label>
            <select id="specialization" name="specialization">
                <option value="" disabled selected>Not decided yet</option>
              
            </select> -->
            <div class="mt-3 text-center bg-gradient d-inline-block rounded p-2" style="background: linear-gradient(45deg, #6ab7ff, #007bff);">
                                    <span class="fs-12 fw-bold px-3">
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 448 512" class="lock-icon" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z">
                                            </path>
                                        </svg>
                                        Your information is safe and protected with us.
                                    </span>
                                </div>
            <div class="footer-note">
            I authorize Collegesathi to contact me via Phone, Email, WhatsApp or SMS. This will take
                                precedence over any DND or NDNC requests.
                                <a href="https://www.collegesathi.com/pages/privacy-policy" target="_blank" style="color: #007bff;">Privacy Policy</a>,
                                <a href="https://www.collegesathi.com/pages/terms-conditions" target="_blank" style="color: #007bff;">Terms of Use</a>
        </div>

            <button type="submit">Find Best University just in one click</button>
        </form>

        
    </div>
</div>

</body>
</html>
