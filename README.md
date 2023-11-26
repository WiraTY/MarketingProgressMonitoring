# Marketing Progress Monitoring (MPM)

Website Marketing Progress Monitoring (MPM) dibuat untuk melakukan monitoring pengiriman penawaran produk yang dilakukan oleh perusahaan

<img src="https://github.com/WiraTY/MarketingProgressMonitoring/assets/108583774/f8622271-a495-43f0-8a37-dc2339f32e9a" width="1000" height="500">
<img src="https://github.com/WiraTY/MarketingProgressMonitoring/assets/108583774/ad0bcd4a-9f80-43c8-8722-e201c7c68276" width="1000" height="500">
<img src="https://github.com/WiraTY/MarketingProgressMonitoring/assets/108583774/8e395a66-d64d-4907-afb3-79c0460196d3" width="1000" height="500">
<img src="https://github.com/WiraTY/MarketingProgressMonitoring/assets/108583774/5c3d3630-a54a-4400-ac58-fd28bb121b26" width="1000" height="500">
<img src="https://github.com/WiraTY/MarketingProgressMonitoring/assets/108583774/a67e4e5f-0141-4ebd-a578-e43edf11fade" width="1000" height="500">
<img src="https://github.com/WiraTY/MarketingProgressMonitoring/assets/108583774/481d974a-5964-4dd1-a80d-72fd8688a84a" width="1000" height="500">
<img src="https://github.com/WiraTY/MarketingProgressMonitoring/assets/108583774/f44faf84-3df8-4435-8006-e5d0d8ae449a" width="1000" height="500">

# CodeIgniter 4 Framework

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds the distributable version of the framework.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

The user guide corresponding to the latest version of the framework can be found
[here](https://codeigniter4.github.io/userguide/).

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Contributing

We welcome contributions from the community.

Please read the [*Contributing to CodeIgniter*](https://github.com/codeigniter4/CodeIgniter4/blob/develop/CONTRIBUTING.md) section in the development repository.

## Server Requirements

PHP version 7.4 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
