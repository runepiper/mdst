[![License](https://img.shields.io/github/license/runepiper/mdst.svg)](https://github.com/runepiper/mdst/blob/master/LICENSE)

# MDST

This package provides a small iCal service for having »Mach deine Scheiße Tag« automatically in your calendar 🛠

## How to use

```php
require_once 'vendor/autoload.php';

header('Content-Type:text/calendar;charset=UTF-8');
header('Content-Disposition:inline;filename=mdst.ics');

echo \RP\MDSTService::render();
```

That's it 🚀
