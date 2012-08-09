# How to Export Your Google Search History (PHP Version)

## Step 1  
Enable Google Web History. If you're militant about privacy, this probably isn't for you. It will save your search history in your Google account (only applies when you're logged in during the search).

## Step 2  
Log in to your Google account and save your cookie file somewhere where you can use it for a cURL request. This needs to be saved in the Netscape standard `cookies.txt` format. If you have an early version of Firefox, your cookies may already be in this format, so you just need to find the file. If you have a more recent version of Firefox, you will need to export your cookies to that format using an add-on like Export Cookies 1.0. If you're using Internet Explorer, there is a built-in Import/Export Wizard to export your cookies to the `cookies.txt` format. For other browsers, investigate how your browser stores cookies and how to export them into the `cookies.txt` format. 

## Step 3  
Modify `gethistory.php` to use the option you want for how to deal with the results.  You can output them as text, save them to a database, or do something else.

## Step 4  
Put the `cookies.txt` file and `gethistory.php` somewhere where you can execute the script

## Step 5  
Execute the script! 

**IMPORTANT: Don't put these files in a public location (like a web-accessible server), or else people can find your login cookies and/or see your search history.**

### Contact  
[noah@noahveltman.com](mailto:noah@noahveltman.com)  
[http://noahveltman.com/](http://noahveltman.com/)