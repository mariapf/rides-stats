
## Rides Stats

Test Application built in Laravel 7
Retrieves a list of scooters every minute through a command and stores eqch ride when comparing responses.

## Create local dev enviroment

```bash
git clone https://github.com/mariapf/rides-stats.git
cd rides-stats/
composer install --ignore-platform-reqs
php vendor/bin/homestead make
cp .env.example .env
vagrant up
vagrant ssh
php artisan migrate --seed
```

Update hosts file `/etc/hosts` using data from `./Homestead.yaml` for example.:

```
# Rides Stats
192.168.10.50 rides.test
```

Set Up Cron Jobs
```
* * * * * cd /path-to-your-project/rides-stats && php artisan schedule:run >> /dev/null 2>&1
```

## Enable database connection outside the box 
Check the pgsql version running
```bash
psql --version 
```
Edit pg_hba.conf file, e.g
```bash
sudo nano /etc/postgresql/12/main/pg_hba.conf
```
Append to end of file and save
```bash
host  all  all 0.0.0.0/0 md5
```
Restart process
```bash
sudo service postgresql restart
```
