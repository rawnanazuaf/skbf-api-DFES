<p align="center"><a href="https://skbf.co.id" target="_blank"><img src="resources/img/skbf-logo.png" width="200"></a></p>

## SKBF API

This API provides the data access to Hyundai Dealer Front End System (DFES).

## REQUIREMENT

- `PHP >= 7.4`
- `mysql >= 7.4`
- `Composer`

## INSTALLATION

- `composer install`
- `php artisan migrate` / `php artisan migrate:fresh` (for fresh installation)
- `npm install`
- `npm run dev`

## RUN

- `php artisan serve`

## API Documentation
- BASE_URL : http://dfes.skbf.co.id/api/
- CONSULTATION_IMAGE_BASE_URL : http://dfes.skbf.co.id/storage/files/ + user_id/file_name
- NEWSPROMO_IMAGE_BASE_URL : http://dfes.skbf.co.id/storage/files/news + file_name

1. Login
   - User registration : `POST /register` : register user to the system
   - User login : `POST /login` : login to the app, authenticating user
   - User logout : `POST /logout` : destroy user token
2. Consultation
   - Register : `POST /consultation` : register for a new consultation
   - Get all consultation : `GET /consultation` : get all consultation
   - View consultation detail : `GET /consultation/detail/{id}` : get the detail of the consultation
   - Update consultation data : `GET /consultation/{consultation_id}` : get the detail of the consultation
   - Delete consultation data : `GET /delete/{consultation_id}` : get the detail of the consultation
   - View My Consultation List : `GET /consultation/{sales_id}/myconsultation` : get all ongoing consultations by sales
   - View Active Consultation List : `GET /consultation/{sales_id}/active` : get all activated consultations by sales
   - View My Consultation History List : `GET /consultation/{sales_id}/history` : get all rejected/finished consultations by sales
3. News
   - `/path` : description
4. Credit Simulation
   - `/path` : description
5. FCM Push Notification
   - Save device token : `POST /device/save-token` : save device token
   - Remove device token : `POST /device/remove-token` : save device token
   - Send notification to a user : `POST /device/send-notification-one` : Send notification to a user
   - Send notification to all users : `POST /device/send-notification-all` : Send notification to all users
6. Data
   - Dashboard : `GET /dashboard/{sales_id}` : get dashboard data

### Application Progress Code ###

| Progress Code | Application Status |
| ----------- | ----------- |
| Step_1	| SLIK Credit Checking |
| Step_2	| Survey |
| Step_3	| Survey Result |
| Step_4	| Final Approval |
| Step_5	| Purchase Order |
| Step_6	| Loan Activation |
