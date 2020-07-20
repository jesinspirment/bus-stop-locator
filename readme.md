# bus-stop-locator

To set up this repository on your local, please follow the instructions as below:

1. Clone the repository using git clone.
2. Modify the .env file and ensure database settings are correct.
3. Execute "php artisan migrate --seed", then "php artisan passport:install".
4. Go to your database, under oauth_clients table, copy the value of the "secret" column of the 2nd row (i.e. password client).
5. In .env file, set the MIX_CLIENT_ID to 2, and MIX_CLIENT_SECRET to the value you copied from the previous step.
6. Run "php artisan config:cache".
7. Run "npm install", followed by "npm run production".

Now the app should be ready by accessing the project root from browser.
