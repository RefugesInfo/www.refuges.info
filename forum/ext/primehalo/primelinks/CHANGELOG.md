# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [1.1.13] - 2020-11-18
### Added
- Added French translation

## [1.1.12] - 2020-09-26
### Added
- Added 2 lines of updated Spanish translations

## [1.1.11] - 2020-08-24
### Changed
- Moved the SQL queries for retrieving post subjects, topic titles, and forum names from inside the main loop to outside the main loop. This should result in better perfomance for pages with posts containing a lot of those links, when that option is enabled.
- Use strtr instead of str_replace to do the link replacements

## [1.1.10] - 2020-07-14
### Fixed
- Typo in the new install_acp_module2.php file that would prevent installation

## [1.1.9] - 2020-07-12
### Added
- Decode % sequences in URLs prior to doing URL checks

### Changed
- Encoded HTML entities in regular expressions are no longer decoded prior to being inserted into the database
- Use parse_str(parse_url()) to access query varaibles instead of parsing them with regular expressions
- Escape certain template variables for use in Javascript code

### Removed
- Unused variables

## [1.1.8] - 2020-05-22
### Fixed
- It was possible that relative links to posts, topics, and forums would not show their associated titles as expected when "show titles instead of URLs" was enabled

## [1.1.7] - 2020-04-21
### Changed
- Typecast a few variables used in SQL statements to prevent SQL injection attacks (these variables were already vetted so there was no existing risk)
- Converted some leading spaces to tabs in composer.json
- Updated the README.md file to indicate phpBB 3.3 was supported

## [1.1.6] - 2019-07-23
### Fixed
- The warning "strpos(): Empty needle" would occur with empty links ([url][/url]) when the "Show titles instead of URLs" option was enabled

## [1.1.5] - 2019-01-25
### Fixed
- All ampersands ("&") used in any of the fields for regular expressions would get converted to "&amp;" before being stored into the database. If any of your regular expressions contain ampersands you will have to go to the Prime Links Settings admin page and submit the form so that they get saved in the database correctly.

## [1.1.4] - 2018-08-13
### Added
- A new option to display the post subject, topic title, or forum name instead of the URL for local links to posts, topics, and forums

### Changed
- Updated to work with PHP 7.0.12 by changing a couple preg_replace statements with preg_replace_callback statements

## [1.1.3] - 2018-05-02
### Added
- Added formal Spanish (es) and casual Spanish (es_x_tu) translations, thanks to Raul [ThE KuKa]

## [1.1.2] - 2018-04-21
### Added
- Added IDs to some form elements to match the *for* attribute values

### Changed
- Quoted the service arguments in config/services.yml

### Fixed
- Corrected some *for* attribute values that were associated with the wrong form elements

### Removed
- Removed the unused property $settings from event/main_listener.php

## [1.1.1] - 2018-04-20
### Added
- Version checking

## [1.1.0] - 2018-02-12
### Changed
- Updated the description to more accurately represent what this extension has become.

## [1.1.0 BETA 3] - 2018-02-09
### Added
- Applied external link attributes to member website links on the viewtopic page (excluding the class attribute because such links are represented as icons and not text links).

### Changed
- For assigning template variables to the member list page, switched from using a core event that was new to phpBB 3.2 to one that has existed since phpBB 3.1.7 to maintain compatibility with phpBB 3.1.

## [1.1.0 BETA 2] - 2018-02-07
### Added
- Applied external link attributes to member website links on the member list page.
- URL prefix option for internal links

### Changed
- Moved the JavaScript code from separate HTML files into a single HTML file
- Switched from phpBB template syntax to Twig template syntax

### Fixed
- A warning about the regular expression /e modifier not being supported in php 7.


## [1.1.0 BETA] - 2018-02-03
### Added
- A module to the ACP for setting options. Options are configured through this ACP module and stored in the database rather than being set directly in a PHP file.

## [1.0.0] - 2015-01-22
- First release for phpBB 3.1, ported from the Prime Links MOD for phpBB 3.0.