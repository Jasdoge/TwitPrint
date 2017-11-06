<p align="center">
  <img src="https://i.imgur.com/8q01aYF.jpg">
</p>

# TwitPrint
Simple PHP script which prints a recent picture from twitter based on hashtags.

# Install
1. Make sure you have installed and set up CUPS for printing. On raspbian you can install the dependencies via:
`sudo apt-get install php php7.0-gd php7.0-curl composer git`
2. Navigate to your home directory `cd`
3. Clone this repo by running: `git clone https://github.com/Jasdoge/TwitPrint`
4. Navigate to TwitPrint: `cd TwitPrint`
5. Install libraries: `composer update`
6. Go to https://apps.twitter.com/ and create an app. Name it anything you like, and you can enter any url in the URL origin of your app.
7. Edit config.php, ex: `nano config.php`
8. Enter your consumer key from twitter in the define() statements. Ex: `define('CONSUMER_KEY', 'pasteConsumerKeyHere'); define('CONSUMER_SECRET', 'pasteConsumerSecretHere');`
9. (Optional) Edit the hashtag array. By default it will search for posts including the hashtag `#shibainu`
10. Hit ctrl+x and enter to save.
11. Test by running `php print.php`
12. Run `crontab -e` to bring up the cronjob editor. You may need to pick an editor to use, you can just hit enter here to select nano (default in raspbian as of writing).
13. Below all the # commented out commands enter `0 19 0 0 5 php /home/pi/TwitPrint/print.php` to run the print every friday at 7 PM.


# Background
My printer kept clogging up. In order to prevent this, I wrote a small PHP script that will print images from twitter. I have it installed on a cronjob on a raspberry pi to print once every friday.
