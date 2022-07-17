# Introduction
### References
- [Setup MySQL Database](https://www.digitalocean.com/community/tutorials/how-to-create-a-new-user-and-grant-permissions-in-mysql)  
- [Setup Composer](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-20-04)  
- [Troubleshoot Bitbucket SSH Issues](https://support.atlassian.com/bitbucket-cloud/docs/troubleshoot-ssh-issues/)  
- [LAMP Setup](https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu-20-04)  
- [Apache Setup](https://www.digitalocean.com/community/tutorials/how-to-install-the-apache-web-server-on-ubuntu-20-04#step-5-setting-up-virtual-hosts-recommended)  
- [Bitbucket Webhooks Documentation](https://support.atlassian.com/bitbucket-cloud/docs/manage-webhooks/)  
- [Bitbucket - Webhooks Request History](https://bitbucket.org/bradsi4/webhook-cd-test/admin/webhooks)  

---

The objective of this documentation is to set up a webhook client within a Laravel application, which will allow for changes to automatically be deployed to a staging environment.

A webhook is a mechanism where an application can notify another application that something has happened. Essentially webhooks are **event-driven HTTP**.

The `spatie/laravel-webhook-client` package provides an easy way to receive webhooks within a Laravel application.

This documentation will focus only on *receiving* webhooks. However, for reference, the `spatie/laravel-webhook-server` package provides an easy way to *send* webhooks. This will be used in further documentation where we can set up a "Push to Deploy" method for deploying to production. It's not relevant for this piece of documentation however.

### Tech Stack
- PHP 8.1
- Laravel 9.x
- Vite
- Bitbucket
- Git
- Ubuntu 20.04
- Digital Ocean
- Apache
- Ngrok


# Initial Setup
## Repo Setup
Create a new Laravel project:
```
composer create-project laravel/laravel webhook-test
```

Change directory into new project and initialise a new git repo
```
cd webhook-test
git init
git add .
git commit -m "Initial commit"
```

Create new empty repo on Bitbucket

Add the git remote origin and push to remote

Update `/etc/hosts` and `Homestead.yaml` files

Run `vagrant reload --provision`

Navigate to webhooks.test in the browser - should see Laravel splash page


## Webhook Setup
### Project
Open project in PHPStorm

Install the webhook client
```
composer require spatie/laravel-webhook-client
```

Publish the config file
```
php artisan vendor:publish --provider="Spatie\WebhookClient\WebhookClientServiceProvider" --tag="webhook-client-config"
```

Publish the migration that will store the webhook calls
```
php artisan vendor:publish --provider="Spatie\WebhookClient\WebhookClientServiceProvider" --tag="webhook-client-migrations"
```

Update DB credentials in `.env`
Run `php artisan migrate`


### Bitbucket
Go to Bitbucket repo -> Repository Settings -> Webhooks -> Add Webhook  
Enter URL like so: [https://webhook-test.jamsoup.com/webhooks/deploy](https://webhook-test.jamsoup.com/webhooks/deploy)  
Edit Triggers to `Pull Request -> Merged` or `Push` for testing


## Setting Up Ngrok for Local Webhook Testing
Sign up for an account at https://ngrok.com/

Download and install Ngrok

### Installation instructions I had to use:
Download ngrok binary for Mac OS (ARM64)
Open terminal and run the following commands:
```
unzip ~/Downloads/ngrok-binary.zip
mv ~/Downloads/ngrok /usr/local/bin
```

Connect your account:
```
ngrok config add-authtoken YOUR_AUTH_TOKEN
```

To run ngrok with an application that you have inside Homestead run the following command:
```
ngrok http 192.168.56.56 --host-header=webhooks.test
```

You'll get a live URL which can be used for testing. Enter this into the Bitbucket URL field for local testing.

# Troubleshooting
### 404 When Navigating to Route
Create a new GET route and navigate to it in the browser.

If it doesn't work:
```bash
# Check syntax of Apache site configuration /etc/apache2/sites-available/yoursite.conf
sudo a2enmod mod_rewrite # enable the mod_rewrite apache module
sudo systemctl reload apache2
```

If it does work: check syntax

# Improvements
### Change ENV Variables Dynamically
Could be useful for pausing deployments  
[Change ENV Variables Dynamically - SO Post](https://stackoverflow.com/questions/32307426/how-to-change-variables-in-the-env-file-dynamically-in-laravel)

### Symfony Process to Execute Script
[Execute External Commands in Laravel - SO Post](https://stackoverflow.com/questions/54266041/how-to-execute-external-shell-commands-from-laravel-controller)
[Run Envoy from Controller - Laracasts Post](https://laracasts.com/discuss/channels/general-discussion/run-envoy-from-controller)

Note: this has now been implemented, but could do some more reading on it.  

### Syntax Highlighting of Envoy Files
[Laracasts Post](https://laracasts.com/discuss/channels/general-discussion/phpstorm-envoy-blade-template-highlighting)

### Whitelist IPs
- [IP Subnet Calculator](https://www.calculator.net/ip-subnet-calculator.html)
- [Bitbucket IP Addresses for Webhooks](https://support.atlassian.com/organization-administration/docs/ip-addresses-and-domains-for-atlassian-cloud-products/#Outgoing-Connections)
- [Atlassian Forum Post](https://community.atlassian.com/t5/Bitbucket-questions/List-of-IP-addresses-used-by-bitbucket-cloud-for-webhook/qaq-p/1203468)
- [IP Whitelist Laravel Middleware - SO Post](https://stackoverflow.com/questions/36398081/only-allow-certain-ip-addresses-to-register-a-user-in-laravel-5-2)

### Spatie Webhooks Post
[Spatie Webhooks Post](https://freek.dev/1383-sending-and-receiving-webhooks-in-laravel-apps)

### Misc
[Paulund - Deploying with Envoy](https://paulund.co.uk/deploying-with-envoy)



Webhook security, when working with webhooks:
- Be aware of attack vectors
- Always use SSL
- Consider shared secrets and hashing
- All good HTTP security practices apply
