=== ManyLeads – All-in-One app for engaging, re-targeting & converting website visitors ===
Tags: web push notifications, on-site messages, conversion rate optimization, retargeting, social proof, nudges
 Requires at least: 3.0.1
Tested up to: 5.2
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html 


Welcome to ManyLeads – this is WordPress plugin that helps you integrate our powerful service that will turn your desktop & mobile website visitors into leads, subscribers & sales. 

== Description ==

ManyLeads wordpress plugin adds javascript code from https://cdn.manyleads.app, required to enable ManyLeads service on your wordpress site. You need active ManyLeads account.
ManyLeads’s WordPress plugin simplifies user engagement, retargeting & conversion for you. This service helps you retarget your website traffic, capture leads and sales & boost conversions.
ManyLeads App’s tools are: 
- On-site messages, for powerful engagement & lead generation
- Web push notifications, for fulminant & permanent re-targeting
- Nudge notifications, for boosting conversions & sales indirectly (Social Proof, FOMO, Custom)
You need to create an account on our service, if you don't have one yet: https://manyleads.app/registration
Terms of use: https://manyleads.app/terms
Privacy policy: https://manyleads.app/privacy-policy


== Installation ==
Wordpress : Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.

WordpressMu : Same as above

== Frequently Asked Questions ==
= How can i check that plugin is working correctly? =
Check page html source. You shold see something like 
<script type="text/javascript">
    (function(w,e,b) {
        e=w.createElement('script');
        e.type='text/javascript';
        e.async=true;
        e.src='https://cdn.manyleads.app/js/-TskdhiurB5rtHRXnQFEkSSaRaOcgo.js';
        b=w.getElementsByTagName('script')[0];
        b.parentNode.insertBefore(e,b);
    })(document);
</script>									
 where 'xxx' is 32-digit hexadecimal number. If you see 'default.js' instead - you have entered incorrect subdomain in the plugin settings

= If I use this plugin, do I need to enter any other code on my website? =
No, this plugin is sufficient by itself

== ChangeLog ==

= 1.0.0 =
* First Version


== Configuration ==

In order to use all ManyLeads tools, you need to install ManyLeads plugin on your Wordpress site.
When it’s installed you need only check Checkbox input «ManyLeads script ON» and Save changes.
After this, your added site on ManyLeads will be automatically synchronized with your WP site.
You can find more details about the plugin on the following link: https://wordpress.org/plugins 

== Adding to your template ==

header code :
`<?php wp_head();?>`

footer code : 
`<?php wp_footer();?>`



 

