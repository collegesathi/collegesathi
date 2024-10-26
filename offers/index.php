<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer Page</title>
    <link rel="stylesheet" href="http://localhost/mukul/offers/style.css">
    <link rel="stylesheet" href="http://localhost/mukul/offers/developer.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
        }

        .banner {
            width: 100%;
            height: 300px;
            background-position: center;
            background-size: cover;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .offer-section {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .offer-wrap {
            flex: 1;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .offer-heading a {
            text-decoration: none;
            color: #000;
        }

        .offer-heading a strong {
            font-size: 24px;
            color: #ff5722;
        }

        .offer-points ol {
            padding-left: 20px;
        }

        .offer-points ol li {
            margin-bottom: 10px;
            font-size: 16px;
        }

        /* Glowing Referral Highlight (Hidden by Default) */
        .referral-highlight {
            display: none; /* Initially hidden */
            margin-top: 20px;
            background-color: #ffcc00;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 15px rgba(255, 204, 0, 0.5);
            font-size: 30px;
            font-weight: bold;
            color: #fff;
            text-shadow: 0 0 10px #ffcc00, 0 0 20px #ffcc00;
            animation: blinkGlow 2s infinite;
        }

        /* Blink and Glow Animation */
        @keyframes blinkGlow {
            0% {
                box-shadow: 0 0 15px rgba(255, 204, 0, 0.5), 0 0 30px rgba(255, 204, 0, 0.8);
            }
            50% {
                box-shadow: 0 0 30px rgba(255, 204, 0, 0.8), 0 0 60px rgba(255, 204, 0, 1);
            }
            100% {
                box-shadow: 0 0 15px rgba(255, 204, 0, 0.5), 0 0 30px rgba(255, 204, 0, 0.8);
            }
        }

        .table-container {
            flex: 1;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
            text-transform: uppercase;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        table td {
            font-size: 16px;
            color: #333;
        }

        /* Button Styling */
        .show-referral-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #ff5722;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .show-referral-btn:hover {
            background-color: #e64a19;
        }
    </style>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="container">
        <!-- Banner Section -->
        <a href="http://localhost/mukul/referrals">
        <div id="bannerSection" class="banner"
            style="background-image: url('http://localhost/mukul/images/diwali-referral.png');">
        </div></a>

        <!-- Offer Section with Flexbox -->
        <div class="offer-section">
            <!-- Left Section (Original Offer) -->
            <div class="offer-wrap">
                <div class="offer-heading">
                    <a href="http://localhost/mukul/referrals">
                        <strong>Earn upto ₹1,11,000!</strong>
                    </a>
                </div>
                <div class="offer-points">
              
                    <ol>
                    <a href="http://localhost/mukul/referrals">
                        <li>Offer duration 25th October 2024 00:00 to 5th November 2024 11:59 PM</li>
                        <li>Cash prize up to 1,11,000*</li>
                        <li>Check the Admission count table</li>
                        <li>Amount credited for every successful admission</li>
                        <li>Collegesathi reserves the right to withdraw the offer at any given point of time</li>
                        <li>Any offer dispute is subject to Jaipur's Jurisdiction only</li>    
                    </a>
                    </ol>
                  
                </div>
            </div>

            <!-- Right Section (Table with Same Data) -->
            <div class="table-container">
                <h3>Admission Count Table</h3>
                <table>
                    <thead>
                        <tr>
                            <th>No. of Admission</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                    <a href="http://localhost/mukul/referrals">
                        <tr>
                            <td>1 admission</td>
                            <td>5k</td>
                        </tr>
                        <tr>
                            <td>2 admission</td>
                            <td>10k</td>
                        </tr>
                        <tr>
                            <td>3 admission</td>
                            <td>15k</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Button to Show Referral Section -->
        <a href="http://localhost/mukul/referrals">
        <button class="show-referral-btn">Click For Referral Offer</button></a>

        <a href="http://localhost/mukul/referrals">
        <div id="referralSection" class="referral-highlight">
            Earn upto ₹1,11,000!
        </div></a>

    </div>
<style>
    .referral-highlight{
        display:block;
    }
</style>
   

</body>

</html>
