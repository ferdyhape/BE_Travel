# BE Travel

## 👨 Creator
Name: ``` Ferdy Hahan Pradana ```

Campus: ``` Politeknik Negeri Malang ```

## 📌 Description
- This repository was created to fulfill the duties of a prospective intern as a Backend Engineer at PT Adma Digital Solusi.

## ⚙️ Feature 
1.  Authentication (Login, Register, Logout)
2.  Profile Action (Get self info & Update Profile)
3.  Travel List (list of travel companies along with trips)
4.  Booking (my booking, booking trip process, show detail booking, upload payment proof, cancel booking)

## 📎 Feature Specific Information
1.  Authentication using a ```sanctum package``` from laravel
2.  Upload image using laravel storage
3.  Filter trips based on various criteria such as price range, origin city, destination city and departure time range
4. Default booking status is ``` pending ```, if the user uploads a payment proof and travel company accept the payment, the status will change to ``` success ```, if the user cancels the booking, the status will change to ``` canceled ```.
5. The user can only upload payment proof if the booking status is ``` pending ```.
6. Users can book trips with multiple passengers. even ordered not for himself, example: for his family or friends (on this feature using the ``` JSON ``` data type to store the passenger's name and phone number in the database).

## 📃 Database Design (ERD)
<p align="center">
  <img src="https://github.com/ferdyhape/BE_Travel/assets/75787853/10200417-ecf8-492d-a6f4-e5f5f76cae4d" width="80%" height="80%">
</p>

## 🔑 API Information
Noted: because here I use the default localhost link from Laravel ``` (http://127.0.0.1:8000) ```, so you can **change the link to be your localhost link**
  <table style="width: 100%; margin:0 10px; text-align: left;">
    <tr>
      <th>*</th>
      <th>API</th>
      <th>Method</th>
      <th>Request</th>
      <th>Information</th>
    </tr>
    <tr>
      <td>1</td>
      <td>http://127.0.0.1:8000/api/login</td>
      <td>POST</td>
      <td>email, password</td>
      <td>User login endpoint. Send user's email and password to authenticate and receive a token for access.</td>
    </tr>
    <tr>
      <td>2</td>
      <td>http://127.0.0.1:8000/api/register</td>
      <td>POST</td>
      <td>name, email, password, password_confirmation, phone_number, avatar(optional)</td>
      <td>User registration endpoint. Register a new user by providing name, email, password, password confirmation, avatar (optional), and phone number.</td>
    </tr>
    <tr>
      <td>3</td>
      <td>http://127.0.0.1:8000/api/update-profile</td>
      <td>POST</td>
      <td>name, email, phone_number, avatar(optional)</td>
      <td>Update user profile data.</td>
    </tr>
    <tr>
      <td>4</td>
      <td>http://127.0.0.1:8000/api/me</td>
      <td>GET</td>
      <td>-</td>
      <td>Get user data.</td>
    </tr>
    <tr>
      <td>5</td>
      <td>http://127.0.0.1:8000/api/logout</td>
      <td>GET</td>
      <td>-</td>
      <td>Logout user.</td>
    </tr>
    <tr>
      <td>6</td>
      <td>http://127.0.0.1:8000/api/travels</td>
      <td>GET</td>
      <td>-</td>
      <td>Show list of trips with travel company data.</td>
    </tr>
    <tr>
      <td>7</td>
      <td>http://127.0.0.1:8000/api/travels/filter/</td>
      <td>POST</td>
      <td>min_price, max_price, departure_city, destination_city, min_departure_time, max_departure_time (All requests are optional)</td>
      <td>Filter trips based on various criteria such as price range, departure city, destination city, and departure time.</td>
    </tr>
    <tr>
      <td>8</td>
      <td>http://127.0.0.1:8000/api/travels-company</td>
      <td>GET</td>
      <td>-</td>
      <td>Show list of travel company data.</td>
    </tr>
    <tr>
      <td>9</td>
      <td>http://127.0.0.1:8000/api/my-booking</td>
      <td>GET</td>
      <td>-</td>
      <td>Show user's booking list.</td>
    </tr>
    <tr>
      <td>10</td>
      <td>http://127.0.0.1:8000/api/booking</td>
      <td>POST</td>
      <td>travel_trip_id, passengers[name][*], passengers[phone_number][*], payment_proof(optional)</td>
      <td>Create a new booking for a travel trip. Provide the travel trip ID, passenger names and phone numbers, and an optional payment proof if available.</td>
    </tr>
    <tr>
      <td>11</td>
      <td>http://127.0.0.1:8000/api/booking/{id}</td>
      <td>GET</td>
      <td>-</td>
      <td>Show details of a booking by ID.</td>
    </tr>
    <tr>
      <td>12</td>
      <td>http://127.0.0.1:8000/api/booking/{id}/payment-proof</td>
      <td>POST</td>
      <td>payment_proof</td>
      <td>Upload payment proof for a booking identified by its ID.</td>
    </tr>
    <tr>
      <td>13</td>
      <td>http://127.0.0.1:8000/api/booking/{id}/cancel</td>
      <td>POST</td>
      <td>-</td>
      <td>Cancel a booking identified by its ID.</td>
    </tr>
  </table>


### 🔗 About Creator
[![portfolio](https://img.shields.io/badge/my_portfolio-000?style=for-the-badge&logo=ko-fi&logoColor=white)](https://www.ferdyhape.site/)
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/ferdy-hahan-pradana)
[![instagram](https://img.shields.io/badge/instagram-833AB4?style=for-the-badge&logo=instagram&logoColor=white)](https://instagram.com/ferdyhape)
[![github](https://img.shields.io/badge/github-333?style=for-the-badge&logo=github&logoColor=white)](https://github.com/ferdyhape)
